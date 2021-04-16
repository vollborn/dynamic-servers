{{ $header ?? '' }}
{{ Illuminate\Mail\Markdown::parse($slot) }}
{{ $subcopy ?? '' }}
{{ $footer ?? '' }}
