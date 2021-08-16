<template>

    <div class="container">
        <form role="form"  @submit.prevent = "CreateTPLPolicy">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    <div class="card-body">
                        <label for="exampleInputFirstName1">{{locale.driver_name}}</label>
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
                                    <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()" :placeholder="locale.last_name" v-model="Create_Policy.driver_last_name">
                                    <div class="form-error" v-if="form_error==true && (Create_Policy.driver_last_name==null || Create_Policy.driver_last_name=='' || Create_Policy.driver_last_name=='undefined')">
                                        <p>{{locale.provide_last_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox trigger">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1"  @click="SelectCheckedData($event)">
                            <label for="customCheckbox1" class="custom-control-label">{{locale.add_second_driver}}</label>
                        </div>
                        <div class="row align-items-center" v-if="add_second_driver==true">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputFirstName1"
                                        :placeholder="locale.first_name" v-model="Create_Policy.second_driver_first_name">
                                    <div class="form-error" v-if="form_error1==true && (Create_Policy.second_driver_first_name==null || Create_Policy.second_driver_first_name=='')">
                                        <p>{{locale.provide_first_name}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputFirstName1" 
                                        :placeholder="locale.last_name" v-model="Create_Policy.second_driver_last_name">
                                    <div class="form-error" v-if="form_error1==true && (Create_Policy.second_driver_last_name==null || Create_Policy.second_driver_last_name=='')">
                                        <p>{{locale.provide_last_name}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">{{locale.date_of_birth}}:</label>
                                    <input type="date" id="start" name="trip-start" value="YYYY-MM-DD" v-model="Create_Policy.date_of_birth">
                                    <div class="form-error" v-if="form_error1==true && (Create_Policy.date_of_birth==null || Create_Policy.date_of_birth=='')">
                                        <p>{{locale.provide_date_of_birth}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">{{locale.id_card_number}}:</label>
                                        <input type="text" class="form-control" id="exampleInputIdCard"
                                            placeholder="ID Card Number" v-model="Create_Policy.id_card_number">
                                        <div class="form-error" v-if="form_error1==true && (Create_Policy.id_card_number==null || Create_Policy.id_card_number=='')">
                                            <p>{{locale.provide_id_card_number}}</p>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="start">{{locale.start_date}}:</label>
                            <datepicker id="start" name="trip-start" value="yyyy-MM-dd" :disabledDates="disabledDates" 
                                v-model="Create_Policy.policy_start_date"  
                                format="yyyy-MM-dd">
                            </datepicker>
                            <div class="form-error" v-if="form_error==true && (Create_Policy.policy_start_date==null || Create_Policy.policy_start_date=='')">
                                <p>{{locale.provide_start_date}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{locale.car_has_insured}}</label>
                            <select class="form-control" @click="SelectCarInsured($event.target.value)">
                                <option :value="null" selected disabled>---Select---</option>

                                <option value="yes">{{locale.yes}}</option>
                                <option value="no">{{locale.newly_registeresd}}</option>
                            </select>
                            <div class="form-error" v-if="form_error==true && (Create_Policy.car_hasbeen_insured_before==null || Create_Policy.car_hasbeen_insured_before=='')">
                                <p>{{locale.provide_car_insured}}</p>
                            </div>
                        </div>
                        <div class="row" v-if="open_car_insured_form==true">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{locale.driving_permit}}:</label>
                                    <div class="upload">
                                        <p><input type="file" accept="image/*" name="image" id="file" v-on:change="SelectPermitFile($event)"
                                                style="display: none;"></p>
                                        <p class="upload-image"><label for="file" style="cursor: pointer;">{{locale.upload_image}}</label>
                                        </p>
                                        <p><img id="output" width="200" /></p>
                                        <div class="form-error" v-if="form_error2==true && (driving_permit_image==null || driving_permit_image=='')">
                                            <p>Provide driving card image</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{locale.id_card_number}}</label>
                                    <div class="upload">
                                        <p><input type="file" accept="image/*" name="image1" id="file1" v-on:change="SelectIdCardFile($event)"
                                                style="display: none;"></p>
                                        <p class="upload-image"><label for="file1" style="cursor: pointer;">{{locale.upload_image}}</label>
                                        </p>
                                        <p><img id="output" width="200" /></p>
                                        <div class="form-error" v-if="form_error2==true && (Create_Policy.id_card_image==null || Create_Policy.id_card_image=='')">
                                            <p>Provide id card image</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{locale.report_demages}}:</label>
                                    <select class="form-control">
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
                            <p class="right" v-if="policy!=null">{{policy.price}} Lek</p>
                        </div>
                        <div class="payment-cont" v-if="policy!=null">
                            <p class="left" v-if="policy.selected_offer">{{policy.selected_offer}}....</p>
                            <p class="left" v-if="!policy.selected_offer">No Offer Available</p>
                            <p class="right" v-if="policy.selected_offer_amount_of!='0'">{{policy.selected_offer_amount_of}}</p>
                            <p class="right" v-if="policy.selected_offer_extra_amount!='0'">{{policy.selected_offer_extra_amount}}</p>
                            <p class="right" v-if="policy.selected_offer_percentage!='0'">-{{policy.selected_offer_percentage}}%</p>

                        </div>
                        <div class="payment-cont">
                            <p class="left">{{locale.report_demages}}</p>
                            <p class="right" v-if="claiming_price==null">0 Lek</p>
                            <p class="right" v-if="claiming_price!=null">{{claiming_price}} Lek</p>
                        </div>
                        <div class="payment-cont">
                            <p class="left">{{locale.shipping}}</p>
                            <p class="right">{{locale.free}}</p>
                        </div>
                        <div class="payment-cont">
                            <p class="left">{{locale.total}}</p>
                            <p class="right">{{Create_Policy.premium}} Lek</p>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2" v-model="form_declared" @click="SelfDecalration()">
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
            </div>
        </form>
    </div> 

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
            'lang',
        ],
        data() {
            return {
                moment: moment,
                policy: null,
                tpl_data: null,
                form_declared: false,
                form_declaration: '',
                Create_Policy: {
                    driver_first_name: null,
                    driver_last_name: null,
                    driver_first_name: null,
                    prospect_name: null,
                    validity_days: null,
                    add_second_driver: "",
                    second_driver_first_name: null,
                    second_driver_last_name: null,
                    date_of_birth: null,
                    id_card_number: null,
                    policy_start_date: null,
                    policy_number: 'TPL_0001',
                    policy_details_id: null,
                    policy_type: 'c1bc21cfdda9',
                    car_hasbeen_insured_before:null,
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
                    id_card_image:null,
                    driving_permit_image: null,
                    selected_offer: null,
                    policy_name: null,
                },
                disabledDates: {
                    to: new Date(Date.now() - 8640000)
                },
                add_second_driver: false,
                user_name: [],
                open_car_insured_form: false,
                claiming_price: null,
                check_car:{
                    car_registration_no: null,
                    policy_type: null,
                    language_type: this.lang,
                },
                driving_permit_image: null,
                id_card_image: null,
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
            getPolicy(){

                //Get Cuurent Date

                // this.disabledDates = new Date();
                // this.disabledDates = moment(this.disabledDates).format('YYYY-MM-DD');                
                
                this.policy = JSON.parse(localStorage.getItem('tpl_policy'));                
                console.log(this.policy);
                 this.Create_Policy.policy_type = 'c1bc21cfdda9';
                this.Create_Policy.insuer_id=this.policy.insurer_id;
                this.Create_Policy.insurer_policy_id=this.policy.insurer_policy_id;
                this.Create_Policy.policy_details_id=this.policy.policy_details_id;
                this.Create_Policy.insuer_id=this.policy.insurer_id;
                this.Create_Policy.premium=this.policy.offered_price;
                this.Create_Policy.premium_paid=this.policy.offered_price;
                this.Create_Policy.insurer_part=this.policy.offered_price ;
                this.Create_Policy.offer=this.policy.selected_offer_id ;
                this.Create_Policy.policy_name=this.policy.policy_name ;
                 if(this.policy.selected_offer_id!=null){
                    this.Create_Policy.selected_offer = this.policy.selected_offer;
                }else{
                    this.Create_Policy.selected_offer ='Not Available';

                }
                this.claimed = 'yes';
                this.claiming_price=0;
                this.Create_Policy.our_part=0;
                this.Create_Policy.premium = 0+(+this.Create_Policy.premium);
                this.Create_Policy.premium_paid = 0+(+this.Create_Policy.premium_paid);

            },
            getTPLData(){
                this.tpl_data = JSON.parse(localStorage.getItem('tpl_data'));
                console.log(this.tpl_data);

                this.check_car.car_registration_no=this.tpl_data.registration_no
                this.check_car.policy_type=this.Create_Policy.policy_type;
                this.Create_Policy.car_registration_number=this.tpl_data.registration_no;
            },
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
            SelectCarInsured(event){
                if(event=='no'){
                    this.open_car_insured_form=true;
                    this.Create_Policy.car_hasbeen_insured_before='no';
                }else{
                    this.open_car_insured_form=false;
                    this.Create_Policy.car_hasbeen_insured_before='yes';

                }
            },
            SelectPermitFile(event){

                this.driving_permit_image = event.target.files[0];
                this.Create_Policy.driving_permit_image = event.target.files[0];
            },
            SelectIdCardFile(event){
                this.id_card_image = event.target.files[0];
                this.Create_Policy.id_card_image = event.target.files[0];

            },

            SelectClaimCovered(event){
                if(event=='yes'){
                    this.claimed = 'yes';
                    
                }else if(event=='no'){
                    this.claimed = 'no';
                    this.claiming_price=null;
                    this.Create_Policy.premium=this.policy.offered_price;
                    this.Create_Policy.premium_paid=this.policy.offered_price;
                }
            },
            SelfDecalration(){
                this.form_declared = !this.form_declared;
                if(!this.form_declared){
                    this.form_declaration = 'Please check the self declaration box!';
                }else{
                    this.form_declaration = '';

                }
            },

            SelectPayMethod(event){
                this.payment_method_data.payment_method = event;
                this.Create_Policy.payment_method=event;
            },

            SetProspectName(){
                this.Create_Policy.prospect_name = this.Create_Policy.driver_first_name + ' '+ this.Create_Policy.driver_last_name;
                console.log(this.Create_Policy.prospect_name);
            },

            CreateTPLPolicy(){
                this.Create_Policy.policy_start_date=moment(this.Create_Policy.policy_start_date).format('YYYY-MM-DD');
                console.log(this.Create_Policy);

                axios.post(this.base_url+'/api/check/car-policy',
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
                        // return;
                        if(res.data.message=='true.'){
                            this.BuyPolicy();
                        }
                    }
                ).catch((error) => {
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })
            },

            BuyPolicy(){
                if(this.Create_Policy.driver_first_name == null || this.Create_Policy.driver_first_name=="" || this.Create_Policy.driver_first_name=="undefined" ||
                this.Create_Policy.driver_last_name == null || this.Create_Policy.driver_last_name=="" || this.Create_Policy.driver_last_name=="undefined" ||
                this.Create_Policy.policy_start_date == null || this.Create_Policy.policy_start_date=="" ||
                this.Create_Policy.car_hasbeen_insured_before == null || this.Create_Policy.car_hasbeen_insured_before=="" ||
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

                if(this.Create_Policy.car_hasbeen_insured_before == 'no'){

                    if(this.driving_permit_image==null || this.driving_permit_image==''||
                        this.id_card_image==null || this.id_card_image==''){
                        this.form_error2 = true;
                        return;
                    }
                }
                if(this.form_declared==false){
                    this.form_declaration='Please check the self declaration box!';
                    return;
                }else{
                    this.form_declaration='';
                }
                let formData = new FormData();
                 formData.append('driver_first_name', this.Create_Policy.driver_first_name);
                 formData.append('driver_last_name', this.Create_Policy.driver_last_name);
                 formData.append('prospect_name', this.Create_Policy.prospect_name);
                 formData.append('add_second_driver', this.Create_Policy.add_second_driver);
                 formData.append('second_driver_first_name', this.Create_Policy.second_driver_first_name);
                 formData.append('second_driver_last_name', this.Create_Policy.second_driver_last_name);
                 formData.append('date_of_birth', this.Create_Policy.date_of_birth);
                 formData.append('id_card_number', this.Create_Policy.id_card_number);
                 formData.append('policy_start_date', this.Create_Policy.policy_start_date);
                 formData.append('policy_number', this.Create_Policy.policy_number);
                 formData.append('policy_details_id', this.Create_Policy.policy_details_id);
                 formData.append('policy_type', 'c1bc21cfdda9');
                 formData.append('car_hasbeen_insured_before', this.Create_Policy.car_hasbeen_insured_before);
                 formData.append('car_registration_number', this.Create_Policy.car_registration_number);
                 formData.append('document_image_1', this.driving_permit_image);
                 formData.append('document_image_2', this.id_card_image);
                 formData.append('insuer_id', this.Create_Policy.insuer_id);
                 formData.append('insurer_policy_id', this.Create_Policy.insurer_policy_id);
                 formData.append('payment_method', this.Create_Policy.payment_method);
                 formData.append('insurer_part', this.Create_Policy.insurer_part);
                 formData.append('our_part', this.Create_Policy.our_part);
                 formData.append('offer', this.Create_Policy.offer);
                 formData.append('premium', this.Create_Policy.premium);
                 formData.append('premium_paid', this.Create_Policy.premium_paid);
                 formData.append('language', this.lang);
                 
                 this.Create_Policy.policy_type = 'c1bc21cfdda9';

                localStorage.setItem('tpl_buy_policy_data', JSON.stringify(this.Create_Policy));                
                axios.post(this.base_url+'/api/buy-policy/tpl-save',
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        this.$emit('child-method', res.data);
                        localStorage.setItem('buy_policy', JSON.stringify(res.data.policy_created_data));
                        localStorage.setItem('policy_created', JSON.stringify(res.data.policy_id));
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
                                window.location.href = this.base_url+'/shipping-address';

                                // window.location.href = this.base_url+'/cod/'+this.payment_method_data.policy_id+'/'+this.Create_Policy.car_registration_number+'/'+this.Create_Policy.policy_name;

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
                                window.location.href = this.base_url+'/shipping-address';

                                // window.location.href = this.base_url+'/pay-bypaypal/'+this.payment_method_data.policy_id+'/'+this.Create_Policy.car_registration_number+'/'+this.Create_Policy.policy_name;
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
            console.log('TPL buy policy form');
            this.getPolicy();
            this.setUserDetails();
            this.getTPLData();
        },
    }
</script>


