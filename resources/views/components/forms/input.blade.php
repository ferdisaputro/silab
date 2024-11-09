@props(['name', 'type' => 'text', 'label' => ''])

<div {{ $attributes->merge(['class']) }}>
   <div class="relative">
      <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder=""
         class="h-12 block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-1 border-gray-200 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer
         @error($name) bg-red-50 border-red-500 text-red-900 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">
      
      <label for="{{ $name }}" class="absolute text-sm duration-300 transform -translate-y-4 scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2
         peer-focus:px-2 peer-focus:text-blue-600 capitalize peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4
         @error($name) text-red-700 dark:text-red-500 @enderror">{{ $label }}</label>
   </div>
   <div>
      @error($name)
         <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
      @enderror
   </div>
</div>
