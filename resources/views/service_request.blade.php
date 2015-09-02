@extends('home')

@section('content')


<div class="row">

    <fieldset class="small-12 medium-6 medium-centered columns">
        <legend>To request services, please fill out the form below.</legend>

        {!! Form::open(array('url' => '/ServiceRequest', 'id' => 'serviceRequest')) !!}
        @if (session('status'))
        <p class="red">
            {{ session('status') }}
        </p>
        @endif
        {!! Form::label('name', 'Full Name') !!}
        {!! Form::text('name') !!}
        @if($errors->has('name'))
        <p class="red">{{ $errors->first('name') }}</p>
        @endif
        {!! Form::label('email', 'Email Address') !!}
        {!! Form::text('email') !!}
        @if($errors->has('email'))
        <p class="red">{{ $errors->first('email') }}</p>
        @endif
        {!! Form::label('phone', 'Phone Number') !!}
        {!! Form::text('phone') !!}
        @if($errors->has('phone'))
        <p class="red">{{ $errors->first('phone') }}</p>
        @endif
        {!! Form::label('address', 'Home Address') !!}
        {!! Form::text('address') !!}
        @if($errors->has('address'))
        <p class="red">{{ $errors->first('address') }}</p>
        @endif

        {!! Form::label('eventDate', 'What is the date of your event?') !!}
        <input type="text" id="eventDate" name="eventDate" />
        @if($errors->has('eventDate'))
        <p class="red">{{ $errors->first('eventDate') }}</p>
        @endif

        {!! Form::label('startTime', 'What time do you want us to start?') !!}
        {!! Form::text('startTime') !!}

        {!! Form::label('endTime', 'What time do you want us to end?') !!}
        {!! Form::text('endTime') !!}

        {!! Form::label('location1', 'First Location Address') !!}
        {!! Form::text('location1') !!}
        @if($errors->has('location1'))
        <p class="red">{{ $errors->first('location1') }}</p>
        @endif

        {!! Form::label('location2', 'Second Location Address', array('id' => 'location2label', 'style' => 'display:none;')) !!}
        {!! Form::text('location2', null, array('style' => 'display:none;')) !!}

        {!! Form::label('location3', 'Third Location Address', array('id' => 'location3label', 'style' => 'display:none;')) !!}
        {!! Form::text('location3', null, array('style' => 'display:none;')) !!}

        {!! Form::label('services', 'What kind of services do you want us to provide?') !!}
        {!! Form::select('services', array('' => '', 'Photo' => 'Photo', 'Video' => 'Video', 'Photo_Video' => 'Photo & Video')) !!}
        @if($errors->has('services'))
        <p class="red">{{ $errors->first('services') }}</p>
        @endif

        {!! Form::label('eventtype', 'What type of event will we be capturing?') !!}
        {!! Form::text('eventtype') !!}
        @if($errors->has('eventtype'))
        <p class="red">{{ $errors->first('eventtype') }}</p>
        @endif

        {!! Form::label('meals', 'Will you be providing a meal for our staff? (Events over 4 Hours)') !!}
        {!! Form::text('meals') !!}
        @if($errors->has('meals'))
        <p class="red">{{ $errors->first('meals') }}</p>
        @endif
        {!! Form::label('planner', 'Do you have an event coordinator/contact person?') !!}
        {!! Form::select('planner', array('' => '', 'Yes' => 'Yes', 'No' => 'No')) !!}
        @if($errors->has('planner'))
        <p class="red">{{ $errors->first('planner') }}</p>
        @endif
        {!! Form::label('plannerName', 'What\'s the name of your coordinator/contact person', array('id' => 'plannerNameLabel')) !!}
        {!! Form::text('plannerName') !!}
        @if($errors->has('plannerName'))
        <p class="red">{{ $errors->first('plannerName') }}</p>
        @endif

        {!! Form::label('plannerNumber', 'Provide coordinator/contact person\'s contact information.', array('id' => 'plannerContactLabel')) !!}
        {!! Form::text('plannerNumber') !!}
        @if($errors->has('plannerNumber'))
        <p class="red">{{ $errors->first('plannerNumber') }}</p>
        @endif

        {!! Form::label('dj', 'Do you have a DJ, Band, or Host?') !!}
        {!! Form::select('dj', array('' => '', 'Yes' => 'Yes', 'No' => 'No')) !!}
        @if($errors->has('dj'))
        <p class="red">{{ $errors->first('dj') }}</p>
        @endif
        {!! Form::label('djName', 'What\'s the name of the DJ, Band, or Host?', array('id' => 'djNameLabel')) !!}
        {!! Form::text('djName') !!}
        @if($errors->has('djName'))
        <p class="red">{{ $errors->first('djName') }}</p>
        @endif

        {!! Form::label('rush', 'Typical turn around to receive your final product is 4-6 weeks, do you require rush processing?') !!}
        {!! Form::select('rush', array('' => '', 'Yes' => 'Yes', 'No' => 'No')) !!}

        {!! Form::label('rushDate', 'Select the date you require delivery of your product', array('id' => 'rushDateLabel')) !!}
        <input type="text" id="rushDate" name="rushDate" />
        @if($errors->has('rush'))
        <p class="red">{{ $errors->first('rushDate') }}</p>
        @endif
        {!! Form::label('videoStyle', 'What style(s) would you like your video edited in?', array('id' => 'videoLabel1')) !!}

        {!! Form::checkbox('Documentary', 'Documentary', null, ['id' => 'Documentary']) !!}
        {!! Form::label('Documentary', 'Documentary', array('id' => 'videoLabel2')) !!}

        {!! Form::checkbox('Highlights_Video', 'Highlights Video', null, ['id' => 'Highlights_Video']) !!}
        {!! Form::label('Highlights_Video', 'Highlights Video', array('id' => 'videoLabel3')) !!}

        {!! Form::checkbox('Commercial', 'Commercial', null, ['id' => 'Commercial']) !!}
        {!! Form::label('Commercial', 'Commercial', array('id' => 'videoLabel4')) !!}

        {!! Form::label('videoFormat', 'In what format would you like to receive your video?', array('id' => 'videoLabel5')) !!}

        {!! Form::checkbox('Blu-Ray', 'Blu-Ray', null, ['id' => 'Blu-Ray']) !!}
        {!! Form::label('Blu-Ray', 'Blu-Ray', array('id' => 'videoLabel6')) !!}

        {!! Form::checkbox('DVD', 'DVD', null, ['id' => 'DVD']) !!}
        {!! Form::label('DVD', 'DVD', array('id' => 'videoLabel7')) !!}

        {!! Form::checkbox('Digital_File', 'Digital File', null, ['id' => 'Digital_File']) !!}
        {!! Form::label('Digital_File', 'Digital File', array('id' => 'videoLabel8')) !!}

        {!! Form::label('photoFormat', 'In what format would you like to receive your photos?', array('id' => 'photoLabel1')) !!}

        {!! Form::checkbox('Print', 'Print', null, ['id' => 'Print']) !!}
        {!! Form::label('Print', 'Print', array('id' => 'photoLabel2')) !!}

        {!! Form::checkbox('Digital_Images', 'Digital Images', null, ['id' => 'digital_images']) !!}
        {!! Form::label('Digital Images', 'Digital Images', array('id' => 'photoLabel3')) !!}

        {!! Form::checkbox('Raw_Files', 'Raw Files', null, ['id' => 'Raw_Files']) !!}
        {!! Form::label('Raw_Files', 'Raw Files', array('id' => 'photoLabel4')) !!}

        <br>
        {!! Form::label('message', 'Is there anything specific about your event that I need to know?') !!}
        {!! Form::textarea('message') !!}
        @if($errors->has('message'))
        <p class="red">{{ $errors->first('message') }}</p>
        @endif
        <input type="submit" value="Submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" />
        {!! Form::close() !!}

    </fieldset>

