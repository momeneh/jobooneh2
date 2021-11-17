@if($show_add_basket == 1 )
    <span class="btn_add_basket "
          onclick="Basket(this,{{$product->id}},'post')"
          Burl="{{route('basket.store')}}"
          view="site_products.basket_part"
    >{{__('title.buy_item')}} </span>
@endif
@if($number_basket > 0 )
    <div class="basket_btn">
        <img src="{{ asset('green') }}/icon/rm.png" class="basket_remove"
             onclick="Basket(this,{{$product->id}},'DELETE')"
             Burl="{{route('basket.destroy',$product->id)}}"
             onmouseover="this.src='{{asset('green')}}/icon/rm_h.png'"
             onmouseout="this.src='{{asset('green')}}/icon/rm.png'"
             view="site_products.basket_part"
        />
        <span class="number_basket"> {{$number_basket}}</span>
        @if($show_plus_btn == 1)
            <img class="plus_basket" src="{{ asset('green') }}/icon/plus.png"
                 onclick="Basket(this,{{$product->id}},'PUT')"
                 Burl="{{route('basket.update',$product->id)}}"
                 onmouseover="this.src='{{asset('green')}}/icon/plus_h.png'"
                 onmouseout="this.src='{{asset('green')}}/icon/plus.png'"
                 view="site_products.basket_part"
            />
        @endif
    </div>
    @if($number_basket > 0 )
        <a href="{{route('basket.index')}}">
            <img src="{{asset('green')}}/icon/basket.png" width="17px"
                 onmouseover="this.src='{{asset('green')}}/icon/basket_h.png'"
                 onmouseout="this.src='{{asset('green')}}/icon/basket.png'"/></a>
    @endif
@endif
