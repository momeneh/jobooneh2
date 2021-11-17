
@if($number_basket > 0 )
    <div class="basket_btn">
        <img src="{{ asset('green') }}/icon/rm.png" class="basket_remove"
             onclick="Basket(this,{{$product->id}},'DELETE',1)"
             Burl="{{route('basket.destroy',$product->id)}}"
             onmouseover="this.src='{{asset('green')}}/icon/rm_h.png'"
             onmouseout="this.src='{{asset('green')}}/icon/rm.png'"
             view="basket.part"
        />
        <span class="number_basket"> {{$number_basket}}</span>
        @if($show_plus_btn == 1)
            <img class="plus_basket" src="{{ asset('green') }}/icon/plus.png"
                 onclick="Basket(this,{{$product->id}},'PUT',1)"
                 Burl="{{route('basket.update',$product->id)}}"
                 onmouseover="this.src='{{asset('green')}}/icon/plus_h.png'"
                 onmouseout="this.src='{{asset('green')}}/icon/plus.png'"
                 view="basket.part"
            />
        @endif
    </div>

@endif
