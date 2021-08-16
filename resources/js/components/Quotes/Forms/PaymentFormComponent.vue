<template>
    <div>
        <form id="card-info">
              <table class="tableClass">
                  <tr>
                      <td colspan='2'>
                          <h1>
                              PayFor - 3D ddd
                          </h1>
                      </td>
                  </tr>
               <tr>
                   <td align='center' colspan='2'>
                       <input type='button' value='Sendiii' class='buttonClass' @click="GenerateForm()"/>
                   </td>
               </tr>
              </table>
   
               <input type="hidden" name="MbrId" v-model="card_genarating_form.MbrId">
               <input type="hidden" name="MerchantID"  v-model="card_genarating_form.MerchantID">
               <input type="hidden" name="UserCode"  v-model="card_genarating_form.UserCode">
               <input type="hidden" name="UserPass"  v-model="card_genarating_form.UserPass">
               <input type="hidden" name="SecureType" v-model="card_genarating_form.SecureType">
               <input type="hidden" name="TxnType"  v-model="card_genarating_form.TxnType">
               <input type="hidden" name="InstallmentCount"  v-model="card_genarating_form.InstallmentCount">
               <input type="hidden" name="Currency"  v-model="card_genarating_form.Currency">
               <input type="hidden" name="OkUrl"  v-model="card_genarating_form.OkUrl">
               <input type="hidden" name="FailUrl"  v-model="card_genarating_form.FailUrl">
               <input type="hidden" name="OrderId"  v-model="card_genarating_form.OrderId">
               <input type="hidden" name="OrgOrderId" v-model="card_genarating_form.OrgOrderId">
               <input type="hidden" name="PurchAmount"  v-model="card_genarating_form.PurchAmount">
               <input type="hidden" name="Lang"  v-model="card_genarating_form.Lang">
               <input type="hidden" name="TemplateType" v-model="card_genarating_form.TemplateType">
               <input type="hidden" name="ShippingNameSurname"  v-model="card_genarating_form.ShippingNameSurname">
               <input type="hidden" name="ShippingEmail"  v-model="card_genarating_form.ShippingEmail">
               <input type="hidden" name="ShippingPhone"  v-model="card_genarating_form.ShippingPhone">
               <input type="hidden" name="ShippingNationalId"  v-model="card_genarating_form.ShippingNationalId">
               <input type="hidden" name="ShippingCompanyName"  v-model="card_genarating_form.ShippingCompanyName">
               <input type="hidden" name="ShippingTaxOffice"  v-model="card_genarating_form.ShippingTaxOffice">
               <input type="hidden" name="ShippingTaxNo" v-model="card_genarating_form.ShippingTaxNo">
               <input type="hidden" name="ShippingAddress" v-model="card_genarating_form.ShippingAddress">
               <input type="hidden" name="ShippingTown"  v-model="card_genarating_form.ShippingTown">
               <input type="hidden" name="ShippingCity"  v-model="card_genarating_form.ShippingCity">
               <input type="hidden" name="ShippingZipCode"  v-model="card_genarating_form.ShippingZipCode">
               <input type="hidden" name="ShippingCountry" v-model="card_genarating_form.ShippingCountry">
               <input type="hidden" name="BillingNameSurname" v-model="card_genarating_form.BillingNameSurname">
               <input type="hidden" name="BillingEmail" v-model="card_genarating_form.BillingEmail">
               <input type="hidden" name="BillingPhone" v-model="card_genarating_form.BillingPhone">
               <input type="hidden" name="BillingNationalId" v-model="card_genarating_form.BillingNationalId">
               <input type="hidden" name="BillingCompanyName" v-model="card_genarating_form.BillingCompanyName">
               <input type="hidden" name="BillingTaxOffice" v-model="card_genarating_form.BillingTaxOffice">
               <input type="hidden" name="BillingTaxNo" v-model="card_genarating_form.BillingTaxNo">
               <input type="hidden" name="BillingAddress" v-model="card_genarating_form.BillingAddress">
               <input type="hidden" name="BillingTown" v-model="card_genarating_form.BillingTown">
               <input type="hidden" name="BillingCity" v-model="card_genarating_form.BillingCity">
               <input type="hidden" name="BillingZipCode" v-model="card_genarating_form.BillingZipCode">
               <input type="hidden" name="BillingCountry" v-model="card_genarating_form.BillingCountry">
               <input type="hidden" name="Rnd" v-model="card_genarating_form.Rnd">
               <input type="hidden" name="Hash" v-model="card_genarating_form.Hash">
 
    </form>
    </div>
