@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex justify-center">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ Storage::url($chambero->profile_photo ?? 'profile-photos/DefaultImage.jpeg') }}"
                    alt="{{ __('Profile Photo') }}" class="w-16 h-16 rounded-full object-cover">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $chambero->name }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $chambero->email }}</p>
                </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                <p><strong>Teléfono:</strong> {{ $chambero->phone ?? 'Sin teléfono' }}</p>
                <p><strong>Provincia:</strong> {{ $chambero->province ?? 'Sin provincia' }}</p>
                <p><strong>Cantón:</strong> {{ $chambero->canton ?? 'Sin cantón' }}</p>
                <p><strong>Dirección:</strong> {{ $chambero->address ?? 'Sin dirección' }}</p>
            </div>

            <!-- Form -->
            <form action="{{ route('quotations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="client_id" value="{{ $clientId }}">
                <input type="hidden" name="chambero_id" value="{{ $chambero->id }}">

                <!-- Work Details -->
                <div class="mb-4">
                    <label for="work_details" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Detalles del
                        trabajo:</label>
                    <textarea id="work_details" name="service_description" rows="4"
                        class="block w-full p-2.5 bg-white border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-700"
                        placeholder="Ingrese los detalles del trabajo"></textarea>
                </div>

                <!-- Date -->
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Fecha del
                        trabajo:</label>
                    <input type="date" id="date" name="scheduled_date"
                        class="block w-full p-2.5 bg-white border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-700"
                        min="{{ \Carbon\Carbon::today()->toDateString() }}"> <!-- Fecha mínima: hoy -->
                </div>

                <!-- Offered Money -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Dinero ofrecido en
                        ₡ :</label>
                    <input type="text" id="price" name="price"
                        class="block w-full p-2.5 bg-white border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-700"
                        placeholder="Ingrese el dinero ofrecido" oninput="formatMoney(this)">
                </div>

                <!-- Buttons -->
                <div class="flex">
                    <button type="submit" class="w-5/12 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                        Enviar Cotización
                    </button>
                    <a href="/dashboard"
                        class="w-5/12 text-center bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700">
                        Cancelar Cotización
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    // Change to a .js
    function formatMoney(input) {
        let value = input.value.replace(/[^0-9]/g, ''); // Only numbers
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ","); // make big numbers have a ","
        input.value = value;
    }
</script>
