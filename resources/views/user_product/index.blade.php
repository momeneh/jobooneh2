
@extends('layouts.green_layout')
@section('title')
    | {{__("title.products")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            <div class="col-xl-3">
                @include('layouts.navbars.sidebar')
            </div>
            <div class="col-xl-9 " style="margin-top: 10px" >
            @include('includes.message')
            @include('product.product_common_admin_user',['r'=>'userProduct'])
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
    <script src="{{asset('green/js/admin_notify_owner.js')}}"
@endsection
