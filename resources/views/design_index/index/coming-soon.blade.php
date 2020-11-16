<!DOCTYPE html>
<html lang="en">
<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт в стадии разработки</title>
    <!-- include the site stylesheet -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700'
          rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/new_design/css/bootstrap.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/new_design/css/animate.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/new_design/css/icon-fonts.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/new_design/css/main.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/new_design/css/responsive.css">
</head>
<body>
<!-- main container of all the page elements -->
<div id="wrapper">
    <!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
        <div class="loader">
            {{--            <img src="images/svg/rings.svg" alt="loader">--}}
        </div>
    </div>
    <div class="w1">
        <main id="mt-main" class="coming-soon" style="background-color: lightgrey;">
            <div class="countdown-center full">
                <div class="container">
                    <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                        <div class="mt-logo">
                            <a href="/">
                                @if(isset($brand->image))
                                    <img src="{{$brand->image}}">
                                @else
                                    <h3 style="font-weight: bold;font-size: 50px; color: black;">{{$brand->name}}</h3>
                                @endif
                            </a>
                        </div>
                        <div class="text2 text-uppercase">
                            <p style="color: black;">сайт в стадии разработки</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas-over" id="particles-js"></div>
        </main>
    </div>
</div>
<!-- include jQuery -->
<script src="/new_design/js/jquery.js"></script>
<!-- include jQuery -->
<script src="/new_design/js/plugins.js"></script>
<!-- include jQuery -->
<script src="/new_design/js/jquery.main.js"></script>
<!-- include jQuery -->
<script src="/new_design/js/particles.js"></script>
</body>
</html>