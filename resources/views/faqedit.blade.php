@extends('home')

@section('content')


@foreach($category as $cat)
<div class="row">
    <?php
    $length = count($faqs);
    if($length===0){
        $token = csrf_token();
        echo "<div class='small-6 medium-3 columns delcat'>";
        echo "<form action='/delete_cat' method='post'><input type='hidden' name='id' value=$cat->id><input type='hidden' name='_token' value=$token><input type='Submit' value='Delete Category'></form>";
        echo "</div>";
    }else {
        for ($i = 0; $i < $length; $i++) {
            if ($faqs[$i]->category == $cat->id) {
                $i = count($faqs) + 100000000;
            } else if ($i == count($faqs) - 1 && $faqs[$i]->category != $cat->id) {
                $token = csrf_token();
                echo "<div class='small-6 medium-3 columns delcat'>";
                echo "<form action='/delete_cat' method='post'><input type='hidden' name='id' value=$cat->id><input type='hidden' name='_token' value=$token><input type='Submit' value='Delete Category'></form>";
                echo "</div>";
            }
        }
    }
    ?>

    <div class="small-6 medium-9 columns">
        <h4>Category: {!! $cat->category !!} </h4>
    </div>
</div>

@foreach($faqs as $faq)
@if($faq->category==$cat->id)
<div class="row">
<form class="small-11 columns" action="/edit_faq" method="post">
    <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>">
    <input name="id" type="hidden" value="{!! $faq->id !!}">
    <div class="row">
        <div class="small-12 medium-2 columns">
        <label for="category">Category: </label>
        <select autocomplete="off" name="category">
        @foreach($category as $cat1)
        @if($cat1->id == $cat->id)
        <option value="{!! $cat1->id !!}" selected="selected">{!! $cat1->category !!}</option>
        @else
        <option value="{!! $cat1->id !!}">{!! $cat1->category !!}</option>
        @endif
        @endforeach
    </select>
        </div>
        <div class="small-12 medium-4 columns">
    <label for="question">Question: </label>
    <input name="question" type="text" value="{!! $faq->question !!}" id="question">
    </div>
        <div class="small-12 medium-5 columns">
    <label for="answer">Answer: </label>
    <input name="answer" type="text" value="{!! $faq->answer !!}" id="answer">
</div>
        <div class="small-11 medium-1 columns button-slide-down">
    <input type="submit" value="Edit!">
            </div>
    </div>
</form>

    <div class="small-1 columns button-slide-down2">
        <form action="/delete_faq" method="post"><input type="hidden" name="id" value="{!! $faq->id !!}"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="Submit" value="Delete"></form>
    </div>
    </div>


@endif
@endforeach
<hr>
@endforeach

<div class="row">
<fieldset class="small-12 medium-6 columns small-centered">
<legend>Add A Question</legend>
{!! Form::open(array('url' => '/FAQ/edit')) !!}

{!! Form::label('category', 'Category:') !!}

<select name="category">
    @foreach($category as $cat)
    <option value="{{$cat->id}}">{{$cat->category}}</option>
    @endforeach
</select>

{!! Form::label('question', 'FAQ Question:') !!}
{!! Form::text('question') !!}
{!! Form::label('answer', 'FAQ Answer:') !!}
{!! Form::text('answer') !!}
{!! Form::submit('Submit!'); !!}
{!! Form::close() !!}
</fieldset>
</div>
<div class="row">
    <fieldset class="small-12 medium-6 columns small-centered">
        <legend>Add A Category</legend>
{!! Form::open(array('url' => '/add_cat')) !!}

{!! Form::label('add_cat', 'Category') !!}
{!! Form::text('add_cat') !!}
{!! Form::submit('Submit!'); !!}
{!! Form::close() !!}
        </fieldset>
</div>
@endsection