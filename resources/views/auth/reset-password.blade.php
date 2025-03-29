<x-guest-layout>
    <form method="POST" action="{{ route('customer.password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">{{ trans('general.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="form-group text-right mt-4">

            <button type="submit" class="btn btn-primary">
            </button>
        </div>
    </form>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</x-guest-layout>
