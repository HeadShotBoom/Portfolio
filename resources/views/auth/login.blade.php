<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email') }}">

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">
    </div>
</form>
<a href="/password/email">Forgot Your Password?</a>