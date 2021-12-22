@extends('layouts.green_layout')
@section('title')
    | {{__("title.links")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                 <div class="card">
                    <div class="flex-center position-ref full-height">
                    <h5>{{__('title.links')}}</h5>
                    <form action="{{route('link.update',$record['id'])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label ">{{ __('title.title')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title',$record['title']) }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                            <label for="is_active" class="col-md-4 control-label">{{__('title.active')}}</label>

                            <div class="col-md-6">
                                <input id="is_active" type="checkbox" class="" name="is_active" value=1 autofocus
                                    {{ old('is_active',$record['is_active']) ? 'checked="1"' : 'checked="0"' }} >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">{{ __('title.link')}} <span class="require">*</span></label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ old('link',$record['link']) }}" required autofocus>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">{{ __('title.description')}} </label>

                            <div class="col-md-6">
                                <textarea id="description"  class="form-control" name="description">{{ old('description',$record['description']) }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">{{__('title.image')}} @if(empty(old('image',$record['image'])))<span class="require">*</span>@endif</label>
                            <div class="col-md-6">
                                @if(!empty($record['image']))
                                    <img id="image_show" src="{{asset('link_images').'/'.$record['image']}}" width="180px">
                                    <input type="hidden" name="image_name" value="{{$record['image']}}"/>
                                    <span class="btn btn-danger" id="remove_image"> </span>
                                @endif
                                <input id="image" type="file" class="form-control hidden" name="image"  accept="image/png, image/jpeg"  @if(empty($record['image'])) required @endif autofocus>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('location_id') ? ' has-error' : '' }}">
                            <label for="location_id" class="col-md-4 control-label">{{__('title.location_show')}} <span class="require">*</span></label>
                            <div class="col-md-6">
                                <select id="location_id" class="form-control" name="location_id" required autofocus>
                                    <option value="">{{__('title.select_one')}}</option>
                                    @foreach($locations as $item)
                                        {{$id_p = old('location_id',$record['location_id'])}}
                                        <option value="{{$item->id}}" {{!empty($id_p) && $id_p == $item->id ? 'selected = selected' : ''}}>{{$item->title}}</option>
                                    @endforeach
                                </select>
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
    </div>
@endsection



