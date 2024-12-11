@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Enviar Contraoferta</h1>
    
    <form action="{{ route('quotations.updateCounteroffer', $quotation->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="service_description" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Descripción del Servicio</label>
            <textarea id="service_description" name="service_description" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-gray-200" rows="4" readonly>{{ $quotation->service_description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Precio (₡)</label>
            <input type="text" id="price" name="price" value="{{ $quotation->price }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <div class="mb-4">
            <label for="scheduled_date" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Fecha Programada</label>
            <input type="date" id="scheduled_date" name="scheduled_date" value="{{ $quotation->scheduled_date }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Enviar Contraoferta
            </button>
        </div>
    </form>
</div>
@endsection
