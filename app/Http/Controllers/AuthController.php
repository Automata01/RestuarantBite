<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {

        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect based on role
        switch ($user->role) {

            case 'superadmin':
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'client':
            default:
                return redirect()->route('reservations.index');
        }
    }

    throw ValidationException::withMessages([
        'email' => 'The email or password is incorrect.',
    ]);
}


    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        $user = User::create([
            'name' => $validated['name'],

            'phone' => $validated['phone'],

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            // IMPORTANT:
            // Never accept role from the public form.
            'role' => 'client',
        ]);


        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Account created successfully.');
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}