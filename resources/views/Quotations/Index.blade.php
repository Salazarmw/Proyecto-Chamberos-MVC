@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Cotizaciones</h1>
        <div class="flex gap-6">
            <!-- Filtros -->
            <div class="w-1/4 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Filtros</h2>
                <form id="filters-form">
                    <div class="mb-4">
                        <input type="checkbox" id="filter1" name="filter1" class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter1" class="ml-2 text-gray-700 dark:text-gray-300">Pendientes</label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="filter2" name="filter2" class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter2" class="ml-2 text-gray-700 dark:text-gray-300">Aceptadas</label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="filter3" name="filter3" class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter3" class="ml-2 text-gray-700 dark:text-gray-300">Rechazadas</label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="filter4" name="filter4" class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <label for="filter4" class="ml-2 text-gray-700 dark:text-gray-300">Completadas</label>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quotations as $quotation)
                            <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $quotation->id }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $quotation->service_description }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $quotation->scheduled_date }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200">₡{{ number_format($quotation->price, 2) }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-gray-800 dark:text-gray-200 capitalize">{{ $quotation->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-600 dark:text-gray-400">No hay cotizaciones disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
