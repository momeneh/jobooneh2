@extends('layouts.app', ['page' => __('products'), 'pageSlug' => 'products'])
{{--{{ dd($__data) }}--}}
@section('title')
    | {{ __('title.record_edit')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                @php $record = $product @endphp
                @php  if(!($record['images']->isEmpty()) ) $saved =  $record['images']; else $saved = [['id'=>'','alt'=> '' ,'image'=>'']]; @endphp
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.record_edit')}}</h5>
                    <form id="frm_product_edit" action="{{route('userProduct.update',$record['id'])}}" method="post" enctype="multipart/form-data">
                        {{method_field('put')}}
                        {{csrf_field()}}


                        @include('product.edit_common_admin_user')


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


@include('product.edit_scripts_common',['r'=>'user_product'])
