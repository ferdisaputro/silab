@props(['identifier', 'max_width' => 'max-w-xl'])

<div x-show="{{ $identifier }}" x-transition.opacity x-on:click.self="{{ $identifier }} = false" class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full max-h-full p-4 overflow-x-hidden md:p-7 bg-black/40 md:inset-0">
    <div class="relative w-full {{ $max_width }} max-h-full p-5 overflow-hidden overflow-y-auto bg-white shadow rounded-xl dark:bg-gray-700">
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
