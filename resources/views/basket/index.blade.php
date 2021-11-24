@extends('layouts.green_layout')
@section('title')
    | {{__('title.basket')}}
@endsection

@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2 inner_page_box" >
            <div class="basket" style="padding-top: 50px">
                @if(!empty($owners))
                @foreach($owners as $owner)
                    <div>
                    <div class="owner  card-user">
                        <a href="{{route('pages.owner',$owner->id)}}">
                            <img class="avatar"
                                 src="
                                        @if (!empty($owner->image) && trim($owner->image)!= '') {{asset('/profile_images/'.$owner->image)}}
                                 @else  {{ asset('white') }}/img/default-avatar.png
                                        @endif
                                     " alt="">
                            <h5 >{{ $owner->name }}</h5>
                        </a>

                    </div>
                    </div>
                    @php $sum = 0 @endphp
                    @foreach($list as $product)
                        @if($owner->id != $product->user_id) @continue @endif

                    <div class="row basket_item">
                        <div class="col-xl-2">
                            @if(!empty($product->images[0]->image))
                                <a href="{{route('pages.product',$product->id)}}"> <img  src="{{asset('product_images/'.$product->images[0]->image)}}"  title="{{asset('product_images/'.$product->images[0]->alt)}}" style="width: 140px;"></a>
                            @endif
                        </div>
                        <div class="col-xl-10">
                            <h3 class="product__name"> <a href="{{route('pages.product',$product->id)}}"> {{$product->title}}</a></h3>

                            <h5 class="product__price">
                                @php  $sum += ($product->price * $product->basket_count) @endphp
                                <span class="color-g_l">{{__('title.price')}} </span>: {{number_format($product->price)}}  {{__('title.currency_title')}}
                            </h5>
                            {{__('title.available')}}
                            @if($product->count==0)<span class="tim-icons icon-simple-remove color_red"></span>
                            @else <span class="tim-icons icon-check-2 color_green"></span>
                            @endif
                            <div class="basket_part">
                                @include('basket.part',['number_basket'=>$product->basket_count,'show_plus_btn'=>$product->show_plus_btn])
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <div class="buy_basket">
                        <span>{{__('title.sum')}} :  {{number_format($sum)}} {{__('title.currency_title')}} </span>
                        <a href="" >{{__('I want to buy')}}</a>
                    </div>
                @endforeach
                @else
                    <div class="c-listing-not-found">
                        <div class="c-message-light c-message-light--info c-listing-not-found__message">
                            <div class="c-message-light__justify">
                                <p>{{__('messages.basket_is_empty')}} </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


