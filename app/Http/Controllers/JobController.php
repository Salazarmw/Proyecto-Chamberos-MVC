<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller

{
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $jobs = Job::whereHas('quotation', function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('chambero_id', $user->id);
        });

        if ($request->has('status')) {
            $jobs->whereIn('status', $request->status);
        }

        $jobs = $jobs->get();

        return view('Jobs.index', compact('jobs'));
    }

    public function updateJobStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'action' => 'required|in:success,failed',
        ]);

        $user = User::findOrFail(Auth::id());

        $job = Job::whereHas('quotation', function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('chambero_id', $user->id);
        })->find($id);

        if (!$job) {
            return response()->json(['error' => 'Trabajo no encontrado o no autorizado'], 403);
        }

        if ($user->user_type === 'client') {
            $job->client_ok = $validated['action'];
            if ($validated['action'] === 'success') {
                $user->blocked_for_review = $job->id;
                $user->save();
            }
        } elseif ($user->user_type === 'chambero') {
            $job->chambero_ok = $validated['action'];
            if ($validated['action'] === 'success') {
                $user->blocked_for_review = $job->id;
                $user->save();
            }
        } else {
            return response()->json(['error' => 'Tipo de usuario no autorizado'], 403);
        }

        if ($job->client_ok === 'success' && $job->chambero_ok === 'success') {
            $job->status = 'completed';
        } elseif ($job->client_ok === 'failed' || $job->chambero_ok === 'failed') {
            $job->status = 'failed';
        }

        $job->save();

        return response()->json(['message' => 'Estado del trabajo actualizado correctamente']);
    }
}
