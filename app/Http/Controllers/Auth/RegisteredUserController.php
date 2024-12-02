<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Get all provinces from the database
        $provinces = Province::all();

        return view('auth.register', compact('provinces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => 'required|string|max:100',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'canton' => 'required|string|max:100',
            'address' => 'required|string',
            'birth_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if ($value && now()->diffInYears($value) > 18) {
                        return $fail('Debes ser mayor de 18 años.');
                    }
                },
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create user with data from request
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'province' => $request->province,
            'canton' => $request->canton,
            'address' => $request->address,
            'birth_date' => $request->birth_date
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('login')->with('success', __('Registration successful!'));
    }
}
