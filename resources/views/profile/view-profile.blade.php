@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex flex-col md:flex-row space-x-0 md:space-x-6 p-6">
        <!-- Profile Details Section -->
        <div class="w-full md:w-1/4 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md mb-6 md:mb-0">
            <div class="text-center">
                <img src="{{ Storage::url($user->profile_photo ?? 'profile-photos/DefaultImage.jpeg') }}"
                    alt="{{ __('Profile Photo') }}" class="w-32 h-32 rounded-full object-cover mb-4 mx-auto">
                <h5 class="text-xl font-bold">{{ $user->name }} {{ $user->lastname }}</h5>
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}"
                        class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Cotizar</a>
                </div>
            </div>
            <hr class="my-4">
            <div class="card-body">
                <h5 class="text-lg font-semibold">Skills</h5>
                <div class="flex flex-wrap mt-2">
                    @foreach ($tags as $tag)
                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            <hr class="my-4">
            <div>
                <h5 class="text-lg font-semibold">Información de Contacto</h5>
                <ul class="list-none mb-0">
                    <li><strong>Teléfono:</strong> <span class= 'text-white'>{{ $user->phone }}</span></li>
                    <li><strong>Email:</strong> <span class= 'text-white'>{{ $user->email }}</span></li>
                    <li><strong>Dirección:</strong> <span class= 'text-white'>{{ $user->address }}, {{ $user->canton }},
                            {{ $user->province }}</span></li>
                </ul>
            </div>
            <hr class="my-4">
            <div>
                <h5 class="text-lg font-semibold">Redes Sociales</h5>
                <ul class="list-none mb-0">
                    <!-- Add links or social media here as needed -->
                    <li><a href="#" class="text-indigo-600 hover:underline">Twitter</a></li>
                    <li><a href="#" class="text-indigo-600 hover:underline">Facebook</a></li>
                    <li><a href="#" class="text-indigo-600 hover:underline">LinkedIn</a></li>
                </ul>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="w-full md:w-3/4 p-6 bg-white dark:bg-gray-900 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Reseñas</h2>
            <div id="reviews-container"
                class="max-h-[300px] overflow-y-auto border border-gray-300 dark:border-gray-700 p-4 rounded-md mt-4">
                @foreach ($reviews as $review)
                    <div class="border-b pb-2 mb-2">
                        <p><strong>{{ $review->fromUser->name }}:</strong> {{ $review->comment }} - Rating:
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </p>
                        <small>{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>

            <!-- Load more button -->
            <button id="load-more" class="mt-4 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Cargar más
                reseñas</button>

            <!-- Average Rating Display -->
            @if ($averageRating)
                <p class="mt-2">Calificación promedio:
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < round($averageRating))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                    ({{ $ratingCount }} reseñas)
                </p>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/reviews.js') }}"></script>
@endsection
