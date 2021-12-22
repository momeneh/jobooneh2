@extends('layouts.green_layout')
@section('title')
    | {{__("title.compose")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
        <div class="col-md-7">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            </p><div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="#">
                                    <img class="avatar" src="{{$message->sender->image ? asset('/profile_images/'.$message->sender->image): asset('green/images/anime3.png')}}" alt="">
                                    <h5 class="title">{{__($message->subject)}}</h5>
                                </a>
                                <h6 >   {{$message->sender->name}}({{$message->sender->email}}>)  </h6>
                            </div>
                            <p></p>
                            <div class="card-description">
                                <a class="btn btn-icon btn-round" style="background-color: #c9f3bc;" href="{{route($prefix.'message_reply',$message->id)}}" >
                                    <i class="tim-icons icon-send" style="top: 20%" title="reply"></i>
                                </a>
                                <hr>
                                {!! nl2br(e($message->body)) !!}
                                <hr>
                                {{!empty(count($message->attachments)) ? count($message->attachments).' '.__('title.attachments') : ''}}
                                @foreach($message->attachments as $attachment)
                                    @php $original_name = substr($attachment->file,strpos($attachment->file,'__')+2,strlen($attachment->file)) @endphp
                                    <div class="file_name"><a target="_blank" href="{{ route($prefix.'show_attachments',$attachment->file)}}"> {{$original_name}}</a></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a class="btn btn-icon btn-round btn-facebook" href="{{$message->sender->facebook_address}}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a class="btn btn-icon btn-round btn-instagram" href="{{$message->sender->insta_address}}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="btn btn-icon btn-round btn-google" href="{{$message->sender->g_plus_address}}">
                                    <i class="fab fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        </div>
    </div>
@endsection



