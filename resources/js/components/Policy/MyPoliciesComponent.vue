<template>
    <div class="wrap-loader">
        <div class="container d-md-flex">
            <div class="col-12 col-md-6 my-policy-list">
                <div class="col-12 text-left pl-0 pb-4">
                    <h5 class="text-bold">{{locale.my_policies}}:</h5>
                </div>

                <div class="no_records_text" v-if="policy_list.length==0">{{locale.no_record_found}}</div>

                <a href="#special" class="policy-group d-flex flex-wrap mb-3" v-for="list in policy_list" :key="list.id"
                        @click="showpolicyDetail(list)">
                    <div class="col-9 d-flex">
                        <!-- C:\xampp\htdocs\mysig\public\frontend\images -->
                        <div v-if="list.type.name=='Home'">
                                <img :src="base_url+'/frontend/images/MySig2-homeicon.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name=='TPL'">
                                <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name== 'Green Card'">
                                <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name== 'Full Casco'">
                                <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name== 'Travel outside country'">
                                <img :src="base_url+'/frontend/images/MySig2-aeroplane2.png'" class="claim-img">
                            </div>
                        <p class="mt-3 text-bold"><span class="typesOfInsurance_span">{{locale.type_of_insurance}}</span><br>
                            {{list.type.name}} 
                        </p>
                    </div>
                    <div class="col-3 mt-5">
                        <img :src="'/frontend/images/Document-icon.png'" class="document-icon">
                    </div>
                    <div class="bordering-myClaim ml-3 mt-2"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between">
                        <div class="status-check">
                            <p class="p_label1 pcnr">PC NR <span>{{list.policy_number}}</span></p>
                            <p class="p_label1 pcnr" v-if="list.status==0">{{locale.status}} <span>{{locale.inactive}} <i class="fa fa-circle circle-icon"></i></span></p>
                            <p class="p_label1 pcnr" v-if="list.status==1">{{locale.status}} <span>{{locale.active}} <i class="fa fa-circle circle-icon"></i></span></p>
                        </div>
                        <div class="date_check">
                            <p class="p_date date_time start_time">Start <span>{{list.start_date}}</span></p>
                            <p class="p_date start_time">Expiry <span>{{list.end_date}}</span></p>
                        </div>
                    </div>
                </a>
                <div class="show-expired-policy">
                    <button type="submit" class="btn btn-primary show" @click="showExpiredPolicyList()">{{locale.show_expired_policy}}</button>
                </div>
                <div class="expired">
                    <h4  v-if="show_expire_list==true">{{locale.expired}}</h4>
                </div>
                <div class="no_records_text" v-if="expired_policy_list.length==0 && show_expire_list==true">{{locale.no_record_found}}</div>
                <template v-if="show_expire_list==true">
                <a href="#" class="policy-group d-flex flex-wrap mb-3" v-for="list in expired_policy_list"
                        :key="list.id">
                    <div class="col-9 d-flex">
                        <!-- C:\xampp\htdocs\mysig\public\frontend\images -->
                        <div v-if="list.type.name=='Home'">
                                <img :src="base_url+'/frontend/images/MySig2-homeicon.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name=='TPL'">
                                <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name== 'Green Card'">
                                <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name== 'Full Casco'">
                                <img :src="base_url+'/frontend/images/MySig2-Car.png'" class="claim-img">
                            </div>
                            <div v-if="list.type.name== 'Travel outside country'">
                                <img :src="base_url+'/frontend/images/MySig2-aeroplane.png'" class="claim-img">
                            </div>
                        <p class="mt-3 text-bold"><span class="typesOfInsurance_span">{{locale.type_of_insurance}}</span><br>
                            {{list.type.name}} 
                        </p>
                    </div>
                    <div class="col-3 mt-5">
                        <img :src="'/frontend/images/Document-icon.png'" class="document-icon">
                    </div>
                    <div class="bordering-myClaim ml-3 mt-2"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between">
                        <div class="status-check"> 
                            <p class="p_label1 pcnr">PC NR <span>{{list.policy_number}}</span></p>
                            <p class="p_label1 pcnr" v-if="list.status==0">{{locale.status}} <span>{{locale.inactive}} <i class="fa fa-circle circle-icon"></i></span></p>
                            <p class="p_label1 pcnr" v-if="list.status==1">{{locale.status}} <span>{{locale.active}} <i class="fa fa-circle circle-icon"></i></span></p>
                        </div>
                        <div class="date_check">
                            <p class="p_date date_time start_time">Start <span>{{list.start_date}}</span></p>
                            <p class="p_date start_time">Expiry <span>{{list.end_date}}</span></p>
                        </div>
                    </div>
                </a>
                </template>
                <div class="active-inactive-policy">
                    <button type="submit" class="btn btn-primary show"  v-if="show_expire_list==true"  @click="ShowPolictActiveList()">{{locale.active_inactive_policy}}</button>
                </div>
            </div>
            <div class="col-12 col-md-6" v-if="show_deatils==false">
                <div class="col-12 text-left pl-0 pb-4">
                    <h5 class="text-bold">{{locale.policy_details}}:</h5>
                </div>
                <div class="policy-details">
                    <h2>{{locale.select_policy}}</h2>
                </div>
            </div>
            <div class="col-12 col-md-6" v-if="show_deatils==true">
                <div class="col-12 text-left pl-0 pb-4">
                    <h5 class="text-bold">{{locale.policy_details}}:</h5>
                </div>
                <div class="quotes-bg" id="special">
                    <div class="col-12 d-flex pt-3 pt-4">
                        <img :src="policiy_detail.logo"
                            style="margin-left: 0.6rem; width: 50px; height: 50px;">
                        <p class="text-bold pl-3" style="margin-top: 15px;">{{policiy_detail.company_details}}</p>
                    </div>

                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 d-flex text-center justify-content-center">
                       
                        <h5 class="text-dark text-center " v-if="policiy_detail.policy_name">{{policiy_detail.policy_name}}</h5>
                    
                    </div>
                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 d-flex text-center justify-content-center">
                       
                    </div>
                    <p class="para1" v-if="policiy_detail.offer!=null">Offer: {{policiy_detail.offer.offer_name}}</p>

                    <p class="para1" v-if="policiy_detail.offer==null">{{locale.no_offer_available}}</p>
                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 d-flex text-center justify-content-center">
                        <h5 class="text-dar text-center text-underline" style="border-bottom: 1px solid gray; ">{{locale.coverage}}
                        </h5>
                    </div>
                    <div class="col-12">
                        <p class="text-dar para2">{{policiy_detail.comparision_values}}.</p>
                    </div>
                    <div class="bordering ml- mt-3"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between" style="margin-top: 10px;">
                        <div class="status-check " style="margin-left: 20px; font-weight: bold; color: gray;">
                            <p class="p_label">{{locale.policy_no}}:{{policiy_detail.policy_number}}</p>
                            <p class="p_date">{{locale.start_date}}: </p>
                            <p class="p_date">{{locale.end_date}}: </p>
                        </div>
                        <div class="date_check" style="font-weight: bold; color: gray;">
                            <p class="p_label" style="margin-right: 40px;" v-if="policiy_detail.status!=1">{{locale.status}}: {{locale.inactive}}</p>
                            <p class="p_label" style="margin-right: 40px;" v-if="policiy_detail.status==1">{{locale.status}}: {{locale.active}}</p>
                            <p class="p_date" style="margin-left:15px"> {{policiy_detail.start_date}}</p>
                            <p class="p_date" style="margin-left:15px">{{policiy_detail.end_date}}</p>
                        </div>
                    </div>
                    <div class="progress mb-3"
                        style="height:9px;max-width:87%; margin-left: 2rem; background-color: #ffffff; border: 1px solid red;">
                        <div class="progress-bar bg-danger" style="width:30%;height:10px"></div>
                    </div>
                    <div class="col-12 text-group-claim d-flex justify-content-between">
                        <div class="status-check " style="margin-left: 20px; font-weight: bold; color: gray;">
                            <p class="p_label  text-dar" v-if="policiy_detail.type.name!='Home' &&  policiy_detail.type.name!='Travel outside country'">{{locale.driver_name}}:</p>
                            <p class="p_label text-dar" v-if="policiy_detail.car_details">{{locale.object}}: {{policiy_detail.car_details.car_registration_number}}</p>
                        </div>
                        <div class="date_check" style="margin-right: 15px; font-weight: bold; color: gray;">
                            <p class="p_label" v-if="policiy_detail.type.name!='Home' && policiy_detail.type.name!='Travel outside country'">{{policiy_detail.driver_deatils.driver_name}}</p>
                            <p class="p_date " v-if=""></p>
                        </div>
                    </div>
                    <div class="bordering ml- mt-2"></div>
                    <div class="col-12 text-group-claim d-flex justify-content-between" style="padding: 10px 10px;">
                        <img :src="'/frontend/images/PDF.png'" class="icon-group mt-3"
                            style="margin-left: 20px;">
                        <div class="claim-details-text-group"
                            style="margin-right: 20px; font-weight: 500; color: rgb(95, 93, 93); font-size: 14px;">
                            <p>{{locale.terms_and_condition}}</p>
                            <p>{{locale.paid}}: <span class="paid_money" style="color: rgb(214, 21, 21);" >{{policiy_detail.premium}} Lek</span> <span v-if="policiy_detail.report!=null">Via {{policiy_detail.report.method}}</span>
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
            'Auth',
            'locale',
        ],
        data: function () {
            return {
                policy_list: [],
                expired_policy_list: [],
                show_deatils: false,
                policiy_detail: null,
                show_expire_list: false,
                language: null,
                loading:true,

            }
        },

        methods: {
            getTranslatedLanguage(){
                console.log(JSON.parse(localStorage.getItem('translated_language')));
                this.language = JSON.parse(localStorage.getItem('translated_language'));
                console.log('language',this.language);

            },
            getPolicies() {
                console.log(this.Auth);
                console.log(this.base_url);
                axios.get(this.base_url+'/api/user/policy-list', {
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: "Bearer " + this.Auth
                    }
                })
                .then(res => {
                    this.loading=false;
                    console.log(res.data);
                    this.policy_list = res.data.message;
                    if(this.policy_list.length>0){
                        this.$toastr.success('Successfully found the Policies');

                    }else{
                        this.$toastr.success('There are no policies bought yet!');

                    }

                }).catch((error) => {
                    console.log(error);
                    this.loading = false;
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })
            },
            showpolicyDetail(list) {
                this.show_deatils = false;

                this.show_deatils = true;
                this.policiy_detail = list;
                console.log(list);

            },

            showExpiredPolicyList(){
                 axios.get(this.base_url+'/api/user/policy-list', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        console.log(res.data);
                        this.expired_policy_list = res.data.message;
                        this.show_expire_list=true;
                        this.show_deatils=false;

                    });
            },

            ShowPolictActiveList(){
                 this.show_expire_list=false;

            }

        },

        mounted() {
            console.log('Component mounted.')
            this.getPolicies();
            this.getTranslatedLanguage();



        }
    }

</script>