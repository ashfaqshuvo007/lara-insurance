<template>
    <div>

        <div id="travelAlbania" class="tab-pane fade show active" @submit.prevent="SaveTravelAlbania(locale.error_msg)">
            <form class="credential mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{locale.travel_zone}}
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectTravelZone( $event.target.value)">
                                <option :value="null" selected disabled>{{locale.travel_zone}}</option>
                                <option _ngcontent-fbk-c5="" :value="index" v-for="zone,index in travel_zones" :key="index">{{zone}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{locale.date_of_birth}}
                            <datepicker name="dob" placeholder="dd/mm/yyyy" format="dd/MM/yyyy"
                            v-model="travel_outside_albania.for_age">
                            </datepicker>
                        </div>
                    </div>
                </div>
               
                <div class="form-group-div no-gutters">
                <h6><b>{{locale.select_travel_date}} :</b></h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{locale.select_start_date}}
                                <datepicker :placeholder="locale.start_date"
                                    v-model="travel_outside_albania.start_date" :disabledDates="disabledDates" v-on:selected="SelectStartDate(travel_outside_albania.start_date)" format="dd/MM/yyyy">
                                </datepicker>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{locale.select_end_date}}
                                <datepicker :placeholder="locale.end_date"
                                    v-model="travel_outside_albania.end_date"  :disabledDates="disabledDates" v-on:selected="SelectEndDate(travel_outside_albania.end_date)" format="dd/MM/yyyy">
                                    </datepicker>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group-div mt-3 no-gutters" v-if="travel_outside_albania.for_validity!=null">
                    <div class="col-12">
                        <div class="form-group">
                           <h6>{{locale.validity}} : </h6>
                           <span class="validity-number">{{travel_outside_albania.for_validity}} {{locale.days}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group-div no-gutters">
                    <div class="col-12">
                        <button class="btn addbuttons btn-block button_bottom" :disabled="loading" @click="ScrollToPolicies($event)">
                        <span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading" role="status"></span>
                        {{locale.show_price}}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker,
        },
        props: ['token', 'country', 'baseUrl','locale', 'selected_language'],
        data: function () {
            return {
                travel_outside_albania: {
                    choose_contury_type: null,
                    for_age: null,
                    for_zone: null,
                    for_validity: null,
                    start_date: null,
                    end_date: null,
                    dob: null,
                },
                travel_zone: {
                    country_type_id: null,
                    language_type: this.selected_language,
                },
                travel_zones: [],
                loading: false,
                No_Quotes: [],
                disabledDates: {
                    to: new Date(Date.now() - 8640000)
                }
            }
        },
        methods: {

            get() {
                this.travel_zone.country_type_id = this.country;
                this.travel_outside_albania.choose_contury_type = this.country;
                this.getTravelZone();

            },

            getTravelZone() {
                axios.post(this.baseUrl + '/api/policy/showTravelZone',
                        this.travel_zone, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.token
                            }
                        }
                    )
                    .then(res => {
                        this.travel_zones = res.data.message;
                    });
            },

            selectTravelZone(event) {
                this.travel_outside_albania.for_zone = event;
                

            },
            
            SelectStartDate(event) {
                this.$nextTick(() => {
                     
                    if(this.travel_outside_albania.start_date !== null &&  this.travel_outside_albania.end_date !== null){
                        if(this.travel_outside_albania.start_date > this.travel_outside_albania.end_date){
                            this.travel_outside_albania.for_validity = null;
                            this.$toastr.warning('End date must be more than Start date');
                            return;
                        }
                        var date1 = new Date( this.travel_outside_albania.start_date); 
                        var date2 = new Date(this.travel_outside_albania.end_date); 
                        var Difference_In_Time = date2.getTime() - date1.getTime();
                        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24); 
                        this.travel_outside_albania.for_validity = Difference_In_Days;
                        this.travel_outside_albania.for_validity = this.travel_outside_albania.for_validity.toString();
                        // console.log(this.travel_outside_albania.for_validity)
                    }
                })
            },


            SelectEndDate(event) {
                console.log(this.travel_outside_albania.end_date,'end date');

                this.$nextTick(() => {

                    
                    if(this.travel_outside_albania.start_date !== null && this.travel_outside_albania.end_date !== null){
                        if(this.travel_outside_albania.start_date > this.travel_outside_albania.end_date){
                            this.travel_outside_albania.for_validity = null;
                            this.$toastr.warning('End date must be more than Start date');
                            return;
                        }
                        var date1 = new Date( this.travel_outside_albania.start_date); 
                        var date2 = new Date(this.travel_outside_albania.end_date); 
                        var Difference_In_Time = date2.getTime() - date1.getTime();
                        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24); 
                        this.travel_outside_albania.for_validity = Difference_In_Days;
                        this.travel_outside_albania.for_validity = this.travel_outside_albania.for_validity.toString();
                    } 
                })
            },

            SaveTravelAlbania(error_msg) {
                this.loading = true;
               
                //Calculating age from give date***
                this.travel_outside_albania.dob = this.travel_outside_albania.for_age;
                this.travel_outside_albania.for_age = new Date(this.travel_outside_albania.for_age);
                var diff_ms = Date.now() - this.travel_outside_albania.for_age.getTime();
                var age_dt = new Date(diff_ms);
                this.travel_outside_albania.for_age = Math.abs(age_dt.getUTCFullYear() - 1970);

                this.travel_outside_albania.for_age = this.travel_outside_albania.for_age.toString();
                this.travel_outside_albania.start_date = new Date(this.travel_outside_albania.start_date).toISOString();
                this.travel_outside_albania.start_date = this.travel_outside_albania.start_date.split('T')[0];
                console.log(this.travel_outside_albania);

                localStorage.setItem('travel_data', JSON.stringify(this.travel_outside_albania));

                axios.post(this.baseUrl + '/api/policy/showTravelList',
                        this.travel_outside_albania, {
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
                        this.$emit('child-method', res.data);
                    }).catch((error) => {
                        this.loading = false;
                        if (error.response) {
                            this.$toastr.error(error_msg);
                        }
                        this.$emit('child-method', this.No_Quotes);

                   
                })

            },

            date(date){
                if(this.travel_outside_albania.start_date!=null && this.travel_outside_albania.start_date!='' && this.travel_outside_albania.end_date!=null && this.travel_outside_albania.end_date!=null){
                    
                }
            },
            ScrollToPolicies(ev) {
                var elemTopPoint = ev.pageY;
                window.scroll(0, (elemTopPoint - 160));
            }
        },
        mounted() {


            this.get();


        }
    }
</script>