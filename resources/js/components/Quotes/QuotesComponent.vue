<style>
    .get-quotes-page {
        margin-bottom: 170px;
    }

</style>

<template>

    <div class="get-quotes-page">

        <section class="main-home">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-formModule">
                                    <div class="main-formHeader">
                                        <h5 class="mb-4">{{locale.choose_insurance}}</h5>
                                    </div>
                                </div>
                                <div class="main-tab-navs">
                                    <div class="nav nav-tabs main-tab-list" id="nav-tab" role="tablist"
                                        style="border:none;">
                                        <a class="nav-item nav-link main-tab-item none-selected" id="nav-home-tab"
                                            data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                            aria-selected="true" @click="CarInsaurance($event)">
                                            <div class="option-group-home">
                                                <img :src="base_url+'/frontend/images/MySig2-Car.png'"
                                                    class="tab-images ml-2 mr-2">
                                                <p class="text-center">{{locale.car}}<br></p>
                                            </div>
                                        </a>
                                        <a class="nav-item nav-link main-tab-item none-selected" id="nav-profile-tab"
                                            data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                            aria-selected="true">
                                            <div class="option-group-home" @click="HomeInsaurance($event)">
                                                <img :src="base_url+'/frontend/images/homeIcon.png'"
                                                    class="tab-images ml-2 mr-2">
                                                <p class="text-center">{{locale.home}}<br> </p>
                                            </div>
                                        </a>
                                        <a class="nav-item nav-link main-tab-item none-selected" id="nav-contact-tab"
                                            data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
                                            aria-selected="false">
                                            <div class="option-group-home" @click="SelectTravelOutsideAlbania(null,$event)">
                                                <img :src="base_url+'/frontend/images/MySig2-aeroplane2.png'"
                                                    class="tab-images ml-2 mr-2">
                                                <p class="text-center">{{locale.travel}}<br></p>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab" v-if="show_car_tabs==true">
                                        <ul class="nav nav-tabs mt-5" role="tablist">
                                            <li class="nav-item home-tab-plan text-center">
                                                <a class="nav-link active" data-toggle="tab" href="#home"
                                                    @click="OpenAddCarButton()">{{locale.tpl}}</a>
                                            </li>
                                            <li class="nav-item home-tab-plan text-center">
                                                <a class="nav-link" data-toggle="tab" href="#menu1"
                                                    @click="OpenGreenCardForm()">{{locale.green_card}}</a>
                                            </li>
                                            <li class="nav-item home-tab-plan text-center">
                                                <a class="nav-link" data-toggle="tab" href="#menu2"
                                                    @click="OpenCascoForm()">{{locale.casco}}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content"
                                            v-if="!IsAddCarFormOpen || !IsGreenCardOpenFormOpen || !IsCascoFormOpen">
                                            <div id="home" class="tab-pane show active">
                                                <br>
                                                <button class="btn addbuttons btn-main pull-right"
                                                    @click="CloseAddCarForm()" v-if="IsAddCarFormOpen">
                                                    {{locale.close}}
                                                    <!-- <img src="{{URL::asset('frontend/images/Plus.png')}}" class="plus-icon"> -->
                                                </button>

                                                <add-cars v-if="IsAddCarFormOpen" :token="Auth" :baseUrl="base_url"
                                                    v-on:child-method="getCarList" :carDetail="update_car_details"
                                                    :locale="locale" :selected_language="lang">
                                                </add-cars>

                                                <p class="text-center"
                                                    style="color: gray; font-size: 13px; font-weight: 400; padding-top: 40px;"
                                                    v-if="!IsAddCarFormOpen && !IsGreenCardOpenFormOpen && !IsCascoFormOpen">
                                                    <span v-if="vehicle_list.length==0">{{locale.no_car_added}}
                                                    </span>
                                                    <i class="fa fa-plus-circle" style="color: #FFA500;"
                                                        v-if="vehicle_list.length==0"></i>
                                                    <span style="color: rgb(66, 63, 63);"><span
                                                            v-if="vehicle_list.length==0">{{locale.to_add_car}}</span></span>
                                                </p>
                                                <button class="btn addbuttons btn-main add-car w-100"
                                                    @click="OpenAddCarForm()"
                                                    v-if="!IsAddCarFormOpen && !IsGreenCardOpenFormOpen && !IsCascoFormOpen && vehicle_list.length==0">
                                                    {{locale.add_a_car}}
                                                    <span class="icon icon-add">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </span>
                                                    <!-- <img src="{{URL::asset('frontend/images/Plus.png')}}" class="plus-icon"> -->
                                                </button>

                                            </div>

                                                <loader v-if="loading == true"></loader>

                                            <div class="selectCar-wrap"
                                                v-if="!IsAddCarFormOpen && !IsGreenCardOpenFormOpen && !IsCascoFormOpen && vehicle_list.length>0">

                                                <div class="heading">
                                                    <h2>{{locale.select_car}}</h2>
                                                </div>
                                                <div class="all_call_list" v-for="list in vehicle_list" :key="list.id">
                                                    <button type="button" class="car-name" :key="list.id"
                                                        @click="SelectCarToshow(list, $event)">{{list.car_registration_number}}</button>
                                                    <button type="button" class="edit" @click="EditCarDetails(list)"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"
                                                            ></i></button>
                                                    <button type="button" class="delete" data-toggle="modal" data-target="#myModal8" 
                                                        @click="ConfirmDeleteModal(list)"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                                <button class="btn addbuttons btn-main add-car w-100"
                                                    @click="OpenAddCarForm()"
                                                    v-if="!IsAddCarFormOpen && !IsGreenCardOpenFormOpen && !IsCascoFormOpen">
                                                    {{locale.add_a_car}}
                                                    <span class="icon icon-add">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </span>
                                                    <!-- <img src="{{URL::asset('frontend/images/Plus.png')}}" class="plus-icon"> -->
                                                </button>
                                                <div class="show" v-if="Show_price==true">
                                                    <button class="btn show-price" @click="ShowCarPolicies($event)"
                                                        :disabled="loading2">
                                                        <span class="spinner-border spinner-border-sm text-light mr-2"
                                                            v-if="loading2" role="status"></span>
                                                        {{locale.show_price}}</button>
                                                </div>
                                            </div>
                                            <green-card :token="Auth" :baseUrl="base_url"
                                                v-on:child-method="updateParent" v-if="IsGreenCardOpenFormOpen"
                                                :locale="locale" :selected_language="lang">
                                            </green-card>

                                            <casco :token="Auth" :baseUrl="base_url" v-if="IsCascoFormOpen"
                                                v-on:child-method="updateParentForCasco" :locale="locale" :selected_language="lang"></casco>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab" v-if="OpenHomeInsauranceForm==true">
                                        <home-insurance-form :token="Auth" :baseUrl="base_url"
                                            v-on:child-method="updateParentHome" :locale="locale" :selected_language="lang">
                                        </home-insurance-form>
                                    </div>
                                    <div class="tab-pane contact-tab fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab" v-if="OpenTravelInsauranceForm==true">
                                        <ul class="nav nav-tabs mt-5" role="tablist">
                                            <li class="nav-item contact-tab-item">
                                                <a class="nav-link active" data-toggle="tab" href="#travelAlbania"
                                                    @click="SelectTravelOutsideAlbania($event.target.innerHTML)">
                                                    {{locale.travel_outside}}
                                                </a>
                                            </li>
                                            <li class="nav-item contact-tab-item">
                                                <a class="nav-link" data-toggle="tab" href="#studentAlbania"
                                                    @click="SelectStudentOutsideAlbania($event.target.innerHTML)">
                                                    {{locale.student_outside}}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <travel-albania v-if="travel_insaurance_type1==1" :baseUrl="base_url"
                                                :token="Auth" :key="travel_insaurance_type1"
                                                :country="not_student_travel" v-on:child-method="updateParent"
                                                :locale="locale" :selected_language="lang">
                                            </travel-albania>
                                            <travel-albania v-if="travel_insaurance_type2==1" :baseUrl="base_url"
                                                :token="Auth" :key="travel_insaurance_type1" :country="travel"
                                                v-on:child-method="updateParent" :locale="locale"></travel-albania>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" v-if="anyCategorySelected==true">
                                <h5 class="mb-4" style="font-weight: 600;" id="quotes">{{locale.quotes}}:</h5>
                                <button type="button" class="btn quote-compare"
                                        v-if="compare_clicked==true && QuotesCompareList.length>0"
                                        @click="Compare()">{{locale.compare}}
                                    </button>
                                <div class="compare-sec">
                                    <button type="button" class="btn compare-now" data-toggle="modal"
                                        data-target="#myModal7" v-if="compare_now==true" @click="showModal()">{{locale.compare}}
                                    </button>
                                    <button type="button" class="btn not-now" v-if="cancel==true"
                                        @click="CancelCompare()">{{locale.cancel}}</button>
                                </div>
                                <div class="quotes-bg">
                                    <div class="container p-5">

                                        <template v-if="QuotesCompareList.length!=0 && policy_type=='green_card'">
                                        <div class="modal-wrap" v-for="list in QuotesCompareList" :key='list._id'
                                            >
                                            <div class="form-check" v-if="compare_now==true">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="list.company_name" :id="list.company_name"
                                                    @click="CheckedPolicy($event,list)">
                                            </div>
                                            <a href="#"
                                                class="quotes-group d-flex align-center justify-content-between mb-2 quotes-wrap btn-text"
                                                data-toggle="modal" data-target="#myModal" @click="selectPolicy(list)">

                                                <div class="img-div">
                                                    <img :src="list.logo">
                                                </div>
                                                <div class="text-group flex-column">
                                                    <p class="pb-0 pt-3 mb-0">{{list.company_name}}</p>
                                                    <div class="quotes_offer" v-if="QuotesOffer.length>0">
                                                        <p class="fs-15 mt-0 pt-0">{{locale.tap_to_choose}}</p>
                                                    </div>
                                                    <div v-if="QuotesOffer.length==0">
                                                        <p class="fs-15 mt-0 pt-0">{{NoQuotesOffer}}</p>

                                                    </div>
                                                </div>
                                                <div class="border-left"></div>
                                                <div class="price-section mt-3"
                                                    v-if="list.price!=null && list.price!=''">
                                                    <p class="mb-1">{{locale.price}}</p>
                                                    <p class="amount_text">{{list.price}} Euro</p>
                                                </div>
                                                <div class="price-section mt-3"
                                                    v-if="list.percentage!=null && list.percentage!=''">
                                                    <p class="mb-1">Percentage</p>
                                                    <p class="amount_text">{{list.percentage}}</p>
                                                </div>
                                            </a>
                                        </div>
                                        </template>

                                        <!-- TPL-->
                                        <template v-if="QuotesCompareList.length!=0 && policy_type=='TPL'">
                                        <div class="modal-wrap" v-for="list in QuotesCompareList"
                                            :key="list.id">
                                            <div class="form-check" v-if="compare_now==true">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="list.company_name" :id="list.company_name"
                                                    @click="CheckedPolicy($event,list)">
                                            </div>
                                            <a href="#"
                                                class="quotes-group d-flex align-center justify-content-between mb-2 quotes-wrap btn-text"
                                                data-toggle="modal" data-target="#myModal1" @click="selectPolicy(list)">

                                                <div class="img-div">
                                                    <img :src="list.logo">
                                                </div>
                                                <div class="text-group flex-column">
                                                    <p class="pb-0 pt-3 mb-0">{{list.company_name}}</p>
                                                    <div class="quotes_offer" v-if="QuotesOffer.length>0">
                                                        <p class="fs-15 mt-0 pt-0">{{locale.tap_to_choose}}</p>
                                                    </div>
                                                    <div v-if="QuotesOffer.length==0">
                                                        <p class="fs-15 mt-0 pt-0">{{NoQuotesOffer}}</p>

                                                    </div>
                                                </div>
                                                <div class="border-left"></div>
                                                <div class="price-section mt-3"
                                                    v-if="list.price!=null && list.price!=''">
                                                    <p class="mb-1">{{locale.price}}</p>
                                                    <p class="amount_text">{{list.price}} Euro</p>
                                                </div>
                                                <div class="price-section mt-3"
                                                    v-if="list.percentage!=null && list.percentage!=''">
                                                    <p class="mb-1">Percentage</p>
                                                    <p class="amount_text">{{list.percentage}}</p>
                                                </div>
                                            </a>
                                        </div>
                                        </template>



                                        <!-- Casco-->
                                        <template v-if="QuotesCompareList.length!=0 && policy_type=='full_casco'">
                                        <div class="modal-wrap" v-for="list in QuotesCompareList"
                                            :key="list.id">
                                            <div class="form-check" v-if="compare_now==true">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="list.company_name" :id="list.company_name"
                                                    @click="CheckedPolicy($event,list)">
                                            </div>
                                            <a href="#"
                                                class="quotes-group d-flex align-center justify-content-between mb-2 quotes-wrap btn-text"
                                                data-toggle="modal" data-target="#myModal3" @click="selectPolicy(list)">

                                                <div class="img-div">
                                                    <img :src="list.logo">
                                                </div>
                                                <div class="text-group flex-column">
                                                    <p class="pb-0 pt-3 mb-0">{{list.company_name}}</p>
                                                    <div class="quotes_offer" v-if="QuotesOffer.length>0">
                                                        <p class="fs-15 mt-0 pt-0">{{locale.tap_to_choose}}</p>
                                                    </div>
                                                    <div v-if="QuotesOffer.length==0">
                                                        <p class="fs-15 mt-0 pt-0">{{NoQuotesOffer}}</p>

                                                    </div>
                                                </div>
                                                <div class="border-left"></div>
                                                <div class="price-section mt-3"
                                                    v-if="list.price!=null && list.price!=''">
                                                    <p class="mb-1">{{locale.price}}</p>
                                                    <p class="amount_text">{{list.price}} Euro</p>
                                                </div>
                                            </a>
                                        </div>
                                        </template>


                                        <!-- Home-->
                                        <template v-if="QuotesCompareList.length>0 && policy_type=='Home'">
                                        <div class="modal-wrap" v-for="list in QuotesCompareList"
                                            :key="list.id">
                                            <div class="form-check" v-if="compare_now==true">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="list.company_name" :id="list.company_name"
                                                    @click="CheckedPolicy($event,list)">
                                            </div>
                                            <a href="#"
                                                class="quotes-group d-flex align-center justify-content-between mb-2 quotes-wrap btn-text"
                                                data-toggle="modal" data-target="#myModal4" @click="selectPolicy(list)">

                                                <div class="img-div">
                                                    <img :src="list.logo">
                                                </div>
                                                <div class="text-group flex-column">
                                                    <p class="pb-0 pt-3 mb-0">{{list.company_name}}</p>
                                                    <div class="quotes_offer" v-if="QuotesOffer.length>0">
                                                        <p class="fs-15 mt-0 pt-0">{{locale.tap_to_choose}}</p>
                                                    </div>
                                                    <div v-if="QuotesOffer.length==0">
                                                        <p class="fs-15 mt-0 pt-0">{{NoQuotesOffer}}</p>

                                                    </div>
                                                </div>
                                                <div class="border-left"></div>
                                                <div class="price-section mt-3"
                                                    v-if="list.price!=null && list.price!=''">
                                                    <p class="mb-1">{{locale.price}}</p>
                                                    <p class="amount_text">{{list.price}} Euro</p>
                                                </div>

                                            </a>
                                        </div>
                                        </template>

                                        <!-- Travel-->
                                        <template v-if="QuotesCompareList.length!=0 && policy_type=='travel_out_side_country'">
                                        <div class="modal-wrap" v-for="list in QuotesCompareList"
                                            :key="list.id">
                                            <div class="form-check" v-if="compare_now==true">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="list.company_name" :id="list.company_name"
                                                    @click="CheckedPolicy($event,list)">
                                            </div>
                                            <a href="#"
                                                class="quotes-group d-flex align-center justify-content-between mb-2 quotes-wrap btn-text"
                                                data-toggle="modal" data-target="#myModal5" @click="selectPolicy(list)">

                                                <div class="img-div">
                                                    <img :src="list.logo">
                                                </div>
                                                <div class="text-group flex-column">
                                                    <p class="pb-0 pt-3 mb-0">{{list.company_name}}</p>
                                                    <div class="quotes_offer" v-if="QuotesOffer.length>0">
                                                        <p class="fs-15 mt-0 pt-0">{{locale.tap_to_choose}}</p>
                                                    </div>
                                                    <div v-if="QuotesOffer.length==0">
                                                        <p class="fs-15 mt-0 pt-0">{{NoQuotesOffer}}</p>

                                                    </div>
                                                </div>
                                                <div class="border-left"></div>
                                                <div class="price-section mt-3"
                                                    v-if="list.price!=null && list.price!=''">
                                                    <p class="mb-1">{{locale.price}}</p>
                                                    <p class="amount_text">{{list.price}} Euro</p>
                                                </div>
                                                <div class="price-section mt-3"
                                                    v-if="list.percentage!=null && list.percentage!=''">
                                                    <p class="mb-1">Percentage</p>
                                                    <p class="amount_text">{{list.percentage}}</p>
                                                </div>
                                            </a>

                                        </div>
                                        </template>

                                        <!-- Student-->
                                         
                                        <template v-if="QuotesCompareList.length!=0 && policy_type=='student_out_side_country'">
                                        <div class="modal-wrap" v-for="list in QuotesCompareList"
                                            :key="list.id">
                                            <div class="form-check" v-if="compare_now==true">
                                                <input class="form-check-input" type="checkbox"
                                                    :value="list.company_name" :id="list.company_name"
                                                    @click="CheckedPolicy($event,list)">
                                            </div>
                                            <a href="#"
                                                class="quotes-group d-flex align-center justify-content-between mb-2 quotes-wrap btn-text"
                                                data-toggle="modal" data-target="#myModal5" @click="selectPolicy(list)">

                                                <div class="img-div">
                                                    <img :src="list.logo">
                                                </div>
                                                <div class="text-group flex-column">
                                                    <p class="pb-0 pt-3 mb-0">{{list.company_name}}</p>
                                                    <div class="quotes_offer" v-if="QuotesOffer.length>0">
                                                        <p class="fs-15 mt-0 pt-0">{{locale.tap_to_choose}}</p>
                                                    </div>
                                                    <div v-if="QuotesOffer.length==0">
                                                        <p class="fs-15 mt-0 pt-0">{{NoQuotesOffer}}</p>

                                                    </div>
                                                </div>
                                                <div class="border-left"></div>
                                                <div class="price-section mt-3"
                                                    v-if="list.price!=null && list.price!=''">
                                                    <p class="mb-1">{{locale.price}}</p>
                                                    <p class="amount_text">{{list.price}}</p>
                                                </div>
                                                <div class="price-section mt-3"
                                                    v-if="list.percentage!=null && list.percentage!=''">
                                                    <p class="mb-1">Percentage</p>
                                                    <p class="amount_text">{{list.percentage}}</p>
                                                </div>
                                            </a>
                                        </div> 
                                        </template>

                                        <div class="quotes-group d-flex align-center justify-content-between mb-2"
                                            v-if="QuotesCompareList.length<=0">
                                            <p>
                                            {{locale.click_show_prices_to_see_quotes}}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--- Green Card modal -->

        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <buy-modal :policy="policy_detail" :token="Auth" :user="user" :baseUrl="base_url" :key="policy_updated"
                    v-if="open_green_card_modal!=false" :locale="locale"></buy-modal>
            </div>
        </div>

        <!--- TPL modal1 -->

        <div class="modal fade in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            v-if="open_tpl_modal==true">
            <div class="modal-dialog" role="document">
                <tplbuy-modal :policy="policy_detail" :token="Auth" :baseUrl="base_url" :key="policy_updated" :locale="locale"></tplbuy-modal>


            </div>
        </div>

        <!--- Full Casco modal3 -->

        <div class="modal fade in" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            v-if="this.open_casco_modal==true">
            <div class="modal-dialog" role="document">
                <cascobuy-modal :baseUrl="base_url" :token="Auth" :policy="policy_detail" :key="policy_updated" :locale="locale"></cascobuy-modal>
            </div>
        </div>

        <!--- Home modal4 -->

        <div class="modal fade in" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            v-if="this.open_home_modal==true">
            <div class="modal-dialog" role="document">
                <homebuy-modal :baseUrl="base_url" :token="Auth" :policy="policy_detail" :key="policy_updated" :locale="locale"></homebuy-modal>
            </div>
        </div>

        <!--Travel modal5-->
        <div class="modal fade in" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            v-if="this.open_travel_outside_modal==true">
            <div class="modal-dialog" role="document">
                <travel-outside-modal :baseUrl="base_url" :token="Auth" :policy="policy_detail" :key="policy_updated" :locale="locale">
                </travel-outside-modal>
            </div>
        </div>

        <!-- Compare-modal -->
        <div id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in"
            aria-modal="true" v-if="showModalNow==true && checked_policy.length==2">
            <div role="document" class="modal-dialog">
                <compare-modal :baseUrl="base_url" :token="Auth" :policies="checked_policy" :key="open_compare_modal" :locale="locale" :policy="policy_type"></compare-modal>
            </div>
        </div>

        <!-- delete modal ------>

        <div id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in" 
                    aria-modal="true">
            <div role="document" class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                    </div>
                    <div class="modal-body">
                        <p class="confirm-text">{{locale.show_car_delete_confirmation}}</p>
                        <div class="confirm-btns">
                            <button type="button" class="yes" @click="DeleteCar('yes',car_details_to_delete)">{{locale.car_delete_yes}}</button>
                            <button type="button" class="no" @click="DeleteCar('no',car_details_to_delete)">{{locale.car_delete_no}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

</template>

<script>
    export default {
        props: [
            'insaurance_logo',
            'base_url',
            'Auth',
            'user',
            'locale',
            'id',
            'lang'
            // 'string'
        ],
        data() {
            return {
                travel_insaurance: {
                    student_outside_albania: null,
                    travel_outside_albania: null,
                },
                loading: false,
                loading2: false,
                loading3: false,
                travel: null,
                not_student_travel: null,
                travel_insaurance_type1: 0,
                travel_insaurance_type2: null,
                IsAddCarFormOpen: false,
                IsGreenCardOpenFormOpen: false,
                IsCascoFormOpen: false,
                QuotesCompareList: [],
                QuotesOffer: [],
                NoQuotesOffer: 'Offers Not Available',
                language_type: this.lang,
                vehicle_list: [],
                tpl_policies: {
                    registration_no: null,
                    tpl_type_id: null,
                    tpl_sub_type_id: null,
                    production_year: null,
                },
                Show_price: false,
                Car_data: null,
                open_green_card_modal: false,
                open_tpl_modal: false,
                open_casco_modal: false,
                open_home_modal: false,
                open_travel_outside_modal: false,
                policy_detail: null,
                checking_policy_type: [],
                policy_type: null,
                policy_updated: 0,
                language: null,
                anyCategorySelected: false,
                update_car_details: null,
                compare_clicked: true,
                compare_now: false,
                cancel: false,
                checked_policy: [],
                car_details_to_delete: null,
                showModalNow: false,
                open_compare_modal: 0,
                compare_error: false,
                show_car_tabs: false,
                OpenTravelInsauranceForm:false,
                OpenHomeInsauranceForm:false,
            }
        },

        methods: {
            getUser(){
                console.log('id',this.id)
                localStorage.setItem('user_id',this.id);
            },

            getTranslatedLanguage() {
                this.language = JSON.parse(localStorage.getItem('translated_language'));

            },

            CarInsaurance(ev){
                var elemTopPoint = ev.pageY;
                window.scroll(0, (elemTopPoint - 50))
                this.show_car_tabs = true;
                this.Show_price = false;
                this.OpenTravelInsauranceForm=false;
                this.OpenHomeInsauranceForm = false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];

                this.ResetQuotesList();

            },

            OpenAddCarForm() {
                this.anyCategorySelected = true;
                this.Show_price = false;
                this.update_car_details = null
                this.IsAddCarFormOpen = true;
                this.IsGreenCardOpenFormOpen = false;
                this.IsCascoFormOpen = false;
                this.OpenTravelInsauranceForm=false;
                this.OpenHomeInsauranceForm = false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];
                this.ResetQuotesList();


            },
            CloseAddCarForm() {
                this.anyCategorySelected = true;
                this.IsAddCarFormOpen = false;
                this.update_car_details = null;
                this.OpenTravelInsauranceForm=false;
                this.OpenHomeInsauranceForm = false;
                this.Show_price = false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];
                this.ResetQuotesList();


            },

            updateParent(data) {
                if(data.length==0){
                    this.ResetQuotesList();
                    return;
                }
                this.checking_policy_type = data.policy_type;
                for (var i in this.checking_policy_type) {
                    this.policy_type = i;
                }
                this.QuotesCompareList = data.message;

                for (let i of this.QuotesCompareList) {

                    if (i.offer.length > 0) {
                        this.QuotesOffer = i.offer;
                    }
                }

            },

            updateParentForCasco(policy_data, input_value) {
                if(policy_data.length==0){
                    this.ResetQuotesList();
                    return;
                }
                this.checking_policy_type = policy_data.policy_type;
                for (var i in this.checking_policy_type) {
                    this.policy_type = i;
                }


                for (var i of policy_data.message) {
                    if (i.percentage != null || i.percentage != '') {
                        i['actual_price'] = input_value.car_value;

                        let price = i.percentage / 100;
                        i['price'] = (+input_value.car_value) * price;
                        i.price = Math.round((i.price * 10000) / 10000).toFixed(2);
                        i.price = Math.round((i.price * 10000) / 10000).toFixed(2);
                        i['price_of_percentage'] = i.price;
                    }
                }
                this.QuotesCompareList = policy_data.message;

                for (let i of this.QuotesCompareList) {

                    if (i.offer.length > 0) {
                        this.QuotesOffer = i.offer;
                    }
                }
            },

            updateParentHome(policy_data, input_value) {
                if(policy_data.length==0){
                    this.ResetQuotesList();
                    return;
                }
                this.checking_policy_type = policy_data.policy_type;
                for (var i in this.checking_policy_type) {
                    this.policy_type = i;
                }

                let home_data = JSON.parse(localStorage.getItem('home_data'));

                for (var i of policy_data.message) {
                    if (i.type == "all") {
                        if (i.percentage != null && i.percentage != '0' && i.percentage != '') {
                            i['price_of_percentage'] = ((+home_data.building_value) + (+home_data.equipmennt_price)) * (
                                +i.percentage / 100);
                            i['price'] = i['price_of_percentage'];
                            i.price = Math.round((i.price * 10000) / 10000).toFixed(2);

                            i.price_of_percentage = i.price;
                            i.price_of_percentage = Math.round((i.price_of_percentage * 10000) / 10000).toFixed(2);
                        }
                    } else if (i.type == "home_value") {

                        if (i.percentage != null && i.percentage != '0' && i.percentage != '') {

                            i['price_of_percentage'] = (+home_data.building_value) * (+i.percentage / 100);
                            i['price'] = i['price_of_percentage'];
                            i.price = Math.round((i.price * 10000) / 10000).toFixed(2);
                            i.price_of_percentage = i.price;
                            i.price_of_percentage = Math.round((i.price_of_percentage * 10000) / 10000).toFixed(2);
                        }
                    }

                }
                this.QuotesCompareList = policy_data.message;

                for (let i of this.QuotesCompareList) {

                    if (i.offer.length > 0) {
                        this.QuotesOffer = i.offer;
                    }
                }
            },

            OpenGreenCardForm() {
                this.Show_price = false;
                this.IsGreenCardOpenFormOpen = true;
                this.anyCategorySelected = true;
                this.IsAddCarFormOpen = false;
                this.IsCascoFormOpen = false;
                this.OpenTravelInsauranceForm=false;
                this.OpenHomeInsauranceForm = false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];
                this.ResetQuotesList();

            },
            OpenCascoForm() {
                this.Show_price = false;
                this.IsCascoFormOpen = true;
                this.IsAddCarFormOpen = false;
                this.OpenHomeInsauranceForm = false;
                this.OpenTravelInsauranceForm=false;
                this.anyCategorySelected = true;
                this.IsGreenCardOpenFormOpen = false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];
                this.ResetQuotesList();

            },

            OpenAddCarButton() {
                this.loading = true;
                this.Show_price = false;
                this.IsGreenCardOpenFormOpen = false;
                this.OpenHomeInsauranceForm = false;
                this.IsAddCarFormOpen = false;
                this.IsCascoFormOpen = false
                this.OpenTravelInsauranceForm=false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];
                this.getCarList();
                this.ResetQuotesList();
            },

            getShowTravelSubId() {
                axios.get(this.base_url + '/api/policy/showTravelSubid/' + this.language_type, {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        this.travel_insaurance.student_outside_albania = res.data.message[0].policy_sub_type_id;
                        this.travel = this.travel_insaurance.travel_outside_albania;


                        this.travel_insaurance.travel_outside_albania = res.data.message[1].policy_sub_type_id;
                        this.not_student_travel = this.travel_insaurance.travel_outside_albania;

                    });
            },

            SelectStudentOutsideAlbania(event) {
                this.Show_price = false;
                this.anyCategorySelected = true;
                this.OpenTravelInsauranceForm=true;
                this.OpenHomeInsauranceForm = false;
                this.travel_insaurance_type1 = 0;
                this.travel_insaurance_type2 = 1;
                this.travel = this.travel_insaurance.student_outside_albania;
                this.ResetQuotesList();

            },
            SelectTravelOutsideAlbania(event,ev2) {

                var elemTopPoint = ev2.pageY;
                window.scroll(0, (elemTopPoint - 50))
                this.OpenTravelInsauranceForm=true;
                this.OpenHomeInsauranceForm = false;
                this.anyCategorySelected = true;
                this.Show_price = false;
                this.travel_insaurance_type1 = 1;
                this.travel_insaurance_type2 = 0;
                this.travel = this.travel_insaurance.travel_outside_albania;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];

                this.ResetQuotesList();



            },
            getCarList() {
                this.IsAddCarFormOpen=false;
                axios.get(this.base_url + '/api/car/showCarlist', {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        this.loading = false;
                        this.vehicle_list = res.data.car_list;
                        console.log(this.vehicle_list, 'list')
                        this.$toastr.success('Successfully found the car list');


                    }).catch((error) => {
                        this.loading = false;
                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }
                    })
            },

            SelectCarToshow(list, evt) {
                this.anyCategorySelected = true;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];

                this.Show_price = true;
                this.Car_data = list;
                this.ResetQuotesList();

                var btns = document.querySelectorAll(".car-name");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].classList.remove("active");
                }

                evt.target.classList.add("active")
            },

            ShowCarPolicies(ev) {
                //Rahul Code
                var elemTopPoint = ev.pageY;
                window.scroll(0, (elemTopPoint - 160))
                console.log(this.tpl_policies.registration_no);
                this.loading2 = true;
                this.tpl_policies.registration_no = this.Car_data.car_registration_number;
                this.tpl_policies.tpl_type_id = this.Car_data.car_tpye;
                this.tpl_policies.tpl_sub_type_id = this.Car_data.car_sub_type;
                if (this.Car_data.production_year == null) {
                    this.tpl_policies.production_year = 'no value';

                } else {
                    this.tpl_policies.production_year = this.Car_data.production_year;

                }
                localStorage.setItem('tpl_data', JSON.stringify(this.tpl_policies));
                axios.post(this.base_url + '/api/policy/tpl',
                        this.tpl_policies, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                Authorization: "Bearer " + this.Auth
                            }
                        }
                    )
                    .then(res => {
                        this.updateParent(res.data);
                        this.loading2 = false;
                        this.$toastr.success('Successfully found the policy list');

                    }).catch((error) => {
                        this.loading2 = false;
                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }


                    })
            },
            selectPolicy(policy) {
                if (this.policy_type == 'green_card') {

                    this.open_green_card_modal = false;
                    this.open_green_card_modal = true;
                } else if (this.policy_type == 'TPL') {
                    this.open_tpl_modal = false;
                    this.open_tpl_modal = true;
                } else if (this.policy_type == 'full_casco') {
                    this.open_casco_modal = false;
                    this.open_casco_modal = true;

                } else if (this.policy_type == 'Home') {
                    this.open_home_modal = false;
                    this.open_home_modal = true;

                } else if (this.policy_type == 'travel_out_side_country' || this.policy_type ==
                    'student_out_side_country') {
                    this.open_travel_outside_modal = false;
                    this.open_travel_outside_modal = true;
                }
                this.policy_updated = this.policy_updated + 1;
                this.policy_detail = policy;


            },

            HomeInsaurance(ev) {
                var elemTopPoint = ev.pageY;
                window.scroll(0, (elemTopPoint - 50))
                this.OpenHomeInsauranceForm = true;
                this.Show_price = false;
                this.anyCategorySelected = true;
                this.OpenTravelInsauranceForm = false;
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];

                this.ResetQuotesList();

            },

            ResetQuotesList() {
                this.QuotesCompareList = [];
            },

            EditCarDetails(car_details) {
                this.update_car_details = car_details;
                this.IsAddCarFormOpen = true

            },

            ConfirmDeleteModal(car_data){
                this.car_details_to_delete=car_data;
            },

            DeleteCar(event,car_details) {


                if (event=='yes' && car_details != null) {

                    axios.delete(this.base_url + '/api/car/' + car_details.car_registration_number, {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        $('#myModal8').modal('hide');
                        $('.modal-backdrop').fadeOut();
                        this.getCarList();
                        this.$toastr.success('Successfully Deleted the car');
                    }).catch((error) => {
                        if (error.response) {
                            this.$toastr.error(error.response.data.message);
                        }
                    })
                } else if(event=='no'){
                    $('#myModal8').modal('hide');
                    $('.modal-backdrop').fadeOut();
                }
            },

            Compare() {
                this.compare_clicked = false;
                this.compare_now = true;
                this.cancel = true;
            },

            CheckedPolicy(evt,list) {
                console.log(this.checked_policy);
                if(this.checked_policy.length==2){
                    evt.target.checked = false;
                }  
                let count = 0;

                console.log(evt.target.checked);
                if(evt.target.checked==true){
                   
                    if (this.checked_policy.length <=2) {
                        this.checked_policy.push(list);

                    }
                }else{
                    console.log('result false');
                    if (this.checked_policy.length > 0) {
                    console.log('length is more than 0');

                        for (let i of this.checked_policy) { 
                            console.log('i',i)
                            console.log('list',list)
                            console.log('i.company_name',i.company_name);
                            console.log('list.company_name',list.company_name)
                            console.log(list.company_name==i.company_name)
                            if (i.company_name == list.company_name) {
                                count = count + 1;
                                console.log(count)
                            }
                            console.log(count)

                            if(count>0){
                                console.log('splicing index', i);
                                let index = this.checked_policy.indexOf(i)
                                let item = this.checked_policy.splice(index, 1);
                                console.log('item',item);
                                break;


                            }

                        }
                        
                    }

                    // if (count <= 0 && this.checked_policy.length<2) {
                    //     this.checked_policy.push(list);
                    // }
                }
                console.log('check', this.checked_policy);
            },

            CancelCompare() {
                this.compare_clicked = true;
                this.compare_now = false;
                this.cancel = false;
                this.checked_policy = [];


            },

            showModal() {
                if (this.checked_policy.length < 2 || this.checked_policy.length > 2) {
                    this.showModalNow = false;
                    this.$toastr.warning(this.locale.select_more_than_two);


                } else if (this.checked_policy.length == 2 ) {
                    this.showModalNow = true;
                    this.open_compare_modal = this.open_compare_modal + 1;
                }
            },

           


        },
        mounted() {
            console.log('Component mounted.');
            console.log(this.lang);
            this.getUser();
            this.getCarList();
            this.getShowTravelSubId();
            this.getTranslatedLanguage();

 
        }


    }

</script>

