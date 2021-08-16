    <?php
        use App\Services\ContactDetailsService\ContactServices;

        $address_details = ContactServices::getContactInfo();
        $year = date("Y");
    ?>
    
    <footer class="footer">
        <div class="footer-content">
        <div class="container">
            <div class="row w-100 pb-5" style="margin-top: 60px;">
            <div class="col-12 col-md-3">
                <h5 class="footer-heading-text" style="position:relative; padding-bottom: 20px;">
                {{ trans('layout-footer.contact_address') }}</h5>
                <div class="footer-section d-flex">
                <!-- frontend/images -->
                <img src="{{URL::asset('frontend/images/Map.png')}}"class="footer-icon mr-">
                <div class="footer-section-address-group">
                    <p>{{$address_details['address']}}</p>
                </div>
                </div>
                <div class="footer-section d-flex mt-2">
                <img src="{{asset('frontend/images/Call.png')}}" class="footer-icon mr-">
                <div class="footer-section-address-group">
                    <p class="mb-0" style="color: rgb(95, 59, 59); font-weight: bold;">{{ trans('layout-footer.phone_no') }}:</p>
                    <p class="mb-0" style="font-weight: 600;">{{$address_details['primary_number']}} {{$address_details['alternate_number']}}</p>
                    <!-- <p class="mb-0" style="font-weight: 600;">{{$address_details['alternate_number']}}</p> -->
                </div>
                </div>
                <div class="footer-section d-flex mt-2" style="padding-top:20px;">
                <img src="{{asset('frontend/images/Email.png')}}" class="footer-icon mr-">
                <div class="footer-section-address-group">
                    <p class="mb-0" style="color: rgb(95, 59, 59); font-weight: bold;">{{ trans('layout-footer.email_id') }}:</p>
                    <p>{{$address_details['email']}}</p>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="footer-section quick_links d-flex">
                <a href="{{ url('/terms-of-use') }}">{{ trans('layout-footer.terms_of_use') }}</a>
                <a href="{{ url('/privacy-policy') }}">{{ trans('layout-footer.privacy_policy') }}</a>
                </div>
            </div>
            </div>
        </div>

        </div>
        <div class="footer-bottom">
        <div class="container">
            <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="footer-bottom-bordering"></div>

            </div>
            <div class="col-12">
                <p class="pt-2">Copyright &copy; {{$year}} Mysig.com - All Rights Reserved.</p>
            </div>
            </div>
        </div>
        </div>
    </footer>
