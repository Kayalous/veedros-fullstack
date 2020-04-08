@component('mail::message')
## Hey, {{$user->name}}!

Please click on this link to login now: <a href="{{$url}}">{{$url}}</a>

if you didn't try to login don't worry, you don't have to do anything. The link will expire in 60 minutes.

<br>
If you're having trouble logging in please contact the support at support@veedros.com.
<br>
{{ config('app.name') }} team.
@endcomponent
