@component('mail::message')

{{-- Greeting --}}
@if (! empty($greeting))
{{ $greeting }}
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
<br />
@endforeach

{{-- Action Button --}}
@isset($actionText)
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
<br />
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@endif

@endcomponent
