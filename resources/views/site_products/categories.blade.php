@extends('layouts.green_layout')
@section('title')
    | {{ __('title.categories')}}
@endsection
@section('meta_keyword') , {{ GetArrayfields($categories,'title',' , ')}} @endsection
@section('meta_description') . {{ __('title.categories')}} @endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2 inner_page_box" >

            <div class="categories_list row">
                @foreach($categories as $cp)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                        <a href="{{route('pages.cat_products',$cp->id)}}" >
                            <i><img src="{{ asset('category_icons/'.$cp->icon) }}" alt="category icons"/></i>
                            {{$cp->title}} <span style="color: #4bc714">({{$cp->count_pro}})</span>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
