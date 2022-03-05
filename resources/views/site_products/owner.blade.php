@extends('layouts.green_layout')
@section('title')    | {{$owner->name}} @endsection
@section('meta_keyword') , {{$owner->name}} @endsection
@section('meta_description') . {{$owner->description}} @endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5  co-sm-l2 inner_page_box" >
            <div class="row " style="padding-top: 50px">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="author">
                                    <div class="block block-one"></div>
                                    <div class="block block-two"></div>
                                    <div class="block block-three"></div>
                                    <div class="block block-four"></div>
                                    <a href="#">
                                        <img class="avatar"
                                             src="
                                        @if (!empty($owner->image) && trim($owner->image)!= '') {{asset('/profile_images/'.$owner->image)}}
                                             @else  {{ asset('green/images/default-avatar.png') }}
                                        @endif
                                                 " alt="avatar">
                                        <h5 class="title">{{ $owner->name }}</h5>
                                    </a>
                                 </div>
                            </div>
                         </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-user">
                    <div class="card-footer">
                        <h3 >
                            {{$owner->job_title}}
                        </h3>
                        <div class="card-description">
                            {{$owner->description}}
                        </div>
                        <div class="button-container">
                            <a class="btn btn-icon btn-round btn-facebook" href="{{$owner->facebook_address}}" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a class="btn btn-icon btn-round btn-instagram" href="{{$owner->insta_address}}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="btn btn-icon btn-round btn-google" href="{{$owner->g_plus_address}}" target="_blank">
                                <i class="fab fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="title owner_products" >
                        <h3 >{{__("PRODUCTS")}}  <strong class="black">  {{__("title.more_visited")}} </strong></h3>
                    </div>
                    <div class="product row" id="product">
                        @include('site_products.cat_products_list')
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('green/js/ajax_paging.js') }}"></script>
@endsection
