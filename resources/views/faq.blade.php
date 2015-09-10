@extends('home')

@section('content')
<div class="row">
<h2 class="small-12 columns">FAQ</h2>
</div>
<div class="row">
<h6 class="small-12 columns">We’ve compiled a list of frequently asked questions for your convenience. If you’re wondering, yes, all of these questions actually have been asked, as specific or as general as some of them may sound. If you have other questions, feel free to email our studio manager at reneohcoa44@gmail.com  You may click on any one of the questions in the “Index of Questions” for a shortcut to the answer; or you may browse all of the questions and answers in the “Full Q&A.”</h6>
</div>
<div class="row">
<div id="faqsort" data-magellan-expedition="fixed">
    <dl class="sub-nav">
        <dd data-magellan-arrival='placeholder'><a href="/FAQ">Categories: </a></dd>
        @foreach($category as $cat)
        <dd data-magellan-arrival={!! $cat->id !!}><a href="#{!! $cat->id !!}">{!! $cat->category !!}</a></dd>
        @endforeach
    </dl>
</div>
</div>
@foreach($category as $cat)
<div class="row">


<h4 data-magellan-destination={!! $cat->id !!} class="small-12 columns">Category: {!! $cat->category !!}<a name={!! $cat->id !!}></a></h4>
@foreach($faqs as $faq)
@if($faq->category==$cat->id)

<p class="small-12 columns"><strong>{!! $faq->question !!}</strong> {!! $faq->answer !!}</p>
@endif
@endforeach
</div>
@endforeach

{!! HTML::script('js/foundation/foundation.magellan.js') !!}
@endsection