@extends('layouts.green_layout')
@section('title')
    | {{__("title.products")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    @php $record = $product @endphp
                    @php  if(!($record['images']->isEmpty()) ) $saved=  $record['images']; else $saved = [['id'=>'','alt'=> '' ,'image'=>'']]; @endphp
                    <div class="flex-center position-ref full-height">
                    <h5>{{__('title.record_edit')}}</h5>
                    <form id="frm_product_edit" action="{{route('product.update',$record['id'])}}" method="post" enctype="multipart/form-data">
                        {{method_field('put')}}
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                            <label for="owner" class="col-md-4 control-label ">{{ __('title.owner')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                @php $owner = (!empty($record['owner']) ? $record['owner']['name'].' : '.$record['owner']['email'] : '') @endphp
                                <input id="auto" type="text" class="ui-autocomplete-input form-control" route = "{{route('autocompleteUsers')}}" autocomplete="off"  name="owner" value="{{ old('owner',$owner) }}" required autofocus>
                                <input id="auto_id" type="text" class="hidden"  autocomplete="off"  name="owner_id" value="{{ old('owner_id',$record['user_id']) }}"  >
                                <span id="loading_data_icon"></span>

                                @include('alerts.feedback', ['field' => 'owner_id'])
                            </div>
                        </div>
                        @include('product.edit_common_admin_user')

                        <div class="form-group_submit">
                            <label for="confirmed" class="control-label">{{__('title.confirmed')}}</label>
                            <input id="confirmed" type="checkbox" class="" name="confirmed" value=1 autofocus  {{ old('confirmed',$record['confirmed']) ? 'checked' : ' ' }} >
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


@include('product.edit_scripts_common',['r'=>'product'])
