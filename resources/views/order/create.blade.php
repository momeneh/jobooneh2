@extends('layouts.green_layout')
@section('title')
    | {{__('title.basket')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('green/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('green/css/slick.css')}}">
@endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5  co-sm-l2 inner_page_box" >
            <div class="basket" style="padding-top: 50px">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h5>{{__('title.address_delivery')}} </h5>
                    {{auth()->user()->address}}
                    <br>
                    <br>
                    {{__('title.postal_code')}} : {{auth()->user()->postal_code}}
                </div>
                <hr>
                <div class="col-xl-12">
                    <h5>{{__('title.owner')}} : <a href="{{route('pages.owner',$list[0]->user_id)}}"> {{$list[0]->name}}</a> </h5>
                    <div class="col-xl-12" style="direction: ltr">
                        <h5>{{__('title.products')}}</h5>
                        <section class="center slider" >
                            @php $sum = 0 @endphp
                            @foreach($list as $i=>$product)
                                <div>
                                    <a href="{{route('pages.product',$product->id)}}">
                                        <img  alt="product image " src=" @if(isset($product->images[0])) {{asset('product_images/'.$product->images[0]->image)}}@endif"
                                              title ="@if(isset($product->images[0])){{$product->images[0]->alt}} @endif" style="width: 140px;">
                                    </a>

                                    <div class="shop_price">
                                        <span class="color-g_l">{{__('title.price')}} </span>: {{number_format($product->price)}}  {{__('title.currency_title')}}<br>
                                        <span class="color-g_l">{{__('title.count')}} </span>: {{number_format($product->basket_count)}}
                                        @php  $sum += ($product->price * $product->basket_count) @endphp
                                    </div>
                                </div>
                            @endforeach

                        </section>
                        <hr style="margin: 30px 0">
                    </div>
                    <h5>{{__('Sum Products Price')}} : {{number_format($sum)}}  {{__('title.currency_title')}} </h5>
                    <h5>{{__('title.post_price_2')}} : {{number_format($product->post_price)}}  {{__('title.currency_title')}} </h5>
                    <h5>{{__('title.sum_price')}} : {{number_format($product->post_price + $sum )}}  {{__('title.currency_title')}} </h5>
                    <h5>{{__('title.card_number')}} : {{$product->card_number }}  </h5>
                    <h5>{{__('title.card_owner')}} : {{$product->card_owner }}  </h5>
                    <h5>{{__('title.description')}}</h5>
                    <div style="line-height: 26px">
                        {{__("messages.shop_desc")}}
                    </div>
                    <form method="post" action="{{route('order.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input name="owner_id" type="hidden" value="{{$list[0]->user_id}}">
                        @foreach($list as $product)
                            <input type="hidden" name="products[]" value="{{$product['id']}}">
                        @endforeach
                            <div class="row" style="padding-bottom: 20px">
                            <label for="receipt" style="margin-top: 27px"><span class="require">*</span> {{__('title.receipt')}}  :  </label>
                            <input id="image" type="file" class="form-control col-md-6" name="receipt"  accept="image/png, image/jpeg"  required  autofocus>
                            <div class="col-md-3" style="margin-top: 25px">
                                <input type="submit" value="{{__('upload receipt')}}" class="btn-danger" style="padding: 5px;border-radius: 5px">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".center").slick({
                dots: true,
                infinite: false,
                centerMode: false,
                slidesToShow: 4,
                slidesToScroll: 1
            });
        });
    </script>
@endsection
