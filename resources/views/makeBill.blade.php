@extends('home')

@section('content')

@if ($errors->has('billMessage'))
<div class="row">
<p class=" small-12 small-text-center red">{{ $errors->first('billMessage') }}</p>
</div>
@endif

<div class="row">
{!! Form::open() !!}

{!! Form::label('name', 'Client Name') !!}
{!! Form::text('name') !!}
    @if ($errors->has('name')) <p class="red">{{ $errors->first('name') }}</p> @endif
{!! Form::label('email', 'Client Email') !!}
{!! Form::text('email') !!}
    @if ($errors->has('email')) <p class="red">{{ $errors->first('email') }}</p> @endif
{!! Form::label('description', 'Charge Description') !!}
{!! Form::text('description') !!}
    @if ($errors->has('description')) <p class="red">{{ $errors->first('description') }}</p> @endif
{!! Form::label('amount', 'Charge Amount') !!}
{!! Form::text('amount') !!}
    @if ($errors->has('amount')) <p class="red">{{ $errors->first('amount') }}</p> @endif
{!! Form::submit('Send Bill') !!}

{!! Form::close() !!}
</div>

@endsection