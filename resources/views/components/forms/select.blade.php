@props([
    'name',
    'label' => '',
    'default' => '',
    'options' => [
        'value' => 'text'
    ] // be aware, this options use value and text. the value will be the result of the options(this could be id, slug, etc).
      // and the text is for the display of the options.
])

<div {{ $attributes->merge(['class']) }}>
   <div class="relative">
      <select name="{{ $name }}" id="countries_disabled" class="border peer capitalize h-12 border-gray-200 text-sm rounded-lg focus:ring-primaryTeal focus:border-primaryTeal block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryTeal dark:focus:border-primaryTeal">
         <option selected>{{ $label }}</option>
         @foreach ($options as $value => $text)
            <option {{ $default == $value? "selected" : '' }} value="{{ $value }}">{{ $text }}</option>
         @endforeach
      </select>

      <label for="{{ $name }}" class="absolute text-sm duration-300 transform -translate-y-[1.2rem] scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2
         peer-focus:px-2 peer-focus:text-primaryTeal capitalize peer-focus:dark:text-primaryLightTeal peer-focus:top-1.5 peer-focus:scale-90 peer-focus:-translate-y-4
         @error($name) text-red-700 dark:text-red-500 @enderror">{{ $label }}</label>
   </div>
   <div>
      @error($name)
         <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
      @enderror
   </div>
</div>
