@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => route('payment',$mail_data['delegate']->id)])
Confirm Payment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
