<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ChamberoProfile;
use App\Models\Province;
use App\Models\Tag;
use App\Models\User;
use App\Models\UsersTag;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
     * Display the Chambero registration view.
     */
    public function createChambero(): View
    {
        // Get all provinces and tags from the database
        $provinces = Province::all();
        $tags = Tag::all()->toArray();
        return view('auth.chambero-register', compact('tags'));
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

        return redirect()->route('login')->with('success', __('Registration successful!'));
    }

    public function storeChambero(Request $request)
    {
        // Validate input data
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
            'tags' => 'required|array|min:1',
            'tags.*' => 'exists:tags,id',
        ]);
        try {
            // Start transaction
            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'province' => $request->province,
                'canton' => $request->canton,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'user_type' => 'chambero'
            ]);

            // Create chambero profile
            $chamberoProfile = ChamberoProfile::create([
                'user_id' => $user->id,
                'profile_completed' => false,
            ]);

            // Associate tags with chambero profile
            Log::error('Chambero tags selected: ', ['tags' => $request->tags]);
            foreach ($request->tags as $tagId) {
                UsersTag::create([
                    'idChambero' => $user->id,
                    'idTags' => $tagId,
                ]);
            }

            // Fire registered event
            event(new Registered($user));

            // Commit transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('login')->with('success', __('Registration successful!'));
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Log error
            Log::error('Chambero registration failed: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withErrors(__('An error occurred during registration. Please try again.'));
        }
    }
}
