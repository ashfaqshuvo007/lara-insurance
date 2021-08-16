@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Claim')
@section('content')
<?php
        $user = Auth::user();
        $token = auth('api')->tokenById($user->id);

        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/layout-claim.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
    ?>
<section class="mt- main-home">
    <claim-list :base_url="'{{ url('/') }}'"
        :insaurance_logo="{{json_encode(url('frontend/images/MySig2-Car.png'))}}"
        :Auth="{{json_encode($token)}}" :locale="{{json_encode($strings)}}">
    </claim-list>
</section>

<section class="reminder_section mt-5">

</section>

<!-- file a claim (information modal) modal6 -->

<div class="modal fade in" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('layout-claim-information.information') }}</h4>
      </div>
      <div class="modal-body">
          <h4>{{ trans('layout-claim-information.imformation_note') }}</h4>
          <div class="content">
              <p>
              {{ trans('layout-claim-information.dear_customer') }}
              </p>
              <p>
              {{ trans('layout-claim-information.fidentia_insurer_broker') }}
              </p>
              <p>
              {{ trans('layout-claim-information.for_this_purpose') }}
              </p>
              <p class="strong">{{ trans('layout-claim-information.contact_in_case') }}</p>
              <p>
              {{ trans('layout-claim-information.in_any_case') }}
              </p>
              <p class="strong">
              {{ trans('layout-claim-information.dear_my_friend') }}
              </p>
              <p class="strong">
              {{ trans('layout-claim-information.mandatory_liability') }}
              </p>
              <p>
              {{ trans('layout-claim-information.be_careful') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.provide_copy') }}
              </p>
              <p>
                {{ trans('layout-claim-information.provide_policy') }}
              </p>
              <p>
                {{ trans('layout-claim-information.provide_photo') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.driving_license') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.vehicle_ownership') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.provide_accident') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.preapare_the_request') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.take_pictures') }}
              </p>
              <p class="strong">
                 {{ trans('layout-claim-information.advice_to_be_followed') }}
              </p>
              <p class="strong">
                {{ trans('layout-claim-information.health_insurance') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.reimbursment_expenses') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.notify_by_phone') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.original_medical_docu') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.any_case_insurer_has') }}
              </p>
              <p class="strong">
                 {{ trans('layout-claim-information.advice_followed') }}
              </p>
              <p class="strong">
                 {{ trans('layout-claim-information.property_insurance') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.immediately_notify') }}
              </p>
              <p>
                  {{ trans('layout-claim-information.in_consultation_with') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.make_photos') }}
              </p>
              <p>
                {{ trans('layout-claim-information.ensure_statements') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.provide_written_verbal') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.earthquake_damage') }}
              </p>
              <p>
                {{ trans('layout-claim-information.flooding_storm_lighting') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.identify_equipment') }}
              </p>
              <p class="strong">
                  {{ trans('layout-claim-information.compensation_damage') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.fidentia_broker') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.wire') }}
              </p>
              <p>
                {{ trans('layout-claim-information.email') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.mobile_phone') }}
              </p>
              <p>
                 {{ trans('layout-claim-information.facebook') }}
              </p>
          </div>
      </div>
     
    </div>
  </div>
</div>
@endsection
