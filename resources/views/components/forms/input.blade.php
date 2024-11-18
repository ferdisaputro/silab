@props([
    'name' => '',
    'height' => 'h-12',
    'type' => 'text',
    'label' => '-',
    'disabled' => false,
    'readonly' => false,
    'placeholder' => '',
    'value' => '',
    // 'class' => '',
])

@php
    $datepicker = false;
    if ($type == "datepicker") $datepicker = true;
@endphp

<div {{ $attributes->merge(['class' => '']) }}>
    <div class="relative">
        <input
            id="{{ $name }}"
            type="{{ $type }}"
            name="{{ $name }}"
            {{ $disabled? "disabled" : '' }}
            {{ $readonly? "readonly" : '' }}
            {{ $datepicker? "datepicker" : '' }}
            @if($value) value="{{ $value }}"
            @endif placeholder="{{ $placeholder }}"
            class="{{ $height }} block px-4 pb-2.5 pt-4 w-full text-sm bg-transparent disabled:bg-primaryGrey rounded-lg border border-gray-200 appearance-none dark:border-gray-600 dark:focus:border-primaryLightTeal focus:outline-none focus:ring-0 focus:border-primaryTeal peer @error($name) bg-red-50 border-red-500 text-red-900 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">

        <label for="{{ $name }}" class="absolute text-sm duration-300 transform -translate-y-4 scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-primaryTeal capitalize peer-disabled:bg-transparent peer-focus:dark:text-primaryLightTeal peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 @error($name) text-red-700 dark:text-red-500 @enderror">{{ $label }}</label>
        {{-- {{ $slot }} --}}

        @if ($datepicker)
            <i class="absolute -translate-y-1/2 fa-solid fa-calendar-days top-1/2 right-4"></i>
        @endif
    </div>
    <div>
        @error($name)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
        @enderror
    </div>
</div>
