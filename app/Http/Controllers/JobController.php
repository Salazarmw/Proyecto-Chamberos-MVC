<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller

{
    public function index(Request $request)
    {
        // Obtener el usuario actual
        $user = Auth::user();

        // Obtener trabajos basados en el quotation_id del usuario
        $jobs = Job::whereHas('quotation', function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('chambero_id', $user->id);
        });

        // Aplicar filtros por estado si se reciben
        if ($request->has('status')) {
            $jobs->whereIn('status', $request->status);
        }

        // Obtener los trabajos con los filtros aplicados
        $jobs = $jobs->get();

        return view('Jobs.index', compact('jobs'));
    }

    public function updateJobStatus(Request $request, $id)
    {
        // Validar la acción entrante
        $validated = $request->validate([
            'action' => 'required|in:success,failed', // Las acciones solo pueden ser 'success' o 'failed'
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Buscar el trabajo verificando que esté relacionado con el usuario
        $job = Job::whereHas('quotation', function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('chambero_id', $user->id);
        })->find($id);

        // Verificar que el trabajo exista
        if (!$job) {
            return response()->json(['error' => 'Trabajo no encontrado o no autorizado'], 403);
        }

        // Actualizar la columna correspondiente según el tipo de usuario
        if ($user->user_type === 'client') {
            $job->client_ok = $validated['action'];
        } elseif ($user->user_type === 'chambero') {
            $job->chambero_ok = $validated['action'];
        } else {
            return response()->json(['error' => 'Tipo de usuario no autorizado'], 403);
        }

        // Comprobar las columnas client_ok y chambero_ok para actualizar el estado general
        if ($job->client_ok === 'success' && $job->chambero_ok === 'success') {
            $job->status = 'completed';
        } elseif ($job->client_ok === 'failed' || $job->chambero_ok === 'failed') {
            $job->status = 'failed';
        }

        // Guardar los cambios
        $job->save();

        return response()->json(['message' => 'Estado del trabajo actualizado correctamente']);
    }
}
