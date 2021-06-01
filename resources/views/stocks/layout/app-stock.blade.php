    {{-- @include('stocks.layout.header') --}}
    <x-stocks.header-stocks/>
    @php
        $main_bg = '';
        if(request()->segment(1) == 'login' || request()->segment(1) == 'register'){
            $main_bg = 'bg-gray-200';
        }
    @endphp
    <main class="{{$main_bg}}">
        <div id="app" class="container mx-auto">

            {{-- flash message --}}
            @if ($message = session()->get('success'))
                <div class="w-full bg-yellow-100 rounded">
                    <p class="px-6 py-3 my-3">
                        {{ $message }}
                    </p>
                </div>
            @endif


            @yield('content')
            {{-- <x-errors-component /> --}}
        </div>
    </main>
    @include('stocks.layout.footer')
     


