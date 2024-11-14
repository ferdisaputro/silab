@props([
    'name' => Str::random(5),
    'label' => '',
    'checked' => false,
])

{{-- <div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input id="{{ $name }}" name="{{ $name }}"  type="checkbox" value="" {{ $checked? "selected" : "" }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="{{ $name }}" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">{{ $label }}</label>
</div> --}}

<div class="flex items-center">
    <input {{ $attributes }} id="{{ $name }}" name="{{ $name }}" type="checkbox" {{ $checked? "selected" : "" }} class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="{{ $name }}" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">{{ $label }}</label>
</div>
