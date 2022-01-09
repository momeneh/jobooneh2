@extends('layouts.green_layout')
@section('title')
    | {{__("title.products")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            <div class="col-xl-3">
                <a href="#" id="side_bar_icon" > <i class="tim-icons icon-bullet-list-67"></i></a>
                @include('layouts.navbars.sidebar')
            </div>
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <h5 >{{ __('title.create_new') }}</h5>
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
