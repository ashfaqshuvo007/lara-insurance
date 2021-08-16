@extends('fontend.layouts.head-master')
@section('title','MySIg by Fidentia | Login')
@section('content')

    @include('fontend.layout-index.layout-index-header') 
  <section>
    <div class="hero-immg">
    <!-- C:\xampp\htdocs\mysig\public\frontend\images -->
      <a href="#"><img src="{{URL::asset('frontend/images/Terms-of-use-bg.png')}}" class="hero-image"></a>
      <h4 class="text-center text-white privacy-text-heading text-heading1">Contact Us</h4>
      <div class="sub-text text-center">
        <a href="{{route('frontend_home')}}" class="hero_menu_home_link">Home</a>
        <a href="{{route('why_choose_us')}}" class="hero_menu_why_choose_us"><i class="fa fa-circle dot-icon1 ml-1 mr-1"></i>
          Contact Us</a>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-center text-center my-5" style="padding:20px 0px 20px">
          <h5 class="why_choose_us_Section_subheading">CONTACT <span class="why_choose_us_Section_span">US</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-12">
          <h3 class="contact_us_left_div_heding" style="font-size: 20px; font-weight: bold; margin-bottom: 30px;">
            CONTACT ADDRESS</h3>
          <div class="d-flex flex-wrap"
            style=" font-family: 'Montserrat', sans-serif; font-size: 14px; color: gray; font-weight: 500;">
            <div class="col-12 col-lg-6 col-md-12 pl-0 pr-0">
              <div class="contact_address-group d-flex flex-column pr-0 pl-0">
                <div class="col-11 contact_group d-flex flex-wrap mb-4 pl-0 pr-0">
                  <img src="{{URL::asset('frontend/images/Map.png')}}" class="map-icon mr-2">
                  <p class="mb-0 ml-1">Soho 95 Broadway st<br>New York, NY 1001</p>
                </div>
                <div class="col-11 contact_group d-flex flex-wrap mb-4 pl-0 pr-0">
                  <img src="{{URL::asset('frontend/images/Call.png')}}" class="map-icon1 mr-2">
                  <p class="mb-0 ml-1" style="color: black;"><span class="contact_number">Phone no.</span><br>001 234 56
                    78<br>001 987 65 43</p>
                </div>
                <div class="col-12 contact_group d-flex flex-wrap mb-4 pl-0 pr-0">
                  <img src="{{URL::asset('frontend/images/Email.png')}}" class="map-icon mr-2">
                  <p class="mb-0 ml-1"><span class="email-address_class">Email id:</span><br>hello@dream-theme.com</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-md-12 pl-0 pr-0">
              <div class="hour_group">
                <p class="hour_heading mb-1">
                  Business Hour:
                </p>
                <p class="mb-0">Monday ............ 10 am-8 pm</p>
                <p class="mb-0">Tuesday ............ 10 am-8 pm</p>
                <p class="mb-0">Wednesday ............ 10 am-8 pm</p>
                <p class="mb-0">Thursday ............ 10 am-8 pm</p>
                <p class="mb-0">Friday ............ 10 am-8 pm</p>
                <p class="mb-0">Saturday ............ Closed</p>
                <p class="mb-0">Sunday ............ Closed</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="card contact-card" style="border: rgba(0,0,0,.125);">
            <div class="card-header-contact d-flex flex-wrap px-5 py-3">
              <div class="card-heading-group d-flex">
                <h5><b>CONTACT FORM</b> </h5>
                <!-- <img src="{{URL::asset('frontend/images/contacr-form-shape.png')}}" class="contact-form-shape"> -->
              </div>

            </div>
            <div class="card-body mt-2">
              <form>
                <div class="container">
                  <div class="row">
                    <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                      <input type="text" class="form-control contact_us_card_field" placeholder="Full Name">
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                      <input type="text" class="form-control contact_us_card_field" placeholder="Phone no.">
                    </div>
                    <div class="col-12 mb-2" style="padding-bottom: 10px;">
                      <input type="text" class="form-control contact_us_card_field" placeholder="Email address">
                    </div>
                    <div class="col-12">
                      <textarea cols="4" rows="4" class="message-text form-control" placeholder="Message"></textarea>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                      <button class="btn btn-block text-white" style="background-color: #f69320; font-size: 12px; font-weight: 600; padding: 0.575rem .75rem;">SUBMIT</button>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- <div id="googleMap" style="width:100%;height:400px;"></div> -->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16612.01292548706!2d-73.99641917956642!3d40.74737071236849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a41f6d57ff%3A0xeeb8e31fe0643b48!2s1001%20Broadway%2C%20New%20York%2C%20NY%2010010%2C%20USA!5e0!3m2!1sen!2sin!4v1595338829851!5m2!1sen!2sin"
            width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
        </div>
      </div>
    </div>
  </section>

  <section class="reminder_section mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 reminder-card">
          <h5 class="reminder_heading">SET AN INSURANCE<br><span class="why_choose_us_Section_span">POLICY
              REMINDER</span></h5>
          <p>We are also authorized to do insurance claim consultancy<br>
            , Risk Inspection and a gap analysis report for our<br>
            clients. A broker represents a policy holder and not<br>
            the insurance company</p>
        </div>
        <div class="col-12 col-md-6">
          <div class="card reminder-card">
            <div class="card-body">
              <form>
                <div class="container">
                  <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                      <input type="text" class="card-input form-control" placeholder="Full Name">
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                      <input type="text" class="card-input form-control" placeholder="Mobile Number">
                    </div>
                    <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                      <input type="text" class="card-input form-control" placeholder="Email Address">
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                      <input type="text" class="card-input form-control" placeholder="Due Date(DD/MM/YY">
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                      <div class=" form-group">
                        <select _ngcontent-fbk-c5=""
                          class="credential__select form-control card-input signup_input_Select pr-5">
                          <option _ngcontent-fbk-c5="" value="other">Insurance Type</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <select _ngcontent-fbk-c5=""
                          class="credential__select form-control card-input signup_input_Select pr-5">
                          <option _ngcontent-fbk-c5="" value="other">Insurance Produt</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 mb-5">
                      <button class="btn btn-warning btn-block text-white"
                        style="background-color: orange; font-size: 12px; font-weight: 600; padding: 0.575rem .75rem;">SUBMIT</button>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('fontend.layouts.head-footer')
@endsection   