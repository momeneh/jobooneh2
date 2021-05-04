<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('green') }}/css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/jquery.mCustomScrollbar.min.css">
    @if(app()->getLocale() == 'fa')
        <link href="{{ asset('green') }}/css/fa.css?v=1.0.0" rel="stylesheet" />
    @else
        <link href="{{ asset('green') }}/css/en.css?v=1.0.0" rel="stylesheet" />
@endif
<!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body class="main-layout " STYLE="direction:
@if(app()->getLocale() == 'fa')  rtl
@else ltr
@endif
    " >
<header>
    <!-- header inner -->
    <div class="header">

        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                @if(app()->getLocale() == 'fa')
                                    <a href="index.html"><img src="{{ asset('green') }}/images/logofa.png" alt="#"></a>
                                @else
                                    <a href="index.html"><img src="{{ asset('green') }}/images/logoen.png" alt="#"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end header inner -->
    <div class="wrapper">


        <div class="main-panel" >
            <div class="content">
                @yield('content')
            </div>

        </div>
    </div>
</header>



    </body>
</html>
