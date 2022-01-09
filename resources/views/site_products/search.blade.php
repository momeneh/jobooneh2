@extends('layouts.green_layout')


@section('title')
    | {{__("Searched for ")}}
    {{$request->search_key}}

@endsection

@section('content')
    <div class="inner_page">
        <div class="col-xl-12 row">
            <div class="filter_icon col-xl-1"><a href="{{route('pages.search.filters',$request->all())}}"> <img src="{{asset('green/icon/filter.png')}}">{{__("filter result")}}</a></div>
            <div class="filter_icon col-xl-1" style="line-height: 23px"><a href="{{route('pages.search',['search_key'=>$request->search_key])}}"> {{__("title.reset_filters")}}</div>
            @if(!empty($categories[0]) || !empty($owners[0]))
            <div class="col-xl-3 search-side " >
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
            <div class="col-xl-8  inner_page_box" style="margin-top: 10px" >
                <div class="row">
                    <ul class="c-listing__sort js-sort-options" data-label="">
                        <li>{{__("Sort By :")}}</li>
                        <li ><a  class="search_link" onclick="Redirect(this)" link_id="1" Stype="sort"
                             @if(!empty($request->sort_id) && $request->sort_id == 1) style="color: #4bc714;" @endif>{{__("Viewed most")}}</a>
                        </li>
                        <li><a  class="search_link" onclick="Redirect(this)" link_id="2" Stype="sort"
                                @if(!empty($request->sort_id) && $request->sort_id == 2) style="color: #4bc714;" @endif >{{__("Newest")}}</a>
                        </li>
                        <li><a class="search_link" onclick="Redirect(this)" link_id="3" Stype="sort"
                               @if(!empty($request->sort_id) && $request->sort_id == 3) style="color: #4bc714;" @endif>{{__('Cheapest')}}</a>
                        </li>
                        <li><a class="search_link" onclick="Redirect(this)" link_id="4" Stype="sort"
                               @if(!empty($request->sort_id) && $request->sort_id == 4) style="color: #4bc714;" @endif >{{__("Most expensive")}}</a>
                        </li>

                    </ul>
                </div>
            <div class=" row" style="min-height: 20px"></div>
            <div class="product row" id="product">
                @if(!empty($products[0]->id))
                    @include('site_products.cat_products_list')
                @else
                    <div class="c-listing-not-found">
                        <div class="c-message-light c-message-light--info c-listing-not-found__message">
                            <div class="c-message-light__justify">
                                <p>{{__('messages.search_not_found',['search_key'=>$request->search_key])}} </p>
                            </div>
                        </div>
                        {{__('messages.search_try_again')}}
                        @if(!empty($categories[0]) || !empty($owners[0]))
                            <br><br>{{__('messages.reduce_filters')}}
                        @endif
                    </div>
                @endif
            </div>
        </div>
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
