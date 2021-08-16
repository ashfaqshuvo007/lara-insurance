@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

<?php
        $base_url=url('/') ;
        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/layout-payment.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
     

    ?>
<form method="post" action="https://vpos.bkt.com.al/Mpi/3Dhost.aspx">
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
                <div id="paypal-button-container" style="width: 300px"></div>
            </div>
        </div>
    </div>

</form>



</section>
@endsection

<div style="margin-top:100px">
    <div id="smart-button-container">

    </div>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AcMuWnOGWxeB3IDsM8_mraf0FLLf32GzFxaKEyTLN9-H0w8mh3oBQAEte9uvDJfILLEdm9M0k0K4uwj8&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    <script>
    window.onload = ()=>{
    function initPayPalButton() {
            paypal.Buttons({
                style: {
                  shape: 'rect',
                  color: 'gold',
                  layout: 'horizontal',
                  label: 'paypal',
                  tagline: 'false',

                },

                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            "amount": {
                                "currency_code": "USD",
                                "value": '<?php echo $data['amount'] ?>'
                            }
                        }]
                    });
                },

                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {

                        var policy_id = '<?php echo $data['policy_id'] ?>';
                       
                        $.ajax({
                                headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                type:'POST',
                                url:"{{ route('paypalDetailsSave') }}",
                                data:{policy_id:policy_id,PaymentId:details.id,intent:details.intent,status:details.status,payerId:details.payer.payer_id,payerEmail:details.payer.email_address,payerName:details.payer.name.given_name},
                                success: function (response) {   // success callback function
                            
                                if(response.success === true)
                                {
                                    window.location = '{{ url("papalRedirection") }}';
                                }

                                },error: function (jqXHR) {
                                    
                                    alert('Something Wrong');
                                    location.reload();
                                
                                }
                                });
                    });
                },

                onError: function (err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    }
       

    </script>
</div>
