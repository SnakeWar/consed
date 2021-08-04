@component('mail::panel')
This is the panel content.
@endcomponent

@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $url, 'color' => 'purple'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
