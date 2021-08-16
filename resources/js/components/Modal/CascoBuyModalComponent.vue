<template>
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">{{locale.policy_details}} Casco</h4>

            </div>
            <div class="modal-body">
                <span><img :src="policy.logo"></span>
                <h4>{{policy.company_name}}</h4>
                <h4>{{policy.policy_name}}</h4>
                <p class="offers">{{locale.choose_offer_below}}</p>
                <div class="form-group" v-if="offers.length!=0">
                    <div class="custom-control custom-radio" v-for="offer in offers" :key='offer._id'>
                        <input class="custom-control-input" type="radio" :id="offer.offers_id" :name="offer" :value="offer.offers_id" @click="setOffer(offer)">
                        <label :for="offer.offers_id" class="custom-control-label">{{offer.offer_name}}</label>
                    </div>  
                </div>
                <p v-if="offers.length==0">{{locale.no_offer_available}}</p>
                <h4 class="coverage">{{locale.coverage}}</h4>
                <div class="scrollable-content">
                    <ul v-for="list in coverage_data" :key='list._id'>
                        <li> {{list}}</li>
                    </ul>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option2" @click="CoveredOutsideCountry()">
                    <label for="customCheckbox1" class="custom-control-label">Covered outside country</label>
                </div>
                <div class="buy-wrap">
                    <p class="special">{{locale.by_buying_this_policy}} <span>
                            <a href="javascript:void(0)" @click="GetTermPolicy()"> {{locale.general_condition}}</a>
                        </span></p>
                    <h4 v-if="price==null">{{locale.price}}: <span>{{policy.price}} Euro</span></h4>
                    <h4 v-if="price!=null && policy_data.covered_outside_country_price==null">Price: <span>{{price}} Euro</span></h4>
                    <h4 v-if="price!=null && policy_data.covered_outside_country_price!=null">Price: <span>{{policy_data.covered_outside_country_price}} Euro</span></h4>
                    <a  href="#" class="buy" v-if="offers!=null && offers.length!=0 && policy_data.selected_offer==null" @click="BuyNowCheckOffer()">{{locale.buy_now}}</a>
                    <a :href="this.baseUrl+'/casco-form'" class="buy" v-if="offers!=null && offers.length!=0 && policy_data.selected_offer!=null">{{locale.buy_now}}</a>
                    <a :href="this.baseUrl+'/casco-form'" class="buy" v-if="policy.offer==null || policy.offer.length==0">{{locale.buy_now}}</a>
                </div>
                <!--<div class="form_error" v-if="offer_error==true">
                    <p> Please Select offer</p>
                </div>-->
            </div>

        </div>
