<template>
    <form role="form" @submit.prevent="BuyPolicy">
        <div class="container">
            <div class="card-body">
                <label for="exampleInputFirstName1">{{locale.insured_name}}:</label>
                <div class="row">
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()"
                            :placeholder="locale.first_name"
                                v-model="Create_Policy.first_name">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.first_name==null || Create_Policy.first_name=='' || Create_Policy.first_name=='undefined')">
                                <p>{{locale.provide_first_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" @input="SetProspectName()"
                            :placeholder="locale.last_name"
                                v-model="Create_Policy.last_name">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.last_name==null || Create_Policy.last_name=='' || Create_Policy.last_name=='undefined')">
                                <p>{{locale.provide_last_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">{{locale.date_of_birth}}:</label>
                            <input type="date" id="start" name="trip-start" value="YYYY-MM-DD"
                                v-model="Create_Policy.date_of_birth">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.date_of_birth==null || Create_Policy.date_of_birth=='')">
                                <p>{{locale.provide_date_of_birth}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="start">{{locale.id_card_number}}:</label>
                            <input type="text" class="form-control" id="exampleInputIdCard" :placeholder="locale.id_card_number"
                                v-model="Create_Policy.id_number">
                            <div class="form-error" v-if="form_error==true && (Create_Policy.id_number==null || Create_Policy.id_number=='')">
                                <p>{{locale.provide_id_card_number}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputPropertyNumber"
                                :placeholder="locale.property_number" v-model="Create_Policy.property_number">
                                <div class="form-error" v-if="form_error==true && (Create_Policy.property_number==null || Create_Policy.property_number=='')">
                                    <p>{{locale.provide_property_number}}</p>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputPropertyNumber" :placeholder="locale.kadastral_zone"
                                v-model="Create_Policy.kadastral_number">
                                <div class="form-error" v-if="form_error==true && (Create_Policy.kadastral_number==null || Create_Policy.kadastral_number=='')">
                                    <p>{{locale.provide_kadastral_zone}}</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputPropertyNumber"
                        :placeholder="locale.property_address" v-model="Create_Policy.full_address">
                        <div class="form-error" v-if="form_error==true && (Create_Policy.full_address==null || Create_Policy.full_address=='')">
                            <p>{{locale.property_address}}</p>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.property_inside}} 1:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectInside1($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image1_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.inside_image_1==null || Create_Policy.inside_image_1=='')">
                                    <p>{{locale.provide_image}}</p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.property_inside}} 2:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectInside2($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image2_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.inside_image_2==null || Create_Policy.inside_image_2=='')">
                                    <p>{{locale.provide_image}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.property_inside}} 3:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectInside3($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image3_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.inside_image_3==null || Create_Policy.inside_image_3=='')">
                                    <p>{{locale.provide_image}}</p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.property_outside}} 1:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectOutside1($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image5_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.outside_image_1==null || Create_Policy.outside_image_1=='')">
                                    <p>{{locale.provide_image}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.property_outside}} 2:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectOutside2($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image6_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.outside_image_2==null || Create_Policy.outside_image_2=='')">
                                    <p>{{locale.provide_image}}</p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.property_outside}} 3:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectOutside3($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image7_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.outside_image_3==null || Create_Policy.outside_image_3=='')">
                                    <p>{{locale.provide_image}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.document}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="Image($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                                <div class="form-error" v-if="image4_error==true">
                                    <p>{{locale.provide_car_extension_valid}}</p>
                                </div>
                                <div class="form-error" v-if="form_error==true && (Create_Policy.image_4==null || Create_Policy.image_4=='')">
                                    <p>{{locale.provide_image}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start">{{locale.start_date}}:</label>
                    <input type="date" id="start" name="trip-start" value="YYYY-MM-DD" :min="disabledDates" v-model="Create_Policy.policy_start_date">
                        <div class="form-error" v-if="form_error==true && (Create_Policy.policy_start_date==null || Create_Policy.policy_start_date=='')">
                            <p>{{locale.provide_start_date}}</p>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{locale.report_demages}}:</label>
                            <select class="form-control" >
                               <!-- <option :value="null" selected disabled>---Select---</option>-->
                                <option value="yes" selected disabled>Yes</option>
                                <!--<option value="no">No</option>-->
                            </select>
                            <div class="form-error" v-if="form_error==true && (claimed==null || claimed=='')">
                                <p>Provide Claiming Option</p>
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
                     <p class="right" v-if="policy.selected_offer_extra_amount!='0'">
                        {{policy.selected_offer_extra_amount}}</p>
                    <p class="right" v-if="policy.selected_offer_percentage!='0'">-{{policy.selected_offer_percentage}}%
                    </p>
                    <p class="right" v-if="policy.selected_offer_amount_off!='0'">-{{policy.selected_offer_amount_off}}
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
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{locale.pay}}</button>
            </div>
        </div>
    </form>
