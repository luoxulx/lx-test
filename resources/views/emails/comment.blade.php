@component('mail::message')
# {{ $title }}

{{ $content }}

@component('mail::button', ['url' => 'https://www.baidu.com', 'color'=>'success'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
