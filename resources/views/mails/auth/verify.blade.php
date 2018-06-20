@component('mail::message')
# {{__('mail.verify_mail_header')}}

{{__('mail.verify_mail_text')}}

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