</template>
<script>
    export default {
        props: [
            'policy',
            'baseUrl',
            'locale',
            'token',
        ],
        data() {
            return {
                    offers:[],
                    policy_data:{
                    commision_percentage: null,
                    actual_price: null,
                    company_name: null,
                    coverage: null,
                    coverage_percentage: null,
                    insurer_id: null,
                    insurer_policy_id: null,
                    logo: null,
                    selected_offer: null,
                    selected_offer_id: null,
                    selected_offer_percentage: null,
                    selected_offer_extra_amount: null,
                    selected_offer_amount_off: null,
                    offered_price: null,
                    policy_details_id: null,
                    policy_name: null,
                    price: null,
                    price_of_percentage: null,
                    terms_and_condition: null,
                    covered_outside_country_price: null,
                },
                offer_error: false,
                offer: null,
                price: null,
                percent_calulate: null,
                coverage_data: null,
                covered_outside_country: false,
            }

        },

        methods: {
            setPolicyDetails(){
                console.log(this.policy.offer);
                if(this.policy.coverage!=null){
                    this.coverage_data=this.policy.coverage.split(",");
                }
                if(this.policy.offer.length==0){

                    this.policy_data.commision_percentage = this.policy.commision_percentage;
                    this.policy_data.actual_price = this.policy.actual_price;
                    this.policy_data.price_of_percentage = this.policy.price_of_percentage;
                    this.policy_data.company_name = this.policy.company_name;
                    this.policy_data.coverage = this.policy.coverage;
                    this.policy_data.coverage_percentage = this.policy.coverage_percentage;
                    this.policy_data.insurer_id = this.policy.insurer_id;
                    this.policy_data.insurer_policy_id = this.policy.insurer_policy_id;
                    this.policy_data.logo = this.policy.logo;
                    this.policy_data.policy_details_id = this.policy.policy_details_id;
                    this.policy_data.policy_name = this.policy.policy_name;
                    this.policy_data.price = this.policy.price;
                    this.policy_data.terms_and_condition = this.policy.terms_and_condition;
                    localStorage.setItem('casco_policy', JSON.stringify(this.policy_data));
                    console.log('data',this.policy_data);

               

                }else{
                    this.offers = this.policy.offer;

                }
            },
            setOffer(offer){
                console.log(offer);
                this.offer=offer;
                if(offer.offers_id==this.policy_data.selected_offer_id){
                    return;
                }
                this.offer_error=false;
                this.policy_data.selected_offer=offer.offer_name;
                this.policy_data.selected_offer_id=offer.offers_id;
                this.policy_data.selected_offer_percentage=offer.percentage_of;
                this.policy_data.selected_offer_extra_amount=offer.extra_amount;
                this.policy_data.selected_offer_amount_off=offer.amount_of;
                this.policy_data.actual_price = this.policy.actual_price;
                this.policy_data.price_of_percentage = this.policy.price_of_percentage;
                this.policy_data.commision_percentage = this.policy.commision_percentage;
                this.policy_data.company_name = this.policy.company_name;
                this.policy_data.coverage = this.policy.coverage;
                this.policy_data.insurer_id = this.policy.insurer_id;
                this.policy_data.insurer_policy_id = this.policy.insurer_policy_id;
                this.policy_data.logo = this.policy.logo;
                this.policy_data.policy_details_id = this.policy.policy_details_id;
                this.policy_data.policy_name = this.policy.policy_name;
                this.policy_data.terms_and_condition = this.policy.terms_and_condition;
                
                this.CalculateTotalPrice(offer);
            },

            BuyNowCheckOffer(){
                console.log(this.policy_data.selected_offer);
                if(this.policy_data.selected_offer==null){

                    this.offer_error=true;
                

                }
                if(this.offer_error==true){
                    this.$toastr.warning('Please Select offer!');

                }
            },

            CoveredOutsideCountry(){
                this.covered_outside_country=!this.covered_outside_country;
                this.CalculateTotalPrice(this.offer);
                
            },
            CalculateTotalPrice(offer){
                this.price=null;
                this.policy_data.offered_price=null;
                this.percent_calulate=null;
                this.policy_data.covered_outside_country_price=null;
                if(this.policy_data.covered_outside_country_price==null){
                    this.price = this.policy.price_of_percentage;

                }
                if(offer!=null){
                
                    if(offer.extra_amount!=null && offer.extra_amount!='0' && offer.amount_of!=null && offer.amount_of!='0' && offer.percentage_of!=null && offer.percentage_of!='0'){
                        this.price = (+this.policy.price_of_percentage) + (+offer.extra_amount);
                        this.price = this.price - (+offer.amount_of);
                        this.percent_calulate = 1-(+offer.percentage_of/100);
                        this.price = this.percent_calulate * (this.price);
                        
                        this.policy_data.offered_price = this.price;

                        console.log('all',this.price);

                    }
                    else if(offer.extra_amount!=null && offer.extra_amount!='0' && offer.amount_of!=null && offer.amount_of!='0' && (offer.percentage_of==null || offer.percentage_of=='0')){
                        this.price = (+this.policy.price_of_percentage) + (+offer.extra_amount);
                        this.price = this.price - (+offer.amount_of);
                    
                        
                        this.policy_data.offered_price = this.price;


                        console.log('extra amount and amount off',this.price);

                    }else if(offer.extra_amount!=null && offer.extra_amount!='0' && (offer.amount_of==null || offer.amount_of=='0') && offer.percentage_of!=null && offer.percentage_of!='0'){
                        this.price = (+this.policy.price_of_percentage) + (+offer.extra_amount);
                        this.percent_calulate = 1-(+offer.percentage_of/100);
                        this.price = this.percent_calulate * (this.price);
                        
                        this.policy_data.offered_price = this.price;
                        
                        console.log('extra amount and percentage off',this.price);
                    }
                    else if((offer.extra_amount==null || offer.extra_amount=='0') && offer.amount_of!=null && offer.amount_of!='0' && offer.percentage_of!=null && offer.percentage_of!='0'){
                        this.price = (+this.policy.price_of_percentage) - (+offer.amount_of);
                        this.percent_calulate = 1-(+offer.percentage_of/100);
                        this.price = this.percent_calulate * (this.price);
                        
                        this.policy_data.offered_price = this.price;

                        console.log('amount off and percentage off',this.price);
                    }
                    else if((offer.extra_amount==null || offer.extra_amount=='0') && (offer.amount_of==null || offer.amount_of=='0') && offer.percentage_of!=null && offer.percentage_of!='0'){
                        this.percent_calulate = 1-(+offer.percentage_of/100);
                        this.price = this.percent_calulate * (+this.price);
                        
                        this.policy_data.offered_price = this.price;

                        console.log('only percentage off',this.price);
                    }
                    else if((offer.extra_amount==null || offer.extra_amount=='0') && (offer.amount_of!=null && offer.amount_of!='0') && (offer.percentage_of==null || offer.percentage_of=='0')){
                        this.price = (+this.price) - (+offer.amount_of);
                        this.policy_data.offered_price = this.price;


                        console.log('only amount off',this.price);
                    }
                    else if((offer.extra_amount!=null && offer.extra_amount!='0') && (offer.amount_of!=null || offer.amount_of!='0') && (offer.percentage_of==null || offer.percentage_of=='0')){
                        this.price = (+this.policy.price_of_percentage) + (+offer.extra_amount);
                        this.policy_data.offered_price = this.price;



                        console.log('only extra amount',this.price);
                    }
                    else{
                        this.price=(+this.policy.price_of_percentage);
                        this.policy_data.offered_price=this.price;

                    }
                }
                if(this.covered_outside_country==true){

                    if(this.price==null){
                        let percent = null;
                        percent = (+this.policy.price_of_percentage*(+this.policy.coverage_percentage/100));
                        this.policy_data.covered_outside_country_price=(+this.policy.price_of_percentage)+percent;
                        this.price = this.policy_data.covered_outside_country_price;
                        this.policy_data.offered_price= this.price;
                    }else if(this.price!=null){
                        this.policy_data.covered_outside_country_price=(+this.price)+(+this.price*(+this.policy.coverage_percentage/100));
                        
                        this.price = this.policy_data.covered_outside_country_price;
                        
                        this.offered_price= this.price;

                    }
                }
                else if(this.covered_outside_country==false){
                    if(this.policy_data.offered_price!=null && this.policy_data.offered_price!='0'){
                        this.policy_data.covered_outside_country_price = this.policy_data.offered_price;

                    }else{
                        this.policy_data.covered_outside_country_price = this.policy_data.price_of_percentage;

                    }
                    console.log('price', this.price)
                    console.log('coverdcountry', this.policy_data.covered_outside_country_price)

                }
                console.log(this.policy_data);

                localStorage.setItem('casco_policy', JSON.stringify(this.policy_data));

            },

            GetTermPolicy(){
                 axios.post(this.baseUrl+'/api/general-condition',
                        this.policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.token
                            }
                        }
                    )
                    .then(res => {
                        console.log(res.data);
                        if(res.data.success){
                            console.log('test');
                            window.open(res.data.message, "_blank"); 
                        }
                    }
                );
            }
            
        },
        mounted() {
            console.log('Component mounted.');
             
            console.log('casco');
            console.log(this.policy);
            this.setPolicyDetails();
        }

    }


</script>