@extends('layouts.green_layout')


@section('title')    | {{GetArrayfields($category,'title',' | ')}}@endsection
@section('meta_keyword') , {{GetArrayfields($category,'title',' , ')}} @endsection
@section('meta_description') . {{GetArrayfields($category,'title','   ')}} @endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 co-sm-l2 inner_page_box" >
            <div class=" row" style="padding: 50px;">
                @foreach($category as $cat)
                    <a href="{{route('pages.cat_products',$cat['id'])}}">{{$cat['title']}}</a>  &nbsp;/ &nbsp;
                @endforeach
            </div>
            <div class="product row" id="product">
                @include('site_products.cat_products_list')
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('green/js/ajax_paging.js') }}"></script>
@endsection
