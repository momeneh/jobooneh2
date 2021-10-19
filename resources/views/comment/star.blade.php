<div class="col-xl-12 " style="direction: ltr" id="star_rate_part">


    <form id="star_rate_form" route="{{route('pages.productRate')}}" >
    <fieldset class="starability-growRotate">
        @for($i=1;$i<=5;++$i)
            <input type="radio" id="growing-rotating-rate{{$i}}" name="rating" value="{{$i}}"
            @if($product->rate>= $i) checked="checked" @endif>
            <label for="growing-rotating-rate{{$i}}" >{{$i}} star</label>
        @endfor
    </fieldset>
    </form>
    <div class="col-xl-2 direction star_desc">
        @if($product->sum_rate >0 )
            {{$product->rate}} {{__('from')}}  5  {{__('from sum')}} {{$product->sum_rate}} {{__('rates')}}
        @endif
    </div>
    @if($product->visited_count>10)
        <div class="col-xl-2 direction star_desc">
            {{$product->visited_count}} {{__(' times visited ')}}
        </div>
    @endif
</div>
