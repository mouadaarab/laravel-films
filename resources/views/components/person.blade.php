@props(['person'])

@if ($person)
    <div class="flex flex-col items-center">
        <img src="{{ $person->profile_url }}" alt="{{ $person->name }}" class="h-[120px] w-[100px] max-w-[100px] rounded" />
        <span class="text-sm font-bold">{{ $person->name }}</span>
        @if ($person->character)
            <span class="text-xs">{{ $person->character }}</span>
        @endif
        @if ($person->job)
            <span class="text-xs">{{ $person->job }}</span>
        @endif
    </div>
@endif
