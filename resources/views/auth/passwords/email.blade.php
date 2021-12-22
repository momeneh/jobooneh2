@extends('layouts.green_layout')

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <h3 class="mb-5"></h3>
    </div>
    <div class="col-lg-4 col-md-7 ml-auto mr-auto login">
        <form class="form" method="post" action="{{ route('password.email') }}">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="{{ asset('green/images/card-primary.png') }}" alt="">
                    <h1 class="card-title">{{ _('Reset password') }}</h1>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    @if(config('services.recaptcha.key'))
                        <div class="input-group ">
                            <div class="g-recaptcha"
                                 data-sitekey="{{config('services.recaptcha.key')}}">
                            </div>
                        </div>
                        @include('alerts.feedback', ['field' => 'g-recaptcha-response'])
                    @endif

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{ _('Send Password Reset Link') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
