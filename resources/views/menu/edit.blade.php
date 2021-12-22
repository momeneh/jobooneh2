@extends('layouts.green_layout')
@section('title')
    | {{__("title.edit")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.record_edit')}}</h5>
                    <form action="{{route('menu.update',$menu['id'])}}" method="post" enctype="multipart/form-data">
                        {{method_field('put')}}
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label ">{{ __('title.title')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title',$menu['title']) }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">{{ __('title.link')}} <span class="require">*</span></label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ old('link',$menu['link']) }}" required autofocus>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                            <label for="is_active" class="col-md-4 control-label">{{__('title.active')}}</label>

                            <div class="col-md-6">
                                <input id="is_active" type="checkbox" class="" name="is_active" value=1 autofocus
                                    {{ old('is_active',$menu['is_active']) ? 'checked="1"' : '' }} >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            <label for="parent_id" class="col-md-4 control-label">{{__('title.parent_id')}}</label>
                            <div class="col-md-6">
                                <select id="parent_id" class="form-control" name="parent_id"  autofocus>
                                    <option value="">{{__('title.select_one')}}</option>
                                    @foreach($menus as $menu_i)
                                        {{$id_p = old('parent_id',$menu['parent_id'])}}
                                        <option value="{{$menu_i->id}}" {{!empty($id_p) && $id_p == $menu_i->id ? 'selected = selected' : ''}}>{{$menu_i->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="priority" class="col-md-4 control-label ">{{ __('title.priority')}} </label>
                            <div class="col-md-6">
                                <input id="priority" type="text" class="form-control" name="priority" value="{{ old('priority',$menu['priority']) }}"  autofocus>

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
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



