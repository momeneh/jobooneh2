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
    <title>{{ __('title.main_title') }}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/style.css">
    @if(app()->getLocale() == 'fa')
        <link rel="stylesheet" href="{{ asset('green') }}/css/fa.css">
    @else
        <link rel="stylesheet" href="{{ asset('green') }}/css/en.css">
    @endif
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('green') }}/css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('green') }}/css/jquery.mCustomScrollbar.min.css">

    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
<!-- header -->
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
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <div class="location_icon_bottum_tt">
                        <ul>
                            <li><img src="{{ asset('green') }}/icon/loc1.png" />
                                @if(app()->getLocale() == 'fa')  <a class="en" href="{{ route('lang','en') }}" >English</a>
                                @else <a class="en" href="{{ route('lang','fa') }}" > Farsi </a>
                                @endif
                            </li>
                            <li><img src="{{ asset('green') }}/icon/email1.png" />info@mamanDooz.com</li>

{{--                            <li><img src="{{ asset('green') }}/icon/call1.png" />(+71)9876543109</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            @include('includes.menu_bar')
        </div>
    </div>
    <!-- end header inner -->
</header>
<!-- end header -->
@include('includes.slider')
<!-- about -->
<div id="about" class="about">
    <div class="container">
        <div class="row">

            <div class="col-xl-5 col-lg-5 col-md-5 co-sm-l2">
                <div class="about_box">
                    {!! $about_us[0]['body'] !!}
                    <a href="{{route('pages.show',$about_us[0]['id'])}}">{{__('title.read_more')}}</a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 co-sm-l2">
                <div class="about_img">
                    <figure><img src="{{ asset('green') }}/images/about2.png" alt="img" /></figure>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about -->
<!-- for_box -->
<div class="for_box_bg">
    <div class="container">
        <div class="row">
            @foreach($category_pros as $cp)
                <div class="col-xl-3 col-lg-3 col-md-3 co-sm-l2">
                    <div class="for_box">
                        <i><img src="{{ asset('category_icons/'.$cp->icon) }}" alt="#"/></i>
                        <span>{{$cp->count_pro}}</span>
                        <h3>{{$cp->title}}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end for_box -->
<!-- offer -->
<div class="offer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2 >{{__("NEW")}} <strong class="black"> {{__("PRODUCTS")}}</strong></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="offer-bg">
        <div class="container">
            <div class="row">
                @php $style_ar=['','margin_ttt','margin-lkk'] @endphp
                @foreach($new_products as $i=>$np)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 {{$style_ar[$i]}}">
                        <div class="offer_box">
                            <h3>{{$np->title}}</h3>
                            @if(!empty($np->images[0]->image))
                                <figure><img src="{{ asset('product_images/'.$np->images[0]->image) }}" alt="img" /></figure>
                            @endif
                            <p>{{substr($np->description,0,500)}}</p>

                        </div>
                    </div>

                @endforeach
            </div>


        </div>

    </div>
    <div class="read_more">
        <a class="read-more">See More</a>
    </div>
</div>

<!-- end offer -->

<!-- product -->
<div id="product" class="product">
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2 >{{__('title.most_visited')}} <strong class="black"> {{__('title.products')}}</strong></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach($most_visited_products as $mv)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="product_box">
                            <figure><img src="{{ asset('product_images/'.$mv->images[0]->image)}}" alt="#" />
                                <h3>{{$mv->title}}</h3></figure>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>


<!-- end product -->
<!-- clients -->
<div id="testimonial" class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2  >{{__('title.business_owners')}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clients_red">
    <div class="container">
        <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#testimonial_slider" data-slide-to="0" class=""></li>
                <li data-target="#testimonial_slider" data-slide-to="1" class="active"></li>
                <li data-target="#testimonial_slider" data-slide-to="2" class=""></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner" style="direction: ltr">
                @foreach($testimontal as $i=>$t)
                    <div class="carousel-item @if($i==1) active @endif">
                        <div class="testomonial_section" >

                            <div class="full testimonial_cont text_align_center cross_layout">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pa_right">
                                        <div class="testomonial_img">
                                            <i><img src="{{ asset('profile_images/'.$t->owner['image']) }}" alt="#"/></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pa_left">
                                        <div class="cross_inner">
                                            <h3>{{$t->owner->name}}<br><strong class="ornage_color">{{$t->owner->job_title}}</strong></h3>
                                            <p><img src="{{ asset('green') }}/icon/1.png" alt="#" />
                                                {{$t->owner->description}}
                                                <img src="{{ asset('green') }}/icon/2.png" alt="#" />
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>

        </div>
    </div>
</div>

<!-- end clients -->

<!-- footer -->
<!--  footer -->
<footr>
    <div class="footer top_layer ">
        <div class="container">

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="address">
                        <div class="logo">
                            @if(app()->getLocale() == 'fa')
                                <a href="index.html"><img src="{{ asset('green') }}/images/logofa.png" alt="#"></a>
                            @else
                                <a href="index.html"><img src="{{ asset('green') }}/images/logoen.png" alt="#"></a>
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
                        <h3>{{__('Subcribe email')}}</h3>
                        <p style="font-size: 15px;text-align: justify" > {{__('With subscribe you can be aware of news in our site')}} </p>
                        <input class="form-control" placeholder="Your Email" type="type" name="Your Email">
                        <button class="submit-btn">Submit</button>
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
</footr>

<!-- end footer -->
<!-- Javascript files-->
<script src="{{ asset('green') }}/js/jquery.min.js"></script>
<script src="{{ asset('green') }}/js/popper.min.js"></script>
<script src="{{ asset('green') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('green') }}/js/jquery-3.0.0.min.js"></script>
<script src="{{ asset('green') }}/js/plugin.js"></script>
<!-- sidebar -->
<script src="{{ asset('green') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ asset('green') }}/js/custom.js"></script>
<!-- javascript -->
<script src="{{ asset('green') }}/js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });

        $(".zoom").hover(function() {

            $(this).addClass('transition');
        }, function() {

            $(this).removeClass('transition');
        });
    });
</script>
<script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
    // Australia.
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: {
                lat: 40.645037,
                lng: -73.880224
            },
        });

        var image = 'images/maps-and-flags.png';
        var beachMarker = new google.maps.Marker({
            position: {
                lat: 40.645037,
                lng: -73.880224
            },
            map: map,
            icon: image
        });
    }
</script>
<!-- google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
<!-- end google map js -->
</body>


</html>
