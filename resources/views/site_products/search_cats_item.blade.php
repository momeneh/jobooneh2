<li>
    <span  class=" @if(!empty($cat['children'])) cat_search_is_parent  @endif  ">
        <a class="search_link" onclick="Redirect(this)" link_id="{{$cat->id}}" Stype="cat"
           @if(!empty($request->cat_id) && $request->cat_id == $cat->id) style="color: #4bc714;" @endif
        > {{$cat['title']}}</a>
    </span>
    @if(!empty($cat['children']))
        <ul class="cat_search ">
            @foreach($cat['children'] as $child)
                @include('site_products.search_cats_item',['cat'=>$child,'request'=>$request])
            @endforeach
        </ul>
    @endif
</li>
