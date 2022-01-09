<div class="col-xl-3">
    <a href="#" id="side_bar_icon" > <i class="tim-icons icon-bullet-list-67"></i></a>

    @if (Auth::guard('admin')->check()) @include('layouts.navbars.sidebar-admins')
    @else
        @include('layouts.navbars.sidebar')
    @endif

</div>
