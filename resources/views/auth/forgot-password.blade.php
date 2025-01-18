@extends('shop.partials.master')

@section('content')
<div class="container" style="margin-top: 200px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <div class="mb-4">
        <!-- Display Session Status -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('customer.password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autofocus
            >
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
@endsection
