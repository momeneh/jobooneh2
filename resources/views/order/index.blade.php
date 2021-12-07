@extends('layouts.green_layout')
@section('title')
    | {{__('title.orders')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('green/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('green/css/slick.css')}}">

@endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2 inner_page_box order" >
            @php $order_id = 0 @endphp
            @foreach ($list as $item)
                @if ($item->order->id == $order_id) @continue @endif
                <div class="order_box">
                    @php $order_id = $item->order->id @endphp
                    <div class="row" style="padding: 6px 7px 0 0;">
                        <div class="col-md-4 color_green" >
                            @if(app()->getLocale() == 'fa') <span dir="ltr"> {{PersianNo(dateConvert::strftime('Y/m/d H:i:s', strtotime($item->order->created_at)))}}</span>
                            @else {{$item->order->created_at}}
                            @endif
                        </div>
                    <div class="col-md-4">{{__('title.owner_confirmed')}} : {{!empty($item->order->owner_confirmed) ? __('title.yes'): __('title.no') }}</div>
                        <div class="col-md-4"> {{__('title.post_tracking_number')}} : {{$item->order->post_tracking_number}}</div>
                    </div>
                    <hr>
                    <h5>{{ __('Sum Products Price')}} : {{number_format($item->order->sum_price_pros)}}  {{__('title.currency_title')}} </h5>
                    <h5>{{ __('title.post_price_2')}} : {{number_format($item->order->post_price)}}  {{__('title.currency_title')}} </h5>
                    <h5>{{ __('title.sum_price')}} : {{number_format($item->order->final_price)}}  {{__('title.currency_title')}}  </h5>
                    <h5>{{ __('title.address_delivery')}} : {{$item->order->deliver_place}}</h5>
                    <h5>{{ __('title.receipt')}} : </h5>
                    <a href="{{asset('receipt_images/'.$item->order->receipt_image)}}" >
                        <img src="{{asset('receipt_images/'.$item->order->receipt_image)}}" alt="pls login to see the image" style="max-width: 700px">
                    </a>
                    <hr>
                    <div class="col-xl-12" style="direction: ltr">
                        <h5>{{__('title.products')}}</h5>
                        <section class="center slider" >
                            @foreach($list as $i=>$item)
                                @if ($item->order->id != $order_id) @continue @endif
                                <div>
                                    <a href="{{route('pages.product',$item->products_id)}}">
                                        <img  src=" @if(isset($item->image[0]->image)) {{asset('product_images/'.$item->image[0]->image)}}@endif"
                                              alt ="@if(isset($item->images[0])){{$item->images[0]->alt}} @endif" style="width: 140px;">
                                    </a>
                                </div>
                            @endforeach

                        </section>
                    </div>

                </div>
            @endforeach
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
                slidesToShow: 5,
                slidesToScroll: 1
            });
        });
    </script>
@endsection
