<header class="fixed-nav">
    <div class="container">
      <div class="row">
        <div class="col-4 col-md-2">
          <a href="{{route('frontend_index')}}" class="logo"><img src="{{url('frontend/images/Logo.png')}}" alt="" class="logo-icon-claim"
              style="margin-left: 120px; margin-top: 10px;"></a>
        </div>
        <div class="col-8 col-md-10 d-flex justify-content-end">
          <div class="navbars inner-width">
            <button type="button" class="dropBtn-main" id="headerDropDown">
              <i class="menu-toggle-btn fa fa-bars"></i>
            </button>
            <nav class="navigation-menu" id="myDropdown">
  
              @if(Auth::check()=='false')
                <a href="{{route('user-home')}}">{{ trans('layout-header.buy_insurance') }}</a>
              @else
                <a href="javascript:void(0)">{{ trans('layout-header.buy_insurance') }}</a>
              @endif
              <a href="{{route('frontend_claim')}}">{{ trans('layout-header.claims') }}</a>
              <div class="dropdowns2">
                <button class="dropbtns">{{ trans('layout-header.about_us') }}
                  <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-contents" id="aboutUs">
                  <a href="#" class="dropdown-nav-items">{{ trans('layout-header.about_mysig') }}</a>
                  <a href="#" class="dropdown-nav-items">{{ trans('layout-header.about_fidentia') }}</a>
                  <a href="{{route('frontend_contact_us')}}" class="dropdown-nav-items">{{ trans('layout-header.contact_us') }}</a>
                </div>
              </div>
              <a href="{{route('frontend_login')}}" class="login-btn auth-btn text-dark pl-3 pr-3">
              {{ trans('layout-header.login') }}
              </a>
              <a href="{{route('frontend_signup')}}" class="signup-btn auth-btn pl-3 pr-3">{{ trans('layout-header.signup') }}</a>

              <!-- <a href="{{ url('/localization/en') }}" class="login-btn auth-btn text-dark pl-3 pr-3">En</a>
              <a href="{{ url('/localization/al') }}" class="signup-btn auth-btn pl-3 pr-3">Al</a> -->
            </nav>
          </div>
          <div class="dropdown language">
                  <div class="select">
                    <span>Language</span>
                  </div>
                  <input type="hidden" name="country-list">
                  <div class="dropdown-menu">
                    <a id="english" href="{{ url('/localization/en') }}" class="language-list">
                      <img src="{{url('/frontend/images/uk.png')}}" alt="">
                      English
                    </a>
                    <a id="albania" href="{{ url('/localization/al') }}" class="language-list">
                      <img src="{{url('/frontend/images/albania.png')}}" alt="">
                      Albania
                    </a>
                  </div>
          </div>
        </div>
      </div>
    </div>

  </header>