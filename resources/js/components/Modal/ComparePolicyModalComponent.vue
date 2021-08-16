<template>
  <div class="modal-content compare">
    <div class="modal-header">
      <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <span aria-hidden="true">×</span>
      </button>
      <h4 id="myModalLabel" class="modal-title">Compare {{locale.policy_details}}</h4>
    </div>
    <div class="row" >
        <div class="col-md-6" v-for="policy,index in policies" :key="policy.id">
            <div class="modal-body">
                <span class="modal-logo"><img :src="policy.logo"></span>
                <h4>{{policy.company_name}}</h4>
                <h4>{{policy.policy_name}}</h4> 
                <p class="offers">{{locale.choose_offer_below}}</p>
                <div class="form-group">
                    <div class="offer-groups" v-if="policy.offer.length>0">
                        <p> There are {{policy.offer.length}} offers avilable</p>
                        <template v-if="index==0">
                        <div class="custom-control custom-radio" v-for="offer in offers1" :key="offer.id">
                            <input class="custom-control-input" type="radio" :id="offer.offers_id" name="offer1" :value="offer.offers_id" @click="setOfferForPolicyData1(offer,policy)">
                            <label :for="offer.offers_id" class="custom-control-label strong">{{offer.offer_name}}</label>
                        </div>
                        </template>
                        <template v-if="index==1">
                        <div class="custom-control custom-radio" v-for="offer in offers2" :key="offer.id">
                            <input class="custom-control-input" type="radio" :id="offer.offers_id" name="offer2" :value="offer.offers_id" @click="setOfferForPolicyData2(offer,policy)">
                            <label :for="offer.offers_id" class="custom-control-label strong">{{offer.offer_name}}</label>
                        </div>
                        </template>
                    </div>
                    <p v-if="policy.offer.length<=0"> No offers Available</p>
                </div>
                <!---->
                <h4 class="coverage">{{locale.coverage}}</h4>
                <p v-if="policy.coverage!=null && policy.coverage!=''">{{policy.coverage}}</p>
                <p v-if="policy.coverage==null || policy.coverage==''">Coverage is not available</p>
                <div class="custom-control custom-checkbox" v-if="show_covered_outsied_checkbox==true && index==0">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1" @click="CoveredOutsideCountry1(policy)">
                    <label for="customCheckbox1" class="custom-control-label">Covered outside country</label>
                </div>

                <div class="custom-control custom-checkbox" v-if="show_covered_outsied_checkbox==true  && index==1">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2" @click="CoveredOutsideCountry2(policy)">
                    <label for="customCheckbox2" class="custom-control-label">Covered outside country</label>
                </div>
                <div class="buy-wrap">
                    <p class="special">{{locale.by_buying_this_policy}} <span> {{locale.general_condition}}</span></p>
                    
                    <div v-if="policy=='TPL'">

                        <h4 v-if="index==0 && show_policy_1_price==true">{{locale.price}}: <span>{{offered_price1}}Lek</span></h4>
                        <h4 v-if="show_policy_2_price==false && index==1">{{locale.price}}: <span>{{policy.price}}Lek</span></h4>
                        <h4 v-if="show_policy_1_price==false && index==0">{{locale.price}}: <span>{{policy.price}}Lek</span></h4>
                        <h4 v-if="show_policy_2_price==true && index==1">{{locale.price}}: <span>{{offered_price2}}Lek</span></h4>
                    </div>
                    <div v-if="policy!='TPL'">
                        <h4 v-if="index==0 && show_policy_1_price==true && covered_outside_country_price1!=null">{{locale.price}}: <span>{{covered_outside_country_price1}}Euro</span></h4>
                        <h4 v-if="index==0 && show_policy_1_price==true && covered_outside_country_price1==null">{{locale.price}}: <span>{{offered_price1}}Euro</span></h4>
                        <h4 v-if="show_policy_2_price==false && index==1 && covered_outside_country_price2==null">{{locale.price}}: <span>{{policy.price}}Euro</span></h4>
                        <h4 v-if="show_policy_1_price==false && index==0 && covered_outside_country_price1==null">{{locale.price}}: <span>{{policy.price}}Euro</span></h4>
                        <h4 v-if="show_policy_2_price==true && index==1 && covered_outside_country_price2==null">{{locale.price}}: <span>{{offered_price2}}Euro</span></h4>
                        <h4 v-if="show_policy_2_price==true && index==1 && covered_outside_country_price2!=null">{{locale.price}}: <span>{{covered_outside_country_price2}}Euro</span></h4>
                    </div>
                    <a href="#" class="buy" v-if="index==0" @click="SendPolicyData1()">{{locale.buy_now}}</a>
                    <a href="#" class="buy" v-if="index==1" @click="SendPolicyData2()">{{locale.buy_now}}</a>
                    
                    <!---->
                    <!---->
                    <!---->
                </div>
                <!---->
            </div>
        </div>
        <!--another policy-->
    </div>
  </div>
