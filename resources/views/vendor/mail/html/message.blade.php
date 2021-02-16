@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="https://i.imgur.com/HDOV70c.png" class="logo" alt="{{config('app.name')}}">
@endcomponent
@endslot

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

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    <img src="https://i.imgur.com/IzEiSXt.jpg" style="width:100%;" alt="{{config('app.name')}}">
@endcomponent
@endslot
@endcomponent

