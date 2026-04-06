<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],

            'country' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:50'],
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'street_no' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:50'],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),

            'country' => $validated['country'],
            'postcode' => $validated['postcode'],
            'city' => $validated['city'],
            'street' => $validated['street'],
            'street_no' => $validated['street_no'],
            'phone_number' => $validated['phone_number'],
        ]);

        Auth::login($user);

        return redirect()->route('profile');
    }
}
