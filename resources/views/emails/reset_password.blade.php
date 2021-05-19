@extends('layouts.layout_simple')

@section('content')

    <div class="container mt--8 pb-5 verify_mail_message">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card offer shadow border-0 py-lg-5">
                   <div class="card-body px-lg-5  about">
                        <div class='about_box '>
                         <h3> {{ __('title.hello')}}</h3>
                         <p>
                            {{__('You are receiving this email because we received a password reset request for your account.')}}
                            <br>
                            <a href=" {{ $url ?? '' }} " target="_blank" style="width:auto;margin-top: 23px;">{{__('Reset Password')}}</a><br><br>
                             {{__('This password reset link will expire in 60 minutes.')}} <br>
                             {{__('If you did not request a password reset, no further action is required.')}} <br><br>
                             {{__('Regards,')}} <br>
                             {{__('title.main_title')}} <hr>
                             {{__('If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:')}}<br>
                             <p style="text-align: left">{{ $url ?? '' }}</p>
                          </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
