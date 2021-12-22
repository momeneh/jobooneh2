@extends('layouts.green_layout')
@section('title')
    | {{__("title.comments")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <div class="flex-center position-ref full-height">
                    <h5>{{__('title.comments')}} </h5>

                    <div class="form-group">
                        <label for="pro_name" class="col-md-4 control-label ">{{ __('title.product_title')}}  </label>
                        <div class="col-md-6">
                            <a href="{{route('product.edit',$record->product->id)}}" >
                                <span class="form-control tim-icons icon-refresh-02">  {{$record->product->title}}   </span></a>
                        </div>
                    </div>

                    <div class="form-group col-xl-5 inline">
                        <label for="name" class="col-md-4 control-label ">{{ __('title.name')}}  </label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $record->name }}"  autofocus>
                    </div>

                    <div class="form-group col-xl-5 inline">
                        <label for="email" class="col-md-4 control-label ">{{ __('title.email')}} </label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ $record->email }}"  autofocus>
                    </div>

                    <div class="form-group col-xl-10">
                        <label for="comment" class="col-md-4 control-label ">{{ __('title.comment')}} <span class="require">*</span> </label>
                        <textarea class="form-control textarea"  type="text" name="comment" required>{{$record->comment}}</textarea>
                    </div>

                    <div class="col-xl-10" style="margin-top: 20px">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection



