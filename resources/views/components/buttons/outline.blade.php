@props(['color' => 'teal', 'type' => 'button'])

@php
   $colors = [
      'teal' => 'text-teal-400 border-teal-400 hover:text-white hover:bg-teal-500 focus:ring-teal-300 dark:border-teal-500 dark:text-teal-500 dark:hover:bg-teal-500 dark:focus:ring-teal-500',
      'gray' => 'text-gray-900 border-gray-800 hover:text-white hover:bg-gray-900 focus:ring-gray-300 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-600 dark:focus:ring-gray-800',
      'green' => 'text-green-700 border-green-700 hover:text-white hover:bg-green-800 focus:ring-green-300 dark:border-green-500 dark:text-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800',
      'red' => 'text-red-700 border-red-700 hover:text-white hover:bg-red-800 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900',
      'yellow' => 'text-yellow-300 border-yellow-300 hover:text-white hover:bg-yellow-400 focus:ring-yellow-300 dark:border-yellow-300 dark:text-yellow-300 dark:hover:bg-yellow-400 dark:focus:ring-yellow-900',
      'purple' => 'text-purple-700 border-purple-700 hover:text-white hover:bg-purple-800 focus:ring-purple-300 dark:border-purple-400 dark:text-purple-400 dark:hover:bg-purple-500 dark:focus:ring-purple-900',
   ];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(["class" => "font-semibold rounded-lg px-5 py-2.5 text-center border focus:ring-4 focus:outline-none $colors[$color]"]) }}>
   {{ $slot ?? 'Default' }}  <!-- Default text if no slot is provided -->
</button>