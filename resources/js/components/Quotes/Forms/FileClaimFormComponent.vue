<template>
    <form role="form" @submit.prevent="ClaimPolicy">
        <div class="container">
            <div class="card-body">
                <div class="form-group">
                    <label>{{locale.incident_date_time}}:</label>
                    <div class="input-group time" id="timepicker">
                        <input class="form-control" type="date" value="YYYY-MM-DD" id="example-date-input" v-model="Claim.incident_date"><span class="input-group-append input-group-addon"></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1"
                        :placeholder="locale.incident_location">
                </div>
                <label for="exampleInputFirstName1">{{locale.details_of_vehicle}}:</label>
                <div class="row">
                    <div class=col-sm-12>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1"
                                :placeholder="locale.license_plate_number" v-model="Claim.plate_number">
                        </div>
                    </div>
                    <!-- <div class=col-sm-12>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1" :placeholder="locale.license_plate_number"
                                v-model="Claim.type_model">
                        </div>
                    </div> -->
                    <div class=col-sm-12>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1"
                                :placeholder="locale.first_last_name" v-model="Claim.name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{locale.dl_group}}:</label>
                    <select class="form-control"  v-on:change="selectDL($event.target.value)">
                        <option :value="null" selected disabled>---{{locale.select}}---</option>
                        <option value="DL Group 1">DL Group 1</option>
                        <option value="DL Group 2">DL Group 2</option>
                        <option value="DL Group 3">DL Group 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="3" :placeholder="locale.incident_description"
                        v-model="Claim.incident_description"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{locale.people_in_car}}</label>
                            <select class="form-control"  v-on:change="SelectPeopleInCar($event.target.value)">
                                <option :value="null" selected disabled>---{{locale.select}}---</option>    
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputFirstName1"
                                :placeholder="locale.vehicle_location" v-model="Claim.incident_location">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{locale.i_ask_for}}:</label>
                    <select class="form-control" v-on:change="SelectClaimDemand($event.target.value)">
                        <option :value="null" selected disabled>---{{locale.select}}---</option>
                        <option value="Payment">Payment</option>
                        <option value="Repair">Repair</option>
                    </select>
                </div>
                <div class="row" v-if="ShowBankDetails==true">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFirstName1" placeholder="Bank"
                            v-model="Claim.bank_name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFirstName1" placeholder="Account Number"
                            v-model="Claim.account_number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.upload_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectFIle1($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.upload_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectFIle2($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.upload_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectFIle3($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{locale.upload_photo}}:</label>
                            <div class="file__inputGrp mb-4 mb-md-0">
                                <input type="file" name="file" class="file__input" v-on:change="SelectFIle4($event)">
                                <input type="text" :placeholder="locale.upload_image" class="form-control file__input-fake">
                            </div>
                        </div>
                    </div>




                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2">
                    <label for="customCheckbox2" class="custom-control-label">{{locale.check_me_out}}</label>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer" :disabled="loading">
                <button type="submit" class="btn btn-primary"><span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading" role="status"></span>
                {{locale.submit}}</button>
            </div>
        </div>

    </form>
</template>
<script>
    export default {
        props: [
            'base_url',
            'Auth',
            'locale',
        ],
        data: function () {
            return {
                policy_list: [],
                show_button: false,
                policy_data: null,
                Claim: {
                    incident_date: null,
                    incident_location: null,
                    plate_number: null,
                    type_model: null,
                    name: null,
                    DL_group: null,
                    people_in_car: null,
                    claim_demand: null,
                    bank_name: null,
                    account_number: null,
                    policy_id: null,
                    incident_description: null,
                    insurer_id: null,
                    insurer_policy_id: null,
                    policy_type: null,
                    image_1: null,
                    image_2: null,
                    image_3: null,
                    image_4: null,
                },
                ShowBankDetails: false,
                loading: false,

            }
        },

        methods: {
            getClaimingPolicy() {
                this.policy_data = JSON.parse(localStorage.getItem('claimed_policy'));
                console.log(this.policy_data);
                this.Claim.policy_id = this.policy_data.policy_id;
                this.Claim.insurer_id = this.policy_data.insurer_id;
                this.Claim.insurer_policy_id = this.policy_data.policy_details.insurer_policy_id;
                this.Claim.policy_type = this.policy_data.type.policy_sub_type_id;

            },
            selectDL(event) {
                this.Claim.DL_group = event;
            },
            SelectPeopleInCar(event) {
                this.Claim.people_in_car = event;
            },
            SelectClaimDemand(event) {
                if (event == 'Repair') {
                    this.ShowBankDetails = false;
                    this.Claim.bank_name = null;
                    this.Claim.account_number = null;
                } else {
                    this.ShowBankDetails = true;
                }

                this.Claim.claim_demand = event;
            },

            SelectFIle1(event) {
                console.log(event);
                console.log( event.target.files);
                console.log( event.target.files[0]);
                this.Claim.image_1 = event.target.files[0];
                console.log(this.Claim.image_1)
            },
            
            SelectFIle2(event) {
                this.Claim.image_2 = event.target.files[0];
            },
            SelectFIle3(event) {
                this.Claim.image_3 = event.target.files[0];
            },
            SelectFIle4(event) {
                this.Claim.image_4 = event.target.files[0];
            },

            ClaimPolicy() {
                this.loading=true
                let formData = new FormData();
                
                console.log()
                formData.append('incident_date', this.Claim.incident_date);
                formData.append('incident_location', this.Claim.incident_location);
                formData.append('policy_id', this.Claim.policy_id);
                formData.append('incident_description', this.Claim.incident_description);
                formData.append('insurer_id', this.Claim.insurer_id);
                formData.append('insurer_policy_id', this.Claim.insurer_policy_id);
                formData.append('policy_type', this.Claim.policy_type);
                formData.append('image_1', this.Claim.image_1);
                formData.append('image_2', this.Claim.image_2);
                formData.append('image_3', this.Claim.image_3);
                formData.append('image_4', this.Claim.image_4);
                formData.append('type_model', this.Claim.type_model);
                formData.append('plate_number', this.Claim.plate_number);
                formData.append('DL_group', this.Claim.DL_group);
                formData.append('name', this.Claim.name);
                formData.append('people_in_car', this.Claim.people_in_car);
                formData.append('claim_demand', this.Claim.claim_demand);
                formData.append('bank_name', this.Claim.bank_name);
                formData.append('account_number', this.Claim.account_number);

                axios.post(this.base_url + '/api/claim/car-policy',
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        this.loading=false;
                        console.log(res);
                        this.$toastr.success('Successfully Filed Claim');

                    }).catch((error) => {
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
            this.getClaimingPolicy()
            console.log(this.base_url)


        }
    }

</script>
