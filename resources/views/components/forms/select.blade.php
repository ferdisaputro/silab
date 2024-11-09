@props(['name', 'type' => 'text', 'label' => '', 'options' => ''])

<div {{ $attributes->merge(['class']) }}>
   <div class="relative">
      <select id="countries_disabled" class="border capitalize h-12 border-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
         <option selected>Role</option>
         @foreach ($options as $key => $option)
            <option value="{{ $option }}">{{ $key }}</option>
         @endforeach
      </select>
   </div>
   <div>
      @error($name)
         <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
      @enderror
   </div>
</div>