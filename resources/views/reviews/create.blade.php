@extends('layouts.app')

@section('content')
    <div class="h-screen bg-gray-800">
        <div class="pt-10 md:pt-20">
            <div class="p-4 md:p-8">
                <h1 class="text-white text-center pb-8 font-light text-4xl md:text-5xl lg:text-6xl">Deja tu Review</h1>
                <form action="{{ route('reviews.store') }}" method="POST" class="flex flex-col items-center">
                    @csrf
                    <div class="md:w-3/4 lg:w-2/3 xl:w-1/2">
                        <div class="flex flex-col md:flex-row items-center">
                            <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'profile-photos/DefaultImage.jpeg') }}"
                                alt="Foto de perfil" class="rounded-full w-16 h-16 mr-4">
                            <span class="my-2 py-2 px-4 rounded-md bg-gray-900 text-gray-300 w-full md:w-1/2 md:mr-2">
                                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                            </span>
                        </div>

                        <!-- Rating Stars -->
                        <div class="my-4 flex items-center">
                            <label for="rating" class="text-gray-300 mr-4">Calificación:</label>
                            <input type="radio" name="rating" value="1" class="hidden peer" id="star1" required>
                            <label for="star1" class="cursor-pointer text-black hover:text-yellow-500 star"
                                data-value="1">★</label>
                            <input type="radio" name="rating" value="2" class="hidden peer" id="star2" required>
                            <label for="star2" class="cursor-pointer text-black hover:text-yellow-500 star"
                                data-value="2">★</label>
                            <input type="radio" name="rating" value="3" class="hidden peer" id="star3" required>
                            <label for="star3" class="cursor-pointer text-black hover:text-yellow-500 star"
                                data-value="3">★</label>
                            <input type="radio" name="rating" value="4" class="hidden peer" id="star4" required>
                            <label for="star4" class="cursor-pointer text-black hover:text-yellow-500 star"
                                data-value="4">★</label>
                            <input type="radio" name="rating" value="5" class="hidden peer" id="star5" required>
                            <label for="star5" class="cursor-pointer text-black hover:text-yellow-500 star"
                                data-value="5">★</label>
                        </div>

                        <!-- Comment Textarea -->
                        <textarea id="comment" name="comment" rows="5" placeholder="Escribe tu comentario aquí..."
                            class="my-2 py-2 px-4 rounded-md bg-gray-900 text-gray-300 w-full outline-none focus:ring-2 focus:ring-blue-600"></textarea>

                        <!-- Hidden Fields -->
                        <input type="hidden" name="to_user_id" value="{{ $toUser->id }}">
                        <input type="hidden" name="requested_job_id" value="{{ $job->id }}">
                    </div>

                    <button type="submit"
                        class="border-2 text-md mt-5 rounded-md py-2 px-4 bg-blue-600 hover:bg-blue-700 text-gray-100 transition duration-300 ease-in-out focus:outline-none focus:ring focus:ring-blue-600">Enviar
                        Review</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                document.querySelectorAll('.star').forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.classList.add('text-yellow-500');
                    } else {
                        s.classList.remove('text-yellow-500');
                    }
                });
                // Set the corresponding radio button checked
                document.querySelector(`input[name="rating"][value="${value}"]`).checked = true;
            });
        });
    </script>
@endsection
