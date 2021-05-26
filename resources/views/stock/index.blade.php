@extends('stock.layout.app-stock')

@section('content')

      <div>
          <div class="flex flex-wrap mt-32">
            @foreach ($lotti as $lotto)
            <a href="{{route('stock.show', $lotto->id)}}">
                <div class="p-4 mr-8 mb-8">
                    <div>
                        <div class="relative group flex w-full h-auto md:w-80 md:h-60 rounded">
                            @if($lotto->shop_image)
                            <img src="{{ asset($lotto->shop_image) }}" class="w-full object-cover">
                            @else
                            <div class="h-full flex-1 bg-gray-300 items-center justify-center">Lotto</div>
                            @endif
                            <div class="absolute bottom-0 self-end opacity-0 group-hover:opacity-100 transition duration-300 bg-white bg-opacity-50">
                                <p class="p-2 text-sm font-semibold">
                                    {{$lotto->shop_descrizione}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-80">
                        {{-- <p class="text-xs font-medium uppercase tracking-wider">lotto</p> --}}
                        <h3 class="font-semibold"> {{$lotto->codice_articolo}}</h3>
                        <p class="uppercase tracking-wider">{{$lotto->shop_prezzo}}</p>
                    </div>
                </div>
            </a>
            @endforeach
          </div>
      </div>

@endsection
{{-- 
@if($lotto->shop_image)
<img src="{{ asset($lotto->shop_image) }}" class="object-cover">
@else
<div class="h-full flex-1 bg-gray-300">Lotto
@endif
<div class="self-end opacity-0 group-hover:opacity-100 transition duration-300">
<p class="p-2 text-sm">
    {{$lotto->shop_descrizione}}
</p>
</div>
@if(!$lotto->shop_image)
</div>
@endif --}}