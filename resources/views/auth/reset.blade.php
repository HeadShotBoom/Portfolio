<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    <label for="email">Email: </label>
    <input type="email" name="email" value="{{ old('email') }}">

    <label for="password">Password: </label>
    <input type="password" name="password">

    <label for="password_confirmation">Password Confirmation: </label>
    <input type="password" name="password_confirmation">



        <input type="submit" value="Reset Password">


</form>