<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Job;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($jobId)
    {
        // Obtain information about the job and user to review
        $job = Job::findOrFail($jobId);
        $quotation = Quotation::findOrFail($job->quotation_id);

        $toUser = User::findOrFail($quotation->chambero_id);

        if ($job->status === 'completed') {
            return view('reviews.create', compact('job', 'toUser'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
            'to_user_id' => 'required|exists:users,id',
            'requested_job_id' => 'required|exists:jobs,id',
        ]);

        Review::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $validated['to_user_id'],
            'requested_job_id' => $validated['requested_job_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $user = User::findOrFail(Auth::id());

        // Update user status to false in blocked_for_review
        $user->blocked_for_review = null;
        $user->save();

        return redirect()->route('jobs')->with('success', 'Review enviada correctamente!');
    }
}
