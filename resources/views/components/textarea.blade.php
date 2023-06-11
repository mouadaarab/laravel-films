@props(['disabled' => false])
@props(['rows' => 4])

<textarea {{ $disabled ? 'disabled' : '' }}  rows="{{ $rows }}"" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}></textarea>
