<template>
    <div>
        <form role="form">
            <div class="container">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>{{locale.name}}</h6>
                                </div>
                                <input type="text" class="form-control" :placeholder="locale.name"
                                    v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.name">
                                <div class="form-error" v-if="form_error==true && shipping_details.name==null">
                                    <p>{{locale.provide_name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>{{locale.surname}}</h6>
                                </div>
                                <input type="text" class="form-control" :placeholder="locale.surname"
                                    v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.surname">
                                <div class="form-error" v-if="form_error==true && shipping_details.surname==null">
                                    <p>{{locale.provide_surname}}</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Email ID</h6>
                                </div>
                                <input type="text" class="form-control"
                                    :placeholder="Email Id" v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.email" v-on:input="TestVaildEmail()">
                                <div class="form-error" v-if="form_error==true && shipping_details.email==null">
                                    <p>Provide Email Id</p>
                                </div>
                                <div class="form-error" v-if="shipping_email_invalid==true">
                                    <p class="error-text"><small>Invalid Email ID</small></p>
                                </div>
                            </div>
                        </div>-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>{{locale.city}}</h6>
                                </div>
                                <input type="text" class="form-control" :placeholder="locale.city"
                                    v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.city">
                                <div class="form-error" v-if="form_error==true && shipping_details.city==null">
                                    <p>{{locale.city}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>{{locale.phone_number}}</h6>
                                </div>
                                <input type="text" class="form-control" :placeholder="locale.phone_number"
                                    v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.phone_number">
                                <div class="form-error" v-if="form_error==true && shipping_details.phone_number==null">
                                    <p>{{locale.provide_phone_number}}</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control"
                                    :placeholder="National Id" v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.national_id">
                                <div class="form-error" v-if="form_error==true && shipping_details.national_id==null">
                                    <p>Provide National Id</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    :placeholder="Company Name" v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.company_name">
                                <div class="form-error" v-if="form_error==true && shipping_details.company_name==null">
                                    <p>Provide Company Name</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    :placeholder="Tax Office" v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.tax_office">
                                <div class="form-error" v-if="form_error==true && shipping_details.tax_office==null">
                                    <p>Provide Tax Office</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control"
                                    :placeholder="Tax No." v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.tax_no">
                                <div class="form-error" v-if="form_error==true && shipping_details.tax_no==null">
                                    <p>Provide Tax Number</p>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-6 m-auto">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>{{locale.address}}</h6>
                                </div>
                                <textarea class="form-control" :placeholder="locale.address"
                                    v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.address"></textarea>
                                <div class="form-error" v-if="form_error==true && shipping_details.address==null">
                                    <p>{{locale.provide_address}}</p>
                                </div>
                            </div>
                        </div>
                      
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Town</h6>
                                </div>
                                <input type="text" class="form-control"
                                    placeholder="Town" v-on:input="CheckBillingDetailsValue()" v-model="shipping_details.town">
                                <div class="form-error" v-if="form_error==true && shipping_details.town==null">
                                    <p>Provide Town</p>
                                </div>
                            </div>
                        </div>-->
                        
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Zip Code</h6>
                                </div>
                                <input type="number" class="form-control" placeholder="Zip Code"
                                    v-model="shipping_details.zipcode">
                                <div class="form-error" v-if="form_error==true && shipping_details.zipcode==null">
                                    <p>Provide ZipCode</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Country</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="Country"
                                    v-model="shipping_details.shipping_country">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.shipping_country==null">
                                    <p>Provide Country</p>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="card-footer">
                    <input type="checkbox" class="shipping-billing-check" checked @click="CheckBillingDetails($event)"
                        :disabled="enable_button==false"> {{locale.same_as_shipping_details}}
                    <!--">Same as Shipping Details</button>-->
                </div>
                <!-- /.card-body -->
                <div class="billing-title" v-if="show_shipping_form==true">
                    <h1>Billing Details</h1>
                </div>

                <div class="card-body" v-if="show_shipping_form==true">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Name</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="Name"
                                     v-model="shipping_details.billing_name">
                                <div class="form-error"
                                    v-if="form_error==true && (shipping_details.billing_name==null || shipping_details.billing_name=='')">
                                    <p>Provide Name</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Surname</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="SurName"
                                     v-model="shipping_details.billing_surname">
                                <div class="form-error"
                                    v-if="form_error==true && (shipping_details.billing_surname==null || shipping_details.billing_surname=='')">
                                    <p>Provide Surname</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Email ID</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="Email Id"
                                     v-model="shipping_details.billing_email">
                                <div class="form-error" v-if="form_error==true && shipping_details.billing_email==null">
                                    <p>Provide Email Id</p>
                                </div>
                                <div class="form-error" v-if="billing_email_invalid==true">
                                    <p class="error-text"><small>Invalid Email ID</small></p>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>City</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="City"
                                     v-model="shipping_details.billing_city">
                                <div class="form-error"
                                    v-if="form_error==true && (shipping_details.billing_city==null || shipping_details.billing_city=='')">
                                    <p>Provide City</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="National Id" 
                                    v-model="shipping_details.billing_national_id">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.billing_national_id==null">
                                    <p>Provide National Id</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Company Name" 
                                    v-model="shipping_details.billing_company_name">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.billing_company_name==null">
                                    <p>Provide Company Name</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Tax Office" 
                                    v-model="shipping_details.billing_tax_office">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.billing_tax_office==null">
                                    <p>Provide Tax Office</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Tax No." 
                                    v-model="shipping_details.billing_tax_no">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.billing_tax_no==null">
                                    <p>Provide Tax Number</p>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Phone Number</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="Phone No."
                                    
                                    v-model="shipping_details.billing_phone_number">
                                <div class="form-error"
                                    v-if="form_error==true && (shipping_details.billing_phone_number==null || shipping_details.billing_phone_number=='')">
                                    <p>Provide Phone Number</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Town</h6>
                                </div>
                                <input type="text" class="form-control" placeholder="Town" 
                                    v-model="shipping_details.billing_town">
                                <div class="form-error" v-if="form_error==true && shipping_details.billing_town==null">
                                    <p>Provide Town</p>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-6 m-auto">
                            <div class="form-group">
                                <div class="input-label">
                                    <h6>Address</h6>
                                </div>
                                <textarea class="form-control" placeholder="Address"
                                    
                                    v-model="shipping_details.billing_address"></textarea>
                                <div class="form-error"
                                    v-if="form_error==true && (shipping_details.billing_address==null ||shipping_details.billing_address=='')">
                                    <p>Provide Address</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Zip Code" 
                                    v-model="shipping_details.billing_zipcode">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.billing_zipcode==null">
                                    <p>Provide ZipCode</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Country" 
                                    v-model="shipping_details.billing_country">
                                <div class="form-error"
                                    v-if="form_error==true && shipping_details.billing_country==null">
                                    <p>Provide Country</p>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-primary" @click="IsFormValid()">{{locale.continue}}</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        props: ['base_url', 'Auth', 'locale'],
        data() {
            return {
                shipping_details: {
                    name: null,
                    user_id: null,
                    surname: null,
                    email: null,
                    phone_number: null,
                    national_id: null,
                    company_name: null,
                    tax_office: null,
                    tax_no: null,
                    address: null,
                    town: null,
                    city: null,
                    zipcode: 1000,
                    shipping_country: 'Albania',
                    amount: null,
                    billing_name: null,
                    billing_surname: null,
                    billing_email: null,
                    billing_phone_number: null,
                    billing_national_id: null,
                    billing_company_name: null,
                    billing_tax_office: null,
                    billing_tax_no: null,
                    billing_address: null,
                    billing_town: null,
                    billing_city: null,
                    billing_zipcode: 1000,
                    billing_country: 'Albania',
                    policy_name: null,
                    offer_name: null,
                    car_registration_number:null,
                },
                form_error: false,
                enable_button: false,
                shipping_email_invalid: false,
                billing_email_invalid: false,
                show_shipping_form: false,
                policy_type: null,
                tpl_buy_policy_data:null,

                update_policy:{
                    delivery_address: null,
                    delivery_date: null,
                    delivery_time: null,
                    delivery_city: null,
                    policy_id: null,
                    car_registration_number: null,
                }
            }
        },
        methods: {
            IsFormValid() {

                if (this.shipping_details.name == null ||
                    this.shipping_details.surname == null ||
                    this.shipping_details.email == null ||
                    this.shipping_details.phone_number == null ||
                    // this.shipping_details.national_id == null ||
                    // this.shipping_details.company_name == null ||
                    // this.shipping_details.tax_office == null ||
                    // this.shipping_details.tax_no == null ||
                    this.shipping_details.address == null ||
                    // this.shipping_details.town == null ||
                    this.shipping_details.city == null ||
                    this.shipping_details.zipcode == null ||
                    this.shipping_details.shipping_country == null ||
                    this.shipping_details.billing_name == null ||
                    this.shipping_details.billing_surname == null ||
                    this.shipping_details.billing_email == null ||
                    this.shipping_details.billing_phone_number == null ||
                    // this.shipping_details.billing_national_id == null ||
                    // this.shipping_details.billing_company_name == null ||
                    // this.shipping_details.billing_tax_office == null ||
                    // this.shipping_details.billing_tax_no == null ||
                    this.shipping_details.billing_address == null ||
                    // this.shipping_details.billing_town == null ||
                    this.shipping_details.billing_city == null ||
                    this.shipping_details.billing_zipcode == null ||
                    this.shipping_details.billing_country == null ||
                    this.shipping_details.name == "" ||
                    this.shipping_details.surname == "" ||
                    this.shipping_details.email == "" ||
                    this.shipping_details.phone_number == "" ||
                    // this.shipping_details.national_id == "" ||
                    // this.shipping_details.company_name == "" ||
                    // this.shipping_details.tax_office == "" ||
                    // this.shipping_details.tax_no == "" ||
                    this.shipping_details.address == "" ||
                    // this.shipping_details.town == "" ||
                    this.shipping_details.city == "" ||
                    this.shipping_details.zipcode == "" ||
                    this.shipping_details.shipping_country == "" ||
                    this.shipping_details.billing_name == "" ||
                    this.shipping_details.billing_surname == "" ||
                    this.shipping_details.billing_email == "" ||
                    this.shipping_details.billing_phone_number == "" ||
                    // this.shipping_details.billing_national_id == "" ||
                    // this.shipping_details.billing_company_name == "" ||
                    // this.shipping_details.billing_tax_office == "" ||
                    // this.shipping_details.billing_tax_no == "" ||
                    this.shipping_details.billing_address == "" ||
                    // this.shipping_details.billing_town == "" ||
                    this.shipping_details.billing_city == "" ||
                    this.shipping_details.billing_zipcode == "" ||
                    this.shipping_details.billing_country == ""
                ) {
                    this.form_error = true;
                    return;

                }
                this.update_policy.delivery_address = this.shipping_details.address;
                this.update_policy.delivery_city = this.shipping_details.city;

                 
                if(this.policy_type =='c1bc21cfdda9'){
                       axios.post(this.base_url+'/api/buy-policy/tpl-save',
                        this.update_policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {

                    }
                );
                }else if(this.policy_type =='dfd3e39b733a'){

                     axios.post('/api/buy-policy/green-card-save',
                        this.update_policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {

                    }
                    );
                }else if(this.policy_type == 'c7824ee08a59'){
                    axios.post(this.base_url + '/api/buy-policy/full-casco-save',
                        this.update_policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                            
                        }
                    )
                    .then(res => {
                    });
                }else if(this.policy_type == '74273e1bc257'){
                    axios.post(this.base_url+'/api/buy-policy/home-policy-save',
                        this.update_policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {

                    });
                }else if(this.policy_type == '69e21f9783bd' || this.policy_type == '0ac2b7cfc696'){
                        axios.post(this.base_url+'/api/buy-policy/travel-policy-save',
                        this.update_policy, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                    });
                }

                var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (this.shipping_details.email.match(pattern) == null) {
                    this.shipping_email_invalid = true;
                    return;
                }
                if (this.shipping_details.billing_email.match(pattern) == null) {
                    this.billing_email_invalid = true;
                    return;
                }
                this.enable_button = true;
                console.log(this.update_policy)
                axios.post(this.base_url + '/api/user/shipping',
                        this.shipping_details, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        this.$toastr.success(res.data.message);
                            console.log(this.policy_type);

                        if(this.policy_type =='c1bc21cfdda9'){
                            if(this.tpl_buy_policy_data.payment_method=="Paypal"){
                                console.log('test');
                                window.location.href = this.base_url+'/pay-bypaypal/'+this.update_policy.policy_id+'/'+this.tpl_buy_policy_data.car_registration_number+'/'+this.tpl_buy_policy_data.policy_name;

                            }else if(this.tpl_buy_policy_data.payment_method=="Cod"){
                                window.location.href = this.base_url+'/cod/'+this.update_policy.policy_id+'/'+this.tpl_buy_policy_data.car_registration_number+'/'+this.tpl_buy_policy_data.policy_name;
                            
                            }else{
                                window.location.href = this.base_url + '/payment_all/'+this.update_policy.policy_id;
                            }
                        }else if(this.policy_type !='c1bc21cfdda9'){
                            if(this.tpl_buy_policy_data.payment_method=="Paypal"){
                                console.log('test');
                                window.location.href = this.base_url+'/pay-bypaypal/'+this.update_policy.policy_id+'/'+this.tpl_buy_policy_data.car_registration_number+'/'+this.tpl_buy_policy_data.policy_name;

                            }else if(this.tpl_buy_policy_data.payment_method=="Cod"){
                                window.location.href = this.base_url+'/cod/'+this.update_policy.policy_id+'/'+this.tpl_buy_policy_data.car_registration_number+'/'+this.tpl_buy_policy_data.policy_name;
                            
                            }else{
                                window.location.href = this.base_url + '/payment/'+this.update_policy.policy_id;
                            }
                        }



                    }).catch((error) => {

                    })

            },
            getUserDetails() {

                var tpl_buy_policy_data = JSON.parse(localStorage.getItem('tpl_buy_policy_data'));
                this.tpl_buy_policy_data = JSON.parse(localStorage.getItem('tpl_buy_policy_data'));
                
                this.shipping_details.amount = tpl_buy_policy_data.premium;
                this.shipping_details.policy_name = tpl_buy_policy_data.policy_name;
                this.shipping_details.offer_name = tpl_buy_policy_data.selected_offer;

                this.policy_type = tpl_buy_policy_data.policy_type;
                if(this.policy_type == 'c1bc21cfdda9' || this.policy_type == 'c7824ee08a59' || this.policy_type== 'dfd3e39b733a'){
                    this.update_policy.car_registration_number = tpl_buy_policy_data.car_registration_number;
                    this.shipping_details.car_registration_number = tpl_buy_policy_data.car_registration_number;
                }
                else{
                    this.update_policy.car_registration_number = null;
                    this.shipping_details.car_registration_number = null;
                }
                 

                var policy_created = JSON.parse(localStorage.getItem('policy_created'));

                this.update_policy.policy_id = policy_created;


                axios.get(this.base_url + '/api/user/details/en', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        this.shipping_details.name = res.data.message.first_name;
                        this.shipping_details.surname = res.data.message.last_name;
                        this.shipping_details.email = res.data.message.email;
                        this.shipping_details.user_id = res.data.message.user_id;
                        this.getUserShippingDetails();



                    });
            },
            getUserShippingDetails() {
                axios.get(this.base_url + '/api/user/get/shippings', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        if (res.data.data.length != 0) {
                            this.enable_button = true;


                        }
                        this.shipping_details.name = res.data.data[0].name;
                        this.shipping_details.surname = res.data.data[0].surname;
                        this.shipping_details.email = res.data.data[0].email;
                        this.shipping_details.phone_number = res.data.data[0].phone_number;
                        this.shipping_details.address = res.data.data[0].address;
                        this.shipping_details.city = res.data.data[0].city;
                        this.shipping_details.company_name = res.data.data[0].company_name;
                        this.shipping_details.national_id = res.data.data[0].national_id;
                        this.shipping_details.shipping_country = res.data.data[0].shipping_country;
                        this.shipping_details.shipping_id = res.data.data[0].shipping_id;
                        this.shipping_details.tax_no = res.data.data[0].tax_no;
                        this.shipping_details.tax_office = res.data.data[0].tax_office;
                        this.shipping_details.town = res.data.data[0].town;
                        this.shipping_details.zipcode = res.data.data[0].zipcode;
                        this.shipping_details.billing_name = res.data.data[0].billing_name;
                        this.shipping_details.billing_surname = res.data.data[0].billing_surname;
                        this.shipping_details.billing_email = res.data.data[0].billing_email;
                        this.shipping_details.billing_phone_number = res.data.data[0].billing_phone_number;
                        this.shipping_details.billing_address = res.data.data[0].billing_address;
                        this.shipping_details.billing_city = res.data.data[0].billing_city;
                        this.shipping_details.billing_company_name = res.data.data[0].billing_company_name;
                        this.shipping_details.billing_national_id = res.data.data[0].national_id;
                        this.shipping_details.billing_country = res.data.data[0].billing_country;
                        this.shipping_details.billing_id = res.data.data[0].billing_id;
                        this.shipping_details.billing_tax_no = res.data.data[0].billing_tax_no;
                        this.shipping_details.billing_tax_office = res.data.data[0].billing_tax_office;
                        this.shipping_details.billing_town = res.data.data[0].billing_town;
                        this.shipping_details.billing_zipcode = res.data.data[0].billing_zipcode;

                    });
            },
            CopyBillingDetails() {
                if (this.show_shipping_form == false) {
                    this.shipping_details.billing_name = this.shipping_details.name;
                    this.shipping_details.billing_surname = this.shipping_details.surname;
                    this.shipping_details.billing_email = this.shipping_details.email;
                    this.shipping_details.billing_phone_number = this.shipping_details.phone_number;
                    this.shipping_details.billing_national_id = this.shipping_details.national_id;
                    this.shipping_details.billing_company_name = this.shipping_details.company_name;
                    this.shipping_details.billing_tax_office = this.shipping_details.tax_office;
                    this.shipping_details.billing_tax_no = this.shipping_details.tax_no;
                    this.shipping_details.billing_address = this.shipping_details.address;
                    this.shipping_details.billing_town = this.shipping_details.town;
                    this.shipping_details.billing_city = this.shipping_details.city;
                    this.shipping_details.billing_zipcode = this.shipping_details.zipcode;
                    this.shipping_details.billing_country = this.shipping_details.shipping_country;

                } else if (this.show_shipping_form == true) {
                    this.shipping_details.billing_name = null;
                    this.shipping_details.billing_surname = null;
                    this.shipping_details.billing_email = null;
                    this.shipping_details.billing_phone_number = null;
                    this.shipping_details.billing_phone_number = null;
                    this.shipping_details.billing_company_name = null;
                    this.shipping_details.billing_tax_office = null;
                    this.shipping_details.billing_tax_no = null;
                    this.shipping_details.billing_address = null;
                    this.shipping_details.billing_town = null;
                    this.shipping_details.billing_city = null;
                    this.shipping_details.billing_zipcode = null;
                    this.shipping_details.billing_country = null;

                }

            },

            CheckBillingDetailsValue(event) {
                if (this.shipping_details.name == null ||
                    this.shipping_details.surname == null ||
                    this.shipping_details.email == null ||
                    this.shipping_details.phone_number == null ||
                    // this.shipping_details.national_id == null ||
                    // this.shipping_details.company_name == null ||
                    // this.shipping_details.tax_office == null ||
                    // this.shipping_details.tax_no == null ||
                    this.shipping_details.address == null ||
                    // this.shipping_details.town == null ||
                    this.shipping_details.city == null ||
                    this.shipping_details.zipcode == null ||
                    this.shipping_details.shipping_country == null) {
                    return;
                }
                this.enable_button = true;


                var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (this.shipping_details.email.match(pattern) == null) {
                    this.billing_email_invalid = false;
                    return;
                }
               
                this.shipping_details.billing_name = this.shipping_details.name;
                this.shipping_details.billing_surname = this.shipping_details.surname;
                this.shipping_details.billing_email = this.shipping_details.email;
                this.shipping_details.billing_phone_number = this.shipping_details.phone_number;
                this.shipping_details.billing_national_id = this.shipping_details.national_id;
                this.shipping_details.billing_company_name = this.shipping_details.company_name;
                this.shipping_details.billing_tax_office = this.shipping_details.tax_office;
                this.shipping_details.billing_tax_no = this.shipping_details.tax_no;
                this.shipping_details.billing_address = this.shipping_details.address;
                this.shipping_details.billing_town = this.shipping_details.town;
                this.shipping_details.billing_city = this.shipping_details.city;
                this.shipping_details.billing_zipcode = this.shipping_details.zipcode;
                this.shipping_details.billing_country = this.shipping_details.shipping_country;

            },
            TestVaildEmail() {
                var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (this.shipping_details.email.match(pattern) != null) {
                    this.billing_email_invalid = false;
                }
            },

            CheckBillingDetails(event) {
                if (event.target.checked == false) {
                    this.show_shipping_form = true;
                } else if (event.target.checked == true) {
                    this.show_shipping_form = false;

                }
                this.CopyBillingDetails();
            }

        },
        mounted() {
            console.log('Shipping Component Mounted');
            this.getUserDetails();
            // this.IsFormValid();
        },
    }

</script>
