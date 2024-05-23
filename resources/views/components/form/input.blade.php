@props(['name', 'type' => 'text', 'label' => null])

@php
    if (! $label) {
        $label = ucwords(str_replace('_', ' ', $name));
    }
@endphp

<x-form.label for="{{ $name }}" name="{{ $label }}" class="{{ $attributes['required'] ? 'asterisk' : '' }}"/>

<input
    name="{{ $name }}"
    id="{{ $name }}"
    type="{{ $type }}"
    {{ $attributes(['value' => old($name), 'class' => 'form-control block w-full px-4 py-3 text-sm font-normal text-gray-700
    bg-white bg-clip-padding border border-solid border-gray-300 rounded transition
    ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none']) }}
/>

<x-error name="{{ $name }}" />
