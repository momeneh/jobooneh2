@extends('layouts.green_layout')
@section('title')
    | {{__("title.Admin_pages")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <div class="flex-center position-ref full-height">
                    <h5>{{__('title.pages')}}</h5>
                    <form action="{{route('page.update',$record['id'])}}" method="post" enctype="multipart/form-data">
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


                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">{{ __('title.body')}}<span class="require">*</span> </label>

                            <div class="col-md-6">
                                <textarea id="body"  class="form-control" name="body" required>{{ old('body',$record['body']) }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
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