</template>
<script>
import moment from "moment";
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
                moment: moment,
                form_declared: false,
                form_declaration: '',
                policy: null,
                home_data: null,
                Create_Policy: {
                    first_name: null,
                    last_name: null,
                    prospect_name: null,
                    square: null,
                    car_registration_number: 'Home',
                    date_of_birth: null,
                    id_number: null,
                    policy_start_date: null,
                    policy_number: 'Home_0001',
                    policy_details_id: null,
                    policy_type: '74273e1bc257',
                    property_number: null,
                    full_address: null,
                    kadastral_number: null,
                    date_of_birth: null,
                    inside_image_1: null,
                    inside_image_2: null,
                    inside_image_3: null,
                    image_4: null,
                    outside_image_1: null,
                    outside_image_2: null,
                    outside_image_3: null,
                    home_type: null,
                    building_value: null,
                    equipmennt_price: null,
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
                    square: null,
                    selected_offer:null,
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
                image5_error: false,
                image6_error: false,
                image7_error: false,
                form_error1: false,
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

                this.disabledDates = new Date();
                this.disabledDates = moment(this.disabledDates).format('YYYY-MM-DD'); 

                this.policy = JSON.parse(localStorage.getItem('home_policy'));
                console.log(this.policy);
                if(this.policy.selected_offer_id!=null){
                    this.Create_Policy.selected_offer = this.policy.selected_offer;
                }else{
                    this.Create_Policy.selected_offer ='Not Available';

                }
                this.Create_Policy.policy_name = this.policy.policy_name;
                this.Create_Policy.insuer_id = this.policy.insurer_id;
                this.Create_Policy.insurer_policy_id=this.policy.insurer_policy_id;
                this.Create_Policy.policy_details_id = this.policy.policy_details_id;
                this.Create_Policy.insuer_id = this.policy.insurer_id;
                if (this.policy.covered_outside_country_price == null && this.policy.offered_price != null) {
                    this.Create_Policy.premium = this.policy.offered_price;
                    this.Create_Policy.premium_paid = this.policy.offered_price;
                    this.Create_Policy.insurer_part = this.policy.offered_price;
                } else if (this.policy.covered_outside_country_price != null && this.policy.offered_price == null) {
                    this.Create_Policy.premium = this.policy.offered_price;
                    this.Create_Policy.premium_paid = this.policy.offered_price;
                    this.Create_Policy.insurer_part = this.policy.offered_price;
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
            getHomeData() {
                this.home_data = JSON.parse(localStorage.getItem('home_data'));
                this.Create_Policy.home_type = this.home_data.property_type;
                this.Create_Policy.building_value = this.home_data.building_value;
                this.Create_Policy.equipmennt_price = this.home_data.equipmennt_price;
                this.Create_Policy.policy_type = '74273e1bc257';
                this.Create_Policy.square = this.home_data.square_m2;


            },

            setUserDetails() {
                this.user_name = this.user.name.split(" ");
                this.Create_Policy.first_name = this.user_name[0];
                this.Create_Policy.last_name = this.user_name[1];
                this.Create_Policy.prospect_name = this.Create_Policy.first_name + ' '+ this.Create_Policy.last_name;
                console.log(this.Create_Policy);
                
            },
            SetProspectName(){
                this.Create_Policy.prospect_name = this.Create_Policy.first_name + ' '+ this.Create_Policy.last_name;
                console.log(this.Create_Policy.prospect_name);
            },
            SelectInside1(event) {
                if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.image1_error = false;
                        this.Create_Policy.inside_image_1 = event.target.files[0];

                        
                }else{
                    this.image1_error = true;
                    return;
                }
            },
            SelectInside2(event) {
                if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.image2_error = false;
                        this.Create_Policy.inside_image_2 = event.target.files[0];
                        
                }else{
                    this.image2_error = true;
                    return;
                }

            },
            SelectInside3(event) {
                 if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.image3_error = false;
                        this.Create_Policy.inside_image_3 = event.target.files[0];
                        
                }else{
                    this.image3_error = true;
                    return;
                }

            },
            Image(event) {
                 if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.image4_error = false;
                        this.Create_Policy.image_4 = event.target.files[0];
                }else{
                    this.image4_error = true;
                    return;
                }

            },
            SelectOutside1(event) {
                if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.image5_error = false;
                        this.Create_Policy.outside_image_1 = event.target.files[0];

                        
                }else{
                    this.image5_error = true;
                    return;
                }

            },
            SelectOutside2(event) {

                if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.Create_Policy.outside_image_2 = event.target.files[0];
                        
                }else{
                    this.image5_error = true;
                    return;
                }

            },
            SelectOutside3(event) {
                if(event.target.files[0].type=='image/png' || 
                    event.target.files[0].type=='image/jpeg' || 
                    event.target.files[0].type=='image/jpg'){
                        this.Create_Policy.outside_image_3 = event.target.files[0];
                        
                }else{
                    this.image5_error = true;
                    return;
                }

            },
            SelectClaimCovered(event) {
                if (event == 'yes') {
                    this.claimed = 'yes';
                    this.claiming_price = 5;
                    this.Create_Policy.our_part = 5;
                    this.total_price = 5 + (+this.Create_Policy.premium);
                    this.Create_Policy.premium = 5 + (+this.Create_Policy.premium);
                    this.Create_Policy.premium_paid = 5 + (+this.Create_Policy.premium_paid);
                } else if (event == 'no') {
                    this.claimed = 'no';
                    this.claiming_price = null;
                    this.total_price = null;
                    this.getPolicy();
                }
            },
            SelectPayMethod(event) {
                this.Create_Policy.payment_method = event;
                this.payment_method_data.payment_method=event;

            },

            SelfDecalration(){
                this.form_declared = !this.form_declared;
                if(!this.form_declared){
                    this.form_declaration = 'Please check the self declaration box!';
                }else{
                    this.form_declaration = '';

                }
            },


            BuyPolicy() {
                if(this.Create_Policy.first_name == null || this.Create_Policy.first_name=="" || this.Create_Policy.first_name=="undefined" ||
                this.Create_Policy.last_name == null || this.Create_Policy.last_name=="" || this.Create_Policy.last_name=="undefined" ||
                this.Create_Policy.date_of_birth == null || this.Create_Policy.date_of_birth=="" ||
                this.Create_Policy.id_number == null || this.Create_Policy.id_number=="" ||
                this.Create_Policy.property_number == null || this.Create_Policy.property_number=="" ||
                this.Create_Policy.kadastral_number == null || this.Create_Policy.kadastral_number=="" ||
                this.Create_Policy.full_address == null || this.Create_Policy.full_address=="" ||
                this.Create_Policy.inside_image_1 == null || this.Create_Policy.inside_image_1=="" ||
                this.Create_Policy.inside_image_2 == null || this.Create_Policy.full_address=="" ||
                this.Create_Policy.inside_image_3 == null || this.Create_Policy.inside_image_3=="" ||
                this.Create_Policy.outside_image_1 == null || this.Create_Policy.outside_image_1=="" ||
                this.Create_Policy.outside_image_2 == null || this.Create_Policy.outside_image_2=="" ||
                this.Create_Policy.outside_image_3 == null || this.Create_Policy.outside_image_3=="" ||
                this.Create_Policy.image_4 == null || this.Create_Policy.image_4=="" ||
                this.Create_Policy.policy_start_date == null || this.Create_Policy.policy_start_date=="" ||
                this.claimed == null || this.claimed=="" ||
                this.Create_Policy.payment_method == null || this.Create_Policy.payment_method==""){
                    this.form_error = true;
                    return;
                }

                if(this.Create_Policy.add_second_driver == 'checked'){
                    if(this.Create_Policy.secoond_driver_first_name==null || this.Create_Policy.secoond_driver_first_name==''||
                    this.Create_Policy.secoond_driver_last_name==null || this.Create_Policy.secoond_driver_last_name=='' ||
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
                let formData = new FormData();
                formData.append('first_name', this.Create_Policy.first_name);
                formData.append('last_name', this.Create_Policy.last_name);
                 formData.append('prospect_name', this.Create_Policy.prospect_name);
                formData.append('date_of_birth', this.Create_Policy.date_of_birth);
                formData.append('id_number', this.Create_Policy.id_number);
                formData.append('square', this.Create_Policy.square);
                formData.append('policy_start_date', this.Create_Policy.policy_start_date);
                formData.append('policy_number', this.Create_Policy.policy_number);
                formData.append('policy_details_id', this.Create_Policy.policy_details_id);
                formData.append('policy_type', '74273e1bc257');
                formData.append('full_address', this.Create_Policy.full_address);
                formData.append('property_number', this.Create_Policy.property_number);
                formData.append('inside_image_1', this.Create_Policy.inside_image_1);
                formData.append('inside_image_2', this.Create_Policy.inside_image_2);
                formData.append('inside_image_3', this.Create_Policy.inside_image_3);
                formData.append('image_4', this.Create_Policy.image_4);
                formData.append('outside_image_1', this.Create_Policy.outside_image_1);
                formData.append('outside_image_2', this.Create_Policy.outside_image_1);
                formData.append('outside_image_3', this.Create_Policy.outside_image_3);
                formData.append('kadastral_number', this.Create_Policy.kadastral_number);
                formData.append('insuer_id', this.Create_Policy.insuer_id);
                formData.append('insurer_policy_id', this.Create_Policy.insurer_policy_id);
                formData.append('payment_method', this.Create_Policy.payment_method);
                formData.append('insurer_part', this.Create_Policy.insurer_part);
                formData.append('our_part', this.Create_Policy.our_part);
                formData.append('offer', this.Create_Policy.offer);
                formData.append('premium', this.Create_Policy.premium);
                formData.append('premium_paid', this.Create_Policy.premium_paid);
                formData.append('home_type', this.Create_Policy.home_type);
                formData.append('building_value', this.Create_Policy.building_value);
                formData.append('equipmennt_price', this.Create_Policy.equipmennt_price);
                formData.append('language', this.lang);
                localStorage.setItem('tpl_buy_policy_data', JSON.stringify(this.Create_Policy));

                axios.post(this.base_url + '/api/buy-policy/home-policy-save',
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
                                // window.location.href = this.base_url+'/cod/'+this.payment_method_data.policy_id+'/'+this.locale.policy_for_home+'/'+this.Create_Policy.policy_name;

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
                                // window.location.href = this.base_url+'/pay-bypaypal/'+this.payment_method_data.policy_id+'/'+this.locale.policy_for_home+'/'+this.Create_Policy.policy_name;
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
            console.log('Home Form Mounted');
            this.getPolicy();
            this.setUserDetails();
            this.getHomeData();
        },
    }

</script>
