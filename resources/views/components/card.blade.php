@php
   $jumlah = $jumlah?? '';
   $kuantitas = $kuantitas?? '';
   $teks = $teks?? '';
   $ikon = $ikon?? '';
   $keterangan = $keterangan?? '';

   // $bg_class = "bg-gradient-to-br from-$background/40 to-$background"
@endphp

<div class="relative p-4 overflow-hidden {{ $color }} rounded-lg shadow-lg bg-gradient-to-br {{ $gradient }}">
{{-- <div class="relative p-5 overflow-hidden {{ $color }} rounded-lg shadow-lg {{ $bg_class }}"> --}}
   <div class="relative z-20">
      <div class="flex items-center justify-between mb-1 font-semibold">
         <span class="text-3xl">{{ $jumlah }} <span class="text-sm capitalize opacity-80">{{ $keterangan }}</span></span>
         <span class="inline-flex items-center gap-2 text-xl opacity-80">
            <i class="fa-solid fa-chevron-right fa-xs"></i>
            {{ $kuantitas }}
         </span>
      </div>
      <div class="flex items-center gap-3">
         <i class="fa-solid {{ $ikon }} fa-xl"></i>
         <span class="text-lg font-bold uppercase">{{ $teks }}</span>
      </div>
   </div>
   <div class="absolute top-0 bottom-0 right-0 translate-x-1/3 z-0 w-1/2 -skew-x-[35deg] bg-gradient-to-r from-white/20 to-transparent"></div>
</div>
