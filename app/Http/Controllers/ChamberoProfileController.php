<?php

namespace App\Http\Controllers;

use App\Models\ChamberoProfile;
use App\Models\User;
use Illuminate\Http\Request;

class ChamberoProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chamberoProfiles = ChamberoProfile::with('user')->get();
        return view('dashboard', compact('chamberoProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('chambero_profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'profile_completed' => 'boolean',
        ]);

        ChamberoProfile::create($validated);
        return redirect()->route('chambero_profiles.index')->with('success', 'Perfil creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('chambero_profiles.show', compact('chamberoProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        return view('chambero_profiles.edit', compact('chamberoProfile', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChamberoProfile $chamberoProfile)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'profile_completed' => 'boolean',
        ]);

        $chamberoProfile->update($validated);
        return redirect()->route('chambero_profiles.index')->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChamberoProfile $chamberoProfile)
    {
        $chamberoProfile->delete();
        return redirect()->route('chambero_profiles.index')->with('success', 'Perfil eliminado exitosamente.');
    }
}
