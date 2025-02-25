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
                                <div class="card-header text-center">{{ __('Register') }}</div>

                                <div class="card-body">
                                <form method="POST" action="{{ route('customer.password.email') }}">
                                                        @csrf

                                                        <!-- Email Address -->
                                                        <div class="form-group">
                                                            <label for="email">{{ __('Email') }}</label>
                                                            <input id="email" type="email" name="email"
                                                                value="{{ old('email') }}"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                required autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- Submit Button -->
                                                        <div class="form-group text-right mt-4">

                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Email Password Reset Link') }}
                                                            </button>
                                                        </div>
                                                    </form>
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
