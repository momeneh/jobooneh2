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
                                {{$sender->name ?? ''}} {{__('has sent you a message in site . please check your dashboard to see the message')}}
                                <br>
                            <br>
                                <a href=" {{ route($prefix.'message.show',$id ?? '') }} " target="_blank" style="width:auto;margin-top: 23px;">{{__('title.message_body')}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
