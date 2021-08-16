@extends('fontend.layouts.head-master')
    @if(!empty($register))
        @section('title','MySIg by Fidentia | Register')
    @else
        @section('title','MySIg by Fidentia | Login')
    @endif
@section('styles')
<style>
    .auth-tabHeader {
        max-width: 300px;
        margin: 0 auto;
    }
    #registration_form_frontend .iti--allow-dropdown{
        width: 100%;
    }
    #registration_form_frontend .iti--allow-dropdown .iti__country-list{
        width: 300px;
    }
</style>
@endsection
@section('content')

    @include('fontend.layout-index.layout-index-header')
    <section class="login-main">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 pl-md-0">
                    <div class="auth-tabHeader">
                        <!-- <h5 class="register_heading_txt mt-5">Login To <span class="mysig-heading">MySig</span></h5>
                        <p style="font-size: 12px; font-weight: 400; color: gray;">There are many variations of passages of Lorem<br>
                        Ipsum available,but the majority</p> -->
                        <ul class="nav nav-tabs" style="margin-bottom: 40px;">
                        @if(empty($register))
                            <li class="nav-item plan-tab_navItem active text-center">
                                <a class="nav-link active" 
                                    data-toggle="tab" 
                                    href="#login"
                                    style="font-size: 14px; font-weight: 600; color: black;">
                                    {{ trans('layout-login.login')}}
                                </a>
                            </li>
                            <li class="nav-item plan-tab_navItem text-center">
                                <a class="nav-link" 
                                    data-toggle="tab"
                                    href="#register-tab"
                                    style="font-size: 14px; font-weight: 600; color: black;">
                                    {{ trans('layout-login.register')}}
                                </a>
                            </li>
                        @else
                            <li class="nav-item plan-tab_navItem  text-center">
                                <a class="nav-link " 
                                    data-toggle="tab" 
                                    href="#login"
                                    style="font-size: 14px; font-weight: 600; color: black;">
                                    {{ trans('layout-login.login')}}
                                </a>
                            </li>
                            <li class="nav-item plan-tab_navItem active text-center">
                                <a class="nav-link active" 
                                    data-toggle="tab"
                                    href="#register-tab"
                                    style="font-size: 14px; font-weight: 600; color: black;">
                                    {{ trans('layout-login.register')}}
                                </a>
                            </li>
                        @endif
                        </ul>
                    </div>

                    <div class="tab-content">
                    @if(empty($register))
                        <div id="login" role="tabpane" class="tab-pane show fade active">
                    @else
                        <div id="login" role="tabpane" class="tab-pane  fade ">
                    @endif
                            <h5 class="register_heading_txt mt-5">{{ trans('layout-login.login_to')}} <span class="mysig-heading">MySig</span></h5>
                            <!-- <p style="font-size: 12px; font-weight: 400; color: gray;">
                            {{ trans('layout-login.many_passages_lorem')}}<br>
                            {{ trans('layout-login.ipsum_available')}}</p> -->
                            <form action="{{route('post_login')}}" method="post" id="forntend_login">
                                @csrf
                                <div class="form-group">
                                <input type="email" class="form-control signup_input" placeholder="{{ trans('layout-login.enter_email')}}" name="email" id="email_login">
                                    <!-- @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror -->
                                    <div class="text-danger"><small id="email_login_error"></small></div>

                                </div>
                                <div class="form-group">
                                <input type="password" class="form-control signup_input" placeholder="{{ trans('layout-login.password')}}" name="password" id="password_login">
                                    <!-- @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror -->
                                    <div class="text-danger"><small id="password_login_error"></small></div>

                                </div>
                                <div class="form-group">
                                <input type="submit" class="btn login-btn-submit text-white login_submit" value="{{ trans('layout-login.login')}}">
                                <!-- <a href="{{route('frontend_home')}}" class="btn btn-submit text-white" type="submit">LogIn</a> -->
                                </div>
                            </form>
                            <div class="forget-password">
                                <a href="#" class="btn-text link" data-toggle="modal" data-target="#myModal">{{ trans('layout-login.Forget_Password')}}</a>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <a href="{{route('frontend_signup')}}" class="text-dark"
                                    style="color: gray; text-decoration: none; font-size: 12px;">{{ trans('layout-login.dont_have_an_Account')}}?<span
                                    class="mysig-heading" style="font-weight: 600;"> {{ trans('layout-login.sign_up')}}</span>
                                </a>
                            </div>
                        </div>
                    @if(empty($register))
                        <div class="tab-pane fade" id="register-tab" role="tabpane">
                    @else
                        <div class="tab-pane show fade active" id="register-tab" role="tabpane">
                    @endif
                            <h5 class="register_heading_txt mt-5"> {{ trans('layout-login.register_to')}} <span class="mysig-heading">MySig</span></h5>
                            <!-- <p style="font-size: 12px; color: gray;">{{ trans('layout-login.many_passages_lorem')}}<br>
                            {{ trans('layout-login.ipsum_available')}}</p> -->
                            <!-- Nav tabs -->
                            <!-- <ul class="nav nav-tabs" style="margin-bottom: 40px;">
                                <li class="nav-item plan-tab_navItem active text-center">
                                <a class="nav-link active" data-toggle="tab" href="#login" style="font-size: 14px; font-weight: 600; color: black;">Login
                                </a>
                                </li>
                                <li class="nav-item plan-tab_navItem text-center">
                                <a class="nav-link" data-toggle="tab" href="#register-tab" style="font-size: 14px; font-weight: 600; color: black;"> Register</a>
                                </li>
                            </ul> -->
                            <form action="{{route('post_save_signin')}}" method="POST" id="registration_form_frontend" name="registration_form_frontend">
                                @csrf
                                    <div class="row d-flex flex-wrap">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control signup_input" placeholder="{{ trans('layout-login.first_name')}}" name="first_name" id="register_first_name">
                                                <div class="text-danger"><small id="first_name_error"></small></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control signup_input" placeholder="{{ trans('layout-login.last_name')}}" name="last_name" id="register_last_name">
                                                <div class="text-danger"><small id="last_name_error"></small></div>
                                            </div>

                                        </div>
                                    </div>
                                <div class="form-group">
                                    <input type="email" class="form-control signup_input" placeholder="{{ trans('layout-login.enter_email')}}" id="register_email" name="email">
                                    <div class="text-danger"><small id="email_error"></small></div>
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control signup_input"  id="phone" placeholder="{{ trans('layout-login.phone_no')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="phone_number">
                                    <div class="text-danger"><small id="phone_number_error"></small></div>

                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control signup_input" placeholder="{{ trans('layout-login.password')}}" id="pwd" name="password">
                                    <div class="text-danger"><small id="password_error"></small></div>

                                </div>
                                <div class="form-group">
                                    <input class="form-control signup_input" type="password" id="cpwd" placeholder="{{ trans('layout-login.confirm_password')}}" name="password_confirmation">
                                    <div class="text-danger"><small id="password_confirmation_error"></small></div>

                                </div>
                                <div class="form-group">
                                    <select class="form-control signup_input" name="user_type" id="user_account_id" placeholder="Select an option">
                                        <option value="Individual">{{ trans('layout-login.individual')}}</option>
                                        <option value="Business">{{ trans('layout-login.business')}}</option>
                                    </select>
                                    <div class="text-danger"><small id="user_type_error"></small></div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-submit text-white registration_submit">
                                    <!-- <span class="spinner-border spinner-border-sm text-light mr-2" role="status"></span> -->
                                    {{ trans('layout-login.create_account')}}
                                    </button>
                                    <!-- <a href="#" class="btn btn-submit text-white" type="submit">Create Account</a> -->
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                <a href="{{route('frontend_login')}}" class="text-dark" style="color: gray; text-decoration: none; font-size: 12px;">{{ trans('layout-login.already_have_an_account')}}?<span
                                    class="mysig-heading" style="font-weight: 600;"> {{ trans('layout-login.login')}}</span></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 pr-md-0 pl-md-3 px-0">
                    <!-- C:\xampp\htdocs\mysig\public\frontend\images -->
                    <img src="{{URL::asset('frontend/images/LoginBackground2.png')}}" class="hero-img" id="img-area">
                </div>
            </div>
        </div>

        <loader></loader>
        
    </section>
    <?php
        $lang = config('app.locale');
    ?>
    <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">{{ trans('layout-login.Forget_Password')}}</h4>
        </div>
        <div class="modal-body">
          <div class="contact-form mar-top">
          <strong>You forgot your password?</strong><br> Here you can easily retrieve a new password.
          {!! session('success') !!}  
          <form action="{{ route('fortgot_password') }}" method="post">
            {!! Form::hidden('language_type', $lang) !!}
            {{csrf_field()}}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group mt-4 w-100">
                    <label>{{ trans('layout-login.enter_email')}}</label>
                    <input type="email" class="form-control" name="email">
                  </div>
                </div>
                <!-- <div class="col-md-12">
                  <div class="form-group">
                    <label>{{ trans('layout-login.new_password')}}</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>{{ trans('layout-login.confirm_password')}}</label>
                    <input type="password" class="form-control" name="confirmed">
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div class="btn-group">
                    <input type="submit" value="{{ trans('layout-login.update_password')}}" class="submit">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
    @include('fontend.layouts.head-footer')
@endsection

@section('add-js')
    <script>

        var input = document.querySelector("#phone");
        var iti_main =  window.intlTelInput(input, {
            preferredCountries:["al"],
            utilsScript: "{{ url('country_code/build/js/utils.js') }}",
           


        });
       
        $("#registration_form_frontend").submit(function(){

            event.preventDefault();
            // get selected country code
            var country = iti_main.getSelectedCountryData();
            // alert(country.dialCode);
            
            var formData = new FormData($(this)[0]);
            formData.append('country_code', country.dialCode);
            // formData.append('is_verified',1);
            $(".registration_submit").prop('disabled', true);
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache:false,
                data: formData,
                loading: false,
                success: function (response) {   // success callback function

                if(response.success === true)
                {
                    this.loading = true;
                    $(".registration_submit").prop('disabled', false);

                    toastr.success('Registration Sucessfully','Success');
                    $("#registration_form_frontend")[0].reset();
                    // $("#save_reminder").reset();
                    window.location = "{{ route('frontend_login') }}";
                }
                else{
                    $("#registration_form_frontend")[0].reset();
                    toastr.error('Registration could not be completed!','Error');
                }

                },error: function (jqXHR) {
                    $(".registration_submit").prop('disabled', false);
                    var errormsg = jQuery.parseJSON(jqXHR.responseText);
                    $.each(errormsg.errors,function(key,value) {
                        $(".text-danger").show();
                        $('#'+key+'_error').html(value);
                    });
                    this.loading = false;
                }
            });
        });


        $("#forntend_login").submit(function(){

            event.preventDefault();
          
            var formData = new FormData($(this)[0]);
            
            $(".login_submit").prop('disabled', true);
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: $(this).attr('action'),
                type: 'POST',
                processData: false,
                contentType: false,
                cache:false,
                data: formData,
                success: function (response) {   // success callback function
                
                    $(".login_submit").prop('disabled', false);
                    toastr.success('Login Successfull','Successfull');
                    $("#forntend_login")[0].reset();
                    window.location = "{{ route('frontend_home') }}";
                
                // $("#forntend_login")[0].reset();
                // toastr.error('You have entered wrong credentials. Please enter correct credentials to continue!','Error');
                

                },error: function (jqXHR) {
                    $(".login_submit").prop('disabled', false);
                    if(jqXHR.responseJSON.status == 1)
                    {
                        $("#forntend_login")[0].reset();
                        toastr.error('You have entered wrong credentials. Please enter correct credentials to continue!','Error');
                    }
                    else{
                        
                        var errormsg = jQuery.parseJSON(jqXHR.responseText);
                        $.each(errormsg.errors,function(key,value) {
                            $(".text-danger").show();
                            $('#'+key+'_login_error').html(value);
                        });
                    }
                   
                }
            });
        });

        //login
        $('#email_login').keyup(function(){
            $('#email_login_error').html('');

         });
        $("#password_login").keyup(function(){
            $("#password_login_error").html('');
        
        });

        //registration
        $("#register_first_name").keyup(function(){
            $("#first_name_error").html('');
        });
        $('#register_last_name').click(function(){
            $('#last_name_error').html('');
        });
        $('#register_email').click(function(){
            $('#email_error').html('');
        });

        $('#phone').click(function(){
            $('#phone_number_error').html('');
        });

        $('#pwd').click(function(){
            $('#password_error').html('');
        });

        $('#cpwd').click(function(){
            $('#password_confirmation_error').html('');
        });
        $('#user_account_id').click(function(){
            $('#user_type_error').html('');
        });
    </script>
@endsection