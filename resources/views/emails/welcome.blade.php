@component('mail::message')
# Welcome to Veedros, {{$user->name}}!

We're glad to have you join us!

Please click on this link to verify your account: <a href="{{$token}}">{{$token}}</a>

Thanks,<br>
{{ config('app.name') }} team.
@endcomponent
