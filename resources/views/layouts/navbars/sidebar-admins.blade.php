<div class="sidebar" style=" @if(app()->getLocale() == 'fa')  right:0 @else left:0 @endif ">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal"> {{ __('title.Admin_Dashboard') }} </a>
        </div>
        <ul class="nav">
{{--            <li @if ($pageSlug == 'dashboard') class="active " @endif>--}}
            <li>
                <a href="{{ route('menu.index') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    {{ __('title.Admin_Menus') }} <p></p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="tim-icons icon-image-02" ></i>
                    <span class="nav-link-text" >{{ __('title.Admin_links') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse hide" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('link_locations.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <p>{{ __('title.links_location') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('link.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <p>{{ __('title.links') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('page.index') }}">
                    <i class="tim-icons icon-paper"></i>
                    {{ __('title.Admin_pages') }} <p></p>
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    {{ __('title.Admin_users') }} <p></p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#business_owners" aria-expanded="false">
                    <i class="tim-icons icon-image-02" ></i>
                    <span class="nav-link-text" >{{ __('title.business_owners') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse hide" id="business_owners">
                    <ul class="nav pl-4">

                        <li>
                            <a href="{{ route('product_category.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <p>{{ __('title.categories') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <p>{{ __('title.products') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('comment.index')  }}">
                                <i class="tim-icons icon-chat-33"></i>
                                <p>{{ __('title.comments') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li >
                <a data-toggle="collapse" href="#messages" aria-expanded="false">
                    <i class="tim-icons icon-chat-33" ></i>
                    <span class="nav-link-text" >{{ __('title.inbox') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse hide" id="messages">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('admin.message.index')  }}">
                                <i class="tim-icons icon-email-85"></i>
                                <p>{{ __('title.inbox') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.message_sent')  }}">
                                <i class="tim-icons icon-send"></i>
                                <p>{{ __('title.sent') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li >
                <a href="{{ route('admin.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('title.Notifications') }} ({{count(Auth::user()->unreadNotifications)}}) </p>
                </a>
            </li>
            <li >
                <a href="{{ route('admin.contacts') }}">
                    <i class="tim-icons icon-email-85"></i>
                    <p>{{ __('Contact Us') }}  </p>
                </a>
            </li>
            <li >
                <a href="{{ route('subscribe.index') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ __('Newsletter') }}  </p>
                </a>
            </li>

            <li >
                <a href="{{ route('admin.logout') }}">
                    <i class="tim-icons icon-button-power"></i>
                    <p>{{ __('title.logout') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
