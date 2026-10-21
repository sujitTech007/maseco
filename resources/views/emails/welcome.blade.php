<!doctype html>
<html lang="en"><body>
    <h1>Welcome to Maseco, {{ $account->name }}!</h1>
    <p>Your {{ $accountType }} account has been created successfully.</p>
    <p><a href="{{ route('login') }}">Sign in to Maseco</a> to get started.</p>
    <p>Thanks,<br>The Maseco team</p>
</body></html>
