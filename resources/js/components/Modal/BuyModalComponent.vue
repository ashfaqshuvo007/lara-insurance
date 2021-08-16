<template>
<div class="modal-content" v-if="policy!=undefined && policy!=null">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Policy Details</h4>
            </div>
            <div class="modal-body">
                <span><img :src="policy.logo"></span>
                <h4>{{policy.company_name}}</h4>
                <h4>{{policy.policy_name}}</h4>
                <p class="offers">{{locale.choose_offer_below}}</p>
                <h4 v-if="policy.offer.length==0">{{locale.no_offer_available}}</h4>
                <h4 v-if="policy.offer.length>0">Offer Availab le</h4>
                <div class="form-group" v-if="offers.length!=0">
                    <div class="custom-control custom-radio" v-for="offer in offers" :key="offer.offer_id">
                        <input class="custom-control-input" type="radio" :id="offer.offers_id" :name="offer" :value="offer.offers_id" @click="setOffer(offer)">
                        <label :for="offer.offers_id" class="custom-control-label">{{offer.offer_name}}</label>
                    </div>                    
                </div>
                <h4 class="coverage">{{locale.coverage}}</h4>
                <h4>{{policy.coverage}}</h4>
                <div class="buy-wrap">
                    <p class="special">{{locale.by_buying_this_policy}}<span>
                            <a href="javascript:void(0)" @click="GetTermPolicy()"> {{locale.general_condition}}</a>
                        </span></p>
                    <h4>{{locale.price}}: <span>{{policy.price}} Euro</span></h4>
                    <a :href="this.baseUrl+'/buy-now'" class="buy">{{locale.buy_now}}</a>
                </div>
            </div>
</div>
</template>
<script>
    export default {
        props: [
            'baseUrl',
            'policy',
            'user',
            'locale',
            'token',

        ],
        data() {
            return {
                offers:[],
                policy_data:{
                    commision_percentage: null,
                    company_name: null,
                    coverage: null,
                    insurer_id: null,
                    insurer_policy_id: null,
                    logo: null,
                    selected_offer: null,
                    selected_offer_id: null,
                    selected_offer_percentage: null,
                    offered_price: null,
                    policy_details_id: null,
                    policy_name: null,
                    price: null,
                    terms_and_condition: null,
                },
                
                offer_error: false,
                price: null,
                percent_calulate:null,
            }
        },

        methods: {
            setPolicyDetails(){
                console.log('policy', this.policy);
                console.log('policy length', this.policy.offer.length);
                if(this.policy.offer.length==0){

                    this.policy_data.commision_percentage = this.policy.commision_percentage;
                    this.policy_data.company_name = this.policy.company_name;
                    this.policy_data.coverage = this.policy.coverage;
                    this.policy_data.insurer_id = this.policy.insurer_id;
                    this.policy_data.insurer_policy_id = this.policy.insurer_policy_id;
                    this.policy_data.logo = this.policy.logo;
                    this.policy_data.policy_details_id = this.policy.policy_details_id;
                    this.policy_data.policy_name = this.policy.policy_name;
                    this.policy_data.price = this.policy.price;
                    this.policy_data.terms_and_condition = this.policy.terms_and_condition;
                    localStorage.setItem('policy', JSON.stringify(this.policy_data));

               

                }else{
                    this.offers = this.policy.offer;

                }
                console.log('policy_data',this.policy_data);

            },
            setOffer(offer){
                console.log(offer);
                if(offer.offers_id==this.policy_data.selected_offer_id){
                    return;
                }
                this.offer_error=false;
                this.policy_data.selected_offer=offer.offer_name;
                this.policy_data.selected_offer_id=offer.offers_id;
                this.policy_data.selected_offer_percentage=offer.percentage_of;
                this.policy_data.commision_percentage = this.policy.commision_percentage;
                this.policy_data.company_name = this.policy.company_name;
                this.policy_data.coverage = this.policy.coverage;
                this.policy_data.insurer_id = this.policy.insurer_id;
                this.policy_data.insurer_policy_id = this.policy.insurer_policy_id;
                this.policy_data.logo = this.policy.logo;
                this.policy_data.policy_details_id = this.policy.policy_details_id;
                this.policy_data.policy_name = this.policy.policy_name;
                this.policy_data.terms_and_condition = this.policy.terms_and_condition;
                this.policy_data.price = this.policy.price;
                this.CalculateTotalPrice(offer);


                
            },

            BuyNowCheckOffer(){
                console.log(this.policy_data.selected_offer);
                if(this.policy_data.selected_offer==null){

                    this.offer_error=true;
                    console.log(this.offer_error);

                }
            },

            CalculateTotalPrice(offer){
                this.price=null;
                this.policy_data.offered_price=null;
                this.percent_calulate=null;
                this.price = this.policy.price;
                this.price =  this.price *(+this.policy.commision_percentage/100);

                if(offer.extra_amount!=null && offer.extra_amount!='0' && offer.amount_of!=null && offer.amount_of!='0' && offer.percentage_of!=null && offer.percentage_of!='0'){
                    this.price = (+ this.price) + (+offer.extra_amount);
                    this.price = this.price - (+offer.amount_of);
                    this.percent_calulate = 1-(+offer.percentage_of/100);
                    this.price = this.percent_calulate * (this.price);
                    
                    this.policy_data.offered_price = this.price;

                    console.log('all',this.price);

                }
                else if(offer.extra_amount!=null && offer.extra_amount!='0' && offer.amount_of!=null && offer.amount_of!='0' && (offer.percentage_of==null || offer.percentage_of=='0')){
                    this.price = (+ this.price) + (+offer.extra_amount);
                    this.price = this.price - (+offer.amount_of);
                
                    
                    this.policy_data.offered_price = this.price;


                    console.log('extra amount and amount off',this.price);

                }else if(offer.extra_amount!=null && offer.extra_amount!='0' && (offer.amount_of==null || offer.amount_of=='0') && offer.percentage_of!=null && offer.percentage_of!='0'){
                    this.price = (+ this.price) + (+offer.extra_amount);
                    this.percent_calulate = 1-(+offer.percentage_of/100);
                    this.price = this.percent_calulate * (this.price);
                    
                    this.policy_data.offered_price = this.price;
                    
                    console.log('extra amount and percentage off',this.price);
                }
                else if((offer.extra_amount==null || offer.extra_amount=='0') && offer.amount_of!=null && offer.amount_of!='0' && offer.percentage_of!=null && offer.percentage_of!='0'){
                    this.price = (+ this.price) - (+offer.amount_of);
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
                    this.price = (+ this.price) + (+offer.extra_amount);
                    this.policy_data.offered_price = this.price;



                    console.log('only extra amount',this.price);
                }
                else{
                    this.price=null;
                    this.policy_data.price=this.price;
                    this.policy_data.offered_price=this.price;

                }
                localStorage.setItem('policy', JSON.stringify(this.policy_data));

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
                        // this.$emit('child-method', res.data);
                        if(res.data.message=='true.'){
                            this.BuyPolicy();
                        }
                    }
                );
            }

        },
        mounted() {
            console.log('Component mounted.');
            console.log('green.');
            console.log(this.token,'token');
            if(this.policy!=undefined){
            this.setPolicyDetails();

            }
        }

    }


</script>