</template>
<script>
    export default {
        props: [
            'policies',
            'baseUrl',
            'locale',
            'policy',
        ],
        data() {
            return {
                offers1: [],
                offers2: [],
                policy_data:{
                    commision_percentage: null,
                    company_name: null,
                    coverage: null,
                    insurer_id: null,
                    insurer_policy_id: null,
                    price_of_percentage: null,
                    price: null,
                    logo: null,
                    selected_offer: null,
                    selected_offer_id: null,
                    selected_offer_percentage: null,
                    selected_offer_extra_amount: null,
                    selected_offer_amount_of: null,
                    offered_price: null,
                    policy_details_id: null,
                    policy_name: null,
                    percentage: null,
                    terms_and_condition: null,
                    covered_outside_country_price: null,
                },
                offer_error: false,
                offer1 : null,
                policy1: null,
                offer2 : null,
                policy2: null,
                price1: null,
                percent_calulate1:null,
                selected_offer1: null,
                selected_offer_id1: null,
                selected_offer_percentage1: null,
                selected_offer_extra_amount1: null,
                selected_offer_amount_of1: null,
                offered_price1: null,
                price2: null,
                percent_calulate2:null,
                selected_offer2: null,
                selected_offer_id2: null,
                selected_offer_percentage2: null,
                selected_offer_extra_amount2: null,
                selected_offer_amount_of2: null,
                offered_price2: null,
                show_policy_1_price: false,
                show_policy_2_price: false,
                show_covered_outsied_checkbox: false,
                covered_outside_country1: false,
                covered_outside_country2: false,
                covered_outside_country_price1: null,
                covered_outside_country_price2: null
            }
        },
        methods: {
            setpolicy(){
                this.offers1=this.policies[0].offer;
                this.offers2=this.policies[1].offer;
            },

            setOfferForPolicyData1(offer,policy){
                this.offer1 = offer;
                this.policy1 = policy;
                this.price1=null;
                this.offered_price1=null;
                this.percent_calulate1=null;
                this.covered_outside_country_price1=null;
                console.log(this.offer1);
                console.log(this.policy1);
                if(offer!=null){
                    this.selected_offer_id1= offer.offers_id;
                    this.selected_offer1= offer.offer_name;
                    this.selected_offer_amount_of1= offer.amount_of;
                    this.selected_offer_extra_amount1= offer.extra_amount;
                    this.selected_offer_percentage1= offer.percentage_of;
                    let converted_price = null;
                    this.price1 = policy.price;
                    if(this.policy=='TPL' || 'travel_out_side_country'){
                    this.price1=this.price1.replace(/,/g, "");

                    this.price1=parseFloat(this.price1);

                    converted_price = this.price1;
                    }else{
                        converted_price = (+policy.price);
                    }
                    if (offer.extra_amount != null && offer.extra_amount != '0' && offer.amount_of != null && offer
                        .amount_of != '0' && offer.percentage_of != null && offer.percentage_of != '0') {
                        this.price1 = converted_price + (+offer.extra_amount);
                        this.price1 = this.price1 - (+offer.amount_of);
                        this.percent_calulate11 = 1 - (+offer.percentage_of / 100);
                        this.price1 = this.percent_calulate11 * (this.price1);
                        this.price1 = Math.round((this.price1 * 10000) / 10000).toFixed(2);
                        this.offered_price1 = this.price1;


                    } else if (offer.extra_amount != null && offer.extra_amount != '0' && offer.amount_of != null &&
                        offer.amount_of != '0' && (offer.percentage_of == null || offer.percentage_of == '0')) {
                        this.price1 = converted_price + (+offer.extra_amount);
                        this.price1 = this.price1 - (+offer.amount_of);

                        this.price1 = Math.round((this.price1 * 10000) / 10000).toFixed(2);
                        this.offered_price1 = this.price1;



                    } else if (offer.extra_amount != null && offer.extra_amount != '0' && (offer.amount_of ==
                            null || offer.amount_of == '0') && offer.percentage_of != null && offer.percentage_of !=
                        '0') {
                        this.price1 = converted_price + (+offer.extra_amount);
                        this.percent_calulate1 = 1 - (+offer.percentage_of / 100);
                        this.price1 = this.percent_calulate1 * (this.price1);
                        this.price1 = Math.round((this.price1 * 10000) / 10000).toFixed(2);
                        this.offered_price1 = this.price1;

                    } else if ((offer.extra_amount == null || offer.extra_amount == '0') && offer.amount_of !=
                        null && offer.amount_of != '0' && offer.percentage_of != null && offer.percentage_of != '0'
                        ) {
                        this.price1 = converted_price - (+offer.amount_of);
                        this.percent_calulate1 = 1 - (+offer.percentage_of / 100);
                        this.price1 = this.percent_calulate1 * (this.price1);
                        this.price1 = Math.round((this.price1 * 10000) / 10000).toFixed(2);
                        this.offered_price1 = this.price1;

                    } else if ((offer.extra_amount == null || offer.extra_amount == '0') && (offer.amount_of ==
                            null || offer.amount_of == '0') && offer.percentage_of != null && offer.percentage_of !=
                        '0') {
                        this.percent_calulate1 = 1 - (+offer.percentage_of / 100);
                        this.price1 = this.percent_calulate1 * (+this.price1);
                        this.price1 = Math.round((this.price1 * 10000) / 10000).toFixed(2);
                        this.offered_price1 = this.price1;

                    } else if ((offer.extra_amount == null || offer.extra_amount == '0') && (offer.amount_of !=
                            null && offer.amount_of != '0') && (offer.percentage_of == null || offer
                            .percentage_of == '0')) {
                        this.price1 = (+this.price1) - (+offer.amount_of);
                        this.offered_price1 = this.price1;


                    } else if ((offer.extra_amount != null && offer.extra_amount != '0') && (offer.amount_of ==
                            null || offer.amount_of == '0') && (offer.percentage_of == null || offer
                            .percentage_of == '0')) {
                        this.price1 = converted_price + (+offer.extra_amount);

                        this.offered_price1 = this.price1;




                    } else {
                        this.price1 = converted_price;
                        this.offered_price1 = this.price1;

                    }
                }

                if(this.policy=='full_casco'){
                    console.log(this.covered_outside_country1)
                    if(this.covered_outside_country1==true){

                        if(this.price1==null){
                            let percent = null;
                            percent = (+policy.price*(+policy.coverage_percentage/100));
                            this.covered_outside_country_price1=(+policy.price)+percent;
                            this.price1 = this.covered_outside_country_price1;
                            this.offered_price1= this.price1;
                        }else if(this.price1!=null){
                            this.covered_outside_country_price1=(+this.price1)+(+this.price1*(+policy.coverage_percentage/100));
                            
                            this.price1 = this.covered_outside_country_price1;
                            
                            this.offered_price= this.price1;

                        }
                    }
                    else if(this.covered_outside_country1==false){
                        if(this.offered_price1!=null && this.offered_price1!='0'){
                    console.log('offer price',this.offered_price1);

                            this.covered_outside_country_price1 = this.offered_price1;
                    console.log('covered price',this.covered_outside_country_price1);


                        }else{
                    console.log('price',policy.price);

                            this.covered_outside_country_price1 = policy.price;
                    console.log('covered price',this.covered_outside_country_price1);


                        }
                        

                    }
                    console.log('covered price',this.covered_outside_country_price1);

                }


                this.show_policy_1_price = true;
                

            },
            setOfferForPolicyData2(offer,policy){
                this.offer2 = offer;
                this.policy2 = policy;
                this.price2=null;
                this.offered_price2=null;
                this.percent_calulate2=null;
                this.covered_outside_country_price2=null;
                if(offer!=null){
                    this.selected_offer_id2= offer.offers_id;
                    this.selected_offer2= offer.offer_name;
                    this.selected_offer_amount_of2= offer.amount_of;
                    this.selected_offer_extra_amount2= offer.extra_amount;
                    this.selected_offer_percentage2= offer.percentage_of;
                    let converted_price = null;
                    this.price2 = policy.price;
                    if(this.policy=='TPL' || 'travel_out_side_country'){
                    this.price2=this.price2.replace(/,/g, "");

                    this.price2=parseFloat(this.price2);

                    converted_price = this.price2;
                    }else{
                        converted_price = (+policy.price);
                    }
                    if (offer.extra_amount != null && offer.extra_amount != '0' && offer.amount_of != null && offer
                        .amount_of != '0' && offer.percentage_of != null && offer.percentage_of != '0') {
                        this.price2 = converted_price + (+offer.extra_amount);
                        this.price2 = this.price2 - (+offer.amount_of);
                        this.percent_calulate2 = 1 - (+offer.percentage_of / 100);
                        this.price2 = this.percent_calulate2 * (this.price2);
                        this.price2 = Math.round((this.price2 * 10000) / 10000).toFixed(2);
                        this.offered_price2 = this.price2;


                    } else if (offer.extra_amount != null && offer.extra_amount != '0' && offer.amount_of != null &&
                        offer.amount_of != '0' && (offer.percentage_of == null || offer.percentage_of == '0')) {
                        this.price2 = converted_price + (+offer.extra_amount);
                        this.price2 = this.price2 - (+offer.amount_of);

                        this.price2 = Math.round((this.price2 * 10000) / 10000).toFixed(2);
                        this.offered_price2 = this.price2;



                    } else if (offer.extra_amount != null && offer.extra_amount != '0' && (offer.amount_of ==
                            null || offer.amount_of == '0') && offer.percentage_of != null && offer.percentage_of !=
                        '0') {
                        this.price2 = converted_price + (+offer.extra_amount);
                        this.percent_calulate2 = 1 - (+offer.percentage_of / 100);
                        this.price2 = this.percent_calulate2 * (this.price2);
                        this.price2 = Math.round((this.price2 * 10000) / 10000).toFixed(2);
                        this.offered_price2 = this.price2;

                    } else if ((offer.extra_amount == null || offer.extra_amount == '0') && offer.amount_of !=
                        null && offer.amount_of != '0' && offer.percentage_of != null && offer.percentage_of != '0'
                        ) {
                        this.price2 = converted_price - (+offer.amount_of);
                        this.percent_calulate2 = 1 - (+offer.percentage_of / 100);
                        this.price2 = this.percent_calulate2 * (this.price2);
                        this.price2 = Math.round((this.price2 * 10000) / 10000).toFixed(2);
                        this.offered_price2 = this.price2;

                    } else if ((offer.extra_amount == null || offer.extra_amount == '0') && (offer.amount_of ==
                            null || offer.amount_of == '0') && offer.percentage_of != null && offer.percentage_of !=
                        '0') {
                        this.percent_calulate2 = 1 - (+offer.percentage_of / 100);
                        this.price2 = this.percent_calulate2 * (+this.price2);
                        this.price2 = Math.round((this.price2 * 10000) / 10000).toFixed(2);
                        this.offered_price2 = this.price2;

                    } else if ((offer.extra_amount == null || offer.extra_amount == '0') && (offer.amount_of !=
                            null && offer.amount_of != '0') && (offer.percentage_of == null || offer
                            .percentage_of == '0')) {
                        this.price2 = (+this.price2) - (+offer.amount_of);
                        this.offered_price2 = this.price2;


                    } else if ((offer.extra_amount != null && offer.extra_amount != '0') && (offer.amount_of ==
                            null || offer.amount_of == '0') && (offer.percentage_of == null || offer
                            .percentage_of == '0')) {
                        this.price2 = converted_price + (+offer.extra_amount);

                        this.offered_price2 = this.price2;




                    } else {
                        this.price2 = converted_price;
                        this.offered_price2 = this.price2;

                    }
                }
                if(this.policy=='full_casco'){
                    if(this.covered_outside_country2==true){

                        if(this.price2==null){
                            let percent = null;
                            percent = (+policy.price*(+policy.coverage_percentage/100));
                            this.covered_outside_country_price2=(+policy.price)+percent;
                            this.price2 = this.covered_outside_country_price2;
                            this.offered_price2= this.price2;
                        }else if(this.price2!=null){
                            this.covered_outside_country_price2=(+this.price2)+(+this.price2*(+policy.coverage_percentage/100));
                            
                            this.price2 = this.covered_outside_country_price2;
                            
                            this.offered_price= this.price2;

                        }
                    }
                    else if(this.covered_outside_country2==false){
                        if(this.offered_price2!=null && this.offered_price2!='0'){
                            this.covered_outside_country_price2 = this.offered_price2;

                        }else{
                            this.covered_outside_country_price2 = policy.price;

                        }
                        

                    }
                    console.log('covered price',this.covered_outside_country_price2);
                }
                this.show_policy_2_price = true;
                

            },

            SendPolicyData1(){
               
                this.policy_data.commision_percentage = this.policies[0].commision_percentage;
                this.policy_data.company_name = this.policies[0].company_name;
                this.policy_data.coverage = this.policies[0].coverage;
                this.policy_data.insurer_id = this.policies[0].insurer_id;
                this.policy_data.insurer_policy_id = this.policies[0].insurer_policy_id;
                this.policy_data.price_of_percentage = this.policies[0].price;
                this.policy_data.price = this.policies[0].price;
                this.policy_data.logo = this.policies[0].logo;
                this.policy_data.selected_offer = this.selected_offer1;
                this.policy_data.selected_offer_id = this.selected_offer_id1;
                this.policy_data.selected_offer_percentage = this.selected_offer_percentage1;
                this.policy_data.selected_offer_extra_amount = this.selected_offer_extra_amount1;
                this.policy_data.selected_offer_amount_of = this.selected_offer_amount_of1;
                this.policy_data.offered_price = this.offered_price1;
                this.policy_data.policy_details_id = this.policies[0].policy_details_id;
                this.policy_data.policy_name = this.policies[0].policy_name;
                this.policy_data.percentage = this.policies[0].percentage;
                this.policy_data.terms_and_condition = this.policies[0].terms_and_condition;
                this.policy_data.covered_outside_country_price = this.covered_outside_country_price1;

                 if(this.offers1.length>0){
                    if(this.selected_offer_id1==null){
                        this.$toastr.warning('Please Select offer!');
                        return;

                    }
                }

                if(this.policy=='TPL'){
                    localStorage.setItem('tpl_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/selectcar-form1';
                }
                if(this.policy=='green_card'){
                   localStorage.setItem('policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/buy-now';
                }
                if(this.policy=='full_casco'){
                   localStorage.setItem('casco_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/casco-form';
                }
                if(this.policy=='Home'){
                   localStorage.setItem('home_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/home-form';
                }

                if(this.policy=='travel_out_side_country'){
                   localStorage.setItem('travel_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/travel-outside-form';
                }

            },

            SendPolicyData2(){
                this.policy_data.commision_percentage = this.policies[1].commision_percentage;
                this.policy_data.company_name = this.policies[1].company_name;
                this.policy_data.coverage = this.policies[1].coverage;
                this.policy_data.insurer_id = this.policies[1].insurer_id;
                this.policy_data.insurer_policy_id = this.policies[1].insurer_policy_id;
                this.policy_data.price_of_percentage = this.policies[1].price;
                this.policy_data.price = this.policies[1].price;
                this.policy_data.logo = this.policies[1].logo;
                this.policy_data.selected_offer = this.selected_offer2;
                this.policy_data.selected_offer_id = this.selected_offer_id2;
                this.policy_data.selected_offer_percentage = this.selected_offer_percentage2;
                this.policy_data.selected_offer_extra_amount = this.selected_offer_extra_amount2;
                this.policy_data.selected_offer_amount_of = this.selected_offer_amount_of2;
                this.policy_data.offered_price = this.offered_price2;
                this.policy_data.policy_details_id = this.policies[1].policy_details_id;
                this.policy_data.policy_name = this.policies[1].policy_name;
                this.policy_data.percentage = this.policies[1].percentage;
                this.policy_data.terms_and_condition = this.policies[1].terms_and_condition;
                this.policy_data.covered_outside_country_price = this.covered_outside_country_price2;

                 if(this.offers2.length>0){
                    if(this.selected_offer_id2==null){
                        this.$toastr.warning('Please Select offer!');
                        return;

                    }
                }

                if(this.policy=='TPL'){
                    localStorage.setItem('tpl_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/selectcar-form1';
                }
                if(this.policy=='green_card'){
                   localStorage.setItem('policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/buy-now';
                }
                if(this.policy=='full_casco'){
                   localStorage.setItem('casco_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/casco-form';
                }
                if(this.policy=='Home'){
                   localStorage.setItem('home_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/home-form';
                }

                if(this.policy=='travel_out_side_country'){
                   localStorage.setItem('travel_policy', JSON.stringify(this.policy_data));
                    window.location.href = this.baseUrl+'/travel-outside-form';
                }

            },

            CoveredOutsideCountry1(policy){
                this.covered_outside_country1=!this.covered_outside_country1;
                this.policy1= policy;
                console.log(this.policy1)
                this.setOfferForPolicyData1(this.offer1,this.policy1);
                
            },

            CoveredOutsideCountry2(policy){
                this.covered_outside_country2=!this.covered_outside_country2;
                this.policy2= policy;
                console.log(this.policy2)
                this.setOfferForPolicyData2(this.offer2,this.policy2);
                
            },



        },
        mounted() {
            console.log('Compare model mounted');
            if(this.policy=='full_casco'){
                this.show_covered_outsied_checkbox = true;
            }
            this.setpolicy();
            
        },
    }

</script>>
