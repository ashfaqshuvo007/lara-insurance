<template>
    <form role="form" @submit.prevent="BuyPolicy">
        <div class="container">
            <div class="card-body">
                <div class="row">
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()"
                                :placeholder="locale.first_name" v-model="Create_Policy.first_name">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.first_name==null || 
                                Create_Policy.first_name=='' || Create_Policy.first_name=='undefined')">
                                <p>{{locale.provide_first_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()"
                            :placeholder="locale.last_name" v-model="Create_Policy.last_name">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.last_name==null || 
                            Create_Policy.last_name=='' || Create_Policy.last_name=='undefined')">
                                <p>{{locale.provide_last_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1"
                                :placeholder="locale.father_name" v-model="Create_Policy.father_name">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.father_name==null || Create_Policy.father_name=='')">
                                <p>{{locale.provide_father_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputIdCard"
                                :placeholder="locale.passport_number" v-model="Create_Policy.passport_number">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.passport_number==null || Create_Policy.passport_number=='')">
                                <p>{{locale.provide_passport_number}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{locale.report_demages}}:</label>
                            <select class="form-control">
                                <!--<option :value="null" selected disabled>---Select---</option>-->
                                <option value="yes" selected disabled>Yes</option>
                                <!--<option value="no">No</option>-->
                            </select>
                            <div class="form-error" v-if="form_error==true && (claimed==null || claimed=='')">
                                <p>Provide Claiming option</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{locale.payment_method}}:</label>
                            <select class="form-control" v-on:change="SelectPayMethod( $event.target.value)">
                                <option :value="null" selected disabled>---Select---</option>
                                <option value="BKT VPOS">{{locale.bkt_vpos}}</option>
                                <option value="Paypal">{{locale.paypal}}</option>
                                <option value="Cod">{{locale.cod}}</option>
                            </select>
                            <div class="form-error" v-if="form_error==true && (Create_Policy.payment_method==null || Create_Policy.payment_method=='')">
                                <p>{{locale.provide_payment_option}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-cont">
                    <p class="left">{{locale.policy}}</p>
                    <p class="right" v-if="policy!=null">{{policy.price_of_percentage}} Euro</p>
                </div>
                <div class="payment-cont" v-if="policy!=null">
                    <p class="left" v-if="policy.selected_offer">{{policy.selected_offer}}....</p>
                    <p class="left" v-if="!policy.selected_offer">No Offer Available</p>
                    <p class="right" v-if="policy.selected_offer_percentage!='0'">-{{policy.selected_offer_percentage}}%</p>
                    <p class="right" v-if="policy.selected_offer_amount_off!='0'">-{{policy.selected_offer_amount_off}}</p>
                    <p class="right" v-if="policy.selected_offer_extra_amount!='0'">{{policy.selected_offer_extra_amount}}</p>
                </div>
                <div class="payment-cont">
                    <p class="left">{{locale.report_demages}}</p>
                    <p class="right" v-if="claiming_price==null">0 Euro</p>
                    <p class="right" v-if="claiming_price!=null">{{claiming_price}} Euro</p>
                </div>
                <div class="payment-cont">
                    <p class="left">{{locale.shipping}}</p>
                    <p class="right">{{locale.free}}</p>
                </div>
                <div class="payment-cont">
                    <p class="left">{{locale.total}}</p>
                    <p class="right" v-if="policy!=null && total_price==null">{{Create_Policy.premium}} Euro</p>
                    <p class="right" v-if="policy!=null && total_price!=null">{{total_price}} Euro</p>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" 
                    value="option2" @click="SelfDecalration()">
                    <label for="customCheckbox2" class="custom-control-label">{{locale.declaration}}</label>
                </div>
                <div class="form-error"  v-if="form_declaration!=''">
                    <p>{{form_declaration}}</p>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{locale.pay}}</button>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
         props: [
            'Auth',
            'user',
            'base_url',
            'locale',
            'lang'
        ],
        data() {
            return {
                policy: null,
                travel_outside_data: null,
                form_declared: false,
                form_declaration: '',
                Create_Policy: {
                    car_registration_number: 'Travel',
                    first_name: null,
                    last_name: null,
                    start_date: null,
                    end_date: null,
                    date_of_birth: null,
                    prospect_name: null,
                    father_name: null,
                    passport_number: null,
                    get_the_days: null,
                    policy_number: 'TOA_0001',
                    policy_details_id: null,
                    policy_type: null,
                    insuer_id: null,
                    insurer_policy_id:null,
                    payment_method:null,
                    insurer_part:null,
                    our_part:null,
                    offer:null,
                    premium:null,
                    premium_paid:null,
                    delivery_address:null,
                    delivery_date:null,
                    delivery_time:null,
                    delivery_date:null,
                    delivery_city:null,
                    square: null,
                },
                 check_car:{
                    car_registration_no: null,
                    policy_type: null,
                    language_type: 'en',
                },
                add_second_driver: false,
                claiming_price: null,
                total_price: null,
                selected_offer:null,
                policy_name: null,
                claimed: null,
                form_error: false,
                payment_method_data:{
                    payment_method: null,
                    policy_id: null
                }
            }
        },

        methods: {
            getPolicy(){
                
                this.policy = JSON.parse(localStorage.getItem('travel_policy'));
                console.log(this.policy);
                 if(this.policy.selected_offer_id!=null){
                    this.Create_Policy.selected_offer = this.policy.selected_offer;
                }else{
                    this.Create_Policy.selected_offer ='Not Available';

                }
                this.Create_Policy.policy_name = this.policy.policy_name;
                this.Create_Policy.insuer_id=this.policy.insurer_id;
                this.Create_Policy.insurer_policy_id=this.policy.insurer_policy_id;
                this.Create_Policy.policy_details_id=this.policy.policy_details_id;
                this.Create_Policy.insuer_id=this.policy.insurer_id;
                if(this.policy.offered_price!=null){
                    this.Create_Policy.premium=this.policy.offered_price;
                    this.Create_Policy.premium_paid=this.policy.offered_price;
                    this.Create_Policy.insurer_part=this.policy.offered_price ;
                }else{
                    this.Create_Policy.premium=this.policy.price_of_percentage;
                    this.Create_Policy.premium_paid=this.policy.price_of_percentage;
                    this.Create_Policy.insurer_part=this.policy.price_of_percentage ;
                }
                
                this.Create_Policy.offer=this.policy.selected_offer_id ;
                this.claimed = 'yes';
                this.claiming_price=0;
                this.Create_Policy.our_part=0;
                this.total_price =this.Create_Policy.premium.replace(/,/g, "");
                this.Create_Policy.premium =  this.total_price;
                this.Create_Policy.premium_paid =  this.total_price;


            },
            getTravelOutsideData(){
                this.travel_outside_data = JSON.parse(localStorage.getItem('travel_data'));
                this.Create_Policy.get_the_days=this.travel_outside_data.for_validity;
                this.Create_Policy.policy_type=this.travel_outside_data.choose_contury_type;
                this.Create_Policy.start_date=this.travel_outside_data.start_date;
                this.Create_Policy.date_of_birth = this.travel_outside_data.dob.split('T')[0];
                this.Create_Policy.end_date = this.travel_outside_data.end_date.split('T')[0];
                console.log(this.Create_Policy,"create");



            },

            setUserDetails(){
                this.user_name=this.user.name.split(" ");
                this.Create_Policy.first_name = this.user_name[0];
                this.Create_Policy.last_name = this.user_name[1];
                this.Create_Policy.prospect_name = this.Create_Policy.first_name + ' '+ this.Create_Policy.last_name;


            },
            SetProspectName(){
                this.Create_Policy.prospect_name = this.Create_Policy.first_name + ' '+ this.Create_Policy.last_name;
            },
             SelectClaimCovered(event){
                if(event=='yes'){
                    this.claimed = 'yes';
                    this.claiming_price=0;
                    this.Create_Policy.our_part=0;
                    this.total_price =this.Create_Policy.premium.replace(/,/g, "");
                    this.Create_Policy.premium =  this.total_price;
                    this.Create_Policy.premium_paid =  this.total_price;
                }else if(event=='no'){
                    this.claimed = 'no';
                    this.claiming_price=null;
                    this.total_price = null; 
                    this.Create_Policy.our_part = null;
                    if(this.policy.offered_price!=null){
                        this.Create_Policy.premium=this.policy.offered_price;
                        this.Create_Policy.premium_paid=this.policy.offered_price;

                    }else{
                        
                        this.Create_Policy.premium=this.policy.price_of_percentage;
                        this.Create_Policy.premium_paid=this.policy.price_of_percentage;
                    }
                    
                }
            },
             SelectPayMethod(event){
                this.Create_Policy.payment_method=event;
                this.payment_method_data.payment_method = event;
            },

            SelfDecalration(){
                this.form_declared = !this.form_declared;
                if(!this.form_declared){
                    this.form_declaration = 'Please check the self declaration box!';
                }else{
                    this.form_declaration = '';

                }
            },

            


            BuyPolicy(){
                if(this.Create_Policy.first_name == null || this.Create_Policy.first_name=="" || this.Create_Policy.first_name=="undefined" ||
                this.Create_Policy.last_name == null || this.Create_Policy.last_name=="" || this.Create_Policy.last_name=="undefined" ||
                this.Create_Policy.passport_number == null || this.Create_Policy.passport_number=="" ||
                this.Create_Policy.father_name == null || this.Create_Policy.father_name=="" ||
                this.claimed == null || this.claimed=="" ||
                this.Create_Policy.payment_method == null || this.Create_Policy.payment_method==""){
                    this.form_error = true;
                    return;
                }
                if(this.form_declared==false){
                    this.form_declaration='Please check the self declaration box!';
                    return;
                }else{
                    this.form_declaration='';
                }
                let formData = new FormData();
                 formData.append('first_name', this.Create_Policy.first_name);
                 formData.append('last_name', this.Create_Policy.last_name);
                 formData.append('start_date', this.Create_Policy.start_date);
                 formData.append('end_date', this.Create_Policy.end_date);
                 formData.append('date_of_birth', this.Create_Policy.date_of_birth);
                 formData.append('prospect_name', this.Create_Policy.prospect_name);
                 formData.append('father_name', this.Create_Policy.father_name);
                 formData.append('passport_number', this.Create_Policy.passport_number);
                 formData.append('get_the_days', this.Create_Policy.get_the_days);
                 formData.append('policy_details_id', this.Create_Policy.policy_details_id);
                 formData.append('policy_type', this.Create_Policy.policy_type);
                 formData.append('policy_number', this.Create_Policy.policy_number);
                 formData.append('insuer_id', this.Create_Policy.insuer_id);
                 formData.append('insurer_policy_id', this.Create_Policy.insurer_policy_id);
                 formData.append('payment_method', this.Create_Policy.payment_method);
                 formData.append('insurer_part', this.Create_Policy.insurer_part);
                 formData.append('our_part', this.Create_Policy.our_part);
                 formData.append('offer', this.Create_Policy.offer);
                 formData.append('premium', this.Create_Policy.premium);
                 formData.append('premium_paid', this.Create_Policy.premium_paid);
                 formData.append('language', this.lang);
                localStorage.setItem('tpl_buy_policy_data', JSON.stringify(this.Create_Policy));

                axios.post(this.base_url+'/api/buy-policy/travel-policy-save',
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        this.$emit('child-method', res.data);
                        localStorage.setItem('policy_created', JSON.stringify(res.data.policy_id));
                        localStorage.setItem('buy_policy', JSON.stringify(res.data.policy_created_data));
                        this.payment_method_data.policy_id = res.data.policy_id;
                        this.NavigateTo();

                    }
                ).catch((error) => {
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })
            },
            NavigateTo(){
                if(this.payment_method_data.payment_method=='Cod'){
                    axios.post(this.base_url+'/api/payment-create',
                            this.payment_method_data, {
                                headers: {
                                    Accept: 'application/json',
                                    'Content-Type': 'application/json',
                                }
                            }
                        )
                        .then(res => {
                            // this.$emit('child-method', res.data);
                            console.log(res.data.success);
                            if(res.data.success){
                                // window.location.href = this.base_url+'/cod/'+this.payment_method_data.policy_id+'/'+this.locale.policy_for_travel+'/'+this.Create_Policy.policy_name;
                                window.location.href = this.base_url+'/shipping-address';

                            }

                        }
                    );
                }else if(this.payment_method_data.payment_method=='Paypal'){
                    axios.post(this.base_url+'/api/payment-create',
                        this.payment_method_data, {
                                headers: {
                                    Accept: 'application/json',
                                    'Content-Type': 'application/json',
                                }
                            }
                        )
                        .then(res => {
                            // this.$emit('child-method', res.data);
                            console.log(res.data.success);
                            if(res.data.success){
                            //    window.location.href = this.base_url+'/pay-bypaypal/'+this.payment_method_data.policy_id+'/'+this.locale.policy_for_travel+'/'+this.Create_Policy.policy_name;
                                window.location.href = this.base_url+'/shipping-address';


                            }

                        }
                    );

                }else{
                    axios.post(this.base_url+'/api/payment-create',
                        this.payment_method_data, {
                                headers: {
                                    Accept: 'application/json',
                                    'Content-Type': 'application/json',
                                }
                            }
                        )
                        .then(res => {
                            // this.$emit('child-method', res.data);
                            console.log(res.data.success);
                            if(res.data.success){
                                window.location.href = this.base_url+'/shipping-address';


                            }

                        }
                    );

                }
            },

        },
         mounted() {
            console.log('Travel Form Mounted');
            this.getPolicy();
            this.setUserDetails();
            this.getTravelOutsideData();
        },     
    }
</script>
