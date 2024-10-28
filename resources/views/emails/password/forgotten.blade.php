<x-mail::message>
# Password Reset

Hi {{ $user->lname." ".$user->fname }},

You can use the following code to change your password.

Password: <strong>{{ $passcode }}</strong>

<x-mail::button :url="'https://mytailor.vercel.app'">
Continue to login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>