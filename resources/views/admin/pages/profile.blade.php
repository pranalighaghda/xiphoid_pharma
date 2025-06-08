@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
    'title' => __('Profile') ,
    'class' => 'col-lg-7'
])

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="ml-3">Edit Profile</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Admin information</h6>

                        <div class="pl-lg-4">
                            {{-- <div class="form-group">
                                <label class="form-control-label" for="image">{{__('Change Profile Photo')}}</label><br>
                                <input type="file" id="image" name="image" accept="image/*" onchange="loadFile(event)"><br>
                                <img id="output" src="{{ asset('images/user.jpg') }}" class="uploadprofileimg mt-3"/>
                            </div> --}}

                            <div class="form-group">
                                <label class="form-control-label" for="name">Name</label>
                                <input type="text"  value="{{old('name', auth()->user()->name)}}" class="form-control" name="name" id="name" placeholder="Name">
                                @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="email">Email</label>
                                <input type="text"  value="{{old('email', auth()->user()->email)}}" class="form-control" name="email" id="email" placeholder="Email">
                                @error('email')
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                    <form class="form-horizontal" action="{{ route('admin.profile.change-password') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Password</h6>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" autocomplete="current-password">
                                @error('current_password')
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" autocomplete="new-password">
                                @error('new_password')
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password" autocomplete="new_password_confirmation">
                                @error('new_password_confirmation')
                                    <div class="invalid-div">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-4">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection