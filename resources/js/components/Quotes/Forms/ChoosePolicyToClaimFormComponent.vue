<template>
    <div class="container">
        <div class="selectCar-wrap">
            <div class="heading">
                <h2>{{locale.choose_policy_to_claim}}</h2>
            </div>
            <div class="all_call_list">
                <button class="car-list" v-for="list in policy_list" @click="SelectPolicyToClaim(list)">
                    {{list.company_details}} {{list.type.name}}
                </button>
            </div>
            <div class="show all_call_list">
                <a :href="this.base_url+'/file-claim-car'" class="show-price file-claim-btn" v-if="show_button_for_car_form==true">File A Claim</a>
                <a :href="this.base_url+'/file-claim-home'" class="show-price file-claim-btn" v-if="show_button_for_home_form==true">File A Claim</a>
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
                show_button_for_car_form: false,
                show_button_for_home_form: false,
                loading: true
            }
        },

        methods: {
            getClaims() {
                axios.get(this.base_url+'/api/user/policy-list', {
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: "Bearer " + this.Auth
                    }
                })
                .then(res => {
                    this.loading=false;
                    console.log(res);
                    this.policy_list = res.data.message;
                    console.log(this.policy_list);
                    this.$toastr.success('Successfully found the policies to claim');

                }).catch((error) => {
                    console.log(error);
                    this.loading = false;
                    if (error.response) {
                        this.$toastr.error(error.response.data.message);
                    }
                })
            },

            SelectPolicyToClaim(policy){
                console.log(policy.type.name);
                console.log(policy);
                if(policy.type.name=='Home'){
                    this.show_button_for_car_form=false;
                    this.show_button_for_home_form = true;
                    
                }else if(policy.type.name=='TPL' || 'Full Casco' || 'Green Card'){
                    this.show_button_for_home_form=false;

                    this.show_button_for_car_form=true
                }
                localStorage.setItem('claimed_policy', JSON.stringify(policy));

            }

        },

        mounted() {
            console.log('Component mounted.');
             console.log(this.locale);
            this.getClaims()


        }
    }
</script>
 