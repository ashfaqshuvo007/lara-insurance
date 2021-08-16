<template>
    <div class="claims_list">
        <div class="container d-md-flex">
            <div class="col-12 col-md-6 my-claim-list">
                
                <h5 class="text-bold" style="margin-bottom: 30px;">{{locale.claims}}:</h5>
                <a href="#" class="policy-group d-flex flex-wrap mb-3" v-for="list in Claim_list"
                    @click="ShowClaimDetails(list)">
                    <div class="col-9 d-flex">
                        <div v-if="list.policy_type=='Home'">
                            <img :src="base_url+'/frontend/images/MySig2-homeicon.png'" class="claim-img">
                        </div>
                        <div v-if="list.policy_type=='TPL'">
                            <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                        </div>
                        <div v-if="list.policy_type== 'Green Card'">
                            <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                        </div>
                        <div v-if="list.policy_type== 'Full Casco'">
                            <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                        </div>
                        <p class="mt-3 text-bold"><span class="typesOfInsurance_span">Type Of Insurance</span><br>
                            {{list.policy_type}}</p>
                    </div>
                    <div class="col-3 mt-5">
                        <img :src="'/frontend/images/Document-icon.png'" class="document-icon">
                    </div>
                    <div class="bordering-myClaim ml-3 mt-2"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between">
                        <div class="status-check">
                            <p class="p_label1 pcnr" v-if="list.policy_details.policy_number!=null">PC NR <span>{{list.policy_details.policy_number}}</span></p>
                            <p class="p_label1 pcnr" v-if="list.policy_details.policy_number==null">PC NR <span>Policy Number does not exist</span></p>
                            <p class="p_label1 pcnr">Status <span v-if="list.status==1">Active <i class="fa fa-circle circle-icon"></i></span>
                                                            <span v-if="list.status==0">Inactive <i class="fa fa-circle circle-icon inactive"></i></span>
                            </p>
                        </div>
                        <div class="date_check">
                            <p class="p_date date_time start_time">Start <span>{{list.start_date}}</span></p>
                            <p class="p_date start_time">Expiry <span>{{list.end_date}}</span></p>
                        </div>
                    </div>
                </a>
                <div class="no_records_text" v-if="Claim_list.length==0">{{locale.no_records_found}} </div>
                <div class="information-btn">
                    <a href="#" data-toggle="modal" data-target="#myModal6" class="show btn-text">{{locale.information}}</a>
                </div>
            </div>
            <div class="col-12 col-md-6" v-if="show_deatils==false">
                    <a class="btn addbuttons btn-main w-100 file-claim-btn" :href="this.base_url+'/choose-policy'">{{locale.file_a_claim}}
                        <span class="icon icon-add">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </span>
                    </a>
                <div class="col-12 text-left pl-0 pb-4">
                    <h5 class="text-bold" style="display: inline-block;">{{locale.claim_details}}:</h5>
                </div>
                <div class="policy-details">
                    <h2>{{locale.select_a_claim}}</h2>
                </div>
            </div>
            <div class="col-12 col-md-6" v-if="show_deatils==true">
                    <a class="btn addbuttons btn-main w-100 file-claim-btn" :href="this.base_url+'/choose-policy'">{{locale.file_a_claim}}
                        <span class="icon icon-add">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </span>
                    </a>
                <div class="col-12 text-left pl-0 pb-4">
                    <h5 class="text-bold">{{locale.claim_details}}:</h5>
                </div>
                <div class="quotes-bg">
                    <div class="col-12 d-flex pt-3 pt-4">
                        <img :src="claim_detail.logo"
                            style="margin-left: 0.6rem; width: 50px; height: 50px;">
                        <p class="text-bold pl-3" style="margin-top: 15px;">{{claim_detail.company_name}}</p>
                    </div>

                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 d-flex text-center justify-content-center">
                        <h5 class="text-dark text-center "  v-if="claim_detail.policy_type=='Home'">Home insurance - {{claim_detail.policy_type}}</h5>
                        <h5 class="text-dark text-center "  v-if="claim_detail.policy_type=='TPL'">{{locale.car_insurance}} - {{claim_detail.policy_type}}</h5>
                    </div>
                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 d-flex text-center justify-content-center">
                        <p class="text-dar text-center " style="border-bottom: 1px solid gray;"
                            v-if="claim_detail.policy_type=='Home'">Home insurance - {{claim_detail.policy_type}}
                        </p>
                        <p class="text-dar text-center " style="border-bottom: 1px solid gray;"
                            v-if="claim_detail.policy_type=='TPL'">{{locale.car_insurance}} - {{claim_detail.policy_type}}</p>
                        <p class="text-dar text-center " style="border-bottom: 1px solid gray;"
                            v-if="claim_detail.policy_type=='Green Card'">{{locale.car_insurance}} -
                            {{claim_detail.policy_type}}</p>
                        <p class="text-dar text-center " style="border-bottom: 1px solid gray;"
                            v-if="claim_detail.policy_type=='Full Casco'">{{locale.car_insurance}} -
                            {{claim_detail.policy_type}}</p>
                        <p class="text-dar text-center " style="border-bottom: 1px solid gray;"
                            v-if="claim_detail.policy_type=='travel_out_side_country' || claim_detail.policy_type=='student_out_side_country'">Travel insurance</p>
                    </div>
                    <p class="para1" v-if="claim_detail.offer!=null">{{claim_detail.offer}} Offer are Available </p>
                    <p class="para1" v-if="claim_detail.offer==null">Offer are not Available </p>
                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 d-flex text-center justify-content-center">
                        <h5 class="text-dar text-center text-underline" style="border-bottom: 1px solid gray;">
                            Coverage</h5>
                    </div>
                    <div class="col-12">
                        <p class="text-dar para2" v-if="claim_detail.policy_type=='Home'">{{claim_detail.get_claim_details.claim_event_history_description}}</p>
                        <p class="text-dar para2" v-if="claim_detail.policy_type=='TPL'">{{claim_detail.get_claim_details.incident_description}} in {{claim_detail.get_claim_details.incident_location}}</p>
                    </div>
                    <div class="bordering ml- mt-3"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between" style="margin-top: 10px;">
                        <div class="status-check " style="margin-left: 20px; font-weight: 600; color: gray;">
                            <p class="p_label"  v-if="claim_detail.policy_details.policy_number!=null">Policy Number:{{claim_detail.policy_details.policy_number}}</p>
                            <p class="p_label"  v-if="claim_detail.policy_details.policy_number==null">Policy Number:NA</p>
                            <p class="p_date">Start Date:</p>
                            <p class="p_date">End Date:</p>
                        </div>
                        <div class="date_check" style="font-weight: bold; color: gray;">
                            <p class="p_label1" style="margin-right: 40px;">Status: <span v-if="claim_detail.status==1">Active</span><span v-if="claim_detail.status==1">Inactive</span></p>
                            <p class="p_date" style="margin-left:15px">{{claim_detail.start_date}}</p>
                            <p class="p_date" style="margin-left:15px">{{claim_detail.end_date}}</p>
                        </div>
                    </div>
                    <div class="progress mb-3"
                        style="height:9px;max-width:87%; margin-left: 2rem; background-color: #ffffff; border: 1px solid red;">
                        <div class="progress-bar bg-danger" style="width:30%;height:10px"></div>
                    </div>
                    <div class="col-12 text-group-claim d-flex justify-content-between">
                        <div class="status-check " style="margin-left: 20px; font-weight: bold; color: gray;">
                            <p class="p_label  text-dar" v-if="claim_detail.policy_type!='Home' && 'travel_out_side_country'">Driver Name:</p>
                            <p class="p_label text-dar">Object: </p>
                            <p class="p_label text-dar">Incident Date: </p>
                            <p class="p_label text-dar"  v-if="claim_detail.policy_type=='Home'">Object Destroyed </p>
                            <p class="p_label text-dar"  v-if="claim_detail.policy_type=='Home'">Minimize Measure </p>
                            <p class="p_label text-dar"  v-if="claim_detail.policy_type=='Home'"> Location </p>
                        </div>
                        <div class="date_check" style="margin-right: 15px; font-weight: bold; color: gray;">
                            <p class="p_date " v-if="claim_detail.policy_type=='Home' && claim_detail.object_details!=null"> {{claim_detail.object_details.albanian_name}}</p>
                            <p class="p_label" v-if="claim_detail.policy_type!='Home' && 'Travel Outside Country' && claim_detail.object_details!=null">{{claim_detail.driver_deatils.driver_name}}</p>
                            <p class="p_date " v-if="claim_detail.policy_type!='Home' && 'Travel Outside Country' &&claim_detail.object_details!=null "> {{claim_detail.object_details.car_registration_number}}</p>
                            <p class="p_date " > {{claim_detail.get_claim_details.incident_datetime}}</p>
                            <p class="p_date " v-if="claim_detail.policy_type=='Home'"> {{claim_detail.get_claim_details.object_destroyed}}</p>

                            <p class="p_date " v-if="claim_detail.policy_type=='Home'"> {{claim_detail.get_claim_details.meassure_to_minimise_damage}}</p>
                            <p class="p_date " v-if="claim_detail.policy_type=='Home'"> {{claim_detail.get_claim_details.name_address}}</p>

                        
                        </div>
                    </div>
                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between" style="padding: 10px 10px;">
                        <img :src="'/frontend/images/PDF.png'" class="icon-group mt-3" style="margin-left: 20px;">
                        <div class="claim-details-text-group"
                            style="margin-right: 20px; font-weight: 500; color: rgb(95, 93, 93); font-size: 14px;">
                            <p>Terms and Condition</p>
                            <p>Paid: <span class="paid_money" style="color: rgb(214, 21, 21);" >{{claim_detail.get_claim_details.total_indemnification_pretended}} Lak</span> <span v-if="claim_detail.report!=null">Via
                                {{claim_detail.report.method}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <loader v-if="loading == true"></loader>
    </div>
</template>
<script>
    export default {
        props: [
            'base_url',
            'insaurance_logo',
            'Auth',
            'locale',
        ],
        data: function () {
            return {
                Claim_list: [],
                show_deatils: false,
                claim_detail: null,
                loading: true,
            }
        },

        methods: {
            getClaims() {
                axios.get(this.base_url+'/api/claim/get-claim-policy', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        this.loading=false;
                        console.log(res);
                        this.Claim_list = res.data.message;
                        if(this.Claim_list.length>0){
                            this.$toastr.success('Successfully found the Claims');

                        }else{
                            this.$toastr.success('There are no claims');

                        }

                    }).catch((error) => {
                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }
                        console.log(error);
                        this.loading = false;
                        
                   
                   
                })
            },
            ShowClaimDetails(list) {
                this.show_deatils = false;

                this.show_deatils = true;
                this.claim_detail = list;
                console.log(list);

            },

        },

        mounted() {
            console.log('Component mounted.')
            this.getClaims()


        }
    }

</script>
