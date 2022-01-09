<div class="inner_page_box box_side sidebar_part">
    <div class="sidebar"  style=" @if(app()->getLocale() == 'fa')  right:0 @else left:0 @endif ">
        <h3 >
            <a href="#" class="simple-text logo-mini">{{ __('title.Dashboard') }} </a>
        </h3>
        <hr>
        <ul class="navi">

                <li >
                    <a href="{{ route('profile.edit')  }}">
                        <i class="tim-icons icon-single-02"></i>
                        <span>{{ __('title.User_Profile') }}</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('profile.change_password')  }}">
                        <i class="tim-icons icon-lock-circle"></i>
                        <span>{{ __('title.change_password') }}</span>
                    </a>
                </li>
                @if(auth()->user()->is_owner === 1 )
                    <li >
                        <a href="{{ route('userProduct.index')  }}">
                            <i class="tim-icons icon-image-02"></i>
                            <span>{{ __('title.products') }}</span>
                        </a>
                    </li>
                @endif
                <li  >
                    <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                        <i class="tim-icons icon-chat-33" ></i>
                        <span class="nav-link-text" >{{ __('title.inbox') }}</span>
                        <b class="tim-icons icon-triangle-right-17 caret2"></b>
                    </a>

                    <div class="collapse hide" id="laravel-examples">
                        <ul class="navi pl-4">
                            <li>
                                <a href="{{ route('message.index')  }}">
                                    <i class="tim-icons icon-email-85"></i>
                                    <span>{{ __('title.inbox') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('message_sent')  }}">
                                    <i class="tim-icons icon-send"></i>
                                    <span>{{ __('title.sent') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('pages.notifications') }}">
                        <i class="tim-icons icon-bell-55"></i>
                        <span>{{ __('title.Notifications') }} ({{count(Auth::user()->unreadNotifications)}}) </span>
                    </a>
                </li>
                @if(auth()->user()->is_owner === 1 )
                    <li>
                        <a href="{{ route('requested_orders') }}">
                            <i class="tim-icons icon-bag-16"></i>
                            <span>{{ __('title.requested_orders') }}</span>
                        </a>
                    </li>
                @endif
                <li >
                    <a href="{{ route('logout.a') }}">
                        <i class="tim-icons icon-button-power"></i>
                        <span>{{ __('title.logout') }}</span>
                    </a>
                </li>
            </ul>
    </div>
</div>
