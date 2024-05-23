@props(['name'])

<td {{ $attributes(['class' => 'text-sm bg-white px-6 py-3 whitespace-nowrap', 'colspan' => '']) }}>
    {{ $slot ?? '' }}
</th>