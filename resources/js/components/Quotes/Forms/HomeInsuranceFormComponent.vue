<template>
    <div>
        <form action="#" method="POST" class="mt-3" @submit.prevent = "SaveHomeInsaurance(locale.error_msg)">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select _ngcontent-fbk-c5="" class="credential__select form-control signup_input_Select pr-5"
                            v-on:change="selectProperty( $event.target.value)">
                            <option _ngcontent-fbk-c5="" :value="null" selected disabled>{{locale.property_type}}</option>
                            <option _ngcontent-fbk-c5="" :value="index" v-for="index,product  in product_type" :key="index">{{product}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-input" value="Square m2"  :placeholder="locale.square_m"
                            v-model = "HomeInsaurance.square_m2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-input" value="Building Value"
                         :placeholder="locale.building_value"
                        v-model = "HomeInsaurance.building_value">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-input" value="Equipment Value"
                        :placeholder="locale.equipment_value"
                        v-model = "HomeInsaurance.equipmennt_price">
                    </div>
                </div>
            </div>
            <div class="form-group-div d-flex mt-3 no-gutters">
                <div class="col-10">
                    <div class="form-group">
                        <select _ngcontent-fbk-c5="" class="credential__select form-control signup_input_Select pr-5"
                            v-on:change="selectPackage( $event.target.value)">
                            <option _ngcontent-fbk-c5="" :value="null" selected disabled>{{locale.package}}</option>
                            <option _ngcontent-fbk-c5="" :value="pack" v-for="index,pack  in packages" :key="index">{{index}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <i class="fa fa-info-circle info-icon"></i>
                </div>
            </div>
            <div class="form-group-div no-gutters">
                <div class="col-12">
                    <button class="btn addbuttons btn-block button_bottom" :disabled="loading" @click="ScrollToPolicies($event)">
                    <span class="spinner-border spinner-border-sm text-light mr-2" v-if="loading" role="status"></span>
                    {{locale.show_price}}</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
   
    export default {
        
        props: ['token', 'baseUrl','locale', 'selected_language'],
        data: function () {
            return {
                product_type: [],
                packages: [],
                language_type: this.selected_language,
                HomeInsaurance: {
                    property_type: null,
                    building_value: null,
                    equipmennt_price: null,
                    home_sub_type_id: null,
                    square_m2: null,
                },
                loading: false,
                No_Quotes: []
            }
        },
        methods: {
            getHomeSubType() {
                axios.get(this.baseUrl+'/api/policy/getHomeSubType/'+this.language_type, {
                      headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.token
                        }
                    })
                    .then(res => {
                        this.product_type = res.data.message;
                        this.packages = res.data.policy_type;
                       
                    }
                );
            },

            selectProperty(event){
                this.HomeInsaurance.property_type = event;
            },

            selectPackage(event){
                this.HomeInsaurance.home_sub_type_id = event;

            },

            SaveHomeInsaurance(error_msg){
                this.loading = true;
                localStorage.setItem('home_data', JSON.stringify(this.HomeInsaurance));

                axios.post(this.baseUrl+'/api/policy/showHomeList',
                        this.HomeInsaurance, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.token
                            }
                        }
                    )
                    .then(res => {
                        console.log(res)
                        this.loading = false;
                        this.$toastr.success('Successfully found the policy list');
                        this.$emit('child-method', res.data,this.HomeInsaurance)
                    }
                ).catch((error) => {
                    if (error.response) {
                        this.$toastr.error(error_msg);
                    }
                    this.loading = false;
                    this.$emit('child-method', this.No_Quotes,this.HomeInsaurance)

                   
                   
                })
            },

            ScrollToPolicies(ev) {
                //Rahul Code
                var elemTopPoint = ev.pageY;
                window.scroll(0, (elemTopPoint - 160));
            }
        },
        mounted() {
            console.log('Component mounted.');
            
            this.getHomeSubType();
        }
    }
</script>
