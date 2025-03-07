@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex space-x-6">
        <!-- Filters container -->
        <div class="w-1/4 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md h-full">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Filtros</h2>

            <!-- Province -->
            <div class="mt-4">
                <x-dropdown-register id="province" name="province" label="Province" :options="$provinces" required />
            </div>

            <!-- Canton -->
            <div class="mt-4">
                <x-dropdown-register id="canton" name="canton" label="Canton" :options="[]" required />
            </div>

            <!-- Tags search bar -->
            <div class="mb-4">
                <label for="searchJobs" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Buscar
                    trabajos</label>
                <input id="searchJobs" type="text" placeholder="Escribe un trabajo..."
                    class="block w-full p-2.5 bg-white border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-700">
            </div>

            <!-- Tags list -->
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Trabajos</h3>
            <div id="jobsList" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($tags as $tag)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" value="{{ $tag->id }}"
                            class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400">
                        <span class="text-gray-700 dark:text-gray-300">{{ $tag->description }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Filter button -->
            <button
                class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-md shadow-lg hover:bg-indigo-700 focus:outline-none">
                Filtrar
            </button>
        </div>

        <!-- Chamberos grid -->
        <div class="w-3/4 p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Perfiles de Chamberos</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                @forelse($users as $user)
                    <!-- Dynamic card -->
                    <x-card title="{{ $user->name }}" description="{{ $user->email }}"
                        phone="{{ $user->phone ?? 'Sin teléfono' }}" province="{{ $user->province ?? 'Sin provincia' }}"
                        canton="{{ $user->canton ?? 'Sin cantón' }}" address="{{ $user->address ?? 'Sin dirección' }}"
                        profile_photo="{{ $user->profile_photo ?? 'profile-photos/DefaultImage.jpeg' }}"
                        user_id="{{ $user->id }}" />
                @empty
                    <!-- No chamberos message -->
                    <p class="col-span-3 text-gray-700 dark:text-gray-300">No hay chamberos disponibles.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

<!-- Search script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchJobs');
        const jobsList = document.getElementById('jobsList');

        if (searchInput && jobsList) {
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();
                const jobItems = jobsList.querySelectorAll('label');

                jobItems.forEach((job) => {
                    const text = job.innerText.toLowerCase();
                    job.style.display = text.includes(query) ? 'flex' : 'none';
                });
            });
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#province').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: '/get-cantons/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#canton').empty();
                        $('#canton').append('<option value="">Select a canton</option>');
                        $.each(data, function(key, value) {
                            $('#canton').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#canton').empty();
                $('#canton').append('<option value="">Select a canton</option>');
            }
        });
    });
</script>
