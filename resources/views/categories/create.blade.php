@extends('layouts.app', ['admin' => 1])

{{--@extends('layouts.main')--}}
@section('title')
   | {{ __('title.categories')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.categories')}}</h5>
                    <form action="{{route('product_category.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label ">{{ __('title.title')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

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
                                    {{ old('is_active') ? 'checked="1"' : 'checked="0"' }} >
                            </div>
                        </div>
                        <div class="form-search">
                            <label for="parent_id">{{ __('title.parent_id')}}:  </label>
                            <select id="parent_id" class="form-control" name="parent_id"  autofocus>
                                <option value="">{{__('title.select_one')}}</option>
                                @foreach($parents as $item)
                                    <option value="{{$item->id}}" {{!empty($request->parent_id) && $request->parent_id == $item->id? 'selected = selected' : ''}}>{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group_submit  ">
                            <div class="">
                                <button type="submit" name='submit' class="btn btn-primary">
                                    {{__('title.create_new')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection



