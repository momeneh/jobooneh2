<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body class="main-layout " STYLE="direction:
@if(app()->getLocale() == 'fa')  rtl
@else ltr
@endif
    " >
<header>
    <!-- header inner -->
    <div class="header" style="font-family: poppins;padding: 10px 0px;background: #142313;  background-position-x: 0%;  background-position-y: 0%;  background-repeat: repeat;
  background-size: auto;background-repeat: no-repeat;background-size: 100% 100%;background-position: center center;">

        <div class="container" style="  width: 100%;  padding-right: 15px;  padding-left: 15px;  margin-right: auto;  margin-left: auto;">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col logo_section" style="flex: 0 0 25%;
max-width: 25%;">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                @if(app()->getLocale() == 'fa')
                                    <a href="index.html"><img src="{{ $message->embed(public_path().'/green/images/logofa.png')}}" alt="#"></a>
                                @else
                                    <a href="index.html"><img src="{{ $message->embed(public_path().'/green/images/logoen.png')}}" alt="#"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end header inner -->
    <div class="wrapper" style="padding: 5px 0;background: #f5f6fa;    font-family: Tahoma;    font-size: 13px;    font-weight: normal;">


        <div class="main-panel" style="margin: auto;width: 80%;margin: auto;background: #ffffff;box-shadow: 0 1px 20px 0px rgba(0, 0, 0, 0.1);padding: 0 40px;" >
            <div class="content" style="color: #4c4a49;line-height: 33px;">
                @yield('content')
            </div>

        </div>
    </div>
</header>



    </body>
</html>
