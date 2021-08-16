@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

<?php
        if ($_POST){
        $data = "";
        $MbrId="9";                                                                         //Member Id
        $MerchantID="000000009251392";                                                               //Language_MerchantID
        $UserCode="FidentiaApiTest";                                                                   //User Code
        $UserPass="Noto5";                                                                   //User Password
        $OrgOrderId=$_POST["OrgOrderId"];                                                   //Orginal Transaction Order Number
        $SecureType= "Inquiry";                                                                    //Language_SecureType
        $TxnType="OrderInquiry";                                                                  //Transaction Type
        $Lang="EN";                                                                           //Language_Lang
        $url = "https://payfortestbkt.cordisnetwork.com/Mpi/Default.aspx";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSLVERSION, 4);	
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch); 
        echo "<br>";
        if (curl_errno($ch)) {
        print curl_error($ch);
        } else {
        curl_close($ch);
        }
        $resultValues = explode(";;", $result);
        echo "<center><table class='tableClass'>";
        foreach($resultValues as $resultt)
        {
        list($key,$value)= explode("=", $resultt);
            echo "<tr><td style='text-align: right'>".$key."</td>";
        echo "<td style='text-align: left'>".$value."</td></tr>";
        }
        echo "</table></center><br>";
    }
?>
    <section>
        <form method="post">
        <table class="tableClass">
            <tr>
                <td colspan="2">
                    <h1>
                        PayFor - Order Inquiry
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    Orginal Transaction Order Number :
                </td>
                <td style="text-align: left">
                    <input type="text" name="OrgOrderId" maxlength="50"    class="inputClass" value="" />
            </tr>

            <tr>
                <td align="center" colspan="2">
                    <input type="submit" value="Send" class="buttonClass" />
                </td>
            </tr>
        </table>
        </form>
    </section>
@endsection

