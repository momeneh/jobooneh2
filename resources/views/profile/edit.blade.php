@extends('layouts.green_layout')
@section('title')
    | {{__("title.change_password")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            <div class="col-xl-3">
                <a href="#" id="side_bar_icon" > <i class="tim-icons icon-bullet-list-67"></i></a>
                @include('layouts.navbars.sidebar')
                <div class=" box_side">
                    <div class="card card-user">
                    <div class="card-body">
                        <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="#">
                                    <img class="avatar"
                                         src="
                                        @if (!empty(auth()->user()->image) && trim(auth()->user()->image)!= '') {{asset('/profile_images/'.Auth::user()->image)}}
                                         @else  {{ asset('green/images/default-avatar.png') }}
                                        @endif
                                             " alt="avatar">
                                    <h5 class="title">{{ auth()->user()->name }}</h5>
                                </a>
                                <h6>
                                    {{auth()->user()->job_title}}
                                </h6>
                            </div>
                        </p>
                        <div class="card-description">
                            {{auth()->user()->description}}
                        </div>
                </div>
                    <div class="card-footer">
                    <div class="button-container">
                        <a class="btn btn-icon btn-round btn-facebook" href="{{auth()->user()->facebook_address}}">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="btn btn-icon btn-round btn-instagram" href="{{auth()->user()->insta_address}}">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="btn btn-icon btn-round btn-google" href="{{auth()->user()->g_plus_address}}">
                            <i class="fab fa-google-plus"></i>
                        </a>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-8 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('title.Edit_Profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('title.name') }} <span class="require">*</span></label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  required value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('title.email') }} <span class="require">*</span></label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-danger' : '' }}">
                            <label>{{ __('title.mobile') }}</label>
                            <input type="tel" name="mobile" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"  value="{{ old('mobile', auth()->user()->mobile_no) }}">
                            @include('alerts.feedback', ['field' => 'mobile'])
                        </div>


                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                            <label>{{__('title.address')}}</label>
                            <textarea  name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" >{{old('address',auth()->user()->address)}}</textarea>
                            @include('alerts.feedback', ['field' => 'address'])
                        </div>

                        <div class="form-group{{ $errors->has('postal') ? ' has-danger' : '' }}">
                            <label>{{__('title.postal_code')}}</label>
                            <input type="text" name="postal" id="postal" maxlength="10" class="form-control{{ $errors->has('postal') ? ' is-invalid' : '' }}" value="{{old('postal',auth()->user()->postal_code)}}"   >
                            @include('alerts.feedback', ['field' => 'postal'])
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label>{{ __('title.job_title') }}</label>
                            <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"  value="{{ old('title', auth()->user()->job_title) }}">
                            @include('alerts.feedback', ['field' => 'title'])
                        </div>


                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label>{{__('title.description')}}</label>
                            <textarea  name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" >{{old('description',auth()->user()->description)}}</textarea>
                            @include('alerts.feedback', ['field' => 'description'])
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label>{{__('title.image')}} </label>
                            <div class="col-md-6">
                                @if(!empty(auth()->user()->image))
                                    <img id="image_show" alt="profile image " src="{{asset('/profile_images/'.Auth::user()->image)}}" width="180px">
                                    <input type="hidden" name="image_name" value="{{auth()->user()->image}}"/>
                                    <span class="btn btn-danger" id="remove_image"> </span>
                                @endif
                                <input id="image" type="file"  class="form-control @if(!empty(auth()->user()->image)) hidden @endif" name="image"  accept="image/png, image/jpeg"   autofocus title="400*400 image file">

                                @include('alerts.feedback', ['field' => 'image'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gplus') ? ' has-danger' : '' }}">
                            <label>{{ __('title.gplusaddress') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="gplus" class="form-control{{ $errors->has('gplus') ? ' is-invalid' : '' }}"  value="{{ old('gplus', auth()->user()->g_plus_address) }}">
                                @include('alerts.feedback', ['field' => 'gplus'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('insta') ? ' has-danger' : '' }}">
                            <label>{{ __('title.instaAddress') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="insta" class="form-control{{ $errors->has('insta') ? ' is-invalid' : '' }}"  value="{{ old('insta', auth()->user()->insta_address) }}">
                                @include('alerts.feedback', ['field' => 'insta'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }}">
                            <label>{{ __('title.facebookAdress') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="facebook" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"  value="{{ old('facebook', auth()->user()->facebook_address) }}">
                                @include('alerts.feedback', ['field' => 'facebook'])
                            </div>
                        </div>

                        @if(auth()->user()->is_owner == 1 )
                            @include('profile.owner_part',['user'=>auth()->user()])
                        @endif

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('title.edit') }}</button>
                    </div>
                </form>
            </div>



            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var msg_invalid_card = "{{ __("card number is invalid")}}";
    </script>
@endsection
