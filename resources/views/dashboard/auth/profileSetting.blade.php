@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
    <style>
        .avatar-wrapper {
            position: relative;
            width: 150px;
            /* Adjust the size as needed */
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        .avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .hover-text {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .avatar-wrapper:hover .hover-text {
            opacity: 1;
        }
    </style>
@endsection

@section('titlepage')
@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    {{-- {{-- <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.category.index')}}">{{ trans('dashboard.all_cat') }}</a></li> --}}
    <li class="breadcrumb-item active" aria-current="page"><a
            href="{{ route('admin.settings.index') }}">{{ trans('general.update_profile') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('general.update_profile') }}</h2>

        <div class="card">
            <div class="my-4 container">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Notifications</a>
                    </li>
                </ul>
                <form action="{{ route('admin.settings.update', Auth::guard('admin')->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                                <div class="avatar-wrapper">
                                    <div class="avatar avatar-xl">
                                        <img src="default-avatar.jpg" alt="Avatar" class="avatar avatar-img rounded-circle" id="avatar">
                                        <div class="hover-text" id="hoverText">Change Picture</div>
                                        <input type="file" name="photo" id="fileInput" style="display: none;" />
                                    </div>
                                </div>

                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 class="mb-1">{{ Auth::guard('admin')->user()->name }}</h4>
                                    <p class="small mb-3"><span class="badge badge-dark">New York, USA</span></p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-7">
                                    <p class="text-muted"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
                                        blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea
                                        dictumst. Cras urna quam, malesuada vitae risus at, pretium blandit sapien. </p>
                                </div>
                                <div class="col">
                                    <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                                    <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                                    <p class="small mb-0 text-muted">(537) 315-1481</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">{{ trans('dashboard.name') }}</label>
                            <input type="text" id="firstname"
                                value="{{ old('name', Auth::guard('admin')->user()->name) }}" class="form-control">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">{{ trans('general.email') }}</label>
                        <input type="email" class="form-control"
                            value="{{ old('name', Auth::guard('admin')->user()->email) }}" id="inputEmail4"
                            placeholder="brown@asher.me">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress5">Address</label>
                        <input type="text" class="form-control" id="inputAddress5"
                            placeholder="P.O. Box 464, 5975 Eget Avenue">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCompany5">Company</label>
                            <input type="text" class="form-control" id="inputCompany5"
                                placeholder="Nec Urna Suscipit Ltd">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState5">State</label>
                            <select id="inputState5" class="form-control">
                                <option selected="">Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip5">Zip</label>
                            <input type="text" class="form-control" id="inputZip5" placeholder="98232">
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPassword4">{{ trans('general.password') }}</label>
                                <input type="password" class="form-control" id="inputPassword5" name="oldpassword">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword5">{{ trans('general.new') }}
                                    {{ trans('general.password') }}</label>
                                <input type="password" class="form-control" id="inputPassword5" name="password">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword6">{{ trans('general.confirm_password') }}</label>
                                <input type="password" class="form-control" id="inputPassword6"
                                    name="password_confirmation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">Password requirements</p>
                            <p class="small text-muted mb-2"> To create a new password, you have to meet all of the
                                following requirements: </p>
                            <ul class="small text-muted pl-4 mb-0">
                                <li> Minimum 8 character </li>
                                <li>At least one special character</li>
                                <li>At least one number</li>
                                <li>Can’t be the same as a previous password </li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                </form>
            </div>
        </div>


    </div>
@endsection

@section('js')
<script>
    document.querySelector('.avatar-wrapper').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar').src = e.target.result; // Update avatar preview
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
