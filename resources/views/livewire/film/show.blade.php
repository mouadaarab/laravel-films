<div>
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
                        <x-input-error for="title" class="mt-2" />
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <x-label for="original_title" value="{{ __('Original Title') }}" />
                        <x-input id="original_title" type="text" class="mt-1 block w-full" wire:model="film.original_title" />
                        <x-input-error for="original_title" class="mt-2" />
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <x-label for="overview" value="{{ __('Overview') }}" />
                        <x-textarea id="overview" type="text" class="mt-1 block w-full" wire:model="film.overview" rows="8" />
                        <x-input-error for="overview" class="mt-2" />
                    </div>

                    <div class="col-span-4 sm:col-span-6">
                        <x-label for="trending_day" value="{{ __('Trending Day') }}" />
                        <x-checkbox id="trending_day" wire:model="film.trending_day" />
                        <x-input-error for="trending_day" class="mt-2" />
                    </div>

                    <div class="col-span-4 sm:col-span-6">
                        <x-label for="trending_week" value="{{ __('Trending Week') }}" />
                        <x-checkbox id="trending_week" wire:model="film.trending_week" />
                        <x-input-error for="trending_week" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                </x-slot>
            </x-form-section>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('updateFilmModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
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
                    <div class="flex flex-wrap gap-x-2 text-sm">
                        <span>{{ $film->release_date->format('d/m/Y') }}</span>
                        <span class="">•</span>
                        <span class="">{{ $film->genres_list }}</span>
                        <span class="text-sm">•</span>
                        <span class="text-sm">{{ $film->vote_average }} ({{ $film->vote_count }})</span>
                    </div>

                    <div class="flex items-center space-x-2">
                    </div>

                    <div class="my-6">
                        <p class="">
                            {{ $film->overview }}
                        </p>
                    </div>

                    <div class="flex gap-x-2">
                        <x-secondary-button wire:click="$toggle('updateFilmModal')" wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3" wire:click="deleteFilm" wire:loading.attr="disabled">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
