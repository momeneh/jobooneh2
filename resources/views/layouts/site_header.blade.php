<div class="header">

    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            @if(app()->getLocale() == 'fa')
                                <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logofa.png" alt="#"></a>
                            @else
                                <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logoen.png" alt="#"></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <div class="location_icon_bottum_tt">
                    <ul>
                        <li><img src="{{ asset('green') }}/icon/loc1.png" />
                            @if(app()->getLocale() == 'fa')  <a class="en" href="{{ route('lang','en') }}" >English</a>
                            @else <a class="en" href="{{ route('lang','fa') }}" > Farsi </a>
                            @endif
                        </li>
                        <li>
                            <div class="user_info_show">

                                @if(empty(auth()->id()))
                                    <a href="{{route('login')}}">
                                        <img id="icon-user"  alt="icon-user"  src="{{ asset('green') }}/icon/user.png" onmouseover="this.src='{{asset('green')}}/icon/user1.png'" onmouseout="this.src='{{asset('green')}}/icon/user.png'" /> {{__('login')}}</a>
                                @else
                                    <img id="icon-user" alt="icon-user"  class="user_info" src="{{ asset('green') }}/icon/user.png" onmouseover="this.src='{{asset('green')}}/icon/user1.png'" onmouseout="this.src='{{asset('green')}}/icon/user.png'" /><span class="tim-icons icon-minimal-down icon-user-info user_info"></span>
                                    @include('layouts.box_user_info')
                                @endif
                                <a href="{{route('basket.index')}}"><img src="{{ asset('green') }}/icon/bask.png" onmouseover="this.src='{{asset('green')}}/icon/bask1.png'" onmouseout="this.src='{{asset('green')}}/icon/bask.png'"  /></a>
                            </div>

                        </li>

                        {{--                            <li><img src="{{ asset('green') }}/icon/call1.png" />(+71)9876543109</li>--}}
                    </ul>
                </div>
            </div>
        </div>
        @include('includes.menu_bar')
    </div>
</div>
