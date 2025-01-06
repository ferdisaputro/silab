@props([
    'value' => '',
    'selected' => false
])

<span data-value="{{ $value }}" {{ $selected? "selected" : '' }} class="block px-4 py-2 text-gray-700 rounded-md cursor-pointer select-form-item hover:bg-gray-100 active:bg-blue-100">
    {{ $slot }}
</span>
