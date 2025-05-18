@extends('admin.layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('admin.layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset('images/user.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name ?? 'Admin' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Admin
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        {{-- @include('components.alert') --}}
    </div>
    <div class="container-fluid py-4">

        {{-- Profile Update Card --}}
        <div class="card mb-4">
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Profile</p>
                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Update Profile</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input class="form-control" type="text" name="name"
                                    value="{{ old('name', auth()->user()->name) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Email address</label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Change Password Card --}}
        <div class="card">
            <form method="POST" action="{{ route('admin.profile.change-password') }}">
                @csrf
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Change Password</p>
                        <button type="submit" class="btn btn-warning btn-sm ms-auto">Update Password</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">Current Password</label>
                                <input class="form-control" type="password" name="current_password" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">New Password</label>
                                <input class="form-control" type="password" name="new_password" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">Confirm Password</label>
                                <input class="form-control" type="password" name="new_password_confirmation" required>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @include('admin.layouts.footers.auth.footer')
@endsection
