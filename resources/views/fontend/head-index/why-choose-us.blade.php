@extends('fontend.layouts.head-master')
@section('title','MySIg by Fidentia | Login')
@section('content')
    @include('fontend.layout-index.layout-index-header') 
    <section>
        <div class="hero-immg">
        <a href="{{route('why_choose_us')}}"><img src="{{URL::asset('frontend/images/Why-Choose-UsBanner - Copy.png')}}" class="hero-image"></a>
            <h4 class="text-center text-white privacy-text-heading text-heading1">WHY CHOOSE US</h4>
            <div class="sub-text text-center">
            <a href="{{route('frontend_home')}}" class="hero_menu_home_link">Home</a>
            <a href="#" class="hero_menu_why_choose_us"><i class="fa fa-circle dot-icon1 mr-2"></i> Why Choose Us</a>  
            </div>
        </div>
    </section>
  
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="privacy_policy_headtag">WHY USE AN INSURANCE BROKER ?</h5>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">Insurance broker represents the insurance buyer, and not the insurance company (insurance seller), though the remuneration of insurance broker is paid<br> and borne bythe insurance companies. There is no additional cost to the insurance buyer for placing business through insurance broker.<br>Insurance brokers have been introduced into the Albanian market by insurance regulatory and development authority as professionals, Who Will truly<br> represent and service the interests of insurance buyers.
                    </p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">Insurance brokers have qualified and experienced insurance experts and can buy insurance for their clients at the most competitive<br> premium rate and terms, Insurance brokers provide a package of services to the insurance buyer, including post-insurance services as well as assisting in<br> submission of claim documents to insurance company. Please see annexure for functions of insurnce brokers</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">Insurance brokers have to obtain licence from the AMF before they carry on insurance broking in Albania and the operations of insurance brokers are<br> monitored and controlled by AMF a copy of code of conduct prescribed by AMF. for insurance brokers is enclosed.</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">Insurance brokers are different from insurance agents. Insurance agents represent a given insurance company, and not the insurance buyer. Thus, insurance<br> agents sell the insurance policies of a given insurance company, taking care of the interests of the insurance company (insurance seller), and not of the<br> insurance buyers</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">Insurance brokers are professionals and represent the insurance buyers Only, and not the insurance company. Insurance broker can place the insurance Of<br> his client with any insurance company, in the best interest of the insurance buyer. Thus, the insurance broker is a single window solution for all insurance<br> problems of the insurance buyer with all insurance companies.</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text"><b>Importance of role of Insurance broker in the emerging scenerio of the "detarrifing"</b></p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">For the last several decades, the insurance premium rates (in other words the prices) for traditional and/or statutory insurance covers in the Fire, Engineering,<br>Motor, Workmen's Compensation, etc, departments have been controlled by Tariff Advisory Committee Of Govt. Of India through "FIRE TARIFF", "ENGINEERING TARIFF",<br> "MOTOR TARIFF", *WORKMEN'S COMPENSATION TARIFF', ETC These insurances are known as "Tariff Insurance covers".
                        </p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">Now that the Government of India have embarked upon insurance reforms and thrown open the insurance sector to private players, sooner rather than later,<br> the above described administered price mechanism through TARIFFS will give way to a NON-TARIFF regime, whereby the premium to be charged for any<br> given insurance cover will be negotiated and fixed between the insurance company and the proposer by considering the risk exposures, past claims<br> experience, risk improvement measures adopted, etc. on a more scientific basis</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">THUS, WITHOUT ANY EXAGGERATION, WE MAY BRING TO YOUR KIND ATTENTION    AND NOTICE THAT ALL BUYERS OF INSURANCE LIKE THE PRIVATE<br>
                        LIMITED / PUBLIC LIMITED CORPORATES, STATUTORY CORPORATIONS OF THE CENTRAUSTATE COVTS„ PARTNERSHIP FIRMS, CHARITABLE<br>
                        INSTITUTIONS, INDIVIDUALS, ETC. WOULD NEED TO USE PAOFESSIONAL INSURANCE BPOKEQS, BECAUSE BuyiNG INSUQANCE THQ0uCH INSUQANCE<br> BROKER IS A WIN-WIN SITUATION FOR ALL INSURANCE BUYERS.
                        </p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">SO, Oug DEAR INSURANCE BUYERS, KINDLY BE AWARE OF THE FIERCE COMPETITION IN-BETWEEN THE INSURANCE COMPANIES FOP SELLING THEIR<br>
                        INSURANCE POLICIES TO YOU. aux, OUR DEAR INSURANCE BUYERS, DO NOT BE TAKEN UNAWARES, BECAUSE INSURANCE IS A HIGHLY SPECIALISED<br>
                        SUBJECT REQUIRING PROFESSIONALS TO ASSIST YOU. APPOINT YOUR INSURANCE BROKERS ay GIVING THEM MANDATE TO NEGOTIATE ON YOUR<br>
                        BEHALF, WITHOUT ANV ADDITIONAL COST TO YOU. YOU WILL DEPIVE IMMENSE BENEFTIS IN TEAMS OF COVERACE, PQEMIUM, ETC. 
                        </p>
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