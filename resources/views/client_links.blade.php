@extends('home')

@section('content')

<p>We continuously strive to deliver images well before the agreed upon date. As soon as your images are complete, we will email you with a link and the password to your gallery. If you think your gallery has already been posted and do not see it here, please head over to the <a href="/Contact" class="link">contact</a> page and send me a message.</p>

@foreach($links as $link)
<a href="Client/{!! $link->name !!}/login" >{!! $link->name !!}</a> <br>
@endforeach


@if(Auth::check())
<h3>Create a New Client Gallery.</h3>
<div class="row">
    <div class="small-12 medium-6 medium-centered columns">
{!! Form::open(array('url' => '/ClientLinks')) !!}

{!! Form::label('name', 'Gallery Name') !!}
{!! Form::text('name') !!}
@if($errors->has('name'))
<p class="red">{{ $errors->first('name') }}</p>
@endif
{!! Form::label('password', 'Gallery Password') !!}
{!! Form::text('password') !!}
@if($errors->has('password'))
<p class="red">{{ $errors->first('password') }}</p>
@endif

{!! Form::submit('Make Gallery') !!}

{!! Form::close() !!}
    </div>
</div>
@endif

@endsection