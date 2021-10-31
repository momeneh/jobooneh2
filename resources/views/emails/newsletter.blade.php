@extends('layouts.layout_simple')

@section('content')

    <div class="container mt--8 pb-5 verify_mail_message">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card offer shadow border-0 py-lg-5">
                    <div class="card-body px-lg-5  about">
                       {!! $body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
