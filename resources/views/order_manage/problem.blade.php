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
                <div class="order_box">
                    <div >
                        <div style="padding: 6px 7px 0 0;">{{__('order code : ')}}{{$item->id}}</div><hr>
                        <form action="{{route('order_desc')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <input  type="text" class="hidden"  autocomplete="off"  name="order_id" value="{{$item['id']}}"  >
                            <input  type="text" class="hidden"  autocomplete="off"  name="receiver_id" value="user_{{$item['shopper_id']}}"  >
                            <input  type="text" class="hidden" name="subject" value="{{__('messages.order_problem_subject',['order_id'=>$item->id])}}" required autofocus>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body" class=" control-label">{{ __('messages.order_desc_title')}} <span class="require">*</span> </label>
                                <div class="col-md-6">
                                <textarea id="body"  class="form-control" name="body" required></textarea>
                                </div>
                            </div>
                            <div class="form-group_submit  ">
                                <div class="">
                                    <button type="submit" name='submit' class="btn btn-primary">
                                        {{__('title.send')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row" style="padding: 6px 7px 0 0;">
                        <div class="col-md-4 color_green" >
                            @if(app()->getLocale() == 'fa') <span dir="ltr"> {{PersianNo(dateConvert::strftime('Y/m/d H:i:s', strtotime($item->created_at)))}}</span>
                            @else {{$item->created_at}}
                            @endif
                        </div>
                        <div class="col-md-4">{{__('title.owner_confirmed')}} : {{!empty($item->owner_confirmed) ? __('title.yes'): __('title.no') }}</div>
                        <div class="col-md-4"> {{__('title.post_tracking_number')}} : {{$item->post_tracking_number}}</div>
                    </div>
                    <hr>
                    <h5>{{ __('Sum Products Price')}} : {{number_format($item->sum_price_pros)}}  {{__('title.currency_title')}} </h5>
                    <h5>{{ __('title.post_price_2')}} : {{number_format($item->post_price)}}  {{__('title.currency_title')}} </h5>
                    <h5>{{ __('title.sum_price')}} : {{number_format($item->final_price)}}  {{__('title.currency_title')}}  </h5>
                    <h5>{{ __('title.address_delivery')}} : {{$item->deliver_place}}</h5>
                    <h5>{{ __('title.receipt')}} : </h5>
                    <a href="{{asset('receipt_images/'.$item->receipt_image)}}" >
                        <img src="{{asset('receipt_images/'.$item->receipt_image)}}" alt="pls login to see the image" style="max-width: 700px">
                    </a>
                    <hr>
                    <div class="col-xl-12" style="direction: ltr">
                        <h5>{{__('title.products')}}</h5>
                        <section class="center slider" >
                            @foreach($pros as $i=>$pro)
                                <div>
                                    <a href="{{route('pages.product',$pro->id)}}">
                                        <img  src=" @if(isset($pro->image[0]->image)) {{asset('product_images/'.$pro->image[0]->image)}}@endif"
                                              alt ="@if(isset($pro->images[0])){{$pro->images[0]->alt}} @endif" style="width: 140px;">
                                    </a>
                                </div>
                            @endforeach

                        </section>
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
                slidesToShow: 5,
                slidesToScroll: 1
            });
        });
    </script>
@endsection
