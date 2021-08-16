@extends('layouts.app')
@section('title', 'MySIg by Fidentia | Register')
@section('content')
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="login-logo">
        <a href="#"><b>My</b>Sig</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

                <form action="{{ route('register_user') }}" method="post">
                    @csrf

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> 
                            @error('name')
                                <span class="invalid-feedback color_red" role="alert">
                                    <h5>*{{ $message }}</h5>
                                </span>
                            @enderror
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback color_red" role="alert">
                                    <h5>*{{ $message }}</h5>
                                </span>
                            @enderror
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback color_red" role="alert">
                                    <h5>*{{ $message }}</h5>
                                </span>
                            @enderror
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation"  value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus>
                            @error('password')
                                <span class="invalid-feedback color_red" role="alert">
                                    <h5>*Give the same password</h5>
                                </span>
							@enderror 
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            <a href="{{ url('admin-login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
</body>
@endsection

@yield('add-js')