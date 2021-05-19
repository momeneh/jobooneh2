@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'change_password'])

@section('content')
    <div class="row">
        <div class="col-md-8">
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
@endsection
