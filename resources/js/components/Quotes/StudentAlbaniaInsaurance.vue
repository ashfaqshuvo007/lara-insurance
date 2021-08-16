<template>
    <div>
        <div id="studentAlbania" class="tab-pane fade show">
            <form action="#" method="POST" class="credential mt-3" @submit.prevent = "SaveStudentTravelAlbania">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{locale.date_of_birth}}
                            <datepicker name="dob" placeholder="dd/mm/yyyy" format="dd/MM/yyyy"
                                v-model="student_outside_albania.for_age">
                            </datepicker>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control signup_input_Select pr-5"
                                v-on:change="selectTravelZone( $event.target.value)">
                                <option :value="null" selected disabled>{{locale.travel_zone}}</option>
                                <option _ngcontent-fbk-c5="" :value="index"
                                v-for="zone,index in travel_zones" :key="index">{{zone}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{locale.date_of_birth}}
                            <datepicker name="dob" placeholder="dd/mm/yyyy" format="dd/MM/yyyy"
                                v-model="student_outside_albania.for_age">     
                            </datepicker>                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-input" 
                                    placeholder="Validity Days"
                                    v-model = "student_outside_albania.for_validity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{locale.select_start_date}}
                            <datepicker name="dob" format="dd/MM/yyyy"
                                :placeholder="locale.start_date"
                                :disabledDates="disabledDates"
                                v-model= "student_outside_albania.start_date">
                                </datepicker>
                        </div>
                    </div>
                </div>
                <div class="form-group-div no-gutters">
                    <div class="col-12">
                        <button class="btn addbuttons btn-block button_bottom" :disabled="loading">
                        <span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading" role="status"></span>
                        Show Price</button>
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
        props: ['token', 'country', 'baseUrl', 'selected_language'],
        data: function () {
            return {
                student_outside_albania: {
                    choose_contury_type: null,
                    for_age: null,
                    for_zone: null,
                    for_validity: null,
                    start_date: null,
                },
                travel_zone: {
                  country_type_id: null,
                  language_type: this.selected_language,
                },
                travel_zones: [],
                loading: false,
                disabledDates: {
                    to: new Date(Date.now() - 8640000)
                }

            }
        },
        methods: {

            get() {
                this.travel_zone.country_type_id=this.country;
                this.student_outside_albania.choose_contury_type=this.country;
                this.getTravelZone();

            },

            getTravelZone(){
                axios.post(this.baseUrl+'/api/policy/showTravelZone',
                        this.travel_zone, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.token
                            }
                        }
                    )
                    .then(res => {
                        this.travel_zones= res.data.message;
                    }
                );
            },

            selectTravelZone(event){
                this.student_outside_albania.for_zone=event;
                
            },

            SaveStudentTravelAlbania(){

                //Calculating age from give date***
                this.loading = true;
                this.student_outside_albania.for_age = new Date(this.student_outside_albania.for_age);
                var diff_ms = Date.now() - this.student_outside_albania.for_age.getTime();
                var age_dt = new Date(diff_ms);                
                this.student_outside_albania.for_age = Math.abs(age_dt.getUTCFullYear() - 1970);
                
                this.student_outside_albania.for_age = this.student_outside_albania.for_age.toString()
                this.student_outside_albania.start_date = this.student_outside_albania.start_date.split('T')[0];

                axios.post(this.baseUrl+'/api/policy/showTravelList',
                        this.student_outside_albania, {
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
                    }
                ).catch((error) => {
                    console.log(error);
                    this.loading = false;
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                   
                })

            }
        },
        mounted() {
            console.log('Component mounted.')
            console.log('Student',this.baseUrl);

            this.get();

        }
    }

</script>
