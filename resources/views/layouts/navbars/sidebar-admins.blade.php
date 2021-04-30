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
                    <i class="tim-icons icon-bullet-list-67"></i>
                    {{ __('title.Admin_pages') }} <p></p>
                </a>
            </li>
{{--            <li @if ($pageSlug == 'icons') class="active " @endif>--}}
{{--                <a href="{{ route('pages.icons') }}">--}}
{{--                    <i class="tim-icons icon-atom"></i>--}}
{{--                    <p>{{ _('Icons') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'maps') class="active " @endif>--}}
{{--                <a href="{{ route('pages.maps') }}">--}}
{{--                    <i class="tim-icons icon-pin"></i>--}}
{{--                    <p>{{ _('Maps') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'notifications') class="active " @endif>--}}
{{--                <a href="{{ route('pages.notifications') }}">--}}
{{--                    <i class="tim-icons icon-bell-55"></i>--}}
{{--                    <p>{{ _('Notifications') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'tables') class="active " @endif>--}}
{{--                <a href="{{ route('pages.tables') }}">--}}
{{--                    <i class="tim-icons icon-puzzle-10"></i>--}}
{{--                    <p>{{ _('Table List') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'typography') class="active " @endif>--}}
{{--                <a href="{{ route('pages.typography') }}">--}}
{{--                    <i class="tim-icons icon-align-center"></i>--}}
{{--                    <p>{{ _('Typography') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li @if ($pageSlug == 'rtl') class="active " @endif>--}}
{{--                <a href="{{ route('pages.rtl') }}">--}}
{{--                    <i class="tim-icons icon-world"></i>--}}
{{--                    <p>{{ _('RTL Support') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class=" {{ $pageSlug == 'upgrade' ? 'active' : '' }} bg-info">--}}
{{--                <a href="{{ route('pages.upgrade') }}">--}}
{{--                    <i class="tim-icons icon-spaceship"></i>--}}
{{--                    <p>{{ _('Upgrade to PRO') }}</p>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
