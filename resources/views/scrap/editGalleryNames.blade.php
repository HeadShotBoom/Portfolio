@extends('home')

@section('content')


<div class="row">
    <h3 class="small-12 small-text-center columns">Edit Photo Galleries</h3>
</div>

<div class="row">
    <fieldset class="small-12 medium-6 columns small-centered">
        <legend>Add A Gallery</legend>

        {!! Form::open(array('url' => '/add_gal')) !!}

        {!! Form::label('gallery', 'Gallery Name:') !!}
        {!! Form::text('gallery') !!}

        {!! Form::submit('Submit!'); !!}

        {!! Form::close() !!}
    </fieldset>
</div>
<br>
<div class="row">
        @foreach($names as $name)
        <form class="small-12 medium-7 small-centered columns" action="/MyPortfolio/edit" method="post">
            <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>">
            <input name="id" type="hidden" value="{!! $name->id !!}">

            <label for="gallery">Gallery Name: </label>
            <input name="gallery" type="text" value="{!! $name->gallery !!}" id="gallery">

            <input class="button small success radius" type="submit" value="Edit!">
            @if($name->position != 1)
            <a class="button small radius secondary" href="/position/{!! $name->id !!}/up">Move Up!</a>
            @endif
            @if($name->position != $last )
            <a class="button small radius secondary" href="/position/{!! $name->id !!}/down">Move Down!</a>
            @endif
            <a class="button small alert radius" href="/gallery/delete/{!! $name->id !!}">Delete This Gallery</a>
        </form>

    <br>
        @endforeach

</div>

@endsection