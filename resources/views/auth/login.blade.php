@extends('shop.partials.master')

@section('title')
@endsection


@section('content')

    <!-- products -->
    <div class="order-section bg-dark">
        <div class="container">
            <div class="row">
                <div class="container" style="margin-top: 200px">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-center">{{ __('Login') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('customer.login') }}">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('Email Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary w-100">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>

                                    <div class="mt-3 text-center">
                                        <a href="{{ route('customer.password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end products -->

@endsection
