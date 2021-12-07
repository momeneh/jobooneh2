<div class="profile-dropdown" id="box_user_info">
    <div class="profile-dropdown-account-container">
        <div class="profile-dropdown-user">
            <div class="profile-dropdown-user-img card-user">
                <a href="{{route('dashboard')}}">
                <img class="avatar" src="
                        @if (!empty(auth()->user()->image) && trim(auth()->user()->image)!= '') {{asset('/profile_images/'.Auth::user()->image)}}
                        @else  {{ asset('white') }}/img/default-avatar.png
                        @endif">
                </a>
            </div>
            <div class="profile-dropdown-user-info">
                <div class="profile-dropdown-user-name"><a href="{{route('dashboard')}}"> {{auth()->user()->name}}</a></div>
                <a class="profile-dropdown-user-profile-link" href="{{route('dashboard')}}">{{__('title.Dashboard')}}</a>
            </div>
        </div>
        <div class="profile-dropdown-account">
            <div class="profile-dropdown-account-item js-user-dropdown-wallet-has-url">
                <a class="profile-dropdown-account-item-title profile-dropdown-account-item-title--link  js-wallet-activation-url" href="{{route('profile.change_password')}}">{{__('title.change_password')}}</a>
            </div>

        </div>
        <div class="profile-dropdown-account">
            <div class="profile-dropdown-account-item js-user-dropdown-wallet-has-url">
                <a class="profile-dropdown-account-item-title profile-dropdown-account-item-title--link  js-wallet-activation-url" href="{{route('order.index')}}">{{__('title.orders')}}</a>
            </div>

        </div>
    </div>

    <div class="profile-dropdown-actions">

        <div class="profile-dropdown-action-container">
            <a href="{{route('logout')}}" data-snt-event="dkHeaderClick"  class="profile-dropdown-action profile-dropdown-action--logout js-logout-button" >{{__('title.logout')}}</a>
        </div>
    </div>
</div>
