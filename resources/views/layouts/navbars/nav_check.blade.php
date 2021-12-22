<div class="col-xl-3">

    @if (Auth::guard('admin')->check()) @include('layouts.navbars.sidebar-admins')
    @else
        @include('layouts.navbars.sidebar')
    @endif

</div>
