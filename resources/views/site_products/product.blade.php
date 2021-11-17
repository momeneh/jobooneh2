@extends('layouts.green_layout')
@section('title')
    | {{$product->title}}
@endsection

@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2 inner_page_box" >
            <div class="row " style="padding-top: 50px">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
                    <div class="  large-5 column ">
                        @if(!empty($product->images[0]))
                            <div class="xzoom-container ">
                                <img class="xzoom" src="{{asset('product_images/'.$product->images[0]->image)}}" xoriginal="{{asset('product_images/'.$product->images[0]->image)}}" title="{{asset('product_images/'.$product->images[0]->alt)}}" style="width: 386px;">
                                <div class="swiper">
                                    <div class="xzoom-thumbs swiper-wrapper">
                                        @foreach($product->images as $image)
                                            <div class="swiper-slide">
                                                <a href="{{asset('product_images/'.$image->image)}}" >
                                                    <img class="xzoom-gallery" width="80" height="80" src="{{asset('product_images/'.$image->image)}}" title="{{$image->alt}}" >
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-xl-7 col-lg-5 col-md-5 col-sm-12" id="record_id" val_id="{{$product->id}}">
                    <h1 class="product__name">{{$product->title}}
                        <div class="basket_part">
                            @include('site_products.basket_part')


                        </div>
                    </h1>
                    <h3><a href="{{route('pages.owner',$product->owner->id)}}">
                            <span class="color-g_l">{{__('title.owner')}} </span> :
                            {{$product->owner->name}}</a>
                    </h3>
                    <h4 class="product__price">
                        <span class="color-g_l">{{__('title.price')}} </span>: {{$product->price}}  {{__('title.currency_title')}}
                    </h4>
                    <h4><a href="{{route('pages.cat_products',$product->category->id)}}">
                            <span class="color-g_l">{{__('title.category')}} </span>
                            : {{$product->category->title}}</a>
                    </h4>
                    @if(!empty($product->sell_status))
                        <h4><span class="color-g_l">{{ __('title.sell_status')}} </span>: {{__('title.sell_status_'.$product->sell_status)}}
                        </h4>
                        @if($product->sell_status == 2)
                            @if(!empty($product->pre_pay))
                                <h4><span class="color-g_l">{{ __('title.pre_pay') }}</span> : {{$product->pre_pay}}  {{__('title.currency_title')}}
                                </h4>
                            @endif
                            @if(!empty($product->duration_of_work))
                                <p class="desc_pro"><span class="color-g_l">{{__('title.duration_of_work')}}</span> : {{$product->duration_of_work}}</p>
                            @endif
                        @endif
                    @endif
                    @if(!empty($product->description))
                        <p class="desc_pro"><span class="color-g_l">{{__('title.description')}} </span>: {{$product->description}}</p>
                    @endif
                </div>


                @include('comment.star')
                @include('comment.comment')
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script src="{{ asset('green') }}/js/jquery.hammer.min.js"></script>
    <script src="{{ asset('green') }}/js/xzoom.js"></script>
    <script src="{{ asset('green') }}/js/xzoomSetup.js"></script>
    <script src="{{ asset('green') }}/js/swiper-bundle.js"></script>
    <script>
        var q = "{{__('Are you sure for rate ::rate ?')}}";
    </script>
    <script src="{{ asset('green/js/star_rating.js') }}"></script>
    <script src="{{ asset('green/js/ajax_paging.js') }}"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            slidesPerView: 3,
            spaceBetween: 30,

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

    </script>
@endsection
