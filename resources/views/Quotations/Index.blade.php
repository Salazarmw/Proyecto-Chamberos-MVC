@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Cotizaciones</h1>
        <div class="flex gap-6">
            <!-- Filtros -->
            <div class="w-1/4 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Filtros</h2>
                <form id="filters-form">
                    <div class="mb-4">
                        <input type="checkbox" id="filter1" name="filter1"
                            class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter1" class="ml-2 text-gray-700 dark:text-gray-300">Pendientes</label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="filter4" name="filter4"
                            class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter4" class="ml-2 text-gray-700 dark:text-gray-300">Contraofertas</label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="filter2" name="filter2"
                            class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter2" class="ml-2 text-gray-700 dark:text-gray-300">Aceptadas</label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="filter3" name="filter3"
                            class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter3" class="ml-2 text-gray-700 dark:text-gray-300">Rechazadas</label>
                    </div>
                </form>
            </div>

            <!-- Tabla de Cotizaciones -->
            <div class="w-3/4 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">ID</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Descripción</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Fecha Programada</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Precio</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Estado</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quotations as $quotation)
                            <tr
                                class="border-b border-gray-300 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-blue-600">
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                                    {{ $quotation->id }}</td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                                    {{ $quotation->service_description }}</td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                                    {{ $quotation->scheduled_date }}</td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                                    ₡{{ number_format($quotation->price, 2) }}</td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200 capitalize">
                                    {{ $quotation->status }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                    @if (auth()->user()->user_type === 'chambero' && $quotation->status === 'pending')
                                        <div class="flex gap-2">
                                            <button onclick="handleAction('accept', {{ $quotation->id }})"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">
                                                Aceptar
                                            </button>
                                            <button onclick="handleAction('reject', {{ $quotation->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
                                                Rechazar
                                            </button>
                                            <button onclick="handleAction('counteroffer', {{ $quotation->id }})"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">
                                                Contra Oferta
                                            </button>
                                        </div>
                                    @elseif (auth()->user()->user_type === 'client' && $quotation->status === 'offer')
                                        <div class="flex gap-2">
                                            <button onclick="handleAction('accept', {{ $quotation->id }})"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">
                                                Aceptar
                                            </button>
                                            <button onclick="handleAction('reject', {{ $quotation->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
                                                Rechazar
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-600 dark:text-gray-400">No hay
                                    cotizaciones disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        async function handleAction(action, quotationId) {
    if (action === 'counteroffer') {
        // Redirect to the counteroffer page instead of using fetch
        window.location.href = `/quotations/${quotationId}/counteroffer`;
        return;
    }

    try {
        const response = await fetch(`/quotations/${quotationId}/${action}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
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
