@php
   $colors = [
      'teal' => 'text-white bg-teal-400 hover:text-white hover:bg-teal-500 focus:ring-teal-300 dark:bg-teal-500 dark:text-teal-500 dark:hover:bg-teal-500 dark:focus:ring-teal-500',
      'gray' => 'text-white bg-gray-800 hover:text-white hover:bg-gray-900 focus:ring-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:hover:bg-gray-600 dark:focus:ring-gray-800',
      'green' => 'text-white bg-green-700 hover:text-white hover:bg-green-800 focus:ring-green-300 dark:bg-green-500 dark:text-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800',
      'red' => 'text-white bg-red-700 hover:text-white hover:bg-red-800 focus:ring-red-300 dark:bg-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900',
      'yellow' => 'text-white bg-yellow-400 hover:text-white hover:bg-yellow-500 focus:ring-yellow-300 dark:bg-yellow-300 dark:text-yellow-300 dark:hover:bg-yellow-400 dark:focus:ring-yellow-900',
      'purple' => 'text-white bg-purple-700 hover:text-white hover:bg-purple-800 focus:ring-purple-300 dark:bg-purple-400 dark:text-purple-400 dark:hover:bg-purple-500 dark:focus:ring-purple-900',
   ];
@endphp

<button type="button" class="font-semibold rounded-lg px-5 py-2.5 text-center me-2 mb-2 focus:ring-4 focus:outline-none {{ $colors["$color"] }}">
   {{ $slot ?? 'Default' }}
</button>