@component('mail::message')
Welcome.

    Thank you for join my community

@component('mail::button', ['url' => 'link'])
@endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
