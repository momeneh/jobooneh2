@extends('layouts.app', ['admin' => 1])

@section('title')
   | {{ __('title.record_edit')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.record_edit')}}</h5>
                    <form action="{{route('user.update',$record['id'])}}" method="post" enctype="multipart/form-data">
                        {{method_field('put')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label ">{{ __('title.email')}} </label>
                            <div class="col-md-6">
                               {{$record['email']}}
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label ">{{ __('title.name')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="name" value="{{ old('name',$record['name']) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                            <label for="address" class="col-md-4 control-label">{{__('title.address')}}</label>
                            <div class="col-md-6">
                                <textarea  name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" >{{old('address',$record['address'])}}</textarea>
                                @include('alerts.feedback', ['field' => 'address'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label for="title" class="col-md-4 control-label">{{ __('title.job_title') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"  value="{{ old('title', $record['job_title']) }}">
                                 @include('alerts.feedback', ['field' => 'title'])
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label for="description" class="col-md-4 control-label">{{__('title.description')}}</label>
                            <div class="col-md-6">
                                <textarea  name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" >{{old('description',$record['description'])}}</textarea>
                                @include('alerts.feedback', ['field' => 'description'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">{{__('title.image')}} </label>
                            <div class="col-md-6">
                                @if(!empty($record['image']))
                                    <img id="image_show" src="{{asset('/profile_images/'.$record['image'])}}" width="180px">
                                    <input type="hidden" name="image_name" value="{{$record['image']}}"/>
                                    <span class="btn btn-danger" id="remove_image"> </span>
                                @endif
                                <input id="image" type="file"  class="form-control @if(!empty($record['image'])) hidden @endif" name="image"  accept="image/png, image/jpeg"   autofocus title="400*400 image file">

                                @include('alerts.feedback', ['field' => 'image'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gplus') ? ' has-danger' : '' }}">
                            <label  for="gplus" class="col-md-4 control-label">{{ __('title.gplusaddress') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="gplus" class="form-control{{ $errors->has('gplus') ? ' is-invalid' : '' }}"  value="{{ old('gplus', $record['g_plus_address']) }}">
                                @include('alerts.feedback', ['field' => 'gplus'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('insta') ? ' has-danger' : '' }}">
                            <label  for="insta" class="col-md-4 control-label">{{ __('title.instaAddress') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="insta" class="form-control{{ $errors->has('insta') ? ' is-invalid' : '' }}"  value="{{ old('insta', $record['insta_address']) }}">
                                @include('alerts.feedback', ['field' => 'insta'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }}">
                            <label  for="facebook" class="col-md-4 control-label">{{ __('title.facebookAdress') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="facebook" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"  value="{{ old('facebook', $record['facebook_address']) }}">
                                @include('alerts.feedback', ['field' => 'facebook'])
                            </div>
                        </div>

                        <div class="form-group_submit  ">
                            <div class="">
                                <button type="submit" name='submit' class="btn btn-primary">
                                    {{__('title.record_edit')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection



