@php
   $classes = "max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 px-3"
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
   {{ $slot }}
</div>