@extends('layouts.appLogin')
@section('content')
    <section class="main-area">
        <div class="container-fluid">
            <div class="row h100">
                <div class="col-md-6 p-0 m-none" style="background: url(https://bbdu.ac.in/wp-content/uploads/2020/06/pharmacy-post-banner-background.jpg) center center;background-size: cover;background-repeat: no-repeat;">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                </div>

                <div class="col-md-6 p-0 data-box-col">
                    <div class="login">
                        <div class="center-box">
                            <div class="logo">
                                <img src="{{ asset('images/logo.png') }}" class="logo-img">
                            </div>
                           
                            <div class="form-wrap">
                                <form role="form"  class="pui-form" id="loginform"  method="POST" action="{{ route('admin.login.submit') }}">
                                @csrf
                                    <div class="pui-form__element">
                                        <label class="animated-label {{ old('email') != null ? 'moveUp': '' }}">Email</label>
                                        <input id="inputEmail" type="email" class="form-control   {{ old('email') != null ? 'outline': '' }} @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="" autocomplete="email">
                                            
                                    </div>
                                    <div class="pui-form__element">
                                        <label class="animated-label">Password</label>
                                        <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" autocomplete="current-password">
                                            
                                    </div>
                                    @if ($errors->any())
                                        <h4 class="text-center text-red">{{$errors->first()}}</h4>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <h4 class="text-center text-red">{{$message}}</h4>
                                    @endif
                                    <div class="pui-form__element">
                                        <button class="btn btn-lg btn-primary btn-block btn-salon" type="submit">SIGN IN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
