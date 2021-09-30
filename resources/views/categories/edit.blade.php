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
                    <form action="{{route('product_category.update',$record['id'])}}" method="post" enctype="multipart/form-data">
                        {{method_field('put')}}
                        {{csrf_field()}}

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
                        <div class="form-group">
                            <label for="parent_id" class="col-md-4 control-label">{{ __('title.parent_id')}}:  </label>
                            <div class="col-md-6">
                            <select id="parent_id" class="form-control" name="parent_id"  autofocus>
                                <option value="">{{__('title.select_one')}}</option>
                                @foreach($parents as $item)
                                    {{$id_p = old('parent_id',$record['parent_id'])}}
                                    <option value="{{$item->id}}" {{!empty($id_p) && $id_p == $item->id? 'selected = selected' : ''}}>{{$item->title}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                            <label for="icon" class="col-md-4 control-label">{{__('title.icon')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                @if(!empty(old('icon',$record['icon'])))
                                    <img id="image_show" src="{{asset('/category_icons/'.old('icon',$record['icon']))}}" width="60px">
                                    <input type="hidden" name="icon_name" value="{{old('icon',$record['icon'])}}"/>
                                    <span class="btn btn-danger" id="remove_image"> </span>
                                @endif
                                <input id="image" type="file"  class="form-control @if(!empty(old('icon',$record['icon']))) hidden @endif" name="icon"  accept="image/pn" required  autofocus title="60*60 png file">

                                @include('alerts.feedback', ['field' => 'icon'])
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



