<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $tags = Tag::all();

        return view('profile.edit', [
            'user' => $user,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'Debes estar autenticado para actualizar tu perfil.']);
        }

        // Check if the email already exists for another user
        if ($request->email !== $user->email) {
            $request->validate([
                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255',
                    Rule::unique(User::class)->ignore($user->id), // Ignore current user ID
                ],
            ]);
        }

        // Validate the date of birth to ensure the user is at least 18 years old
        if ($request->birth_date) {
            $birthDate = \Carbon\Carbon::parse($request->birth_date);
            if ($birthDate->diffInYears(now()) < 18) {
                return redirect()->route('profile.edit')->withErrors(['birth_date' => 'Debes ser mayor de 18 años.']);
            }
        }

        Log::info('Attempting to store profile photo:', ['file' => $request->file('profile_photo')]);
        // Handle profile photo upload (existing logic)
        if ($request->hasFile('profile_photo')) {
            // Delete previous photo if it exists
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            // Save new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Fill the model with validated data
        $validatedData = $request->validated();
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle tags for chambero users
        if ($user->user_type == 'chambero') {
            $tags = $request->input('tags', []);
            
            // Validate tag selection
            $validTags = Tag::whereIn('id', $tags)->pluck('id');
            
            // Sync tags, limiting to 10 tags
            $user->tags()->sync($validTags->take(10));
        }

        if ($user->wasChanged()) {
            Log::info('User updated successfully:', ['user' => $user]);
        } else {
            Log::warning('User not updated:', ['user' => $user]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Show a specific user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
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
