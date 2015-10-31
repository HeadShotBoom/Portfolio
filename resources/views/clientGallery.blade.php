@extends('home')

@section('content')

@if(Auth::check())
<div class="row">
    <div class="small-12 medium-10 small-centered columns dropzone" id="dropzoneFileUpload">
    </div>
</div>

{!! HTML::script('js/dropzone.js') !!}

<script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    var url = window.location.href;
    var galleryName = decodeURI(url.substring(url.lastIndexOf('/')+1));
    var extendedUrl = "/ClientGallery/" + galleryName + "/upload";
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
@elseif($groupOrNot === 'individual')
<div class="row">
    <h5 class="small-12 small-text-center columns">Please select the images you would like to order below. Once your finished click <strong>Place Order</strong> below.</h5>
    <a class="small-12 small-text-center columns button success" href="/submitClientOrder/{!! $galleryName !!}">Submit Order!</a>
</div>
@elseif($groupOrNot === 'group')
    <h5 class="small-12 small-text-center columns">Select the images you would like, enter your information, and press place order.</h5>
<div class="row">
<form class="small-12 small-centered medium-6 columns" action="/placeGroupOrder/{!! $galleryName !!}" method="get">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" />
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" />
        <input type="hidden" name="galleryName" value="{!! $galleryName !!}" />
        <input type="submit" value="Place Order" class="button success">
    </form>
</div>
@endif


<div class="grid">
    @foreach($relevantImages as $image)
    <group>
        @if($image->chosenImage != 1)
        <img src="{!! $image->thumbPath !!}" id="{!! $image->id !!}" />
        <a href="/pickThisImage/{!! $image->id !!}">Select This Image</a>
        @endif

        @if($image->chosenImage == 1)
        <img src="{!! $image->thumbPath !!}" id="{!! $image->id !!}"  class="selectedImage" />
        <a href="/unPickThisImage/{!! $image->id !!}" class="red">Deselect This Image</a>
        @endif

        @if(Auth::check())
        <a href="deleteClientImage/{!! $image->id !!}">Delete Image</a>
        @endif
    </group>
    @endforeach
</div>

{!! HTML::script('js/gridify.js') !!}
<script type="text/javascript">
    window.onload = function(){
        var options =
        {
            srcNode: 'group',
            margin: '10px',
            max_width: '550px',
            resizable: true,
            transition: 'all 0.5s ease'
        }
        document.querySelector('.grid').gridify(options);
    }
</script>
@endsection