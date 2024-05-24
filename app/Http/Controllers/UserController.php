<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('users.index');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        \Log::info('Store User Request: ', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
            'phone_number' => 'nullable|string|max:20',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|string',
        ]);

        \Log::info('Validation passed.');

        if ($request->hasFile('user_image')) {
            \Log::info('File is present.');
            $imagePath = $request->file('user_image')->store('user_images','public');
            \Log::info('Image Path: ' . $imagePath);

            $data = $request->all();
            $data['user_image'] = $imagePath;

            $user = User::create($data);
            \Log::info('User created with ID: ' . $user->id);
        } else {
            \Log::info('File is not present.');
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    // Display the specified resource
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified resource
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,user',
            'phone_number' => 'nullable|string|max:20',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|string',
        ]);

        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('user_images', 'public');
            $user->user_image = $imagePath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}

