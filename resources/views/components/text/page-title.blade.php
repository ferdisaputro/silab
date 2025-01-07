<h3 {{ $attributes->merge(['class' => 'text-xl font-semibold ms-3 inline-flex items-center gap-3']) }}>
    {{ $slot }}
    <x-loading.circle wire:loading></x-loading.circle>
</h3>
