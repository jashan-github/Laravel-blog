@props(['name'])

<th {{ $attributes([
    'class' => 'px-6 py-4 text-black font-bold uppercase text-xs text-left whitespace-nowrap'
    ]) }}>
    {{ $slot ?? '' }}
</th>