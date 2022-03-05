@extends('layouts.green_layout')
@section('title')
    | {{ __('Contact Us')}}
@endsection
@section('meta_keyword') ,  {{__('Contact Us')}}@endsection
@section('meta_description') |  {{__('Contact Us')}}@endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2 inner_page_box" >
            <div >
                <form class="main_form" action="{{route('pages.contact_us')}}" method="post" >
                        {{csrf_field()}}
                        <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" placeholder="Name" type="text" name="name" value="{{old('name')}}">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" placeholder="Email" type="email" name="email"  value="{{old('email')}}" required>
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" placeholder="Phone" type="tel" name="phone" value="{{old('phone')}}">
                            @include('alerts.feedback', ['field' => 'phone'])
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <textarea class="form-control textarea" placeholder="Message" type="text" name="message" required>{{old('message')}}</textarea>
                            @include('alerts.feedback', ['field' => 'message'])
                        </div>
                            @if(config('services.recaptcha.key'))
                                <div class="input-group ">
                                    <div class="g-recaptcha"
                                         data-sitekey="{{config('services.recaptcha.key')}}">
                                    </div>
                                </div>
                                @include('alerts.feedback', ['field' => 'g-recaptcha-response'])
                            @endif

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <button class="send">Send</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
