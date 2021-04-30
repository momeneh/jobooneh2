@extends('layouts.app', ['admin' => 1])

{{--@extends('layouts.main')--}}
@section('title')
   | {{ __('title.links_location')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.links_location')}}</h5>
                    <form action="{{route('link_locations.store')}}" method="post" enctype="multipart/form-data">
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



