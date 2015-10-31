<p>{!! $whichClient !!} has placed a request for images through your site. He/She has requested the following images.</p>

<?php
foreach($imageNames as $thisImage){
    echo "<p>$thisImage</p>";
}
?>