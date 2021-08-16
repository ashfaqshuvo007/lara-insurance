<template>
    <div class="modal-content" v-if="policy!=undefined && policy!=null">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">{{locale.policy_details}}</h4>

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
                <p>{{policy.coverage}}</p>
                <div class="buy-wrap">       
                    <p class="special">{{locale.by_buying_this_policy}} 
                        <span>
                            <a href="javascript:void(0)" @click="GetTermPolicy()"> {{locale.general_condition}}</a>
                        </span></p>
                    <h4 v-if="price==null">{{locale.price}}: <span>{{policy.price}} Lek</span></h4>
                    <h4 v-if="price!=null">{{locale.price}}: <span>{{price}} Lek</span></h4>
                    <a  href="#" class="buy" v-if="offers!=null && offers.length!=0 && policy_data.selected_offer==null" @click="BuyNowCheckOffer()">{{locale.buy_now}}</a>
                    <a :href="this.baseUrl+'/selectcar-form1'" class="buy" v-if="offers!=null && offers.length!=0 && policy_data.selected_offer!=null">{{locale.buy_now}}</a>
                    <a :href="this.baseUrl+'/selectcar-form1'" class="buy" v-if="policy.offer==null || policy.offer.length==0">{{locale.buy_now}}</a>
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
                    percentage: null,
                    terms_and_condition: null,
                },
                offer_error: false,
                price: null,
                percent_calulate:null
            }
        },

        methods: {
            setPolicyDetails(){
                if(this.policy.offer.length==0 && this.policy.offer==null){

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
                    localStorage.setItem('tpl_policy', JSON.stringify(this.policy_data));

               

                }else{
                    this.offers = this.policy.offer;

                }
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

            CalculateTotalPrice(offer){
                this.price=null;
                this.policy_data.offered_price=null;
                this.percent_calulate=null;
                this.price = this.policy.price;
                this.price=this.price.replace(/,/g, "");
                this. price=parseFloat(this.price);

                
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
                console.log(this.policy_data.offered_price);
                localStorage.setItem('tpl_policy', JSON.stringify(this.policy_data));

            },


            BuyNowCheckOffer(){
                console.log(this.policy_data.selected_offer);
                if(this.policy_data.selected_offer==null){

                    this.offer_error=true;
                console.log(this.offer_error);

                }
                if(this.offer_error==true){
                    this.$toastr.warning(this.locale.please_select_offer);

                }
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
            console.log('policy',this.policy);
            console.log('token',this.token);
            if(this.policy!=null){
                this.setPolicyDetails();

            }
             

        }

    }


</script>