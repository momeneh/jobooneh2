@extends('layouts.green_layout')
@section('title')
    | {{__("title.Dashboard")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
            </div>
        </div>
    </div>
@endsection
