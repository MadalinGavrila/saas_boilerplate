@component('mail::message')
# Activate your account

Thanks for signing up, please activate your account

@component('mail::button', ['url' => route('activation.activate', $token)])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy')
@lang(
    "If you’re having trouble clicking the \"Activate\" button, copy and paste the URL below\n".
    'into your web browser: [:url](:url)',
    [
        'url' => route('activation.activate', $token)
    ]
)
@endcomponent

@endcomponent
