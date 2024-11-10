@props([
    'color' => 'blue',
    'message' => 'Change a few things up and try submitting again.',
    'title' => '',
    'icon' => 'fa-circle-info'
])

@php
    $colors = [
        'blue' => 'text-blue-400 border-blue-400 bg-blue-50 hover:bg-blue-200 hover:text-blue-600 dark:border-blue-500 dark:text-blue-500 dark:bg-blue-600 dark:focus:ring-blue-500',
        'teal' => 'text-teal-400 border-teal-400 bg-teal-50 hover:bg-teal-200 hover:text-teal-600 dark:border-teal-500 dark:text-teal-500 dark:bg-teal-600 dark:focus:ring-teal-500',
        'gray' => 'text-gray-500 border-gray-400 bg-gray-50 hover:bg-gray-200 hover:text-gray-600 dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 dark:focus:ring-gray-500',
        'green' => 'text-green-500 border-green-500 bg-green-50 hover:bg-green-200 hover:text-green-600 dark:border-green-600 dark:text-green-600 dark:bg-green-700 dark:focus:ring-green-800',
        'red' => 'text-red-500 border-red-500 bg-red-50 hover:bg-red-200 hover:text-red-600 dark:border-red-600 dark:text-red-600 dark:bg-red-700 dark:focus:ring-red-900',
        'yellow' => 'text-yellow-500 border-yellow-400 bg-yellow-50 hover:bg-yellow-200 hover:text-yellow-600 dark:border-yellow-300 dark:text-yellow-300 dark:bg-yellow-400 dark:focus:ring-yellow-900',
        'purple' => 'text-purple-500 border-purple-500 bg-purple-50 hover:bg-purple-200 hover:text-purple-600 dark:border-purple-400 dark:text-purple-400 dark:bg-purple-500 dark:focus:ring-purple-900'
    ];
@endphp

<div {{ $attributes->merge(["class" => "flex items-center p-4 text-sm $colors[$color] border rounded-lg"]) }} role="alert">
    <i class="mr-3 fa-solid {{ $icon }} fa-lg"></i>
    <span class="sr-only">{{ $title }}</span>
    <div>
        <span class="font-medium">{{ ucfirst($title) }}</span> {{ $message }}
    </div>
</div>
