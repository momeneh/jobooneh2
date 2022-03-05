
@extends('layouts.green_layout')
@section('title')
    | {{__("title.products")}}
@endsection
@section('meta_keyword') , {{__("title.products")}} @endsection
@section('meta_description') . {{__("title.products")}} @endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                  @include('includes.message')
                    @include('product.product_common_admin_user',['r'=>'product'])
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var url = "{{ route('admin.notify_user')}}";
        var created = "{{__('messages.created')}}";
        var error_happened = "{{__('messages.error_happened')}}";

    </script>
    <script src="{{asset('green/js/admin_notify_owner.js')}}"></script>
@endsection
