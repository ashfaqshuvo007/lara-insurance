@extends('layouts.master')
@section('title','MySIg by Fidentia | Profile')
@section('content')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Profile
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="{{route('home')}}" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Profile</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">User Info</h3>
              </div>
              {!! Form::model($user, array('route' => 'save_updated_profile','enctype'=>'multipart/form-data')) !!}
                <div class="box-body">
                  <!-- text input -->
                  <div class="form-group">
                    {{Form::label('Name')}}
                    {{Form::text('name',null,['class'=>'form-control'.( $errors->has('name') ? ' is-invalid' : '' ),'placeholder'=>'Enter Name'])}}
                      @error('name')
                        <span class="color_red" role="alert">
                          <h5 class="message_text">*{{ $message }}</h5>
                        </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    {{Form::label('Email address')}}
                    {{Form::email('email',null,['class'=>'form-control'.( $errors->has('email') ? ' is-invalid' : '' ),'placeholder'=>'Enter email'])}}
                      @error('email')
                        <span class="color_red" role="alert">
                          <h5 class="message_text">*{{ $message }}</h5>
                        </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    {{Form::label('Phone Number')}}
                    {{Form::text('phone',null,['class'=>'form-control input number_only'.( $errors->has('phone_number') ? ' is-invalid' : '' ),'placeholder'=>'Enter Phone Number'])}}
                      @error('phone')
                        <span class="color_red" role="alert">
                          <h5 class="message_text">*{{ $message }}</h5>
                        </span>
                      @enderror
                  </div>
                  <div class="file-upload-div"> <span id="filename">Select your file</span>
                    <label for="file-upload">Browse
                      <input type="file" id="file-upload" name="profile_image">
                    </label>   
                  </div>
                  @error('profile_image')
                    <span class="color_red" role="alert">
                      <h5 class="message_text">*{{ $message }}</h5>
                    </span>
                  @enderror
                </div>
                <div class="box-footer">
                  {{Form::submit('Save',['class'=>'btn btn-primary'])}}
                </div>
              {{ Form::close() }}
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title">Change Password</h3>
              </div>
              {{ Form::open(array('route'=>'save_updated_password')) }}
                <div class="box-body">
                  <!-- text input -->
                  <div class="form-group">
                    {{Form::label('Old Password')}}
                    {{Form::password('old_password',['class'=>'form-control'.( $errors->has('old_password') ? ' is-invalid' : '' )])}}
                        @error('old_password')
                          <span class="color_red" role="alert">
                            <h5 class="message_text">*{{ $message }}</h5>
                          </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    {{Form::label('New Password')}}
                    {{Form::password('new_password',['class'=>'form-control'.( $errors->has('password') ? ' is-invalid' : '' )])}}
                        @error('new_password')
                          <span class="color_red" role="alert">
                            <h5 class="message_text">*{{ $message }}</h5>
                          </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    {{Form::label('Confirm Password')}}
                    {{Form::password('confirm_password',['class'=>'form-control'.( $errors->has('password') ? ' is-invalid' : '' )])}}
                        @error('confirm_password')
                          <span class="color_red" role="alert">
                            <h5 class="message_text">*It will be same as new password</h5>
                          </span>
                        @enderror
                  </div>
                </div>
                <div class="box-footer">
                  {{Form::submit('Save',['class'=>'btn btn-primary'])}}
                </div>
                {{ Form::close() }}
              <!-- </form> -->
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
@endsection
@section('add-js')
    <script>
        $('#file-upload').change(function () {
            var filepath = this.value;
            var m = filepath.match(/([^\/\\]+)$/);
            var filename = m[1];
            $('#filename').html(filename);

        });
        //Input only number
        $(function(){
          $(".number_only").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
            }
          });
        });
    </script>
        
@endsection