<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
/**
* Display the user's profile form.
*/
public function edit(Request $request): View
{
return view('profile.edit', [
'user' => $request->user(),
]);
}

/**
* Update the user's profile information and image.
*/
public function update(ProfileUpdateRequest $request): RedirectResponse
{
$user = $request->user();
$validatedData = $request->validated();

// Update profile information
$user->fill($validatedData);

// Update profile image
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension(); // Generate unique image name
        $image->move(public_path('images'), $imageName); // Move image to public/images directory
        $user->user_image = $imageName; // Store only the image filename
    }

// Save changes
$user->save();

if ($user->wasChanged()) {
return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

return Redirect::back()->withErrors(['Nothing to update']);
}

/**
* Delete the user's account.
*/
public function destroy(Request $request): RedirectResponse
{
$request->validateWithBag('userDeletion', [
'password' => ['required', 'current_password'],
]);

$user = $request->user();

Auth::logout();

$user->delete();

$request->session()->invalidate();
$request->session()->regenerateToken();

return Redirect::to('/');
}
}
