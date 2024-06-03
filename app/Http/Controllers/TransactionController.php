<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;

class TransactionController extends Controller
{
    /**
     * Create a Stripe Checkout session for payment.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ApiErrorException
     */
    public function createCheckoutSession(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $user = Auth::user();

        Stripe::setApiKey(Config::get('stripe.secret'));

        try {
            // Create or retrieve customer
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $booking->car->model,
                        ],
                        'unit_amount' => $booking->total_price * 100, // Stripe expects amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'customer' => $customer->id, // Explicitly setting the customer ID
                'mode' => 'payment',
                'success_url' => route('transactions.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('transactions.cancel'),
            ]);

            return redirect()->away($session->url);
        } catch (ApiErrorException $e) {
            \Log::error('Error creating Stripe session: ' . $e->getMessage());
            return back()->with('error', 'Error creating Stripe session: ' . $e->getMessage());
        }
    }

    /**
     * Handle payment success.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function success(Request $request)
    {
        Stripe::setApiKey(Config::get('stripe.secret'));

        try {
            $sessionId = $request->get('session_id');
            if (!$sessionId) {
                \Log::error('Session ID missing.');
                return redirect()->route('home')->with('error', 'Session ID missing.');
            }

            $session = Session::retrieve($sessionId);
            \Log::info('Session data: ' . json_encode($session));

            if (!isset($session->customer) || !$session->customer) {
                \Log::error('Customer ID is missing in the session.');
                return redirect()->route('home')->with('error', 'Customer ID is missing in the session.');
            }

            $customer = \Stripe\Customer::retrieve($session->customer);
            \Log::info('Customer data: ' . json_encode($customer));

            $user = Auth::user();
            $booking = Booking::where('user_id', $user->id)->latest()->first();

            // Mark booking as paid and confirmed
            $booking->status = 'confirmed';
            $booking->save();

            // Create transaction record
            Transaction::create([
                'user_id' => $user->id,
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'status' => 'completed',
                'payment_date' => now(),
                'payment_method' => 'stripe',
            ]);

            // Send confirmation email
            Mail::to($user->email)->send(new BookingConfirmed($booking));

            return view('transactions.success', [
                'customer' => $customer,
                'booking' => $booking,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in success method: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error retrieving session: ' . $e->getMessage());
        }
    }

    /**
     * Handle payment cancellation.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cancel()
    {
        return view('transactions.cancel');
    }
}
