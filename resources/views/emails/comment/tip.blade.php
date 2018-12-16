@component('mail::message')
# {{ $title }}

{{ $content }}

@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
