<template>
    <div>
        <form class="w-100 pull-left"  @submit.prevent="saveForm">
         <h5 class="mb-4" style="font-weight: 600;" v-if="car_id==null">{{locale.add_car}}
        </h5>
        <h5 class="mb-4" style="font-weight: 600;" v-if="car_id!=null">{{locale.edit_car}}
        </h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form_input">
                            <input type="text" class="form-control form-control-input" 
                            :placeholder="locale.car_registration_number"
                            v-model="addCar.car_registration_number" v-on:input="SetRegistration()">
                        </div>
                        <div class="form-error" v-if="car_registration_number_error==true">
                            <p>{{locale.provide_reg_no}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form_input">
                            <input type="text" class="form-control form-control-input" 
                            :placeholder="locale.car_vin_number"
                            v-model="addCar.car_vin_number" v-on:input="SetVinNumber()">
                        </div>
                        <div class="form-error" v-if="car_vin_number_error==true">
                            <p>{{locale.provide_car_no}}</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select _ngcontent-fbk-c5="" 
                            class="credential__select form-control signup_input_Select pr-5"
                             v-on:change="selectCarTypeValue( $event.target.value)">
                            <option :value="null" selected disabled>---{{locale.select}}---</option>
                            <option _ngcontent-fbk-c5="" :value="index" v-for="index,vehicle  in vehicle_types" :key="index"
                                :selected="index==addCar.car_type" >{{vehicle}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select _ngcontent-fbk-c5="" 
                            class="credential__select form-control signup_input_Select pr-5" 
                            v-on:change="selectCarSubType( $event.target.value)">
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='5387b8bf5632'">{{locale.select_engine}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='d931b542bcad'">{{locale.select_engine}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='0c0361f6647e'">{{locale.select_your_seat}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='22b8a3a60595'">{{locale.select_your_seat}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='bacb3f1ffff6'">{{locale.select_your_weight}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='c32b0536df2f'">{{locale.type}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='497a41074388'">{{locale.type}}</option>
                            <option _ngcontent-fbk-c5="" :value="null" v-if="this.addCar.car_tpye=='a51933d621cb'">{{locale.type}}</option>
                            <option _ngcontent-fbk-c5="" :value="index" v-for="index,vehicle_sub_type  in vehicle_sub_types" :key="index" :selected="index==addCar.car_sub_type">{{vehicle_sub_type}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" v-if="this.addCar.car_tpye=='5387b8bf5632'">
                        <select _ngcontent-fbk-c5="" 
                            class="credential__select form-control signup_input_Select pr-5"
                            v-on:change="selectCarProductionYear($event.target.value)">
                            <option _ngcontent-fbk-c5="" :value="null" :selected="addCar.production_year==null">{{locale.production_year}}</option>
                            <option _ngcontent-fbk-c5="" :value="2011" :selected="addCar.production_year>2010">{{locale.newer_than_2010}}</option>
                            <option _ngcontent-fbk-c5="" :value="2009" :selected="addCar.production_year!=null&&addCar.production_year<=2010">{{locale.older}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn addbuttons btn-main" :disabled="loading">
            <span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading" role="status"></span>
                {{locale.save}}
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['token','baseUrl', 'carDetail', 'locale', 'selected_language'],
        data: function () {
            return {
                addCar: {
                    car_registration_number: null,
                    car_vin_number: null,
                    car_sub_type: null,
                    car_tpye: null,
                    production_year: null,
                },
                car_id : null,
                language_type:this.selected_language,
                vehicle_types: [],
                carSubTypeData: {
                    language_type:this.selected_language,
                },
                vehicle_sub_types:[],
                loading: false,
                car_registration_number_error: false,
                car_vin_number_error: false,
                car_type_error: false,
                car_sub_type_error: false,
                production_year_error: false,
            }
        },
         methods: {
            getCarType(){
                axios.get(this.baseUrl+'/api/policy/tpl-type/'+this.language_type,
                {   headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: "Bearer "+this.token
                    }
                })
                    .then(res => {
                    this.vehicle_types=res.data.message;
                    
                });
            },
             getCarSubType(){
                axios.post(this.baseUrl+'/api/policy/tpl-sub-type',
                this.carSubTypeData,
                    {headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: "Bearer "+this.token
                    }}
                    )
                    .then(res => {
                    this.vehicle_sub_types=res.data.message;
                    
                });
            },
            saveForm() {
                this.loading=true;
                console.log(this.addCar);
                if((this.addCar.car_registration_number==null || 
                    this.addCar.car_registration_number=='') && 
                    (this.addCar.car_tpye==null || 
                    this.addCar.car_tpye=='') && 
                    (this.addCar.car_sub_type==null || 
                    this.addCar.car_sub_type=='') && 
                    (this.addCar.production_year==null || 
                    this.addCar.production_year=='')&& 
                    (this.addCar.car_vin_number==null || 
                    this.addCar.car_vin_number=='')){
                        console.log('return');
                        this.loading = false;
                    this.car_registration_number_error = true;
                    this.car_vin_number_error = true;
                    this.car_type_error = true;
                    this.car_sub_type_error = true;
                    this.production_year_error = true;
                    return
                }
                
                if(this.car_id==null){
                    axios.post(this.baseUrl+'/api/car/add-car',
                    this.addCar ,
                    {headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: "Bearer "+this.token
                    }}
                    )
                    .then(res => {
                        this.loading=false;
                        this.$toastr.success('Car Added Successfully');

                        this.$emit('child-method', 'added_car')
                    }).catch((error) => {
                        console.log(error);
                        this.loading = false;
                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }

                   
                    });
                }else if(this.car_id!=null){
                    axios.put(this.baseUrl+'/api/car/'+this.addCar.car_registration_number,
                    this.addCar ,
                    {headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: "Bearer "+this.token
                    }}
                    )
                    .then(res => {
                        this.loading=false;
                        this.$toastr.success('Car Updated Successfully');

                        this.$emit('child-method', 'added_car')
                    }).catch((error) => {
                        console.log(error);
                        this.loading = false;
                        this.$toastr.error('Something went wrong. Please try again ');

                    })
                }
                   
            },
            selectCarTypeValue(car_type){
                this.addCar.car_tpye=car_type
                this.carSubTypeData.tpl_type_id=car_type;

                this.getCarSubType();

            },
            selectCarSubType(car_sub_type){
                this.addCar.car_sub_type=car_sub_type

            },
            selectCarProductionYear(production_year){
                this.addCar.production_year=production_year

            },

            mapCarData(){
                console.log(this.carDetail);
                if(this.carDetail!=null){
                    this.car_id = this.carDetail.car_id; 
                    this.addCar.car_type = this.carDetail.car_tpye;
                    console.log(this.carDetail.car_tpye);

                    this.carSubTypeData.tpl_type_id=this.carDetail.car_tpye;
                    console.log(this.carSubTypeData.tpl_type_id);
                    this.selectCarTypeValue(this.addCar.car_type);
                    console.log(this.carSubTypeData.tpl_type_id);


                    this.addCar.car_registration_number = this.carDetail.car_registration_number;
                    this.addCar.car_vin_number = this.carDetail.car_vin_number;
                    if(this.carDetail.production_year!=null && this.carDetail.production_year!= ''){
                        this.addCar.production_year = this.carDetail.production_year;
                    }                    

                    this.addCar.car_sub_type = this.carDetail.car_sub_type;;
                    console.log(this.addCar)
                }
                
            },

            SetRegistration(){
                this.car_registration_number_error = false;
            },

            SetVinNumber(){
                this.car_vin_number_error = false;
            },
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.selected_language);
            this.mapCarData();

            this.getCarType();
        }
    }

</script>
