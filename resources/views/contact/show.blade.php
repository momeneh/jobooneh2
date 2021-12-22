@extends('layouts.green_layout')
@section('title')
    | {{__("Contact Us")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('Contact Us')}}</h5>


                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label ">{{ __('title.name')}} </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $record['name'] }}"  autofocus>
                            </div>
                        </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label ">{{ __('title.email')}} </label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $record['email'] }}"  autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-md-4 control-label ">{{ __('title.phone')}} </label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $record['phone'] }}"  autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-md-4 control-label ">{{ __('title.message_body')}} </label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="message" >{{ $record['message'] }}</textarea>
                        </div>
                    </div>

                    <br><br>
                </div>

            </div>
        </div>
    </div>
@endsection



