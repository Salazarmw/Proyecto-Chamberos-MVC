<!-- resources/views/Jobs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Trabajos</h1>

        <div class="flex gap-6">
            <!-- Filtros -->
            <div class="w-1/4 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Filtrar trabajos</h2>
                <form method="GET" action="{{ route('jobs') }}" class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="status[]" value="failed"
                            class="form-checkbox h-5 w-5 text-red-600 dark:text-red-400">
                        <span class="text-gray-700 dark:text-gray-300">Failed</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="status[]" value="in_progress"
                            class="form-checkbox h-5 w-5 text-yellow-600 dark:text-yellow-400">
                        <span class="text-gray-700 dark:text-gray-300">In Progress</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="status[]" value="completed"
                            class="form-checkbox h-5 w-5 text-green-600 dark:text-green-400">
                        <span class="text-gray-700 dark:text-gray-300">Completed</span>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-md shadow-lg hover:bg-indigo-700 focus:outline-none">
                        Filtrar
                    </button>
                </form>
            </div>

            <!-- Tabla de trabajos -->
            <div class="w-3/4 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Trabajo ID</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Descripción</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Estado</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr
                                class="border-b border-gray-300 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-blue-600">
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                                    {{ $job->id }}</td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                                    {{ $job->quotation->service_description ?? 'Sin descripción' }}
                                </td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200 capitalize">
                                    {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                </td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                    @if ($job->status === 'in_progress')
                                        <div class="flex gap-2">
                                            @if (Auth::user()->user_type === 'client' && $job->client_ok !== 'success')
                                                <button onclick="handleJobAction('success', {{ $job->id }})"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">
                                                    Terminar
                                                </button>
                                                <button onclick="handleJobAction('failed', {{ $job->id }})"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
                                                    Cancelar
                                                </button>
                                            @endif

                                            @if (Auth::user()->user_type === 'chambero' && $job->chambero_ok !== 'success')
                                                <button onclick="handleJobAction('success', {{ $job->id }})"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">
                                                    Terminar
                                                </button>
                                                <button onclick="handleJobAction('failed', {{ $job->id }})"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
                                                    Cancelar
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-600 dark:text-gray-400">No hay trabajos
                                    disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        async function handleJobAction(action, jobId) {
            try {
                const response = await fetch(`/jobs/${jobId}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        action
                    }),
                });

                if (response.ok) {
                    location.reload();
                } else {
                    alert('Ocurrió un error. Intente nuevamente.');
                }
            } catch (error) {
                console.error(error);
                alert('Error de red. Verifique su conexión.');
            }
        }
    </script>
@endsection
