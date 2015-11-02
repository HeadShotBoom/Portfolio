@extends('home')

@section('content')

@if ($errors->has('billMessage'))
<div class="row">
    <p class=" small-12 small-text-center red">{{ $errors->first('billMessage') }}</p>
</div>
@else

<p>Hello, {!! $thisCharge->name !!} this is the charge for {!! $thisCharge->description !!}.</p>
<p>Your total is ${!! $thisCharge->amount !!}</p>



{!! Form::open(['id' => 'billing-form']) !!}
<div class="form-row">
    <label>
        <span>Card Number:</span>
        <input type="text" data-stripe="number">
    </label>
</div>

<div class="form-row">
    <label>
        <span>CVC:</span>
        <input type="text" data-stripe="cvc">
    </label>
</div>

<div class="form-row">
    <label>
        <span>Expiration Date:</span>
        {!! Form::selectMonth(null, null, ['data-stripe' => 'exp-month']) !!}
        {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, ['data-stripe' => 'exp-year']) !!}
    </label>
</div>

<div class="form-row">
    {!! Form::submit('Pay Now') !!}
</div>
<?php
if(isset($error1)){
echo "<p>$error1</p>";
}

?>
<div class="payment-errors"></div>

{!! Form::close() !!}
@endif
{!! HTML::script('js/vendor/jquery.js') !!}
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript" src="/js/stripeBilling.js">

</script>


@endsection