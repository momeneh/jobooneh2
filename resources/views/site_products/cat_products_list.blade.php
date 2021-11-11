@foreach($products as $pro)
    <div class="col-xl-4 ">
        <div class="product_box">
            <figure>
                <a href="{{route('pages.product',$pro->id)}}">
                    @if (!empty($pro->images[0]->image) && file_exists(storage_path('app\product_images\\'.$pro->images[0]->image)))
                        <img src="{{ asset('product_images/'.$pro->images[0]->image) }}" alt="#">
                    @else
                        <img src="{{ asset('green/images/'.rand(1,24).'.jpg') }}" alt="#">
                    @endif
                    <div class="product_info">
                        <h5>{{$pro->title}}</h5>
                        <div class="row">
                            <div class="col-xl-6 product_info_stock">{{__('title.available')}}
                                @if($pro->count==0)<span class="tim-icons icon-simple-remove color_red"></span>
                                @else <span class="tim-icons icon-check-2 color_green"></span>
                                @endif </div>
                            <div class="col-xl-6 product_info_order ">
                                @if($pro->sell_status == 2 ) {{__('title.can_order')}} @endif
                            </div>
                        </div>
                        <span class="product-info_price" >{{__('title.price')}} : {{number_format($pro->price)}} {{__('title.currency_title')}}</span>
                    </div>
                </a>
            </figure>
        </div>
    </div>

@endforeach
<div class="navigations">
    @if(!empty($products->nextPageUrl()))
        <button class="refresh_button" onclick="Getmore('.product')" url_gif=""></button>
        <img src="{{asset('green/images/icons8-refresh.gif')}}" width="18px" class="refresh_gif hidden" />
    @endif
    {{$products->appends(request()->query())->links()}} <!-- PAGINATION-->
</div>
