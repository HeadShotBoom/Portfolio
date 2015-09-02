@extends('home')

@section('content')

{!! Form::open(array('url' => '/ClientLoginAttempt')) !!}

{!! Form::label('password', 'Gallery Password') !!}
{!! Form::text('password') !!}
@if(Session::has('message'))
<p class="red">That password is incorrect, please try again.</p>
@endif
{!! Form::hidden('galleryName', $galleryName) !!}

{!! Form::submit('Login') !!}

{!! Form::close() !!}



@endsection
