<div>
    {{-- update film modal --}}
    <x-dialog-modal wire:model="updateFilmModal">
        <x-slot name="title">
            {{ __('Update') }}
        </x-slot>

        <x-slot name="content">
            <x-form-section submit="save">
                <x-slot name="title">
                    {{ __('Film Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Update your film\'s information.') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-12 sm:col-span-12">
                        <x-label for="title" value="{{ __('Title') }}" />
                        <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="film.title" />
                        <x-input-error for="film.title" class="mt-2" />
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <x-label for="original_title" value="{{ __('Original Title') }}" />
                        <x-input id="original_title" type="text" class="mt-1 block w-full" wire:model="film.original_title" />
                        <x-input-error for="film.original_title" class="mt-2" />
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <x-label for="overview" value="{{ __('Overview') }}" />
                        <x-textarea id="overview" type="text" class="mt-1 block w-full" wire:model="film.overview" rows="8" />
                        <x-input-error for="film.overview" class="mt-2" />
                    </div>

                    <div class="col-span-4 sm:col-span-6">
                        <x-label for="trending_day" value="{{ __('Trending Day') }}" />
                        <x-checkbox id="trending_day" wire:model="film.trending_day" />
                        <x-input-error for="film.trending_day" class="mt-2" />
                    </div>

                    <div class="col-span-4 sm:col-span-6">
                        <x-label for="trending_week" value="{{ __('Trending Week') }}" />
                        <x-checkbox id="trending_week" wire:model="film.trending_week" />
                        <x-input-error for="film.trending_week" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                </x-slot>
            </x-form-section>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeUpdateFilmModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- delete film modal --}}
    <x-dialog-modal wire:model="confirmingFilmDeletionModal">
        <x-slot name="title">
            {{ __('Delete Film') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this film?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingFilmDeletionModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Film') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Trailer modal --}}
    <x-dialog-modal wire:model="trailerModal">
        <x-slot name="title">
            {{ __('Trailer') }}
        </x-slot>

        <x-slot name="content">
            <div class="aspect-w-16 aspect-h-9">
                <iframe class="rounded-lg w-full h-[400px]" src="{{ $film->youtube_trailer }}" title="{{ $film->title }}" allowfullscreen></iframe>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeTrailerModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <main class="" style="{{ "background-image:url('".$film->backdrop_url."'); background-size: cover;" }}">
        <div class="p-14" style="background-image: linear-gradient(to right, rgba(241.5, 220.5, 199.5, 1) calc((50vw - 170px) - 340px), rgba(241.5, 220.5, 199.5, 0.84) 50%, rgba(241.5, 220.5, 199.5, 0.84) 100%);">
            <div class="container mx-auto flex">
                <div class="">
                    <img src="{{ $film->poster_url }}" alt="{{ $film->title }}" class="h-[450px] w-[300px] max-w-[300px] rounded" />
                </div>

                <div class="px-10">
                    <x-action-message class="col-span-12 sm:col-span-12" on="saved">
                        <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 rounded-lg mb-4" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#feffff}</style><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                            <p class="ml-4">{{ __('Film successfully updated.') }}</p>
                            </div>
                    </x-action-message>

                    <h1 class="text-3xl">
                        <span class="font-bold">{{ $film->title }}</span>
                        ({{ $film->release_year }})
                    </h1>
                    <div class="flex flex-wrap gap-2 text-sm my-2">
                        <span>{{ $film->release_date->format('d/m/Y') }}</span>
                        <span class="">•</span>
                        <span class="">{{ $film->genres_list }}</span>
                        <span class="text-sm">•</span>
                        <span class="text-sm">{{ $film->vote_average }} ({{ $film->vote_count }})</span>
                    </div>

                    <div class="my-4">
                        <button wire:click="openTrailerModal" class="flex items-center px-4 py-1 rounded-full bg-white gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>
                            {{ __('Play Trailer') }}
                        </button>
                    </div>

                    <div class="my-6">
                        <p class="">
                            {{ $film->overview }}
                        </p>
                    </div>

                    <div class="my-6">
                        <h2 class="text-xl font-bold">{{ __('Cast') }}</h2>
                        <div class="flex flex-wrap gap-2 justify-between">
                            @foreach ($film->casts as $cast)
                                <x-person :person="$cast"></x-person>
                            @endforeach
                        </div>
                    </div>

                    <div class="my-6">
                        <h2 class="text-xl font-bold">{{ __('Crew') }}</h2>
                        <div class="flex flex-wrap gap-2 justify-between">
                            @foreach ($film->crews as $crew)
                                <x-person :person="$crew"></x-person>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex gap-x-2">
                        <x-secondary-button wire:click="openUpdateFilmModal" wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3" wire:click="$toggle('confirmingFilmDeletionModal')" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('trailerStop', () => {
                var iframe = document.querySelector('iframe');
                if (iframe !== null) {
                        var iframeSrc = iframe.src;
                        iframe.src = iframeSrc;
                }
            });
        });
    </script>
</div>

