@extends('home')

@section('content')

<div class="row">
    @foreach($links as $link)
    <div class="small-12 medium-6 columns">
        <div class="flex-video">
            <iframe src={!! $link->link !!} width="420" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <p class="small-12 small-text-center">{!! $link->description !!}</p>
    </div>
    @endforeach
</div>

@endsection