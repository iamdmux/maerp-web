@extends('shop.layout.app')

@section('content')
      <div>
          @php $collection = [1,2,3,4,5,6,7,8,9,10]; @endphp
          <div class="flex flex-wrap mt-32">
            @foreach ($collection as $item)
            <a href="/shop/show">
                <div class="p-4 mr-8 mb-8">
                    <div class="group flex w-80 h-60 bg-gray-300 rounded">
                        <div class="self-end opacity-0 group-hover:opacity-100 transition duration-300">
                            <p class="p-2 text-sm">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                            </p>
                        </div>
                    </div>
                    <div class="w-80">
                        {{-- <p class="text-xs font-medium uppercase tracking-wider">lotto</p> --}}
                        <h3 class="font-semibold">Lorem ipsum</h3>
                        <p class="uppercase tracking-wider">€ 100</p>
                    </div>
                </div>
            </a>
            @endforeach
          </div>
      </div>

@endsection