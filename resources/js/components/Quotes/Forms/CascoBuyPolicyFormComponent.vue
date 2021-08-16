<template>
    <form role="form" @submit.prevent="CreateCascoPolicy">
        <div class="container">
            <div class="card-body">
                <label for="exampleInputFirstName1">{{locale.insured_name}} :</label>
                <div class="row">
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.first_name" @input="SetProspectName()"
                                v-model="Create_Policy.driver_first_name">
                            <div class="form-error"
                                v-if="form_error==true && (Create_Policy.driver_first_name==null || Create_Policy.driver_first_name=='' || Create_Policy.driver_first_name=='undefined')">
                                <p>{{locale.provide_first_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.last_name" @input="SetProspectName()"
                                v-model="Create_Policy.driver_last_name">
                            <div class="form-error"
                                v-if="form_error==true && (Create_Policy.driver_last_name==null || Create_Policy.driver_last_name=='' || Create_Policy.driver_last_name=='undefined')">
                                <p>{{locale.provide_last_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-control custom-checkbox trigger">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1"
                        @click="SelectCheckedData($event)">
                    <label for="customCheckbox1" class="custom-control-label">{{locale.add_second_driver}}</label>
                </div>
                <div class="row" v-if="add_second_driver==true">
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.first_name"
                                v-model="Create_Policy.secoond_driver_first_name">
                            <div class="form-error"
                                v-if="form_error1==true && (Create_Policy.secoond_driver_first_name==null || Create_Policy.secoond_driver_first_name=='')">
                                <p>{{locale.provide_first_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.last_name"
                                v-model="Create_Policy.secoond_driver_last_name">
                            <div class="form-error"
                                v-if="form_error1==true && (Create_Policy.secoond_driver_last_name==null || Create_Policy.secoond_driver_last_name=='')">
                                <p>{{locale.provide_last_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">{{locale.date_of_birth}}:</label>
                            <input type="date" id="start" name="trip-start" value="YYYY-MM-DD"
                                v-model="Create_Policy.date_of_birth">
                            <div class="form-error"
                                v-if="form_error1==true && (Create_Policy.date_of_birth==null || Create_Policy.date_of_birth=='')">
                                <p>{{locale.provide_date_of_birth}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">{{locale.id_card_number}}:</label>
                            <input type="text" class="form-control" id="exampleInputIdCard" :placeholder="locale.id_card_number"
                                v-model="Create_Policy.id_card_number">
                            <div class="form-error"
                                v-if="form_error1==true && (Create_Policy.id_card_number==null || Create_Policy.id_card_number=='')">
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
                    <div class="form-error"
                        v-if="form_error==true && (Create_Policy.policy_start_date==null || Create_Policy.policy_start_date=='')">
                        <p>{{locale.provide_start_date}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.car_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectFile1($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image1_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error"
                                    v-if="form_error==true && (Create_Policy.document_image_1==null || Create_Policy.document_image_1=='')">
                                    <p>{{locale.provide_car_image}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.car_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file1" class="file__input" v-on:change="SelectFile2($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image2_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error"
                                    v-if="form_error==true && (Create_Policy.document_image_2==null || Create_Policy.document_image_2=='')">
                                    <p>{{locale.provide_car_image}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.car_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file2" class="file__input" v-on:change="SelectFile3($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image3_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error"
                                    v-if="form_error==true && (Create_Policy.document_image_3==null || Create_Policy.document_image_3=='')">
                                    <p>{{locale.provide_car_image}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.car_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file3" class="file__input" v-on:change="SelectFile4($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image4_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error"
                                    v-if="form_error==true && (Create_Policy.document_image_4==null || Create_Policy.document_image_4=='')">
                                    <p>{{locale.provide_car_image}}</p>
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
                            <div class="form-error"
                                v-if="form_error==true && (Create_Policy.payment_method==null || Create_Policy.payment_method=='')">
                                <p>{{locale.provide_payment_option}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-cont">
                    <p class="left">{{locale.policy}}</p>
                    <p class="right" v-if="policy!=null">{{Create_Policy.premium}} Euro</p>
                </div>
                <div class="payment-cont" v-if="policy!=null">
                    <p class="left" v-if="policy.selected_offer">{{policy.selected_offer}}....</p>
                    <p class="left" v-if="!policy.selected_offer">No Offer Available</p>
                    <p class="right" v-if="policy.selected_offer_percentage!='0'">-{{policy.selected_offer_percentage}}%
                    </p>
                    <p class="right" v-if="policy.selected_offer_amount_off!='0'">-{{policy.selected_offer_amount_off}}
                    </p>
                    <p class="right" v-if="policy.selected_offer_extra_amount!='0'">
                        -{{policy.selected_offer_extra_amount}}
                    </p>
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
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{locale.pay}}</button>
            </div>
        </div>
        <!-- /.card-body -->
        
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
                policy: null,
                casco_data: null,
                disabledDates: {
                    to: new Date(Date.now() - 8640000)
                },
                Create_Policy: {
                    driver_first_name: null,
                    driver_last_name: null,
                    prospect_name: null,
                    validity_days: null,
                    add_second_driver: '',
                    secoond_driver_first_name: null,
                    secoond_driver_last_name: null,
                    date_of_birth: null,
                    id_card_number: null,
                    policy_start_date: null,
                    policy_number: 'Casco_0001',
                    policy_details_id: null,
                    policy_type: null,
                    car_registration_number: null,
                    variant: null,
                    document_image_1: null,
                    document_image_2: null,
                    document_image_3: null,
                    document_image_4: null,
                    insuer_id: null,
                    insurer_policy_id: null,
                    payment_method: null,
                    insurer_part: null,
                    our_part: null,
                    offer: null,
                    premium: null,
                    premium_paid: null,
                    delivery_address: null,
                    delivery_date: null,
                    delivery_time: null,
                    delivery_date: null,
                    delivery_city: null,
                    selected_offer: null,
                    policy_name: null,
                },
                check_car: {
                    car_registration_no: null,
                    policy_type: null,
                    language_type: 'en',
                },
                add_second_driver: false,
                claiming_price: null,
                total_price: null,
                claimed: null,
                form_error: false,
                image1_error: false,
                image2_error: false,
                image3_error: false,
                image4_error: false,
                form_error1: false,
                form_error2: false,
                disabledDates: null,
                payment_method_data:{
                    payment_method: null,
                    policy_id: null
                }
            }
        },

        methods: {
            getPolicy() {
                //Get Cuurent Date

                    // to: new Date(Date.now() - 8640000)
                this.disabledDates ={
                    to:new Date(Date.now() - 8640000)
                } 
                // this.disabledDates = moment(this.disabledDates).format('YYYY-MM-DD'); 

                this.policy = JSON.parse(localStorage.getItem('casco_policy'));
                console.log(this.policy);
                this.Create_Policy.insuer_id = this.policy.insurer_id;
                if (this.policy.selected_offer_id != null) {
                    this.Create_Policy.selected_offer = this.policy.selected_offer;
                } else {
                    this.Create_Policy.selected_offer = 'Not Available';

                }
                this.Create_Policy.policy_name = this.policy.policy_name;

                this.Create_Policy.insurer_policy_id=this.policy.insurer_policy_id;
                this.Create_Policy.policy_details_id = this.policy.policy_details_id;
                this.Create_Policy.insuer_id = this.policy.insurer_id;
                if (this.policy.covered_outside_country_price == null && this.policy.offered_price != null) {
                    this.Create_Policy.premium = this.policy.offered_price;
                    this.Create_Policy.premium_paid = this.policy.offered_price;
                    this.Create_Policy.insurer_part = this.policy.offered_price;
                } else if (this.policy.covered_outside_country_price != null && this.policy.offered_price == null) {
                    this.Create_Policy.premium = this.policy.covered_outside_country_price;
                    this.Create_Policy.premium_paid = this.policy.covered_outside_country_price;
                    this.Create_Policy.insurer_part = this.policy.covered_outside_country_price;
                } else {
                    this.Create_Policy.premium = this.policy.price_of_percentage;
                    this.Create_Policy.premium_paid = this.policy.price_of_percentage;
                    this.Create_Policy.insurer_part = this.policy.price_of_percentage;
                }

                this.Create_Policy.offer = this.policy.selected_offer_id;
                this.claimed = 'yes';
                this.claiming_price = 0;
                this.Create_Policy.our_part = 0;
                this.total_price = 0 + (+this.Create_Policy.premium);
                this.Create_Policy.premium = 0 + (+this.Create_Policy.premium);
                this.Create_Policy.premium_paid = 0 + (+this.Create_Policy.premium_paid);


            },
            getTPLData() {
                this.casco_data = JSON.parse(localStorage.getItem('full_casco_data'));
                this.check_car.car_registration_no = this.casco_data.car_registration_no
                this.check_car.policy_type = this.casco_data.varient_type;
                this.Create_Policy.car_registration_number = this.casco_data.car_registration_no;
                this.Create_Policy.policy_type = 'c7824ee08a59';
                this.Create_Policy.variant = this.casco_data.varient_type;


            },

            setUserDetails() {
                this.user_name = this.user.name.split(" ");
                this.Create_Policy.driver_first_name = this.user_name[0];
                this.Create_Policy.driver_last_name = this.user_name[1];
                this.Create_Policy.prospect_name = this.Create_Policy.driver_first_name + ' ' + this.Create_Policy.driver_last_name;


            },
            SetProspectName(){
                this.Create_Policy.prospect_name = this.Create_Policy.driver_first_name + ' '+ this.Create_Policy.driver_last_name;
            },

            SelectCheckedData($event) {
                this.add_second_driver = !this.add_second_driver;
                if (this.add_second_driver == true) {
                    this.Create_Policy.add_second_driver = "checked";
                } else {
                    this.Create_Policy.add_second_driver = "";

                }
            },
            SelectFile1(event) {
                console.log(event.target.files[0]);

                if (event.target.files[0].type == 'image/png' ||
                    event.target.files[0].type == 'image/jpeg' ||
                    event.target.files[0].type == 'image/jpg') {
                    this.image1_error = false;
                    this.Create_Policy.document_image_1 = event.target.files[0];
                    console.log(this.Create_Policy.document_image_1);

                } else {
                    this.image1_error = true;
                    return;
                }

            },
            SelectFile2(event) {
                if (event.target.files[0].type == 'image/png' ||
                    event.target.files[0].type == 'image/jpeg' ||
                    event.target.files[0].type == 'image/jpg') {
                    this.image2_error = false;
                    this.Create_Policy.document_image_2 = event.target.files[0];
                    console.log(this.Create_Policy.document_image_2);

                } else {
                    this.image2_error = true;
                    return;
                }
            },
            SelectFile3(event) {
                if (event.target.files[0].type == 'image/png' ||
                    event.target.files[0].type == 'image/jpeg' ||
                    event.target.files[0].type == 'image/jpg') {
                    this.image2_error = false;
                    this.Create_Policy.document_image_3 = event.target.files[0];
                    console.log(this.Create_Policy.document_image_3);

                } else {
                    this.image2_error = true;
                    return;
                }
            },
            SelectFile4(event) {
                if (event.target.files[0].type == 'image/png' ||
                    event.target.files[0].type == 'image/jpeg' ||
                    event.target.files[0].type == 'image/jpg') {
                    this.image4_error = false;
                    this.Create_Policy.document_image_4 = event.target.files[0];
                    console.log(this.Create_Policy.document_image_4);

                } else {
                    this.image4_error = true;
                    return;
                }
            },
            SelectClaimCovered(event) {
                if (event == 'yes') {
                    this.claimed = 'yes';

                } else if (event == 'no') {
                    this.claimed = 'no';
                    this.claiming_price = null;
                    this.total_price = null;
                    this.getPolicy();
                }
            },
            SelectPayMethod(event) {
                this.Create_Policy.payment_method = event;
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
            CreateCascoPolicy() {
                this.Create_Policy.policy_start_date=moment(this.Create_Policy.policy_start_date).format('YYYY-MM-DD');

                axios.post(this.base_url + '/api/check/car-policy',
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
                        if (res.data.message == 'true.') {
                            this.BuyPolicy();
                        }
                    }).catch((error) => {

                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }
                    })
            },

            BuyPolicy() {

                if (this.Create_Policy.driver_first_name == null || this.Create_Policy.driver_first_name == "" || this.Create_Policy.driver_first_name == "undefined" ||
                    this.Create_Policy.driver_last_name == null || this.Create_Policy.driver_last_name == "" || this.Create_Policy.driver_last_name == "undefined" ||
                    this.Create_Policy.policy_start_date == null || this.Create_Policy.policy_start_date == "" ||
                    this.Create_Policy.document_image_1 == null || this.Create_Policy.document_image_1 == "" ||
                    this.Create_Policy.document_image_2 == null || this.Create_Policy.document_image_2 == "" ||
                    this.Create_Policy.document_image_3 == null || this.Create_Policy.document_image_3 == "" ||
                    this.Create_Policy.document_image_4 == null || this.Create_Policy.document_image_4 == "" ||
                    this.claimed == null || this.claimed == "" ||
                    this.Create_Policy.payment_method == null || this.Create_Policy.payment_method == "") {
                    this.form_error = true;
                    return;
                }

                if (this.Create_Policy.add_second_driver == 'checked') {
                    if (this.Create_Policy.secoond_driver_first_name == null || this.Create_Policy
                        .secoond_driver_first_name == '' ||
                        this.Create_Policy.secoond_driver_last_name == null || this.Create_Policy
                        .secoond_driver_last_name == '' ||
                        this.Create_Policy.date_of_birth == null || this.Create_Policy.date_of_birth == '' ||
                        this.Create_Policy.id_card_number == null || this.Create_Policy.id_card_number == '') {
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
                let formData = new FormData();
                formData.append('driver_first_name', this.Create_Policy.driver_first_name);
                formData.append('driver_last_name', this.Create_Policy.driver_last_name);
                formData.append('prospect_name', this.Create_Policy.prospect_name);
                formData.append('add_second_driver', this.Create_Policy.add_second_driver);
                formData.append('secoond_driver_first_name', this.Create_Policy.secoond_driver_first_name);
                formData.append('secoond_driver_last_name', this.Create_Policy.secoond_driver_last_name);
                formData.append('date_of_birth', this.Create_Policy.date_of_birth);
                formData.append('id_card_number', this.Create_Policy.id_card_number);
                formData.append('policy_start_date', this.Create_Policy.policy_start_date);
                formData.append('policy_number', this.Create_Policy.policy_number);
                formData.append('policy_details_id', this.Create_Policy.policy_details_id);
                formData.append('policy_type', this.Create_Policy.policy_type);
                formData.append('car_hasbeen_insured_before', this.Create_Policy.car_hasbeen_insured_before);
                formData.append('car_registration_number', this.Create_Policy.car_registration_number);
                formData.append('document_image_1', this.Create_Policy.document_image_1);
                formData.append('document_image_2', this.Create_Policy.document_image_2);
                formData.append('document_image_3', this.Create_Policy.document_image_3);
                formData.append('document_image_4', this.Create_Policy.document_image_4);
                formData.append('variant', this.Create_Policy.variant);
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

                axios.post(this.base_url + '/api/buy-policy/full-casco-save',
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
                    }).catch((error) => {
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
            console.log('Casco Form Mounted');
            this.getPolicy();
            this.setUserDetails();
            this.getTPLData();
        },
    }

</script>
