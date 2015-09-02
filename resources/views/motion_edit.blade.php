@extends('home')

@section('content')


<div class="row">

    <div class="small-12 medium-6 medium-centered columns">
        <p class="small-12 small-text-center columns" >Add a Link from Youtube or vimeo.</p>
        <p class="small-12 small-text-center columns red">Ensure you are posting the "Embed This Video" link.</p>
        {!! Form::open(array('url' => '/add_iframe')) !!}

        {!! Form::label('link', 'Link') !!}
        {!! Form::text('link') !!}

        {!! Form::label('description', 'Video Title') !!}
        {!! Form::text('description') !!}

        {!! Form::submit('Submit!') !!}
        {!! Form::close() !!}
    </div>
</div>
<br>
<div class="row">
@foreach($links as $link)
    <div class="small-12 medium-6 columns">
<div class="flex-video">
<iframe src="{!! $link->link !!}" width="420" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
        <div class="small-3 columns">
        @if($link->position != 1)
        {!! HTML::image('SiteImages/Up Arrow.png', 'Up Arrow', array('class' => 'arrows', 'onClick' => "window.location='/move_this_video_up/$link->id'")) !!}
        @endif
        @if($link->position != $last)
        {!! HTML::image('SiteImages/Down Arrow.png', 'Down Arrow', array('class' => 'arrows', 'onClick' => "window.location='/move_this_video_down/$link->id'")) !!}
        @endif
            </div>
        <p class="small-4 columns">{!! $link->description !!}</p>
        <a class="black-text small-4 small-text-right columns" href="/Motion/delete/{!! $link->id !!}">Delete</a>
    </div>
@endforeach
</div>




@endsection





