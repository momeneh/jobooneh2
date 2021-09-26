@extends('layouts.app', $navbar)

@section('title')
   | {{ __('title.message_body')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
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
                                    <img class="avatar" src="{{$message->sender->image ? asset('/profile_images/'.$message->sender->image): asset('white/img/anime3.png')}}" alt="">
                                    <h5 class="title">{{__($message->subject)}}</h5>
                                </a>
                                <p class="description">
                                    {{$message->sender->name}}({{$message->sender->email}}>)
                                </p>
                            </div>
                            <p></p>
                            <div class="card-description">
                                <hr>
                                {{$message->body}}
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
@endsection



