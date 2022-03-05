@extends('layouts.green_layout')
@section('title')
    | {{__("title.requested_orders")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-8 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('title.edit') }}</h5>
                    </div>
                    <form method="post" action="{{ route('order_update',$record->id) }}" autocomplete="off" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('put')

                            <div class="form-group{{ $errors->has('shopper') ? ' has-danger' : '' }}">
                                <label>{{ __('title.shopper') }}</label>
                                <input type="text" readonly name="shopper" class="form-control"  value="{{ old('shopper', $record->shopper->name) }}">
                            </div>
                            <div class="form-group{{ $errors->has('seller') ? ' has-danger' : '' }}">
                                <label>{{ __('title.seller') }}</label>
                                <input type="text" readonly name="seller" class="form-control"  value="{{ old('seller', $record->seller2->name) }}">
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <label>{{__('title.address_delivery')}}</label>
                                <textarea  name="address" readonly class="form-control" >{{old('address',$record->deliver_place )}}</textarea>
                                @include('alerts.feedback', ['field' => 'address'])
                            </div>

                            <h4>{{__('Sum Products Price')}} : {{number_format($record->sum_price_pros )}}  {{__('title.currency_title')}} </h4>
                            <h4>{{__('title.post_price_2')}} : {{number_format($record->post_price)}}  {{__('title.currency_title')}} </h4>
                            <h4>{{__('title.sum_price')}} : {{number_format($record->final_price )}}  {{__('title.currency_title')}} </h4>

                            <div class="form-group">
                                <label>{{__('title.receipt')}}</label>
                                <a href="{{asset('receipt_images/'.$record->receipt_image)}}" >
                                    <img alt="receipt image " src="{{asset('receipt_images/'.$record->receipt_image)}}" alt="pls login to see the image" style="max-width: 700px">
                                </a>
                            </div>
                            <div class="form-group{{ $errors->has('confirmed') ? ' has-error' : '' }}">
                                <label for="confirmed" >{{__('title.owner_confirmed')}}</label>
                                <input id="confirmed" type="checkbox" class="" name="confirmed"
                                       @if(!empty(old('confirmed',$record['owner_confirmed']))) checked="true" @endif onchange="ShowHidePost()" >
                            </div>
                            <div id="post_track" class="form-group{{ $errors->has('post_track') ? ' has-danger' : '' }}">
                                <label class="col-md-4 control-label ">{{ __('title.post_tracking_number') }} </label>
                                <div class="col-md-6">
                                    <input type="text" name="post_track" id="post_track_field" class="form-control{{ $errors->has('post_track') ? ' is-invalid' : '' }}"  value="{{ old('post_track',$record['post_tracking_number']) }}" >
                                    @include('alerts.feedback', ['field' => 'post_track'])
                                </div>
                            </div>

                            <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('title.edit') }}</button>
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


    </script>
@endsection
