<p>{!! $individualInfo['name'] !!} would like to purchase some images from the gallery named {!! $individualInfo['galleryName'] !!}. He/She has requested the following images.</p>
<p>Their email address is: {!! $individualInfo['email'] !!}</p>

<?php
foreach($imageNames as $thisImage){
    echo "<p>$thisImage</p>";
}
?>