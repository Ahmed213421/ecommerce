@extends('shop.partials.master')

@section('title')
@endsection

@section('css')
<style>
    body {
        background-color: #f8f9fa;
    }
    .form-container {
        background: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .form-header {
        background: linear-gradient(45deg, #007bff, #6610f2);
        color: #ffffff;
        padding: 15px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .form-header h4 {
        margin: 0;
        text-align: center;
    }
    .btn-custom {
        background: linear-gradient(45deg, #007bff, #6610f2);
        border: none;
        color: white;
    }
    .btn-custom:hover {
        background: linear-gradient(45deg, #0056b3, #4e0ca5);
    }
</style>
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                        <h1>{{ trans('general.settings') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="text-center mb-0">{{ trans('general.update_profile') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('customer.settings.update',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">{{ trans('dashboard.name') }}</label>
                                    <input type="text" class="form-control" id="name"value="{{ old('name', auth()->user()->name) }}" placeholder="Enter your full name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="photo">{{ trans('dashboard.photo') }}</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">{{ trans('general.email') }}</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Enter your email" name="email">
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">{{ trans('general.password') }}</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter new password" name="password">
                                </div>
                                <!-- Password Confirmation -->
                                <div class="form-group">
                                    <label for="confirm-password">{{ trans('general.confirm_password') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="confirm-password" placeholder="Confirm new password">
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-block">{{ trans('general.update_profile') }}</button>
                            </form>
                            @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
