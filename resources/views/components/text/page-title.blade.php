<h3 {{ $attributes->merge(['class' => 'relative text-xl font-semibold ms-3 inline-flex h-fit items-center gap-3']) }}>
    {{ $slot }}
    <x-loading.circle class="absolute translate-x-full -translate-y-1/2 -right-3 top-1/2" wire:loading></x-loading.circle>
</h3>
