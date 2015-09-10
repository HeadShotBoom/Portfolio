@extends('home')

@section('content')
<div class="row">

    <a class="small-12 small-text-center columns red" href="/ServiceRequest">Click Here to Request Our Services.</a>
<aside class="small-12 medium-6 columns">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>You need to come up with a specific blurb for this.</p>
    <h1>Rene Ochoa</h1>
    <h3>San Antonio, Tx 78240</h3>
</aside>

<fieldset class="small-12 medium-6 columns">
<legend>Send me a message</legend>

    {!! Form::open(array('url' => '/Contact')) !!}

    {!! Form::label('name', 'Full Name') !!}
    {!! Form::text('name') !!}
    @if($errors->has('name'))
    <p class="red">{{ $errors->first('name') }}</p>
    @endif
    {!! Form::label('email', 'Email Address') !!}
    {!! Form::text('email') !!}
    @if($errors->has('email'))
    <p class="red">{{ $errors->first('email') }}</p>
    @endif

    {!! Form::label('message', 'Message') !!}
    {!! Form::textarea('message') !!}
    @if($errors->has('message'))
    <p class="red">{{ $errors->first('message') }}</p>
    @endif
    @if (session('status'))
    <p class="red">
        {{ session('status') }}
    </p>
    @endif
    <input type="submit" value="Submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" />
    {!! Form::close() !!}

</fieldset>

</div>
@endsection