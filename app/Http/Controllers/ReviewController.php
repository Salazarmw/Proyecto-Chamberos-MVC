<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($userId)
    {
        $reviews = Review::where('to_user_id', $userId)
                         ->skip(request()->input('offset'))
                         ->take(request()->input('limit'))
                         ->get();

        return response()->json(['reviews' => $reviews]);
    }
}
