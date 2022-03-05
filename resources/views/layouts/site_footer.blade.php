<div class="footer top_layer ">
    <div class="container">

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address">
                    <div class="logo">
                        @if(app()->getLocale() == 'fa')
                            <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logofa.png" alt="#"></a>
                        @else
                            <a href="{{route('MainPage')}}"><img src="{{ asset('green') }}/images/logoen.png" alt="#"></a>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <p  style="font-size: 15px;text-align: justify">
                        {!! $footer_desc[0]['body'] !!}
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address footer_links">
                    <h3>{{__('Quick links')}}</h3>
                    <ul class="">
                        @foreach($main_menus as $menu_item)
                            <li > <img class="arrow" src="{{ asset('green') }}/icon/3.png" alt="#" /> <a href="{{$menu_item['link']}}">{{$menu_item['title']}}</a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address footer_links">
                    <h3>{{__('Subscribe')}}</h3>
                    <p style="font-size: 15px;text-align: justify" > {{__('With subscribe you can be aware of news in our site')}} </p>
                    <input class="form-control" placeholder="Your Email" type="type" name="subscribe_mail" id="subscribe_mail" url="{{route('subscribe')}}">
                    <button class="submit-btn" onclick="subscribe()">Submit</button>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="address footer_links">
                    <h3>{{__('Contact Us')}}</h3>

                    <ul class="loca">
                        <li style="font-size: 14px;"> <a href="#"><img src="{{ asset('green') }}/icon/email.png" alt="email" />   momeneh.jafari@gmail.com </a></li>
                        <li> <a href="#"><img src="{{ asset('green') }}/icon/call.png" alt="call" />  +12586954775</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="container">
        © 2021 made with momeneh.jafari@gmail.com thanks to
        <a href="https://creative-tim.com" target="_blank">{{ _('Creative Tim') }}</a> &amp;
        <a href="https://updivision.com" target="_blank">{{ _('Updivision') }}</a>

    </div>
</div>
