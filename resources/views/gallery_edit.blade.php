@extends('home')

@section('content')

<div class="row">
    <h1 class="small-12 small-text-center columns">Edit {!! $title !!} Gallery</h1>
    <p class="small-12 small-text-center columns red">ONLY UPLOAD JPEG IMAGES</p>
    <p id="galleryname" class="hidden">{!! $title !!}</p>
</div>


<div class="row">
    <div class="small-12 medium-10 small-centered columns dropzone" id="dropzoneFileUpload">
    </div>
</div>

{!! HTML::script('js/dropzone.js') !!}

<script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    var extendedUrl = "/Portfolio/" + document.getElementById('galleryname').innerHTML + "/upload";
    var token = "{{ Session::getToken() }}";
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#dropzoneFileUpload", {
        url: baseUrl + extendedUrl,
        params: {
            _token: token
        }
    });
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 30, // MB
        addRemoveLinks: true,
        acceptedFiles: ".jpeg",
        accept: function(file, done) {

        },
    };
</script>
<div class="grid">
@foreach($images as $image)
    <group>
        <img src="{!! $image->path !!}" />
        @if($image->position != 1)
        {!! HTML::image('SiteImages/Up Arrow.png', 'Up Arrow', array('class' => 'arrows', 'onClick' => "window.location='/move_this_image_up/$image->id'")) !!}
        @endif
        @if($image->position != $last)
        {!! HTML::image('SiteImages/Down Arrow.png', 'Down Arrow', array('class' => 'arrows', 'onClick' => "window.location='/move_this_image_down/$image->id'")) !!}
        @endif
        @if($image->main_gallery == 0)
        <a href="/add_main_gal/{!! $image->id !!}">Add To Main Portfolio?</a>
        @elseif($image->main_gallery == 1)
        <a href="/rem_main_gal/{!! $image->id !!}" class="red">Remove From Main Portfolio</a>
        @endif
        @if($image->home_page == 0)
        <a href="/add_home_page_gal/{!! $image->id !!}">Add To Home Page?</a>
        @elseif($image->home_page == 1)
        <a href="/rem_home_page_gal/{!! $image->id !!}" class="red">Remove From Home Page</a>
        @endif
        <a href="delete/{!! $image->id !!}" class="red">Delete</a>
    </group>
@endforeach
</div>





{!! HTML::script('js/gridify.js') !!}
<script type="text/javascript">
    window.onload = function(){
        document.querySelector('.grid').gridify({srcNode: 'group', margin: '20px', width: '550px', resizable: true});
    }
</script>
@endsection