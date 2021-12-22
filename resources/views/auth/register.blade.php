@extends('layouts.green_layout')

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <h3 class="mb-5"></h3>
    </div>
    <div class="row">
        <div class="col-md-8 mr-auto ml-auto login">
            <div class="card card-register card-white">
                <div class="card-header">
                    <img  src="{{ asset('green/images/card-primary.png') }}" alt="register" style="width: 941px;height: 300px;">
                </div>
                <form class="form" method="post" action="{{ route('register') }}">
                    @csrf

                    <div class="card-body">

                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-single-02"><span class="require">*</span> </i>
                                </div>
                            </div>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('title.name') }}" value="{{ old('name') }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>


                        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-email-85"><span class="require">*</span> </i>
                                </div>
                            </div>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('title.email') }}" value="{{ old('email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>


                        <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"><span class="require">*</span> </i>
                                </div>
                            </div>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('title.password') }}">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-lock-circle"><span class="require">*</span> </i>
                                </div>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('title.confirm_pass') }}">
                        </div>


                        <div class="input-group{{ $errors->has('mobile') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-chat-33"></i>
                                </div>
                            </div>
                            <input type="tel" name="mobile" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="{{ __('title.mobile') }}" value="{{old('mobile')}}">
                            @include('alerts.feedback', ['field' => 'mobile'])
                        </div>


                        <div class="input-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-square-pin"></i>
                                </div>
                            </div>
                            <textarea  name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('title.address') }}">{{old('address')}}</textarea>
                            @include('alerts.feedback', ['field' => 'address'])
                        </div>

                        <div class="input-group{{ $errors->has('postal') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-square-pin"></i>
                                </div>
                            </div>
                            <input type="text" name="postal" id="postal" maxlength="10" class="form-control{{ $errors->has('postal') ? ' is-invalid' : '' }}" value="{{old('postal')}}" placeholder="{{ __('title.postal_code') }}"  >
                            @include('alerts.feedback', ['field' => 'postal'])
                        </div>

                        @if(config('services.recaptcha.key'))
                            <div class="input-group ">
                                <div class="g-recaptcha"
                                     data-sitekey="{{config('services.recaptcha.key')}}">
                                </div>
                            </div>
                            @include('alerts.feedback', ['field' => 'g-recaptcha-response'])
                        @endif

                        <div class="form-check text-left {{ $errors->has('agree_terms_and_conditions') ? ' has-danger' : '' }}">
                            <label class="form-check-label">
                                <span class="form-check-sign"></span>
                                {{ __('title.I_agree') }}
                                <a href="#">{{ __('title.terms') }}</a> {{__('title.agree')}}
                            </label>
                            <input class="form-check-input {{ $errors->has('agree_terms_and_conditions') ? ' is-invalid' : '' }}" name="agree_terms_and_conditions"  type="checkbox"  {{ old('agree_terms_and_conditions') ? 'checked' : '' }}>
                            @include('alerts.feedback', ['field' => 'agree_terms_and_conditions'])
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{__('title.register')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
