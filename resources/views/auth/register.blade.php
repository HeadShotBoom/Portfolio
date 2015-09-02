<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <label for="name">Full Name: </label>
    <input type="text" name="name" value="{{ old('name') }}">


    <label for="email">Email: </label>
    <input type="email" name="email" value="{{ old('email') }}">

    <label for="password">Password: </label>
    <input type="password" name="password">

    <label for="password_confirmation">Repeat Password: </label>
    <input type="password" name="password_confirmation">


    <?php
    $admin = DB::table('users')->where('id', '2')->pluck('email');
    if(count($admin)>0) {
        echo "<label for='admin_pass'>Administrator Password: </label>";
        echo "<input type='password' name='admin_password'>";
    }
    ?>
    <button type="submit">Register</button>
</form>