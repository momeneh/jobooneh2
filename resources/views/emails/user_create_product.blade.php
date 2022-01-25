@extends('layouts.layout_simple')

@section('content')

    <div class="container mt--8 pb-5 verify_mail_message">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card offer shadow border-0 py-lg-5">
                    <div class="card-body px-lg-5  about">
                        <div class='about_box '  style="padding: 2px;margin: 20px">
                            <h3>{{ $receiver->name ?? ''}} {{ __('title.dear')}}</h3>
                            <p>
                                {{$owner->name ?? ''}} {{ __('messages.owner_created_product')}}
                                <table border="1" cellpadding="20" class="table table-hover">
                                <thead>
                                <tr>
                                    <td>{{ __('title.id')}}</td>
                                    <td>{{ __('title.title')}}</td>
                                    <td>{{ __('title.owner')}}</td>
                                    <td>{{ __('title.categories')}}</td>
                                    <td>{{ __('title.confirmed')}}</td>
                                    <td>{{ __('title.sell_status')}}</td>
                                    <td>{{ __('title.price')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr >
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->owner->name}}</td>
                                        <td>{{$product->category->title}}</td>
                                        <td>{{$product->confirmed === 1 ? __('title.yes') : __('title.no')}}</td>
                                        <td>{{__('title.sell_status_'.$product->sell_status)}}</td>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <br>
                                <a href=" {{ route('product.edit',$product->id ?? '') }} " target="_blank" style="width:auto;margin-top: 23px;">{{__('messages.product_confirm')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
