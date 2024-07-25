@component('mail::message')
    # Welcome

    Thank you for subscribing

    Thanks,
    {{ config('app.name') }}
@endcomponent

{{--<x-emails::message>--}}
{{--    Welcome.--}}

{{--    Thank you for subscribing--}}

{{--    <x-emails::button :url="''">--}}
{{--        Button Text--}}
{{--    </x-emails::button>--}}

{{--    Thanks,<br>--}}
{{--    {{ config('app.name') }}--}}
{{--</x-emails::message>--}}
