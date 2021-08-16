<section>
    <div class="hero-image-section">
      <img src="{{URL::asset('frontend/images/Home-Page-Banner - Copy.png')}}" class="index-hero-img">
      <div class="index-hero-banner-heading">
        <h4 class="text-center text-white home_banner_heading text-uppercase hero-section-policy-header">
        {{ trans('layout-body.buy_insurance_policies') }}</h4>
      </div>
      <div class="option-group d-flex text-center justify-content-center mt-3">
        <div class="option-tab ml-3">
          <input type="checkbox" value="30" name="widget-1" class="subscription-check" id="widget-1">
          <label for="widget-1" class="subscription-checkLabel">
          
            <img src="{{URL::asset('frontend/images/MySig2-Car.png')}}" class="tab-images">
            <p>{{ trans('layout-body.car') }}<br></p>
            <a class="sub_price mt-md-3 text-uppercase" href="#">{{ trans('layout-body.buy_now') }}</a>
          </label>
        </div>
        <div class="option-tab ml-1">
          <input type="checkbox" value="30" name="widget-2" class="subscription-check" id="widget-2">
          <label for="widget-2" class="subscription-checkLabel">
            <img src="{{URL::asset('frontend/images/homeIcon.png')}}" class="tab-images">
            <p>{{ trans('layout-body.home') }}<br></p>
            <a class="sub_price mt-md-3 text-uppercase" href="#">{{ trans('layout-body.buy_now') }}</a>
          </label>
        </div>
        <div class="option-tab ml-1">
          <input type="checkbox" value="30" name="widget-3" class="subscription-check" id="widget-3">
          <label for="widget-3" class="subscription-checkLabel">
            <img src="{{URL::asset('frontend/images/planeIcon.png')}}" class="tab-images">
            <p>{{ trans('layout-body.travel') }}<br></p>
            <a class="sub_price mt-md-3 text-uppercase" href="#">{{ trans('layout-body.buy_now') }}</a>
          </label>
        </div>
      </div>
      <div class="index-btn-group">
        <a href="#" class="btn-otherProduct_link">{{ trans('layout-body.view_other_insurance_products') }}</a>
      </div>
    </div>
  </section>

  <section>
    <div class="why_choose_us_Section mt-4">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex flex-column justify-content-center text-center mb-5">
            <p class="why_choose_us_section_heading mb-0" style="margin-top: 50px;">{{ trans('layout-body.welcome_to') }}</p>
            <h3 class="why_choose_us_Section_subheading">MYSIG <span class="why_choose_us_Section_span">"{{ trans('layout-body.by_fidentia') }}!"</span>
            </h3>
          </div>
          <div class="col-12 col-md-6">
            <h5 class="why_choose_us_Section_left_div_heading" style="margin-bottom: 20px; font-weight: 600;">{{ trans('layout-body.why_choose_us') }}?</h5>
            <div class="why_choose_us_Section_border">
              <p class="text-left why_choose_us_text">{{ trans('layout-body.mysig_ecommerce_portal') }},{{ trans('layout-body.we') }} {{ trans('layout-body.strogly_believe') }}</p>
              <p class="text-left why_choose_us_text">{{ trans('layout-body.broker_since') }}
              {{ trans('layout-body.health_insurance_behalf') }}</p>

              <p class="why_choose_us_text text-left mt-3">{{ trans('layout-body.also_authorized_claim') }}
              {{ trans('layout-body.risk_inception') }}.</p>
              <!-- {{ trans('layout-body.preapare_gap_analysis') }}
              {{ trans('layout-body.policy_holder') }}</p> -->
            </div>

            <div class="why_choose_us_Section_button-group d-flex flex-wrap">
              <a href="#" class="more_option more-option-left mr-3 mt-md-2 mb-md-2">{{ trans('layout-body.more_about_us') }}</a>
              <!-- <a href="#" class="more_option mr-3 mt-2 mb-2">{{ trans('layout-body.make_an_appointment') }}</a> -->
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="why_choose_us_Section_right_div_group justify-content-center d-flex flex-wrap">
              <div class="col-12 col-md-6 d-flex mb-2">
                <img src="{{asset('frontend/images/Compare.png')}}" class="icon-bg-home">
                <p class="why_choose_us_Section_right_div_text">{{ trans('layout-body.compare_and_buy') }}</p>
              </div>
              <div class="col-12 col-md-6 d-flex mb-2">
                <img src="{{URL::asset('frontend/images/Manage.png')}}" class="icon-bg-home">
                <p class="why_choose_us_Section_right_div_text">{{ trans('layout-body.manage_entire') }}, {{ trans('layout-body.insurance_portfolio') }}</p>
              </div>
            </div>
            <div class="why_choose_us_Section_right_div_group d-flex flex-wrap">
              <div class="col-12 col-md-6 d-flex mb-2">
                <img src="{{URL::asset('frontend/images/Document.png')}}" class="icon-bg-home">
                <p class="why_choose_us_Section_right_div_text">{{ trans('layout-body.manage_documenets') }}<br> {{ trans('layout-body.secure_place') }}</p>
              </div>
              <div class="col-12 col-md-6 d-flex mb-2">
                <img src="{{URL::asset('frontend/images/Apply.png')}}" class="icon-bg-home">
                <p class="why_choose_us_Section_right_div_text" style="margin-top: 10px;">{{ trans('layout-body.apply_claims') }}</p>
              </div>
            </div>
            <div class="why_choose_us_Section_right_div_group d-flex flex-wrap mt-2">
              <div class="col-12 col-md-6 d-flex mb-2">
                <img src="{{URL::asset('frontend/images/Notification.png')}}" class="icon-bg-home" alt="notification">
                <p class="why_choose_us_Section_right_div_text">{{ trans('layout-body.set_policy') }}<br> {{ trans('layout-body.get_notifications') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- <section class="way-we-work-curve-section">

  </section> -->

  <!-- <section>
    <div class="way_we_work_Section d-flex flex-column justify-content-center">
      
      <div class="container">
        <div class="row mb-5" style="font-size: 12px;">
          <div class="col-12 d-flex flex-column justify-content-center text-center mb-5">
            <h5 class="why_choose_us_Section_subheading">{{ trans('layout-body.way_we') }} <span class="why_choose_us_Section_span">{{ trans('layout-body.do_work') }}</span>
            </h5>
            <p>{{ trans('layout-body.insurance_broker_regulatory') }} <br>
            {{ trans('layout-body.professional_truly_represent') }} </p>
          </div>
          <div class="col-12 col-md-3 text-center">
            <img src="{{URL::asset('frontend/images/Achivment.png')}}" class="icon-bg mb-3">
            <h5 style="font-size: 18px;">{{ trans('layout-body.our_achivement') }}</h5>
            <p><span class="why_choose_us_Section_span">1,80,000 +</span> {{ trans('layout-body.customer_as_on_date') }}<br>
            {{ trans('layout-body.of_insurance_service') }}</p>
          </div>
          <div class="col-12 col-md-3 text-center">
            <img src="{{URL::asset('frontend/images/Vission.png')}}" class="icon-bg mb-3">
            <h5 style="font-size: 18px;">{{ trans('layout-body.our_vision') }}</h5>
            <p>{{ trans('layout-body.make_cust_exp') }}<br> {{ trans('layout-body.world_class_aspect') }}</p>
          </div>
          <div class="col-12 col-md-3 text-center">
            <img src="{{URL::asset('frontend/images/Goal.png')}}" class="icon-bg mb-3">
            <h5 style="font-size: 18px;">{{ trans('layout-body.our_goal') }}</h5>
            <p><span class="why_choose_us_Section_span">100</span> {{ trans('layout-body.crores_premium') }}</<br>
            {{ trans('layout-body.customer_satisfaction') }}</</p>
          </div>
          <div class="col-12 col-md-3 text-center">
            <img src="{{URL::asset('frontend/images/Team.png')}}" class="icon-bg mb-3">
            <h5 style="font-size: 18px;">{{ trans('layout-body.our_team') }}</h5>
            <p><span class="why_choose_us_Section_span">100 +</span> {{ trans('layout-body.employee_rolls_Serve') }}<br> {{ trans('layout-body.you_as_on_date') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <section>
    <div class="call_us_section">
      <div class="container">
        <div class="call_us_banner d-flex flex-column justify-content-center">
          <div class="row">
            <div class="col-12 d-flex pl-5">
              <img src="{{URL::asset('frontend/images/Support.png')}}" class="support-icon">
              <div class="phone_number_group ml-2 ">
                <h5 class="text-white call-us-text call_us_section_phone_number">{{ trans('layout-body.have_any_questions') }}?</h5>
                <h5 class="font-weight-light text-white call_us_section_phone_number">{{ trans('layout-body.call_us_now') }}!
                  <!-- <span class="text-dark way_we_work_span">001 234 56 78</span> -->
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="reminder_section mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 reminder-card">
          <h5 class="reminder_heading">{{ trans('layout-body.set_insurance') }}<br><span class="why_choose_us_Section_span">
          {{ trans('layout-body.policy_reminder') }}</span></h5>
          <p>{{ trans('layout-body.we_authorized') }}<br>
             {{ trans('layout-body.risk_inspection') }}</p>
            <!-- {{ trans('layout-body.clients') }}. {{ trans('layout-body.broker_represents') }}<br>
            {{ trans('layout-body.the_insurance_company') }}</p> -->
        </div>
        <div class="col-12 col-md-6">
          <div class="card reminder-card">
            <div class="card-body">
              {!! Form::open(['route'=>'post_save_reminder','id'=>'save_reminder']) !!}
                <div class="container">
                  <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                    {{Form::text('name',null,['class'=>'card-input form-control'.( $errors->has('name') ? ' is-invalid' : '' ),'id'=>'full_name_id','placeholder'=>trans('layout-body.full_name')])}}
                        <small class="text-danger"><strong id="name_error"></strong></small>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                    {{Form::text('mobile_number',null,['class'=>'card-input form-control'.( $errors->has('mobile') ? ' is-invalid' : '' ),'id'=>'mobile_number_id','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",'placeholder'=>trans('layout-body.mobile_no')])}}
                      <small class="text-danger"><strong id="mobile_number_error"></strong></small>  
                    </div>
                    <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                    {{Form::text('email',null,['class'=>'card-input form-control'.( $errors->has('email') ? ' is-invalid' : '' ),'id'=>'email_id','placeholder'=>trans('layout-body.email_address')])}}
                      <small class="text-danger"><strong id="email_error"></strong></small>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                    {{Form::text('due_date',null,['class'=>'card-input form-control select-date'.( $errors->has('due_date') ? ' is-invalid' : '' ),'id'=>'due_date_id','placeholder'=>trans('layout-body.due_date').'(DD/MM/YY)'])}}
                      <small class="text-danger"><strong id="due_date_error"></strong></small>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                      <div class=" form-group">
                          {{Form::select('insurance_type',$get_insurance_type,null,['class'=>'credential__select form-control card-input signup_input_Select pr-5'.( $errors->has('insurance_type') ? ' is-invalid' : '' ),'id'=>'insurance_name','placeholder'=>trans('layout-body.select_an_option')])}}
                          <small class="text-danger"><strong id="insurance_type_error"></strong></small>
                      </div>
                    </div>
                    <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;" id="registration_number_div">
                    {{Form::text('registration_number',null,['class'=>'card-input form-control'.( $errors->has('registration_number') ? ' is-invalid' : '' ),'id'=>'registration_number_id','placeholder'=>trans('layout-body.registration_number')])}}
                        <small class="text-danger"><strong id="registration_number_error"></strong></small>
                    </div>
                    <div class="col-12 mb-5">
                      <button class="btn btn-warning btn-block text-white reminder_button"
                        style="background-color: orange; font-size: 12px; font-weight: 600; padding: 0.575rem .75rem;" >{{trans('layout-body.submit')}}</button>
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
