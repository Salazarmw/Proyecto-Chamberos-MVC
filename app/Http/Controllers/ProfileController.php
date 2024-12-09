<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use App\Models\UsersTag;
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
        $tags = Tag::all();

        return view('profile.edit', [
            'user' => $request->user(),
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

        // Fill the model with validated data
        $validatedData = $request->validated();
        $user->fill($validatedData);

        Log::info('Attempting to store profile photo:', ['file' => $request->file('profile_photo')]);
        // Handle profile photo upload (existing logic)
        if ($request->hasFile('profile_photo')) {
            // Delete previous photo if it exists
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            // Save new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            Log::info('Path to store profile photo:', ['file' => $path]);
            $user->profile_photo = $path;
        }

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
     * Show a specific user profile.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Load reviews and calculate average rating and count
        $reviews = Review::where('to_user_id', $user->id)->with('fromUser')->get();
        $averageRating = $reviews->avg('rating');
        $ratingCount = $reviews->count();

        // Get tags associated with the user
        $tags = UsersTag::where('idChambero', $user->id)
            ->with('tag') // Eager load the related tags
            ->get()
            ->pluck('tag.description');

        return view('profile.view-profile', compact('user', 'reviews', 'averageRating', 'ratingCount', 'tags'));
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
