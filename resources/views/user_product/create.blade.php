@extends('layouts.app', ['page' => __('products'), 'pageSlug' => 'products'])

{{--@extends('layouts.main')--}}
@section('title')
    | {{ __('title.products')}}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.products')}}</h5>
                    <form id="frm_product_create" action="{{route('userProduct.store')}}" method="post" enctype="multipart/form-data" >
                        {{csrf_field()}}

                        @include('product.create_common_admin_user')

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


@include('product.create_scripts_common',['r'=>'user_product'])
