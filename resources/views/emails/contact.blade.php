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
                                {{__('One user with below information has filled contact form : ')}}
                                <br>
                                {{__('title.name')}} : {{$m->name}}<br>
                                {{__('title.email')}} : {{$m->email}}<br>
                                {{__('title.phone')}} : {{$m->phone}}<br>
                                {{__('title.message_body')}} : <br> {!! nl2br(e($m->message)) !!}
                            <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
