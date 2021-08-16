@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')
<?php
    // dd($data);
    $lang = config('app.locale');
    $files = glob(resource_path('lang/' . $lang . '/layout-payment.php'));
    foreach ($files as $file) {
        $strings = require $file;
    }
       
    ?>

<form method="get" action="{{ route('frontend_cod_thankyou') }}">
@csrf
 <div class="heading-sec">
        <div class="container">
        <h1>{{$strings['header']}}</h1>
            <div class="box">
              <strong>{{$strings['name']}} - </strong><?php  echo $data['prospect_name'] ?><br><br>
              <strong>{{$strings['insurance_plan']}} - </strong><?php  echo $data['policy_name'] ?><br><br>
              <strong>{{$strings['amount_to_be_paid']}} - </strong><?php  echo $data['amount'] ?><strong>
              @if($data['policy_type']=='c1bc21cfdda9')ALL<br><br>
              @else
              Lek<br><br>
              @endif
              </strong>
                @if(isset($data['registration_number']))
                  <strong>{{$strings['car_registration_number']}}- </strong><?php  echo $data['registration_number'] ?><br><br>
                @else
                  <strong>{{$strings['policy_for']}}- </strong><?php  echo $data['policy_for'] ?><br><br>
                @endif
                
            </div>
            <div class="box-btns">
                <button class="btn" style="width: 300px; background-color: #1B0202; color: #fff"> {{$strings['confirm_pay_on_delivery']}}</button>
            </div>
        </div>
    </div>
    </form>

@endsection
