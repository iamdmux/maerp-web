@component('mail::layout')
{{-- Header --}}
{{-- @slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot --}}

{{-- Body --}}

{{ $slot }}


{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset


<img src="{{ asset('img/logo-mea.jpg')}}" class="logo" style="margin-top:115px" alt="logo" />
<p class="sub" style="margin-top:10px;">M&A Export s.r.l.<br>
P.IVA: IT11320520015<br>
C.F.: 11320520015<br>
Via Italia 21 - 10035 Mazze (Torino) - Italia<br>
<p>


{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} M&A Export s.r.l.
@endcomponent
@endslot
@endcomponent
