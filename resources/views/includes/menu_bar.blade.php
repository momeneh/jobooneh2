<div class="row">
    <div class="col-md-12 location_icon_bottum">
        <div class="row">
            <div class="col-md-8 ">
                <div class="menu-area">
                    <div class="limit-box">
                        <nav class="main-menu">
                            <ul class="menu-area-main">
                                @foreach($main_menus as $menu_item)
                                    <li > <a href="{{$menu_item['link']}}">{{$menu_item['title']}}</a> </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <form class="search" method="get" action="{{route('pages.search')}}" >
                    <button><img src="{{ asset('green') }}/images/search_icon.png" alt="search"></button>
                    <input class="form-control" id="site_search_box" type="text" placeholder="{{__('title.search')}}" name="search_key" @if(!empty($request->search_key)) value="{{$request->search_key}}" @endif>
                </form>
            </div>
        </div>
    </div>
</div>
