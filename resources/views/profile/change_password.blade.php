@extends('layouts.green_layout')
@section('title')
    | {{__("title.change_password")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            <div class="col-xl-3">
                <a href="#" id="side_bar_icon" > <i class="tim-icons icon-bullet-list-67"></i></a>
                @include('layouts.navbars.sidebar')
            </div>
            <div class="col-xl-8 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('title.change_password') }}</h5>
                    </div>
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
            <div class="card-body">
                @csrf
                @method('put')

                @include('alerts.success', ['key' => 'password_status'])

                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <label>{{ __('title.current_password') }}</label>
                    <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"  value="" required>
                    @include('alerts.feedback', ['field' => 'old_password'])
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{ __('title.new_password') }}</label>
                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  value="" required>
                    @include('alerts.feedback', ['field' => 'password'])
                </div>
                <div class="form-group">
                    <label>{{ __('title.confirm_new_password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control"  value="" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">{{ __('title.change_password') }}</button>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
