@extends('layouts.app', ['pageSlug' => ''])

@section('content')
{{--    @include('layouts.headers.guest')--}}

    <div class="container mt--8 pb-5 verify">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('auth.verify_email') }}</small>
                        </div>
                        <div>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('auth.verification_sent') }}
                                </div>
                            @endif

                            {{ __('auth.Before_proceeding') }}

                            @if (Route::has('verification.resend'))
                                {{ __('auth.not_receive_email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" id="request_another" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.request_another') }}</button>.
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
