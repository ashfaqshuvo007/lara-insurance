
@extends('layouts.app')
@section('title', 'MySIg by Fidentia | Login')
@section('content')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>My</b>Sig</a>
            </div>
            <!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback color_red" role="alert">
                                        <h5>{{ $message }}</h5>
                                    </span>
                                @enderror
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                @error('password')
                                    <span class="invalid-feedback color_red" role="alert">
                                        <h5>{{ $message }}</h5>
                                    </span>
                                @enderror

                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                            <!-- <a type="submit" class="btn btn-primary btn-block btn-flat" href="dashboard.html">Sign In</a> -->
                        </div>
                        <!-- /.col -->
                        </div>
                    </form>
                <!-- /.social-auth-links -->

                <a href="{{url('password/reset')}}">I forgot my password</a><br>
                <a href="{{url('register')}}" class="text-center">Register a new membership</a>

                </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </body>
@endsection



