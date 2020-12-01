@component('mail::message')
# Dear,{{$maildata['name']}}

The body of your message.

@component('mail::panel')
    <div style="width: 100%;text-align: center;display: block;">
        <img src="{{$maildata['qr']}}">
    </div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
