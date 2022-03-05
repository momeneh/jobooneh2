@extends('layouts.green_layout')


@section('title')    | {{__("Searched for ")}}    {{$request->search_key}}@endsection
@section('meta_keyword') , {{__("Searched for ")}}    {{$request->search_key}} @endsection
@section('meta_description') . {{__("Searched for ")}}    {{$request->search_key}} @endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-12 row">
            @if(!empty($categories[0]) || !empty($owners[0]))
                <div class="col-xl-3  " >
                    @if(!empty($categories[0]))
                        <div class="inner_page_box bocx_side">
                            <div class="S_header">{{__('Categories result')}}</div>
                            <div>
                                <ul class="cat_search">
                                    @foreach($categories as $cat)
                                        @include('site_products.search_cats_item',['cat'=>$cat,'request'=>$request])
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if(!empty($owners[0]))
                        <div class="inner_page_box box_side">
                            <div class="S_header">{{__('title.business_owners')}}</div>
                            <div>
                                <ul class="cat_search">
                                    @foreach($owners as $owner)
                                        <li>
                                        <span > <a class="search_link" onclick="Redirect(this)" link_id="{{$owner->id}}" Stype="owner"
                                                   @if(!empty($request->owner_id) && $request->owner_id == $owner->id) style="color: #4bc714;" @endif
                                            > {{$owner['name']}}</a>    </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="inner_page_box box_side">
                        <div class="custom-control custom-switch" style="padding:10px 43px">
                            <input type="checkbox" class="custom-control-input" id="available" onclick="RedirectCheck(this)"  Stype="available"
                                   @if(!empty($request->available)) checked="true" @endif>
                            <label class="custom-control-label" for="available">{{__('title.available')}}

                        </div>
                        <div class="custom-control custom-switch" style="padding:10px 43px">
                            <input type="checkbox" class="custom-control-input" id="can_order" onclick="RedirectCheck(this)"  Stype="can_order"
                                   @if(!empty($request->can_order)) checked="true" @endif >
                            <label class="custom-control-label" for="can_order">{{__('title.can_order')}}</label>
                        </div>

                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('green/js/ajax_paging.js') }}"></script>
    <script>
        var url= "{{route('pages.search')}}";
        var request = @json($request->all());
    </script>
    <script src="{{ asset('green/js/white.js')}}"></script>
@endsection
