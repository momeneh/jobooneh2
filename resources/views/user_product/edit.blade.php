@extends('layouts.green_layout')
@section('title')
    | {{__("title.products")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            <div class="col-xl-3">
                @include('layouts.navbars.sidebar')
            </div>
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('title.record_edit') }}</h5>
                    </div>
                    @php $record = $product @endphp
                    @php  if(!($record['images']->isEmpty()) ) $saved =  $record['images']; else $saved = [['id'=>'','alt'=> '' ,'image'=>'']]; @endphp
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
