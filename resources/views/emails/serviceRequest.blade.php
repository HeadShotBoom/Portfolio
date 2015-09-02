<p>You have been contacted by a potential client. The following is a record of the information they have sent you.</p>


<p>Full Name: {{ $data['name'] }}</p>
<p>Email: {{ $data['email'] }}</p>
<p>Phone: {{ $data['phone'] }}</p>
<p>Address: {{ $data['address'] }}</p>
<p>Event Date: {{ $data['eventDate'] }}</p>


<?php
if($data['startTime'] != '') {
    echo "<p>Start Time: ". $data['startTime'] ."</p>";
}


if( $data['endTime']  != '') {
    echo "<p>End Time: " . $data['endTime'] . "</p>";
}

if( $data['location1'] != '') {
    echo "<p>First Location: " . $data['location1'] . "</p>";
}

if( $data['location2'] != '') {
    echo "<p>Second Location: " . $data['location2'] . "</p>";
}

if( $data['location3'] != '') {
    echo "<p>Third Location: " . $data['location3'] . "</p>";
}

if( $data['services']  == 'Photo'){
    echo "<p>Services Requested: Photo Only </p>";
}elseif( $data['services']  == 'Video'){
    echo "<p>Services Requested: Video Only </p>";
}elseif( $data['services']  == 'Photo_Video') {
    echo "<p>Services Requested: Photo & Video </p>";
}
if( $data['eventtype'] != '') {
    echo "<p>Event Type: " . $data['eventtype'] . "</p>";
}

if( $data['meals'] != '') {
    echo "<p>Providing Meals: " . $data['meals'] . "</p>";
}

if( $data['planner'] == 'Yes') {
    if ($data['plannerName'] != '' && $data['plannerNumber'] != '') {
        echo "<p>We are using " . $data['plannerName'] . " as our event planner. Their contact info is: " . $data['plannerNumber'] . "</p>";
    }else if($data['plannerName'] != '' ){
        echo "<p>We are using " . $data['plannerName'] . " as our event planner. We did not provide contact info. </p>";
    }else{
        echo "<p>We are using an event planner but provided no information about them</p>";
    }
}elseif($data['planner'] == 'No'){
    echo "<p>We will not have an event planner.</p>";
}

if( $data['dj'] == 'Yes' && $data['djName'] != '') {
    echo "<p>We have a DJ/Band/Host, we will be using " . $data['djName'] . "</p>";
}elseif($data['dj'] == 'Yes'){
    echo "<p>We will have a DJ/Band/Host but did not provide their name.</p>";
}elseif($data['dj'] == 'No'){
    echo "<p>We will not have a DJ/Band/Host</p>";
}

if( $data['rush'] == 'Yes'){
    echo "<p>We require a rush delivery date of: " . $data['rushDate'] . "</p>";
}

if($data['services']  == 'Video' || $data['services']  == 'Photo_Video') {
    if (isset($data['Documentary']) || isset($data['Highlights_Video']) || isset($data['Commercial'] )) {
        echo "<p>I would like the following video products: ";
        if (isset($data['Documentary'])) {
            echo " Documentary Video ";
        }
        if (isset($data['Highlights_Video'])) {
            echo " Highlights Video ";
        }
        if (isset($data['Commercial'])) {
            echo " Commercial Video ";
        }
        echo "</p>";
    }

    if (isset($data['Blu-Ray']) || isset($data['DVD']) || isset($data['Digital_File'])) {
        echo "<p>We would like the video to be delivered in the following way: ";
        if (isset($data['Blu-Ray'])) {
            echo " Bluray Disk ";
        }
        if (isset($data['DVD'])) {
            echo " DVD ";
        }
        if (isset($data['Digital_File'])) {
            echo " Digital File ";
        }
        echo "</p>";
    }
}


if($data['services']  == 'Photo' || $data['services']  == 'Photo_Video') {
         if (isset($data['Print']) || isset($data['Digital_Images']) || isset($data['Raw_Files'])) {
             echo "<p>We would like the photos to be delivered in the following way: ";
            if (isset($data['Print'])) {
                echo " Printed Images ";
            }
            if (isset($data['Digital_Images'])) {
                echo " Digital Images ";
            }
            if (isset($data['Raw_Files'])) {
                echo " Raw Files ";
            }
            echo "</p>";
        }
}
if($data['message'] != '') {
    echo "<p>Their additional message says: " . $data['message'] . "</p>";
}
?>


