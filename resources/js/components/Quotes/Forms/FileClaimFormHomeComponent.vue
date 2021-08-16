<template>
    <form role="form" @submit.prevent="ClaimPolicy">
        <div class="container">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Incident Date</label>
                            <input class="form-control" type="date" value="YYYY-MM-DD" id="example-date-input" v-model="Claim.incident_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Incident Time</label>
                            <input class="form-control" type="time" value="00:00" id="example-time-input" v-model="Claim.incident_time">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1"
                        placeholder="Describe the claim event that caused the damage" v-model="Claim.claim_event_that_cause_the_damage">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1" placeholder="Objects destroyed" v-model="Claim.object_destroyed">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1"
                        placeholder="Place were damaged objects can be controlled" v-model="Claim.place_where_the_damage_occured">
                </div>
                <div class="form-group">
                    <label>Were there any witnesses when the claim....</label>
                    <select class="form-control"v-on:change="SelectWitness($event.target.value)">
                        <option disabled selected :value="null">--Select--</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1" placeholder="Address" v-model="Claim.name_address">
                </div>
                <div class="form-group">
                    <label>Did you make changes in the insured object....</label>
                    <select class="form-control" v-on:change="SelectInsuredAltered($event.target.value)">
                        <option disabled selected value>Did you make changes in the insured object....</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1" placeholder="Describe shortly" v-model="Claim.describe_shortly">
                </div>
                <div class="form-group">
                    <label>Did the alarm system work ( if you have it )?</label>
                    <select class="form-control" v-on:change="SelectAlarmOption($event.target.value)">
                        <option disabled selected :value="null">--Select--</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1"
                        placeholder="Measures taken to minimize the damages" v-model="Claim.measure_taken_to_minimize_damage">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputFirstName1"
                        placeholder="Please describe the history of the claim" v-model="Claim.description_of_claim_event">
                </div>
                <hr>
                <label>Repair or replacement's cost of damaged objects</label>
                <div class="row">
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="number" class="form-control" id="exampleInputFirstName1" placeholder="Building"
                                min="0" max="9" v-model="Claim.repair_cost_building">
                        </div>
                    </div>
                    <div class=col-sm-6>
                        <div class="form-group">
                            <input type="number" class="form-control" id="exampleInputFirstName1"
                                placeholder="Equipments" min="0" max="9" v-model="Claim.repair_cost_equipments">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="exampleInputFirstName1"
                        placeholder="Total amount of indemnification pretended" min="0" max="9" v-model="Claim.total_indemnification_pretended">
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="option3">
                    <label for="customCheckbox3" class="custom-control-label">Declaration: I/We declare that the above
                        details are true and correct</label>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer" :disabled="loading">
                <button type="submit" class="btn btn-primary"> <span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading" role="status"></span>
                    Submit</button>
            </div>
        </div>
    </form>

</template>
<script>
    export default {
        props: [
            'base_url',
            'Auth',
        ],
        data: function () {
            return {
                policy_list: [],
                loading:false,
                show_button: false,
                policy_data: null,
                Claim: {
                    incident_date: null,
                    incident_time: null,
                    policy_id: null,
                    claim_event_that_cause_the_damage: null,
                    object_destroyed: null,
                    event_witness:null,
                    place_where_the_damage_occured: null,
                    name_address: null,
                    insured_objects_altered: null,
                    describe_shortly: null,
                    did_the_alarm_work: null,
                    measure_taken_to_minimize_damage: null,
                    insurer_id: null,
                    insurer_policy_id: null,
                    policy_type: null,
                    description_of_claim_event: null,
                    repair_cost_building: null,
                    repair_cost_equipments: null,
                    total_indemnification_pretended: null,
                },
                ShowBankDetails: false,
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

            SelectWitness(event){
                this.Claim.event_witness=event;
            },
            SelectInsuredAltered(event){
                console.log(event);
                if(event=='yes'){
                    this.Claim.insured_objects_altered=1;
                    console.log(this.Claim.insured_objects_altered)
                }else if(event=='no'){
                    this.Claim.insured_objects_altered=0;
                    console.log(this.Claim.insured_objects_altered)

                }
                
            },
            SelectAlarmOption(event){
                this.Claim.did_the_alarm_work=event;
            },

            ClaimPolicy() {
                this.loading=true;
                let formData = new FormData();
                formData.append('incident_date', this.Claim.incident_date);
                formData.append('incident_time', this.Claim.incident_time);
                formData.append('policy_id', this.Claim.policy_id);
                formData.append('claim_event_that_cause_the_damage', this.Claim.claim_event_that_cause_the_damage);
                formData.append('object_destroyed', this.Claim.object_destroyed);
                formData.append('place_where_the_damage_occured', this.Claim.place_where_the_damage_occured);
                formData.append('name_address', this.Claim.name_address);
                formData.append('insured_objects_altered', this.Claim.insured_objects_altered);
                formData.append('describe_shortly', this.Claim.describe_shortly);
                formData.append('did_the_alarm_work', this.Claim.did_the_alarm_work);
                formData.append('measure_taken_to_minimize_damage', this.Claim.measure_taken_to_minimize_damage);
                formData.append('insurer_id', this.Claim.insurer_id);
                formData.append('insurer_policy_id', this.Claim.insurer_policy_id);
                formData.append('policy_type', this.Claim.policy_type);
                formData.append('description_of_claim_event', this.Claim.description_of_claim_event);
                formData.append('repair_cost_building', this.Claim.repair_cost_building);
                formData.append('repair_cost_equipments', this.Claim.repair_cost_equipments);
                formData.append('total_indemnification_pretended', this.Claim.total_indemnification_pretended);

                axios.post(this.base_url+'/api/claim/home-policy',
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

                   
                    });

            }

        },

        mounted() {
            console.log('Component mounted.')
            this.getClaimingPolicy()
            console.log(this.base_url);


        }
    }

</script>
