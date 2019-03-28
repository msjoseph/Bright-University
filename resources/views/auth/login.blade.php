@extends('base')
@section('title')
    Login
@endsection

@section('stylesheets')
    <link type="text/css" href='{{ asset('css/login.css') }}' rel='stylesheet'>
@endsection

@section('content')
    <style type="text/css">
        body {
            margin:0;
            color:#edf3ff;
            background:#c8c8c8;
            background:url({{ asset('images/unii1.jpg') }}) fixed;
            background-size: cover;background-position: center center;
background-repeat: no-repeat;background-attachment:fixed;

        }
        .login-wrap{
            width: 100%;
            margin:auto;
            max-width:510px;
            min-height:510px;
            position:relative;
            background: #0b2e13;
            background-size: cover;
            box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
            margin-top: 20px;
        }
    </style>



    <div class="container">

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="login-wrap">
                <div class="login-html">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
                    <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">Forgot Password</label>
                    <div class="login-form">
                        <div class="sign-in-htm">
                            <div class="group">
                                <label for="email" class="label">Email address</label>
                                <input id="email" type="email" class="input form-control{{ $errors->has('email') ? '
                                    is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="group">
                                <label for="password" class="label">Password</label>
                                <input id="password" type="password" class="input form-control{{ $errors->has('password') ?
                                    ' is-invalid' : '' }}" data-type="password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember"><small>Remember me</small></label>
                                <small><a href="{{route('register')}}" class="pull-right">Create Account</a></small>
                            </div>

                            <div class="group">
                                <input type="submit" class="button btn btn-primary" value="Sign In">
                            </div>
                            <div class="hr"></div>
                        </div>
                        <div class="for-pwd-htm">
                            <div class="group">
                                <a  class="button btn btn-primary" href="/password/reset">Reset Password</a>
                            </div>
                            <div class="hr"></div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>

@endsection
