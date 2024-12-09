<!-- resources/views/components/card.blade.php -->

@props(['title', 'description', 'phone', 'province', 'canton', 'address', 'profile_photo', 'user_id'])

<div
    class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 shadow-md bg-white dark:bg-gray-800 max-w-xs w-full h-[350px]">
    <div class="flex items-center gap-4">
        <img src="{{ Storage::url($profile_photo) }}" alt="{{ __('Profile Photo') }}"
            class="w-12 h-12 rounded-full object-cover">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $title }}</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $description }}</p>
        </div>
    </div>
    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
        <p><strong>Teléfono:</strong> {{ $phone }}</p>
        <p><strong>Provincia:</strong> {{ $province }}</p>
        <p><strong>Cantón:</strong> {{ $canton }}</p>
        <p><strong>Dirección:</strong> {{ $address }}</p>
    </div>
    <div class="mt-4 flex space-x-2">
        <a href="{{ route('profile.show', $user_id) }}"
        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Ver Perfil</a>
        <button
            class="w-full bg-indigo-600 text-white py-2 rounded-lg cursor-pointer hover:bg-indigo-700">Cotizar</button>
    </div>
</div>
