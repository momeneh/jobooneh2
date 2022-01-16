@extends('layouts.green_layout')

@section('content')
    <!-- end header -->
    @include('includes.slider')
    <!-- about -->
    <div id="about" class="about" name="about">
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
                            <i><a href="{{route('pages.cat_products',$cp->id)}}"> <img src="{{ asset('category_icons/'.$cp->icon) }}" alt="#"/></a></i>
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
                                <a href="{{route('pages.product',$np->id)}}">
                                <h3>{{$np->title}}</h3>
                                @if(!empty($np->images[0]->image))
                                    <figure>    <img src="{{ asset('product_images/'.$np->images[0]->image) }}" alt="img" /></figure>
                                @endif
                                <p>{{substr($np->description,0,500)}}</p>
                                </a>
                            </div>
                        </div>

                    @endforeach
                </div>


            </div>

        </div>
        <div class="read_more">
            <a class="read-more" href="{{route('pages.search',['sort_id'=>2])}}">See More</a>
        </div>
    </div>

    <!-- end offer -->

    <!-- product -->
    <div id="product" class="product" style="margin-top: 40px">
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
                        <div class="product_box p_box">
                            <a href="{{route('pages.product',$mv->id)}}">
                            <figure>
                                <img src="{{ asset('product_images/'.$mv->images[0]->image)}}" alt="#" />
                                <div class="overlay">
                                    <h3>{{$mv->title}}</h3>
                                </div>
                            </figure>

                            </a>
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
                                                <i><img src="{{ asset('profile_images/'.$t->owner['image']) }}" alt="#" /></i>
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pa_left">
                                            <div class="cross_inner">
                                                <a href="{{route('pages.owner',$t->owner->id)}}">
                                                <h3>{{$t->owner->name}}<br><strong class="ornage_color">{{$t->owner->job_title}}</strong></h3>
                                                <p><img src="{{ asset('green') }}/icon/1.png" alt="#" />
                                                    {{$t->owner->description}}
                                                    <img src="{{ asset('green') }}/icon/2.png" alt="#" />
                                                </p>
                                                </a>

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
@endsection

