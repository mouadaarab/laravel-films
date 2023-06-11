<div
    class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500 flex flex-col justify-between">
    <div>
        <h3 class="mb-3 text-sm font-bold text-indigo-600">
            @foreach ($film->genres as $genre)
                {{ $genre->name }}
                @if (!$loop->last)
                    -
                @endif
            @endforeach
        </h3>

        <div class="relative">
            <img class="w-full rounded-xl" src="{{ $film->backdrop_url }}" alt="Colors" />
            <p class="absolute top-0 bg-green-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                @if ($film->adule)
                    +18
                @else
                    -18
                @endif
            </p>
        </div>

        <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">
            {{ $film->title }}
        </h1>
    </div>

    <div class="my-4">
        <div class="flex items-center justify-between mt-4">
            <p class="text-gray-600 text-sm">
                {{ $film->release_date->format('M d, Y') }}
            </p>

            <div class="flex items-center">
                <span class="text-gray-600 text-sm">{{ __('Votes') }} :</span>
                <span class="ml-2 text-gray-600 text-sm">{{ $film->vote_average }} ({{ $film->vote_count }})</span>
            </div>
        </div>

        <div class="flex gap-x-2">
            <a class="mt-4 text-base w-1/3 text-white bg-indigo-600 py-2 rounded-md shadow-md text-center" href="{{ route('films.show', ['film' => $film]) }}">{{ __('Details') }}</a>
        </div>
    </div>
</div>
