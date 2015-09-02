<form method="POST" action="/password/email">
    {!! csrf_field() !!}

    <label for="email">Email: </label>
    <input type="email" name="email" value="{{ old('email') }}">
    <input type="submit" value="Send Password Reset Link">
</form>