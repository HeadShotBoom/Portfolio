@extends('home')

@section('content')

<h1>We are here!</h1>


<?php
$value = Session::all();
echo "<pre>";
print_r($value);
echo "</pre>";
?>

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
@endif
@endsection