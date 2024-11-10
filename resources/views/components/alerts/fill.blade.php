@props([
    'color' => 'blue',
    'message' => 'Change a few things up and try submitting again.',
    'title' => 'Alert',
    'icon' => 'fa-circle-info'
])

@php
    $colors = [
        'teal' => 'text-white bg-teal-400 hover:bg-teal-500 focus:ring-teal-300 dark:bg-teal-500 dark:hover:bg-teal-500 dark:focus:ring-teal-500',
        'blue' => 'text-white bg-blue-400 hover:bg-blue-500 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-500 dark:focus:ring-blue-500',
        'gray' => 'text-primaryWhite bg-gray-400 hover:bg-gray-500 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-400 dark:focus:ring-gray-500',
        'green' => 'text-white bg-green-500 hover:bg-green-600 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800',
        'red' => 'text-white bg-red-500 hover:bg-red-700 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-700 dark:focus:ring-red-900',
        'yellow' => 'text-primaryDark bg-yellow-300 hover:bg-yellow-400 focus:ring-yellow-300 dark:bg-yellow-300 dark:hover:bg-yellow-400 dark:focus:ring-yellow-900',
        'purple' => 'text-white bg-purple-400 hover:bg-purple-500 focus:ring-purple-300 dark:bg-purple-400 dark:hover:bg-purple-500 dark:focus:ring-purple-900'
    ];
@endphp

<div class="flex items-center p-4 text-sm {{ $colors[$color] }} border rounded-lg" role="alert">
    <i class="mr-3 fa-solid {{ $icon }} fa-lg"></i>
    <span class="sr-only">{{ $title }}</span>
    <div>
        <span class="font-medium">{{ ucfirst($title) }}</span> {{ $message }}
    </div>
</div>
