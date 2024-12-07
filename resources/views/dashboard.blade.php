<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto flex space-x-6">
    <!-- Sección de Filtros (parte izquierda de la página) -->
    <div class="w-1/4 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md h-full">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Filtros</h2>

        <!-- Dropdown Menu -->
        <div class="mb-4">
            <label for="filterDropdown" class="block text-gray-700 dark:text-gray-300 mb-2">Selecciona una opción:</label>
            <select id="filterDropdown" class="w-full bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md p-2">
                <option value="opcion1">Opción 1</option>
                <option value="opcion2">Opción 2</option>
                <option value="opcion3">Opción 3</option>
                <option value="opcion4">Opción 4</option>
                <option value="opcion5">Opción 5</option>
                <option value="opcion6">Opción 6</option>
                <option value="opcion7">Opción 7</option>
            </select>
        </div>

        <!-- Botón para aplicar filtros -->
        <button class="w-full bg-indigo-600 text-white py-2 rounded-lg cursor-pointer hover:bg-indigo-700 mt-4">Filtrar</button>
    </div>

    <!-- Cuadrícula de Chamberos (derecha) -->
    <div class="w-3/4 p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Perfiles de Chamberos</h1>

        <!-- Cuadrícula con 3 columnas en pantallas medianas y grandes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            <!-- Card con información estática -->
            <x-card 
                title="Juan Pérez" 
                description="juan@example.com" 
                phone="1234-5678" 
                province="San José" 
                canton="Escazú" 
                address="Calle Ficticia 123" />
            
            <x-card 
                title="Ana Gómez" 
                description="ana@example.com" 
                phone="9876-5432" 
                province="Alajuela" 
                canton="Alajuela" 
                address="Avenida Real 456" />
            
            <x-card 
                title="Carlos López" 
                description="carlos@example.com" 
                phone="4567-8901" 
                province="Cartago" 
                canton="Cartago" 
                address="Barrio Central 789" />
            
            <x-card 
                title="Carlos aaaaa" 
                description="carlos2@example.com" 
                phone="4567-89011111" 
                province="Cartago2" 
                canton="Cartago2" 
                address="Barrio Central2 789" />
        </div>
    </div>
</div>
@endsection
