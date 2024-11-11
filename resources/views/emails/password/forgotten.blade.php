<x-mail::message>
# Password Reset

Hi {{ $user->lname." ".$user->fname }},

You can use the following code to change your password.

Passcode: <strong>{{ $passcode }}</strong>

<x-mail::button :url="'https://mytailor.vercel.app'">
Continue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>