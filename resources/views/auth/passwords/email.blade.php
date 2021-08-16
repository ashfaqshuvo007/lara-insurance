@extends('layouts.app')
@section('title', 'MySIg by Fidentia | Password Reset')

@section('content')
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>My</b>Sig</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

        <form method="POST" action="{{ route('password.email') }}">
        @csrf
          <div class="form-group has-feedback">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-12 px_15">
              <button type="submit" class="btn btn-primary btn-block">Request new password</button>
            </div>
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="{{ url('admin-login') }}">Login</a>
        </p>
        <p class="mb-0">
          <a href="{{url('register')}}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  

  

</body>
@endsection
