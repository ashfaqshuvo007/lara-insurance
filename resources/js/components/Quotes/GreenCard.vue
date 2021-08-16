<template>
    <div>
        <div id="menu1" class="tab-pane fade">
            <br>
            <form class="credential" action="" method="POST" @submit.prevent="SaveGreenCard(locale.car_error)">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectCar( $event.target.value)">
                                <option v-if="green_card.select_car==null" :value="null" selected disabled>
                                    ---{{locale.select_car}}---</option>
                                <option _ngcontent-fbk-c5="" :value="list.car_registration_number"
                                    v-for="list in vehicle_list" :key="list.id">{{list.car_registration_number}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="check" hidden v-model="green_card.other_car"
                                    @click="Select($event)">
                                <label for="check" class="checkmark">
                                    <p>{{locale.other_car}}</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" v-if="green_card.select_car!=null || green_card.other_car!=false">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectTravelZone( $event.target.value)">
                                <option v-if="green_card.green_card_type==null" :value="null" selected disabled>
                                    {{locale.travel_zone}}</option>
                                <option _ngcontent-fbk-c5="" :value="list.green_card_type_id"
                                    v-for="list in travel_zone" :key="list.id">{{list.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" v-if="green_card.other_car!=false || show_vehicle_type==true">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectVehicleType( $event.target.value)">
                                <option :value="null" selected disabled>{{locale.vehicle_type}}</option>
                                <option _ngcontent-fbk-c5="" :value="list.green_card_sub_type_id"
                                    v-for="list in vehicle_types" :key="list.id">{{list.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" v-if="green_card.select_car!=null || green_card.other_car!=false">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectValidaty( $event.target.value)">
                                <option :value="null" selected disabled>{{locale.validity_period}}</option>
                                <option _ngcontent-fbk-c5="" :value="list.days" v-for="list in validity_days"
                                    :key="list.id">
                                    {{list.days}}</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" v-if="green_card.other_car!=false || green_card.select_car_value!=false">
                            <input type="text" class="form-control form-control-input" 
                                :placeholder="locale.car_registration_number"
                                v-model="green_card.car_registration_number">
                        </div>
                    </div>
                   

                </div>
                <div class="form-group-div mt-3 mb-3  no-gutters">
                    <div class="col-12">
                        <button class="btn addbuttons btn-block button_bottom" @click="ScrollToPolicies($event)"
                            :disabled="loading">
                            <span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading"
                                role="status"></span>
                            {{locale.check_price}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['token', 'baseUrl', 'locale', 'selected_language'],
        data: function () {
            return {
                vehicle_list: [],
                green_card: {
                    select_car: null,
                    other_car: false,
                    select_car_value: false,
                    green_card_type: null,
                    green_card_sub_type: null,
                    for_how_many_days: null,
                    car_registration_number: null
                },
                language_type: this.selected_language,
                travel_zone: [],
                vehicle_type: {
                    green_card_type_id: null,
                    language_type: this.selected_language,
                },
                vehicle_types: [],
                validity_days: [],
                loading: false,
                show_vehicle_type: false,
                No_Quotes: []

            }
        },
        methods: {
            getCarList() {
                axios.get(this.baseUrl + '/api/car/showCarlist', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.token
                        }
                    })
                    .then(res => {
                        this.vehicle_list = res.data.car_list;

                    });
            },

            selectCar(car) {
                this.green_card.green_card_type = null;
                this.green_card.green_card_sub_type = null;
                this.green_card.select_car = car;
                this.green_card.other_car = false;
                for (let i of this.vehicle_list) {
                    if (i.car_registration_number == car) {
                        console.log('data', i);
                        console.log('matched', i.car_tpye, '5387b8bf5632', i.car_tpye == '5387b8bf5632');
                        if (i.car_tpye == '5387b8bf5632') {
                            console.log('car');
                            this.show_vehicle_type = false;
                        } else {
                            this.show_vehicle_type = true;
                        }

                        break;
                    }
                }
                console.log('show vehicle', this.show_vehicle_type);
                this.getTravelZone();

            },

            getTravelZone() {
                axios.get(this.baseUrl + '/api/policy/green-card-type/' + this.language_type, {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.token
                        }
                    })
                    .then(res => {
                        this.travel_zone = res.data.green_card_type_list;

                    });
            },

            selectTravelZone(green_card_type_id) {
                this.green_card.green_card_type = green_card_type_id,
                    this.vehicle_type.green_card_type_id = green_card_type_id,
                    this.getVehicleType();

            },

            getVehicleType() {
                axios.post(this.baseUrl + '/api/policy/green-card-sub-type',
                        this.vehicle_type, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.token
                            }
                        }
                    )
                    .then(res => {
                        this.vehicle_types = res.data.get_sub_type_deatails;
                        this.validity_days = res.data.green_card_days;
                        if (this.show_vehicle_type == false) {
                            this.green_card.green_card_type = '9e1cd2ba817a';
                            this.green_card.green_card_sub_type = 'c21ff7205d80';
                        }

                    });
            },

            selectVehicleType(green_card_sub_type_id) {
                this.green_card.green_card_sub_type = green_card_sub_type_id;

            },

            selectValidaty(Validity) {
                this.green_card.for_how_many_days = Validity;

            },

            Select(event) {
                this.green_card.other_car = !this.green_card.other_car;
                this.green_card.green_card_type = null,
                    this.vehicle_type.green_card_type_id = null,
                    this.green_card.select_car = null;
                this.getTravelZone();
            },

            SaveGreenCard(car_error) {
                this.loading = true;
                console.log(this.green_card);
                if (this.green_card.green_card_sub_type == null) {
                     this.$toastr.warning(car_error);
                    this.loading = false;
                    this.$emit('child-method', this.No_Quotes);
                    return;

                }
                localStorage.setItem('green_card_data', JSON.stringify(this.green_card));
                axios.post(this.baseUrl + '/api/policy/green-card',
                        this.green_card, {
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
                        this.$emit('child-method', res.data)
                    }).catch((error) => {
                        console.log(error);
                        this.loading = false;
                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }
                        this.$emit('child-method', this.No_Quotes);


                    })
            },

            ScrollToPolicies(ev) {
                var elemTopPoint = ev.pageY;
                window.scroll(0, (elemTopPoint - 160));
            }

        },
        mounted() {
            console.log('Component mounted.')
            console.log('green', this.baseUrl);

            this.getCarList();
        }
    }

</script>
