@extends('layouts.layout_simple')

@section('content')

    <div class="container mt--8 pb-5 verify_mail_message">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card offer shadow border-0 py-lg-5">
                    <div class="card-body px-lg-5  about">
                        <div class='about_box '>
                            <h3>{{ $receiver->name ?? ''}} {{ __('title.dear')}}</h3>
                            <p>
                                {{ __('messages.App\Notifications\ProductChanged',['id_product'=>$product->id,'id_user'=>$owner->id,'name_user'=>$owner->name])}}
                                @foreach($changes as $ch)
                                    <p>{{$ch}}</p>
                                @endforeach

                            <br>
                                <a href=" {{ route('product.edit',$product->id ?? '') }} " target="_blank" style="width:auto;margin-top: 23px;">{{__('title.edit')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
