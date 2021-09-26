<div class="sidebar"  style=" @if(app()->getLocale() == 'fa')  right:0 @else left:0 @endif ">
    <div class="sidebar-wrapper" >
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('title.Dashboard') }} </a>
        </div>
        <ul class="nav">

            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('title.User_Profile') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'change_password') class="active " @endif>
                <a href="{{ route('profile.change_password')  }}">
                    <i class="tim-icons icon-lock-circle"></i>
                    <p>{{ __('title.change_password') }}</p>
                </a>
            </li>
            <li >
                <a href="{{ route('userProduct.index')  }}">
                    <i class="tim-icons icon-image-02"></i>
                    <p>{{ __('title.products') }}</p>
                </a>
            </li>

            <li  @if ($pageSlug == 'messages') class="active " @endif>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="tim-icons icon-chat-33" ></i>
                    <span class="nav-link-text" >{{ __('title.inbox') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse hide" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('message.index')  }}">
                                <i class="tim-icons icon-email-85"></i>
                                <p>{{ __('title.inbox') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('message_sent')  }}">
                                <i class="tim-icons icon-send"></i>
                                <p>{{ __('title.sent') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'notifications') class="active " @endif>
                <a href="{{ route('pages.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('title.Notifications') }}</p>
                </a>
            </li>
            <li >
                <a href="{{ route('logout') }}">
                    <i class="tim-icons icon-button-power"></i>
                    <p>{{ __('title.logout') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
