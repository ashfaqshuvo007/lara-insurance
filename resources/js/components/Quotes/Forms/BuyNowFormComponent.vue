<template>
<form role="form" @submit.prevent = "CreateGreenCardPolicy" style="margin-top: 50px">
    <div class="container">
        <div class="card-body">
            <label for="exampleInputFirstName1">{{locale.insured_name}}:</label>
            <div class="row">
                <div class=col-sm-6>
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()"
                            :placeholder="locale.first_name" v-model="Create_Policy.driver_first_name">
                        <div class="form-error" v-if="form_error==true && (Create_Policy.driver_first_name==null || Create_Policy.driver_first_name=='' || Create_Policy.driver_first_name=='undefined')">
                            <p>{{locale.provide_first_name}}</p>
                        </div>
                    </div>
                </div>
                <div class=col-sm-6>
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()"
                            :placeholder="locale.last_name" v-model="Create_Policy.driver_last_name">
                        <div class="form-error" v-if="form_error==true && (Create_Policy.driver_last_name==null || Create_Policy.driver_last_name=='' || Create_Policy.driver_last_name=='undefined')">
                            <p>{{locale.provide_last_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-control custom-checkbox trigger">
                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1" @click="SelectCheckedData($event)">
                <label for="customCheckbox1" class="custom-control-label">{{locale.add_second_driver}}</label>
            </div>
            <div class="checked_form_inputs" v-if="add_second_driver==true">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.first_name" v-model="Create_Policy.second_driver_first_name">
                        <div class="form-error" v-if="form_error1==true && (Create_Policy.second_driver_first_name==null || Create_Policy.second_driver_first_name=='')">
                            <p>{{locale.provide_first_name}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.last_name" v-model="Create_Policy.second_driver_last_name">
                        <div class="form-error" v-if="form_error1==true && (Create_Policy.second_driver_last_name==null || Create_Policy.second_driver_last_name=='')">
                            <p>{{locale.provide_last_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <label for="start">{{locale.date_of_birth}}:</label>
                    <input type="date" id="start" name="trip-start" value="YYYY-MM-DD" v-model="Create_Policy.date_of_birth">
                    <div class="form-error" v-if="form_error1==true && (Create_Policy.date_of_birth==null || Create_Policy.date_of_birth=='')">
                        <p>{{locale.provide_date_of_birth}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.id_card_number" v-model="Create_Policy.id_card_number">
                    <div class="form-error" v-if="form_error1==true && (Create_Policy.id_card_number==null || Create_Policy.id_card_number=='')">
                        <p>{{locale.provide_id_card_number}}</p>
                    </div>          
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="start">{{locale.start_date}}:</label>
                <datepicker id="start" name="trip-start" value="yyyy-MM-dd"
                    :disabledDates="disabledDates"
                    v-model="Create_Policy.policy_start_date"  
                    format="yyyy-MM-dd">
                </datepicker>
                <div class="form-error" v-if="form_error==true && (Create_Policy.policy_start_date==null || Create_Policy.policy_start_date=='')">
                    <p>{{locale.provide_start_date}}</p>
                </div>
            </div>
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
                            <option value="BKT VPOS" >{{locale.bkt_vpos}}</option>                                    
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
                <p class="right" v-if="policy!=null">{{policy.price}} Euro</p>
            </div>
            <div class="payment-cont"> 
                <p class="left" >{{locale.report_demages}}</p>
                <p class="right" v-if="claiming_price==null">0 Euro</p>
                <p class="right" v-if="claiming_price!=null">{{claiming_price}} Euro</p>
                
            </div>
            <div class="payment-cont">
                <p class="left">{{locale.shipping}}</p>
                <p class="right">{{locale.free}}</p>
            </div>
            <div class="payment-cont">
                <p class="left" >{{locale.total}}</p>
                <p class="right" v-if="policy!=null">{{Create_Policy.premium}} Euro</p>


                
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
import moment from "moment";
import Datepicker from 'vuejs-datepicker';


export default {
    components: {
            Datepicker,
        },
        props: [
            'Auth',
            'user',
            'base_url',
            'locale',
            'lang'
        ],
        data() {
            return {
                moment: moment,
                form_declared: false,
                form_declaration: '',
               disabledDates: {
                    to: new Date(Date.now() - 8640000)
                },
                Create_Policy: {
                    driver_first_name: null,
                    driver_last_name: null,
                    driver_first_name: null,
                    prospect_name: null,
                    validity_days: null,
                    add_second_driver: '',
                    second_driver_first_name: null,
                    second_driver_last_name: null,
                    date_of_birth: null,
                    id_card_number: null,
                    policy_start_date: null,
                    policy_number: 'Green_Card_0001',
                    policy_details_id: null,
                    policy_type: 'dfd3e39b733a',
                    car_registration_number: null,
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
                    selected_offer:null,
                    policy_name: null,
                    language: this.lang,
                },
                add_second_driver: false,
                policy: null,
                user_name: [],
                green_card_data: null,
                check_car:{
                    car_registration_no: null,
                    policy_type: null,
                    language_type: 'en',
                },
                claiming_price: 0,
                claimed: null,
                form_error: false,
                form_error1: false,
                form_error2: false,
                payment_method_data:{
                    payment_method: null,
                    policy_id: null
                }
            }

        },

        methods: {
            SelectCheckedData($event){
                this.add_second_driver=!this.add_second_driver;
                if(this.add_second_driver==true){
                    this.Create_Policy.add_second_driver="checked";
                }else{
                    this.Create_Policy.add_second_driver="";
                    
                }
            },
            setUserDetails(){
                this.user_name=this.user.name.split(" ");
                this.Create_Policy.driver_first_name = this.user_name[0];
                this.Create_Policy.driver_last_name = this.user_name[1];
                this.Create_Policy.prospect_name = this.Create_Policy.driver_first_name + ' '+ this.Create_Policy.driver_last_name;
            },
            SetProspectName(){
                this.Create_Policy.prospect_name = this.Create_Policy.driver_first_name + ' '+ this.Create_Policy.driver_last_name;
            },
            getPolicy(){                 
                //Get Cuurent Date

                // this.disabledDates = new Date();
                // this.disabledDates = moment(this.disabledDates).format('YYYY-MM-DD'); 

                this.policy = JSON.parse(localStorage.getItem('policy'));
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
                    this.Create_Policy.premium=this.policy.price;
                    this.Create_Policy.premium_paid=this.policy.price;
                    this.Create_Policy.insurer_part=this.policy.price ;
                }
                this.claimed = 'yes';
                this.claiming_price= 0;
                this.Create_Policy.premium = 0+(+this.Create_Policy.premium);
                this.Create_Policy.premium_paid = 0+(+this.Create_Policy.premium_paid);
                this.Create_Policy.our_part=0;


            },
            getGreenCardData(){
                this.green_card_data= JSON.parse(localStorage.getItem('green_card_data'));
                
                if(this.green_card_data.car_registration_number!=null){
                    this.Create_Policy.car_registration_number=this.green_card_data.car_registration_number;
                    this.check_car.car_registration_no=this.green_card_data.car_registration_number;

                }else{
                this.Create_Policy.car_registration_number=this.green_card_data.select_car;
                this.check_car.car_registration_no=this.green_card_data.select_car;


                }
                this.Create_Policy.validity_days=this.green_card_data.for_how_many_days;
                this.Create_Policy.policy_type='dfd3e39b733a';
                this.check_car.policy_type=this.green_card_data.green_card_type;


            },
            SelectClaimCovered(event){
                if(event=='yes'){
                    this.claimed = 'yes';
                    this.claiming_price= 5;
                    this.Create_Policy.premium = 5+(+this.Create_Policy.premium);
                    this.Create_Policy.premium_paid = 5+(+this.Create_Policy.premium_paid);
                    this.Create_Policy.our_part=5;
                    }else if(event=='no'){
                        this.claimed = 'no';
                        this.claiming_price= 5;
                        if(this.policy.offered_price!=null){
                        this.Create_Policy.premium=this.policy.offered_price;
                        this.Create_Policy.premium_paid=this.policy.offered_price;
                        this.Create_Policy.insurer_part=this.policy.offered_price ;
                    }else{
                        this.Create_Policy.premium=this.policy.price;
                        this.Create_Policy.premium_paid=this.policy.price;
                        this.Create_Policy.insurer_part=this.policy.price ;
                    }
                    this.Create_Policy.our_part=0;

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

            CreateGreenCardPolicy(){
                this.Create_Policy.policy_start_date=moment(this.Create_Policy.policy_start_date).format('YYYY-MM-DD');


                axios.post('/api/check/car-policy',
                        this.check_car, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        
                        // this.$emit('child-method', res.data);
                        if(res.data.message=='true.'){
                            this.BuyPolicy();
                        }else{
                            this.$toastr.success(res.data.message);
                        }
                    }
                    ).catch((error) => {
                            console.log(error);

                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }
                    })
                
            },
            
            BuyPolicy(){
                if(this.Create_Policy.driver_first_name == null || this.Create_Policy.driver_first_name=="" || this.Create_Policy.driver_first_name=="undefined" ||
                this.Create_Policy.driver_last_name == null || this.Create_Policy.driver_last_name=="" || this.Create_Policy.driver_last_name=="undefined" ||
                this.Create_Policy.policy_start_date == null || this.Create_Policy.policy_start_date=="" ||
                this.claimed == null || this.claimed=="" ||
                this.Create_Policy.payment_method == null || this.Create_Policy.payment_method==""){
                    this.form_error = true;
                    return;
                }

                if(this.Create_Policy.add_second_driver == 'checked'){
                    if(this.Create_Policy.second_driver_first_name==null || this.Create_Policy.second_driver_first_name==''||
                    this.Create_Policy.second_driver_last_name==null || this.Create_Policy.second_driver_last_name=='' ||
                    this.Create_Policy.date_of_birth==null || this.Create_Policy.date_of_birth=='' ||
                    this.Create_Policy.id_card_number==null || this.Create_Policy.id_card_number==''){
                        this.form_error1 = true;
                        return;
                    }
                }

                if(this.form_declared==false){
                    this.form_declaration='Please check the self declaration box!';
                    return;
                }else{
                    this.form_declaration='';
                }
                localStorage.setItem('tpl_buy_policy_data', JSON.stringify(this.Create_Policy));
                axios.post('/api/buy-policy/green-card-save',
                        this.Create_Policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        this.$emit('child-method', res.data);
                        localStorage.setItem('policy_created', JSON.stringify(res.data.policy_id));
                        localStorage.setItem('buy_policy', JSON.stringify(res.data.policy_created_data));
                        this.payment_method_data.policy_id = res.data.policy_id;
                        console.log(res.data.message);
                        this.$toastr.success(res.data.message);
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
                                // window.location.href = this.base_url+'/cod/'+this.payment_method_data.policy_id+'/'+this.Create_Policy.car_registration_number+'/'+this.Create_Policy.policy_name;
                                window.location.href = this.base_url+'/shipping-address';

                            }

                        }
                    ).catch((error) => {
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })
                }
                else if(this.payment_method_data.payment_method=='Paypal'){
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

                            // window.location.href = this.base_url+'/pay-bypaypal/'+this.payment_method_data.policy_id+'/'+this.Create_Policy.car_registration_number+'/'+this.Create_Policy.policy_name;

                            }

                        }
                    ).catch((error) => {
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })
                    

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
                    ).catch((error) => {
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })

                }
            },

        },
        
        mounted() {
            console.log('Component mounted.');
            console.log(this.locale);
            this.setUserDetails();
            this.getPolicy();
            this.getGreenCardData();

        },

    }
</script>