</div>
{!! HTML::script('js/vendor/jquery.js') !!}
<script>
    $(document).ready(function() {
        toggleFields();

        $('#rush').change(function(){
            toggleFields();
        });
        $('#services').change(function(){
            toggleFields();
        });
        $('#dj').change(function(){
            toggleFields();
        });
        $('#planner').change(function(){
            toggleFields();
        });


        function toggleFields(){
            if($('#rush').val() != 'Yes'){
                $('#rushDate').hide();
                $('#rushDateLabel').hide();
            }else{
                $('#rushDate').show();
                $('#rushDate').glDatePicker();
                $('#rushDateLabel').show();
            }

            $('#location1').change(function(){
                $('#location2label').show();
                $('#location2').show();
            });

            $('#location2').change(function(){
                $('#location3label').show();
                $('#location3').show();
            });


            if($('#services').val() == 'Photo'){
                $('#videoLabel1').hide();
                $('#videoLabel2').hide();
                $('#videoLabel3').hide();
                $('#videoLabel4').hide();
                $('#videoLabel5').hide();
                $('#videoLabel6').hide();
                $('#videoLabel7').hide();
                $('#videoLabel8').hide();
                $('#Documentary').hide();
                $('#Highlights_Video').hide();
                $('#Commercial').hide();
                $('#Blu-Ray').hide();
                $('#DVD').hide();
                $('#Digital_File').hide();
                $('#photoLabel1').show();
                $('#photoLabel2').show();
                $('#photoLabel3').show();
                $('#photoLabel4').show();
                $('#Print').show();
                $('#digital_images').show();
                $('#Raw_Files').show();
            }else if($('#services').val() == 'Video'){
                $('#videoLabel1').show();
                $('#videoLabel2').show();
                $('#videoLabel3').show();
                $('#videoLabel4').show();
                $('#videoLabel5').show();
                $('#videoLabel6').show();
                $('#videoLabel7').show();
                $('#videoLabel8').show();
                $('#Documentary').show();
                $('#Highlights_Video').show();
                $('#Commercial').show();
                $('#Blu-Ray').show();
                $('#DVD').show();
                $('#Digital_File').show();
                $('#photoLabel1').hide();
                $('#photoLabel2').hide();
                $('#photoLabel3').hide();
                $('#photoLabel4').hide();
                $('#Print').hide();
                $('#digital_images').hide();
                $('#Raw_Files').hide()
            }else if($('#services').val() == 'Photo_Video'){
                $('#videoLabel1').show();
                $('#videoLabel2').show();
                $('#videoLabel3').show();
                $('#videoLabel4').show();
                $('#videoLabel5').show();
                $('#videoLabel6').show();
                $('#videoLabel7').show();
                $('#videoLabel8').show();
                $('#Documentary').show();
                $('#Highlights_Video').show();
                $('#Commercial').show();
                $('#Blu-Ray').show();
                $('#DVD').show();
                $('#Digital_File').show();
                $('#photoLabel1').show();
                $('#photoLabel2').show();
                $('#photoLabel3').show();
                $('#photoLabel4').show();
                $('#Print').show();
                $('#digital_images').show();
                $('#Raw_Files').show()
            }
            else{
                $('#videoLabel1').hide();
                $('#videoLabel2').hide();
                $('#videoLabel3').hide();
                $('#videoLabel4').hide();
                $('#videoLabel5').hide();
                $('#videoLabel6').hide();
                $('#videoLabel7').hide();
                $('#videoLabel8').hide();
                $('#Documentary').hide();
                $('#Highlights_Video').hide();
                $('#Commercial').hide();
                $('#Blu-Ray').hide();
                $('#DVD').hide();
                $('#Digital_File').hide();
                $('#photoLabel1').hide();
                $('#photoLabel2').hide();
                $('#photoLabel3').hide();
                $('#photoLabel4').hide();
                $('#Print').hide();
                $('#digital_images').hide();
                $('#Raw_Files').hide()
            }

            if($('#dj').val() == 'Yes'){
                $('#djName').show();
                $('#djNameLabel').show();
            }else{
                $('#djName').hide();
                $('#djNameLabel').hide();
            }

            if($('#planner').val() == 'Yes'){
                $('#plannerName').show();
                $('#plannerNameLabel').show();
                $('#plannerContactLabel').show();
                $('#plannerNumber').show();
            }else{
                $('#plannerName').hide();
                $('#plannerNameLabel').hide();
                $('#plannerContactLabel').hide();
                $('#plannerNumber').hide();
            }



        }
    })
</script>

@endsection