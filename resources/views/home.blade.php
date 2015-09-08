<!DOCTYPE html>
<html>
    <head>
        <title>Legendary Productions</title>
        {!! HTML::style('css/combinedCss.css') !!}
        {!! HTML::script('js/vendor/modernizr.js') !!}
    </head>
    <body>
    <div class="row">
    <a href="/"><h1 class="small-12 columns small-text-center">Legendary Productions</h1></a>
    </div>
    <div class="row">
        @include('partials.nav')
    </div>
        @yield('content')

    @if($__env->yieldContent('content')==null)

    <div class="fadein">
        @foreach($allHomeImages as $image)
        <img src="{{ $image->path }}" alt="{{ $image->alt_tag }}" onclick="window.location='<?php
        $path = substr(ltrim($image->path, '/'), 0, strpos(ltrim($image->path, '/'), '/'));
        if($path=='gallery'){
            echo "/Portfolio/".$image->category;
        }else if($path=='ProjectImages'){
            echo "/Projects/".$image->category;
        }
?>
            '"/>
        @endforeach
    </div>

    @endif

    {!! HTML::script('js/vendor/jquery.js') !!}
    {!! HTML::script('js/foundation/foundation.js') !!}
    {!! HTML::script('js/foundation/foundation.topbar.js') !!}
    {!! HTML::script('js/glDatePicker.min.js') !!}
        <script>
            $(document).foundation();
        </script>
    <script>
        $(window).load(function()
        {
            $('#eventDate').glDatePicker();

        });
    </script>
    @if($__env->yieldContent('content')==null)
    <script>
        $(function(){
            $('.fadein img:gt(0)').hide();

            var totalImg = $('.fadein img').length+1;
            var lastImg = $('.fadein img').length;
            var number = 1;
            function resetEm(){
                if(number!=1) {
                    $('.fadein :nth-child(' + number + ')').prev().removeClass().css('display', 'none');
                }else if(number===1){
                    $('.fadein :nth-child(' + lastImg + ')').removeClass().css('display', 'none');
                }
            }

            function slideEm(){
                setTimeout(resetEm, 2000);
                $('.fadein :nth-child(' + number + ')').removeClass().addClass('animated slideOutLeft');
                number++;
                $('.fadein :nth-child(' + number + ')').addClass('animated slideInRight').css('display', 'block');
                if(number==totalImg){
                    $('.fadein :nth-child(' + lastImg + ')').addClass('animated slideOutLeft');
                    $('.fadein :nth-child(1)').addClass('animated slideInRight').css('display', 'block');
                    number=1;
                    setTimeout(slideEm, 4000);
                }else{
                    setTimeout(slideEm, 4000);
                }
            }
            setTimeout(slideEm, 1000);
        });
    </script>
    @endif
    </body>
</html>


