@extends('layouts.layout_simple')

@section('content')

    <div class="container mt--8 pb-5 verify_mail_message">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class=" offer shadow border-0 py-lg-5">
                    <div class="order-body px-lg-5  about ">
                        <h3>{{ $receiver->name ?? ''}} {{ __('title.dear')}}</h3>
                        <p class="desc_pro">

                        @yield('message_part')
                        <h5>{{ __('title.sent_at')}} :
                            @if(app()->getLocale() == 'fa') <span dir="ltr"> {{dateConvert::strftime('Y/m/d H:i:s', strtotime($order->created_at))}}</span>
                            @else {{$order->created_at}}
                            @endif
                        </h5>
                        <h5>{{ __('Sum Products Price')}} : {{number_format($order->sum_price_pros)}}  {{__('title.currency_title')}} </h5>
                        <h5>{{ __('title.post_price_2')}} : {{number_format($order->post_price)}}  {{__('title.currency_title')}} </h5>
                        <h5>{{ __('title.sum_price')}} : {{number_format($order->final_price)}}  {{__('title.currency_title')}}  </h5>
                        <h5>{{ __('title.address_delivery')}} : {{$order->deliver_place}}</h5>
                        <h5>{{ __('title.receipt')}} : </h5>
                        <a href="{{asset('receipt_images/'.$order->receipt_image)}}" >
                            <img src="{{asset('receipt_images/'.$order->receipt_image)}}" alt="pls login to see the image" style="max-width: 700px">
                        </a>

                        </p>
                        <table border="1" cellpadding="20" class="table table-hover" style="margin-top: 20px">
                            <thead>
                            <tr>
                                <td>{{__('title.product_title')}}</td>
                                <td>{{__('title.image')}}</td>
                                <td>{{__('title.price')}}</td>
                                <td>{{__('title.count')}}</td>

                            </tr>
                            </thead>
                            @foreach($order->items as $item)
                                <tr>
                                    <td> <a href="{{route('pages.product',$item->products_id)}}"> {{$item->products->title }} </a></td>
                                    <td> <a href="{{route('pages.product',$item->products_id)}}">
                                            <img src="{{asset('product_images/'.$item->products->images[0]->image)}}" style="width: 50px">
                                        </a>
                                    </td>
                                    <td>{{$item->products->price}}</td>
                                    <td>{{$item->count}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
