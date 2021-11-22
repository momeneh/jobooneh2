<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- fevicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('green') }}/images/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('green') }}/images/favicon.png">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- site metas -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('title.main_title') }} @yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('green') }}/css/xzoom.css">
    <link rel="stylesheet" href="{{ asset('green') }}/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('green') }}/css/starability-growRotate.css">
    @if(app()->getLocale() == 'fa')
        <link rel="stylesheet" href="{{ asset('green') }}/css/fa.css">
    @else
        <link rel="stylesheet" href="{{ asset('green') }}/css/en.css">
    @endif
    <link href="{{ asset('white') }}/css/nucleo-icons.css" rel="stylesheet" />
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('green') }}/css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/jquery.mCustomScrollbar.min.css">

    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="{{ asset('green') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('green') }}/css/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <!-- Javascript files-->
    <script src="{{asset('pub')}}/jquery-1.12.4.js"></script>
    <script src="{{ asset('green') }}/js/jquery.min.js"></script>
    <script src="{{ asset('green') }}/js/popper.min.js"></script>
    <script src="{{ asset('green') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('green') }}/js/jquery-3.0.0.min.js"></script>
    <script src="{{ asset('green') }}/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="{{ asset('green') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('green/js/custom.js') }}"></script>
    <!-- javascript -->
    <script src="{{ asset('green') }}/js/owl.carousel.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('white') }}/js/plugins/bootstrap-notify.js"></script>
    <script src="{{ asset('white') }}/js/theme.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
{{--    <script src="{{ asset('green') }}/js/jquery.fancybox.min.js"></script>--}}
</head>
<body class="main-layout " STYLE="direction:
@if(app()->getLocale() == 'fa')  rtl
@else ltr
@endif
    " >
<!-- loader  -->
{{--<div class="loader_bg">--}}
{{--    <div class="loader"><img src="{{ asset('green') }}/images/loading.gif" alt="#" /></div>--}}
{{--</div>--}}
<!-- end loader -->

<!-- header inner -->
<div class="header">

    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            @if(app()->getLocale() == 'fa')
                                <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logofa.png" alt="#"></a>
                            @else
                                <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logoen.png" alt="#"></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <div class="location_icon_bottum_tt">
                    <ul>
                        <li><img src="{{ asset('green') }}/icon/loc1.png" />
                            @if(app()->getLocale() == 'fa')  <a class="en" href="{{ route('lang','en') }}" >English</a>
                            @else <a class="en" href="{{ route('lang','fa') }}" > Farsi </a>
                            @endif
                        </li>
                        <li>
                            <div class="user_info_show">

                            @if(empty(auth()->id()))
                                <a href="{{route('login')}}">
                                    <img id="icon-user"    src="{{ asset('green') }}/icon/user.png" onmouseover="this.src='{{asset('green')}}/icon/user1.png'" onmouseout="this.src='{{asset('green')}}/icon/user.png'" /> {{__('login')}}</a>
                            @else
                                    <img id="icon-user"  class="user_info" src="{{ asset('green') }}/icon/user.png" onmouseover="this.src='{{asset('green')}}/icon/user1.png'" onmouseout="this.src='{{asset('green')}}/icon/user.png'" /><span class="tim-icons icon-minimal-down icon-user-info user_info"></span>
                                    @include('layouts.box_user_info')
                            @endif
                            <a href="{{route('basket.index')}}"><img src="{{ asset('green') }}/icon/bask.png" onmouseover="this.src='{{asset('green')}}/icon/bask1.png'" onmouseout="this.src='{{asset('green')}}/icon/bask.png'"  /></a>
                            </div>

                        </li>

                        {{--                            <li><img src="{{ asset('green') }}/icon/call1.png" />(+71)9876543109</li>--}}
                    </ul>
                </div>
            </div>
        </div>
        @include('includes.menu_bar')
    </div>
</div>
<!-- end header inner -->
@include('includes.message_js')
@yield('content')

<!--  footer -->
<div class="footer top_layer ">
    <div class="container">

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address">
                    <div class="logo">
                        @if(app()->getLocale() == 'fa')
                            <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logofa.png" alt="#"></a>
                        @else
                            <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logoen.png" alt="#"></a>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <p  style="font-size: 15px;text-align: justify">
                        {!! $footer_desc[0]['body'] !!}
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address footer_links">
                    <h3>{{__('Quick links')}}</h3>
                    <ul class="">
                        @foreach($main_menus as $menu_item)
                            <li > <img class="arrow" src="{{ asset('green') }}/icon/3.png" alt="#" /> <a href="{{$menu_item['link']}}">{{$menu_item['title']}}</a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address footer_links">
                    <h3>{{__('Subscribe')}}</h3>
                    <p style="font-size: 15px;text-align: justify" > {{__('With subscribe you can be aware of news in our site')}} </p>
                    <input class="form-control" placeholder="Your Email" type="type" name="subscribe_mail" id="subscribe_mail" url="{{route('subscribe')}}">
                    <button class="submit-btn" onclick="subscribe()">Submit</button>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address footer_links">
                    <h3>{{__('Contact Us')}}</h3>

                    <ul class="loca">
                        <li style="font-size: 14px;"> <a href="#"><img src="{{ asset('green') }}/icon/email.png" alt="#" />   momeneh.jafari@gmail.com </a></li>
                        <li> <a href="#"><img src="{{ asset('green') }}/icon/call.png" alt="#" />  +12586954775</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="container">
        © 2021 made with momeneh.jafari@gmail.com thanks to
        <a href="https://creative-tim.com" target="_blank">{{ _('Creative Tim') }}</a> &amp;
        <a href="https://updivision.com" target="_blank">{{ _('Updivision') }}</a>

    </div>
</div>
<!-- end footer -->
@yield('scripts')

</body>
</html>
