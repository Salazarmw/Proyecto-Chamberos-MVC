<?php

namespace App\Http\Controllers;

use App\Models\ChamberoProfile;
use App\Models\Province;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChamberoProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all provinces
        //$provinces = Province::with('cantons')->get();


        // Get all chamberos
        $users = User::where('user_type', 'chambero')->get();

        // Get all tags
        $tags = Tag::all();


        return view('dashboard', compact('users', 'tags'));
    }
}
