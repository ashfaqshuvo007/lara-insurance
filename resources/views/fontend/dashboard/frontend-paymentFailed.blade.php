@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

<?php
        $base_url=url('/') ;
        // $unsuccess_reason = 'There was some issue while processing the payment!';
        $unsuccess_reason = 'some issue while processing the payment!';
        // $user = Auth::user();
        // dd($user);
        // $token = auth('api')->tokenById($user->id);
?>
<payment-failed :base_url="'{{ url('/') }}'"></payment-failed>
<div class="payment-failed-wrap text-center">
    <h3>Payment failed due to <?php echo $unsuccess_reason?></h3><br>
        <h4>Please try again!</h4><br><br>
        @if($input['Currency']=='978')
        <a href="/payment/{{$input['policy_id']}}" class="btn addbuttons button_bottom btn-default">
            <i class="fa fa-refresh text-light mr-1" aria-hidden="true"></i>
            Retry
        </a>
        @else
        <a href="/payment/{{$input['policy_id']}}" class="btn addbuttons button_bottom btn-default">
            <i class="fa fa-refresh text-light mr-1" aria-hidden="true"></i>
            Retry
        </a>
        @endif
</div>
@endsection