<template>
    <div>
        <div id="menu2" class="tab-pane fade">
            <br>
            <form class="credential" action="" method="POST" @submit.prevent="SaveCasco(locale.casco_error)">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectCar( $event.target.value)">
                                <option :value="null" selected disabled >---{{locale.select_car}}---</option>
                                <option _ngcontent-fbk-c5="" :value="list.car_registration_number"
                                    v-for="list in vehicle_list" :key="list.id">{{list.car_registration_number}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-input" 
                                :placeholder="locale.production_year"
                                v-model="production_year" :disabled="no_edit==true" v-on:input="SetProdectionYear($event)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-input" 
                                :placeholder="locale.car_value"
                                v-model="casco.car_value">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectVarient( $event.target.value)">
                                <option _ngcontent-fbk-c5="" value="other">{{locale.varient}}</option>
                                <option _ngcontent-fbk-c5="" :value="list.casco_type_id"
                                    v-for="list in varient_list" :key="list.id">{{list.varient_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <i class="fa fa-info-circle info-icon"></i>
                    </div>
                </div>
                <div class="form-group-div  no-gutters">
                    <div class="col-12">
                        <button class="btn addbuttons btn-block button_bottom" @click="ScrollToPoilicies($event)" 
                            :disabled="loading">
                        <span class="spinner-border spinner-border-sm text-light mr-2" 
                            v-if="loading" role="status"></span>
                        {{locale.show_price}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['token','baseUrl','locale'],
        data: function () {
            return {
                vehicle_list: [],
                varient_list: [],
                casco:{
                    car_registration_no: null,
                    production_year: null,
                    car_value: null,
                    varient_type: null,
                },
                production_year: null,
                loading: false,
                No_Quotes: [],
                no_edit: false,
            }
        },
        methods: {
            getCarList() {
                axios.get(this.baseUrl+'/api/car/showCarlist', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.token
                        }
                    })
                    .then(res => {
                        this.vehicle_list = res.data.car_list;
                       
                    }
                );
            },

            selectCar(car) {
                console.log('prod',this.production_year);
                this.casco.car_registration_no = car;
                for(let i of this.vehicle_list){
                    if(i.car_registration_number==this.casco.car_registration_no){
                        this.casco.production_year = i.production_year;

                        if(i.car_tpye=='5387b8bf5632'){ 
                            this.no_edit = true;
                            
                            if(i.production_year>2010){
                                this.production_year = 'Newer than 2010';
                            }else if(i.production_year<=2010){
                                this.production_year = '2010 or older';

                            }
                        }else{
                            console.log(this.production_year);
                            this.casco.production_year = null;
                             this.production_year = '';
                             this.casco.production_year= null;
                             this.no_edit = false;
                        }
                        
                        break;
                    }
                }
            },

           SetProdectionYear($event){
               this.casco.production_year = this.production_year;
            },

            getVarient(){
                axios.get(this.baseUrl+'/api/policy/get-full-casco-sub-type', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.token
                        }
                    })
                    .then(res => {
                        this.varient_list = res.data.message;
                       
                    }
                );
            },

            selectVarient(varient) {
                this.casco.varient_type = varient;
            },

            SaveCasco(casco_error){
                this.loading = true;
                if(this.casco.production_year!=null && this.casco.production_year<=2010){
                    this.loading = false;
                    this.$toastr.warning('kasko can not be offered for cars older than 10 years');
                    this.$emit('child-method', this.No_Quotes,this.casco);
                    return;
                }
                else if(this.casco.production_year==null){
                    this.loading = false;
                    this.$toastr.warning(casco_error);
                    this.$emit('child-method', this.No_Quotes,this.casco);
                    return;
                }
                localStorage.setItem('full_casco_data', JSON.stringify(this.casco));
                /*if(!this.casco.car_registration_no || !this.casco.production_year || !this.car_value || !this.casco.varient_type){
                    this.$toastr.error(this.locale.casco_error);
                    return; 
                }*/
                axios.post(this.baseUrl+'/api/policy/showFullCasco',
                        this.casco, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.token
                            }
                        }
                    )
                    .then(res => {
                        this.loading = false;
                        this.$toastr.success('Successfully found the policy list');
                        this.$emit('child-method', res.data,this.casco);
                    }
                ).catch((error) => {
                   this.loading = false;
                    if (error.response) {
                        this.$toastr.error(this.locale.casco_error);
                    }
                    this.$emit('child-method', this.No_Quotes,this.casco);

                });
            },

            ScrollToPoilicies(ev) {
                //Rahul Code
                var elemTopPoint = ev.pageY;
                console.log(elemTopPoint);
                window.scroll(0, (elemTopPoint - 150));
            }

        },
        mounted() {
            console.log('Component mounted.')

            this.getCarList();
            this.getVarient();
        }
    }
</script>
