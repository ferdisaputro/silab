@props([
    // 'class' => '',
    'height' => 'h-12',
    'name',
    'label' => '',
    'disabled' => false,
])

<div {{ $attributes }}>
   <div class="relative">
    @php
        $id = Str::random(10);
    @endphp
      <select name="{{ $name }}" id="{{ $id }}" {{ $disabled? "disabled" : '' }} {{ $attributes->whereStartsWith('wire') }}
          class="{{ $height }} border disabled:bg-primaryGrey peer capitalize border-gray-200 text-sm rounded-lg focus:ring-primaryTeal focus:border-primaryTeal block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryTeal dark:focus:border-primaryTeal @error($name) border-red-500 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">
          <option selected>{{ $label }}</option>
          {{ $slot }}
      </select>

      <label for="{{ $id }}" class="absolute text-sm duration-300 transform -translate-y-[1.2rem] scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2
         peer-focus:px-2 peer-focus:text-primaryTeal peer-disabled:bg-transparent capitalize peer-focus:dark:text-primaryLightTeal peer-focus:top-1.5 peer-focus:scale-90 peer-focus:-translate-y-4
         @error($name) text-red-700 dark:text-red-500 @enderror">{{ $label }}</label>
   </div>
   <div>
      @error($name)
         <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
      @enderror
   </div>
</div>
