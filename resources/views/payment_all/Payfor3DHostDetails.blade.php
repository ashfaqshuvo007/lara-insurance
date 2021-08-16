@extends('fontend.layouts.frontend-master', ['data' => $data])
@section('title','MySIg by Fidentia | Buy')
@section('content')

<?php

        $user = Auth::user();
        $base_url=url('/') ;
        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/layout-payment.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
        //ALL 
        $MbrId="9";                                                                         //Member Id
        $MerchantID="9257625";                                                               //Language_MerchantID
        $MerchantPass="W2e8R4X0";                                                           //Language_MerchantPass
        $UserCode="fidentiaadmin";                                                                   //User Code
        $UserPass="Mysig@Fidentia";                                                                   //User Password
        $SecureType="3DHost";                                                                     //Language_SecureType
        $TxnType="Auth";                                                                          //Transaction Type
        $InstallmentCount="0";                                                                    //Installment Count
        $Currency="008";   
        $OkUrl="https://mysig.al/thank-you?policy_id={$data['policy_id']}&id={$user['id']}";                                                                        //Language_OkUrl
        $FailUrl="https://mysig.al/transaction-failed?policy_id={$data['policy_id']}&id={$user['id']}";                                                                  //Currency
        // $OkUrl="https://mysig.al/transaction-failed?policy_id={$data['policy_id']}&id={$user['id']}";                                                                        //Language_OkUrl
        // $FailUrl="https://mysig.al/transaction-failed?policy_id={$data['policy_id']}&id={$user['id']}";                                                       //Language_FailUrl
        $OrderId="";  
        $OrgOrderId="";                                                               //Orginal Transaction Order Number
        // $PurchAmount=$data['amount'];                                                                         //Amount
        $PurchAmount=(float)$data['amount']; 
        $Lang="EN";                                                                           //Language_Lang
        $TemplateType="1";                                                                        //Language_TemplateType
        $ShippingNameSurname=$data['name'].' '.$data['surname'];  //Language_ShippingNameSurname
        $ShippingEmail=$data['email'];                                                 //Language_ShippingEmail
        $ShippingPhone=$data['phone_number'];                                                          //Language_ShippingPhone
        $ShippingNationalId="";                                                        //Language_ShippingNationalId
        $ShippingCompanyName="";                                         //Language_ShippingCompanyName
        $ShippingTaxOffice="";                                                            //Language_ShippingTaxOffice
        $ShippingTaxNo="";                                                              //Language_ShippingTaxNo
        $ShippingAddress=$data['address'];                                           //Language_ShippingAddress
        $ShippingTown="";                                                                  //Language_ShippingTown
        $ShippingCity=$data['city'];                                                                 //Language_ShippingCity
        $ShippingZipCode=$data['zipcode'];                                                                 //Language_ShippingZipCode
        $ShippingCountry=$data['shipping_country'];                                                                //Language_ShippingCountry
        $BillingNameSurname=$data['billing_name'].' '.$data['billing_surname'];                                                        //Language_BillingNameSurname
        $BillingEmail=$data['billing_email'];                                                  //Language_BillingEmail
        $BillingPhone=$data['billing_phone_number'];                                                           //Language_BillingPhone
        $BillingNationalId="";                                                         //Language_BillingNationalId
        $BillingCompanyName="";                                          //Language_BillingCompanyName
        $BillingTaxOffice="";                                                             //Language_BillingTaxOffice
        $BillingTaxNo="";                                                               //Language_BillingTaxNo
        $BillingAddress=$data["billing_address"];                                            //Language_BillingAddress
        $BillingTown="" ;                                                                  //Language_BillingTown
        $BillingCity=$data["billing_city"];                                                                  //Language_BillingCity
        $BillingZipCode=$data["billing_zipcode"];                                                                  //Language_BillingZipCode
        $BillingCountry=$data["billing_country"];                                                                 //Language_BillingCountry
        $rnd = microtime();
        $rnd = str_replace(' ','',$rnd); 
        $rnd = str_replace('.','',$rnd); 
        // dd($rnd);
        $hashstr = $MbrId . $OrderId . $PurchAmount . $OkUrl . $FailUrl . $TxnType . $InstallmentCount . $rnd . $MerchantPass;
        $hash = base64_encode(pack('H*',sha1($hashstr)));

    ?>
  <form method="post" action="https://vpos.bkt.com.al/Mpi/3Dhost.aspx">
    <div class="heading-sec">
        <div class="container">
            <h1>{{ trans('layout-errors.pay_for')}}</h1>
            <div class="box">
                <strong>{{$strings['insurance_plan']}}n - </strong><?php  echo $data['policy_name'] ?><br><br>
                @if($data['offer'])
                <strong>{{$strings['offer_plan']}} - </strong><?php  echo $data['offer'] ?><br><br>
                @else
                <strong>{{$strings['offer_plan']}} - </strong>Not Available<br><br>
                @endif
                @if(!empty($data['car_registration_number']))
                    <strong>{{$strings['car_registration_number']}}- </strong><?php  echo $data['car_registration_number'] ?><br><br>
                @endif
                
                <strong>{{$strings['shipping_details']}}  - </strong><?php  echo $data['name'].' '.$data['surname']?>, <?php  echo $data['email']?>, <?php  echo $data['phone_number']?>, <?php  echo $data['address'].' '.$data['city'].' '.$data['shipping_country'].' '.$data['zipcode']?><br><br>
            </div>  
            <input type='submit' value="{{$strings['proceed_to_card_form']}}" class='buttonClass' />
        </div>
    </div>
              <!-- <table class="tableClass">
                  <tr>
                      <td colspan='2'>
                          <h1>
                              PayFor - 3D Host_Details1
                          </h1>
                      </td>
                  </tr>
               <tr>
                   <td align='center' colspan='2'>
                       <input type='submit' value='Send' class='buttonClass' />
                   </td>
               </tr>
              </table> -->
   
               <input type="hidden" name="MbrId" value="<?php  echo $MbrId ?>">
               <input type="hidden" name="MerchantID" value="<?php  echo $MerchantID ?>">
               <input type="hidden" name="SecureType" value="<?php  echo $SecureType ?>">
               <input type="hidden" name="UserCode" value="<?php  echo $UserCode ?>">
               <input type="hidden" name="UserPass" value="<?php  echo $UserPass ?>">
               <input type="hidden" name="TxnType" value="<?php  echo $TxnType ?>">
               <input type="hidden" name="InstallmentCount" value="<?php  echo $InstallmentCount ?>">
               <input type="hidden" name="Currency" value="<?php  echo $Currency ?>">
               <input type="hidden" name="OkUrl" value="<?php  echo $OkUrl ?>">
               <input type="hidden" name="FailUrl" value="<?php  echo $FailUrl ?>">
               <input type="hidden" name="OrderId" value="<?php  echo $OrderId ?>">
               <input type="hidden" name="OrgOrderId" value="<?php  echo $OrgOrderId ?>">
               <input type="hidden" name="PurchAmount" value="<?php  echo $PurchAmount ?>">
               <input type="hidden" name="Lang" value="<?php  echo $Lang ?>">
               <input type="hidden" name="TemplateType" value="<?php  echo $TemplateType ?>">
               <input type="hidden" name="ShippingNameSurname" value="<?php  echo $ShippingNameSurname ?>">
               <input type="hidden" name="ShippingEmail" value="<?php  echo $ShippingEmail ?>">
               <input type="hidden" name="ShippingPhone" value="<?php  echo $ShippingPhone ?>">
               <input type="hidden" name="ShippingNationalId" value="<?php  echo $ShippingNationalId ?>">
               <input type="hidden" name="ShippingCompanyName" value="<?php  echo $ShippingCompanyName ?>">
               <input type="hidden" name="ShippingTaxOffice" value="<?php  echo $ShippingTaxOffice ?>">
               <input type="hidden" name="ShippingTaxNo" value="<?php  echo $ShippingTaxNo ?>">
               <input type="hidden" name="ShippingAddress" value="<?php  echo $ShippingAddress ?>">
               <input type="hidden" name="ShippingTown" value="<?php  echo $ShippingTown ?>">
               <input type="hidden" name="ShippingCity" value="<?php  echo $ShippingCity ?>">
               <input type="hidden" name="ShippingZipCode" value="<?php  echo $ShippingZipCode ?>">
               <input type="hidden" name="ShippingCountry" value="<?php  echo $ShippingCountry ?>">
               <input type="hidden" name="BillingNameSurname" value="<?php  echo $BillingNameSurname ?>">
               <input type="hidden" name="BillingEmail" value="<?php  echo $BillingEmail ?>">
               <input type="hidden" name="BillingPhone" value="<?php  echo $BillingPhone ?>">
               <input type="hidden" name="BillingNationalId" value="<?php  echo $BillingNationalId ?>">
               <input type="hidden" name="BillingCompanyName" value="<?php  echo $BillingCompanyName ?>">
               <input type="hidden" name="BillingTaxOffice" value="<?php  echo $BillingTaxOffice ?>">
               <input type="hidden" name="BillingTaxNo" value="<?php  echo $BillingTaxNo ?>">
               <input type="hidden" name="BillingAddress" value="<?php  echo $BillingAddress ?>">
               <input type="hidden" name="BillingTown" value="<?php  echo $BillingTown ?>">
               <input type="hidden" name="BillingCity" value="<?php  echo $BillingCity ?>">
               <input type="hidden" name="BillingZipCode" value="<?php  echo $BillingZipCode ?>">
               <input type="hidden" name="BillingCountry" value="<?php  echo $BillingCountry ?>">
               <input type="hidden" name="Rnd" value="<?php echo $rnd?>">
               <input type="hidden" name="Hash" value="<?php echo $hash?>">
            </form>
  
</section>
@endsection
