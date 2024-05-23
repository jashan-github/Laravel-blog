@props(['name'])

<label
    {{ $attributes(['for' => '', 'class' => 'mt-2 block mb-2 text-sm font-semibold text-gray-900']) }}
>
    {{ ucwords($name) }}
</label>
