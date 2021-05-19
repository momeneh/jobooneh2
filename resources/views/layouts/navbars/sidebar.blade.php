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
