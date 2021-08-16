/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'

window.Vue = require('vue');
window.toastr = require('toastr');
 
Vue.use(VueToastr2)



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('quotes-component', require('./components/Quotes/QuotesComponent').default);
Vue.component('add-cars', require('./components/Quotes/AddCarComponent').default);
Vue.component('home-insurance-form', require('./components/Quotes/Forms/HomeInsuranceFormComponent').default);
Vue.component('green-card', require('./components/Quotes/GreenCard').default);
Vue.component('casco', require('./components/Quotes/CascoComponent').default);
Vue.component('compare-quotes-component', require('./components/Quotes/CompareQuotesComponent').default);
Vue.component('travel-albania', require('./components/Quotes/TravelAlbaniaInsaurance').default);
Vue.component('student-albania', require('./components/Quotes/StudentAlbaniaInsaurance').default);
Vue.component('buy-modal', require('./components/Modal/BuyModalComponent').default);
Vue.component('tplbuy-modal', require('./components/Modal/TPLBuyModalComponent').default);
Vue.component('cascobuy-modal', require('./components/Modal/CascoBuyModalComponent').default);
Vue.component('homebuy-modal', require('./components/Modal/HomeBuyModalComponent').default);
Vue.component('travel-outside-modal', require('./components/Modal/TravelOutsideBuyModalComponent').default);
Vue.component('buy-form', require('./components/Quotes/Forms/BuyNowFormComponent').default);
Vue.component('claim-list', require('./components/Claims/ClaimListComponent').default);
Vue.component('policy-list', require('./components/Policy/MyPoliciesComponent').default);
Vue.component('tpl-buy', require('./components/Quotes/Forms/TPLBuyPolicyFormComponent').default);
Vue.component('casco-buy', require('./components/Quotes/Forms/CascoBuyPolicyFormComponent').default);
Vue.component('home-buy', require('./components/Quotes/Forms/HomeBuyPolicyFormComponent').default);
Vue.component('travel-albania-buy', require('./components/Quotes/Forms/TravelAlbaniaBuyPolicyComponent').default);
Vue.component('choose-policy', require('./components/Quotes/Forms/ChoosePolicyToClaimFormComponent').default);
Vue.component('file-claim', require('./components/Quotes/Forms/FileClaimFormComponent').default);
Vue.component('file-claim-home', require('./components/Quotes/Forms/FileClaimFormHomeComponent').default);
Vue.component('select-language', require('./components/Language/LanguageComponent').default);
Vue.component('compare-modal', require('./components/Modal/ComparePolicyModalComponent').default);
Vue.component('loader', require('./components/Loader/LoaderComponent').default);
Vue.component('contentloader', require('./components/Loader/ContentLoaderComponent').default);
Vue.component('shipping', require('./components/Quotes/Forms/ShippingDetailsFormComponent').default);
Vue.component('payment-form', require('./components/Quotes/Forms/PaymentFormComponent').default);
Vue.component('thank-you', require('./components/Success/PaymentSucessComponent').default);
Vue.component('invoice', require('./components/Success/InvoiceComponent').default);
Vue.component('invoice_pdf', require('./components/Success/InvoicePdfComponent').default);
Vue.component('payment-failed', require('./components/Success/PaymentFailedComponent').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

