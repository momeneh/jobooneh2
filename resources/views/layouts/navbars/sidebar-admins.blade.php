<div class="inner_page_box box_side sidebar_part">
    <div class="sidebar" style=" @if(app()->getLocale() == 'fa')  right:0 @else left:0 @endif ">
        <h3 >
            <a href="#" class="simple-text logo-mini">{{ __('title.Admin_Dashboard') }} </a>
        </h3>
        <hr>
        <ul class="navi">
{{--            <li @if ($pageSlug == 'dashboard') class="active " @endif>--}}
            <li>
                <a href="{{ route('menu.index') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <span>{{ __('title.Admin_Menus') }} </span>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="tim-icons icon-image-02" ></i>
                    <span class="nav-link-text" >{{ __('title.Admin_links') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse hide" id="laravel-examples">
                    <ul class="navi pl-4">
                        <li>
                            <a href="{{ route('link_locations.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <span>{{ __('title.links_location') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('link.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <span>{{ __('title.links') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('page.index') }}">
                    <i class="tim-icons icon-paper"></i>
                    <span>{{ __('title.Admin_pages') }} </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <span>{{ __('title.Admin_users') }} </span>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#business_owners" aria-expanded="false">
                    <i class="tim-icons icon-image-02" ></i>
                    <span class="nav-link-text" >{{ __('title.business_owners') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse hide" id="business_owners">
                    <ul class="navi pl-4">

                        <li>
                            <a href="{{ route('product_category.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <span>{{ __('title.categories') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index')  }}">
                                <i class="tim-icons icon-image-02"></i>
                                <span>{{ __('title.products') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('comment.index')  }}">
                                <i class="tim-icons icon-chat-33"></i>
                                <span>{{ __('title.comments') }}</span>
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
                    <ul class="navi pl-4">
                        <li>
                            <a href="{{ route('admin.message.index')  }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span>{{ __('title.inbox') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.message_sent')  }}">
                                <i class="tim-icons icon-send"></i>
                                <span>{{ __('title.sent') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li >
                <a href="{{ route('admin.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <span>{{ __('title.Notifications') }} ({{count(Auth::user()->unreadNotifications)}}) </span>
                </a>
            </li>
            <li >
                <a href="{{ route('admin.contacts') }}">
                    <i class="tim-icons icon-email-85"></i>
                    <span>{{ __('Contact Us') }}  </span>
                </a>
            </li>
            <li >
                <a href="{{ route('subscribe.index') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <span>{{ __('Newsletter') }}  </span>
                </a>
            </li>
            <li>
                <a href="{{ route('requested_orders') }}">
                    <i class="tim-icons icon-bag-16"></i>
                    <span>{{ __('title.requested_orders') }}</span>
                </a>
            </li>

            <li >
                <a href="{{ route('admin.logout') }}">
                    <i class="tim-icons icon-button-power"></i>
                    <span>{{ __('title.logout') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
