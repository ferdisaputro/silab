@props(['identifier', 'max_width' => 'max-w-xl'])

<div x-show="{{ $identifier }}" style="display: none" x-transition.opacity x-on:click.self="{{ $identifier }} = false" {{ $attributes->merge(['class' => 'fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full max-h-full p-4 overflow-x-hidden md:p-7 bg-black/40 md:inset-0']) }}>
    <div class="relative flex w-full {{ $max_width }} max-h-full overflow-hidden bg-white shadow rounded-xl dark:bg-gray-700">
        <div class="flex-1 overflow-hidden overflow-y-auto p-7">
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>







{{-- @props(['identifier', 'max_width' => 'max-w-xl'])

<div
    x-show="{{ $identifier }}"
    x-cloak
    x-transition.opacity
    x-on:click.self="{{ $identifier }} = false"
    x-init.debounce.300ms="() => { $nextTick(() => { {{ $identifier }} = true }) }"
    style="display: none"
    {{ $attributes->merge(['class' => 'fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full max-h-full p-4 overflow-x-hidden md:p-7 bg-black/40 md:inset-0']) }}
>
    <div class="relative flex w-full {{ $max_width }} max-h-full overflow-hidden bg-white shadow rounded-xl dark:bg-gray-700">
        <div class="flex-1 overflow-hidden overflow-y-auto p-7">
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div> --}}
