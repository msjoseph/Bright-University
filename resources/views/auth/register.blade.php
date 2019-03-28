@extends('base')
@section('title')
    Create account
@endsection
@section('content')
    <style type="text/css">
        body{
            background: url("{{ asset('images/unii1.jpg') }}");
            background-size: cover;background-position: center center;
background-repeat: no-repeat;background-attachment:fixed;
        }
    </style>
    <div class="container mt-3 mb-5 card bg-light col-lg-5 col-md-6 col-sm-10  border">
        <h3 class="text-center" style="color: #e436d4">Create account</h3>
        <small class="card-text mb-3"><a href="{{ route('login') }}">Login</a></small>

        <form method="POST" action="{{ route('register') }}" class="mb-3">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"
                       name="name" id="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"
                       name="email" id="email" value="{{ old('email') }}" required>
                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                       name="password"  id="password" required>
                <small class="form-text text-muted">*Use a minimum of 6 characters.</small>
                <small class="form-text text-muted">*Ensure the two passwords match.</small>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password-confirm">Password confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" required>
            </div>

            <button type="submit" class="btn btn-info">Register</button>

        </form>
    </div>
@endsection
