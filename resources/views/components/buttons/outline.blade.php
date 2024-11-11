@props(['color' => 'teal', 'type' => 'button', 'height' => 'h-11'])

@php
   $colors = [
      'blue' => 'text-blue-400 border-blue-400 hover:text-white hover:bg-blue-400 focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-500 dark:focus:ring-blue-500',
      'teal' => 'text-teal-400 border-teal-400 hover:text-white hover:bg-teal-400 focus:ring-teal-300 dark:border-teal-500 dark:text-teal-500 dark:hover:bg-teal-500 dark:focus:ring-teal-500',
      'gray' => 'text-gray-400 border-gray-400 hover:text-white hover:bg-gray-400 focus:ring-gray-300 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-600 dark:focus:ring-gray-800',
      'green' => 'text-green-500 border-green-500 hover:text-white hover:bg-green-600 focus:ring-green-300 dark:border-green-500 dark:text-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800',
      'red' => 'text-red-500 border-red-500 hover:text-white hover:bg-red-700 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-700 dark:focus:ring-red-900',
      'yellow' => 'text-yellow-300 border-yellow-300 hover:text-white hover:bg-yellow-400 focus:ring-yellow-300 dark:border-yellow-300 dark:text-yellow-300 dark:hover:bg-yellow-400 dark:focus:ring-yellow-900',
      'purple' => 'text-purple-400 border-purple-400 hover:text-white hover:bg-purple-500 focus:ring-purple-300 dark:border-purple-400 dark:text-purple-400 dark:hover:bg-purple-500 dark:focus:ring-purple-900',
   ];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(["class" => "font-semibold rounded-lg px-5 text-center border focus:ring-4 focus:outline-none $height $colors[$color]"]) }}>
   {{ $slot ?? 'Default' }} 
</button>