</template>
<script>
    export default {
        props:['Auth','rnd','hash','base_url'],
        data() {
            return {
                card_genarating_form:{
                    MbrId:"9",                                                                         //Member Id
                    MerchantID:"000000009251392",                                                               //Language_MerchantID
                    MerchantPass:"Aa123456",                                                           //Language_MerchantPass
                    UserCode:"FidentiaApiTest",                                                                   //User Code
                    UserPass:"p1mgm1",                                                                   //User Password
                    SecureType:"3DHost",                                                                     //Language_SecureType
                    TxnType:"Auth",                                                                          //Transaction Type
                    InstallmentCount:"0",                                                                    //Installment Count
                    Currency:"8",                                                                   //Currency
                    OkUrl:"https://www.w3schools.com/",                                                                         //Language_OkUrl
                    FailUrl:"https://getbootstrap.com/docs/3.3/",                                                                     //Language_FailUrl
                    OrderId:"",                                                                     //Order Number
                    OrgOrderId:"",                                                               //Orginal Transaction Order Number
                    PurchAmount:"1",                                                                         //Amount
                    Lang:"EN",                                                                           //Language_Lang
                    TemplateType:"1",                                                                        //Language_TemplateType
                    ShippingNameSurname:"Kerem ERCAN",                                                       //Language_ShippingNameSurname
                    ShippingEmail:"kerem.ercan@cardtek.com",                                                 //Language_ShippingEmail
                    ShippingPhone:"00901112223344",                                                          //Language_ShippingPhone
                    ShippingNationalId:"12345678909",                                                        //Language_ShippingNationalId
                    ShippingCompanyName:"Cardtek Payment Solutions",                                         //Language_ShippingCompanyName
                    ShippingTaxOffice:"Istanbul",                                                            //Language_ShippingTaxOffice
                    ShippingTaxNo:"1234567890",                                                              //Language_ShippingTaxNo
                    ShippingAddress:"ITU KoruYolu Ayazaga Maslak",                                           //Language_ShippingAddress
                    ShippingTown:"Sariyer",                                                                  //Language_ShippingTown
                    ShippingCity:"Istanbul",                                                                 //Language_ShippingCity
                    ShippingZipCode:"34333",                                                                 //Language_ShippingZipCode
                    ShippingCountry:"Turkey",                                                                //Language_ShippingCountry
                    BillingNameSurname:"Kerem ERCAN",                                                        //Language_BillingNameSurname
                    BillingEmail:"kerem.ercan@cardtek.com",                                                  //Language_BillingEmail
                    BillingPhone:"00901112223344",                                                           //Language_BillingPhone
                    BillingNationalId:"12345678909",                                                         //Language_BillingNationalId
                    BillingCompanyName:"Cardtek Payment Solutions",                                          //Language_BillingCompanyName
                    BillingTaxOffice:"Istanbul",                                                             //Language_BillingTaxOffice
                    BillingTaxNo:"1234567890",                                                               //Language_BillingTaxNo
                    BillingAddress:"ITU KoruYolu Ayazaga Maslak",                                            //Language_BillingAddress
                    BillingTown:"Sariyer",                                                                   //Language_BillingTown
                    BillingCity:"Istanbul",                                                                  //Language_BillingCity
                    BillingZipCode:"34333",                                                                  //Language_BillingZipCode
                    BillingCountry:"Turkey",  
                    Rnd:null,
                    Hash:null,
                }
            }
        },
        methods:{
            GenerateForm(){ 
                
                 var formData = new FormData($('#card-info')[0]);
                for(var pair of formData.entries()) {
                    console.log(pair[0]+ ', '+ pair[1]);
                }
                
                axios.post(this.base_url+'/api/card',
                        formData, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                            }
                        }
                    )
                    .then(res => {
                        console.log(res)
                        
                    }
                ).catch((error) => {
                    console.log(error);
                   
                })
            }
        },
        mounted() {
            console.log("Payment form Mounted");
            
        },
        
    }
</script>