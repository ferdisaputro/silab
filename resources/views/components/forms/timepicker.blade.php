@props([
   'id' => Str::random(10),
   'label' => null,
   'name' => null,
   'height' => 'h-12',
   'disabled' => false,
   'value' => null,
   'min' => '00:00',
   'max' => '23:59',
])

<div>
   @if ($label)
      <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
   @endif
   <div class="relative">
       <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
               <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
           </svg>
       </div>
       <input 
         {{ $attributes->whereStartsWith('wire') }} 
         @if($disabled) disabled @endif
         type="time" id="{{ $id }}" 
         value="{{ $value }}"
         class="{{ $height }} block px-4 w-full text-sm bg-transparent disabled:bg-primaryGrey rounded-lg border border-gray-200 appearance-none dark:border-gray-600 dark:focus:border-primaryLightTeal focus:outline-none focus:ring-1 focus:ring-primaryTeal focus:border-primaryTeal peer @error($name) bg-red-50 border-red-500 text-red-900 placeholder-red-600 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror" 
         min="{{ $min }}" max="{{ $max }}" />
   </div>
   <div>
      @error($name)
          <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
      @enderror
  </div>
</div>

