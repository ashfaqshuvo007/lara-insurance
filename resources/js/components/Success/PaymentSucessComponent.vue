<template>
    <div>
        <div class="thank-you-wrap">
            <h4>Thank You</h4><p>{{data.ShippingNameSurname}}</p>
            <p>Your transaction has been successfull</p>

            <button class="btn addbuttons btn-block button_bottom" @click="ViewInvoice()" :disabled="loading==true">
                <span class="spinner-border spinner-border-sm text-light mr-2" role="status" v-if="loading==true"></span>
                Click Here To View Invoice 
            </button>


        </div> 
    </div>
</template>
<script>

    export default {
         props: [
            'base_url',
            'data',
        ],
        data: function () {
            return {
                loading: false,
                update_policy:{
                    policy_id: null,
                },
                invoice_data:{
                    policy_name:null,
                    policy_type:null,
                    start_date:null,
                    expiry_date: null,
                    PurchAmount: null,
                    Currency: null,
                    BillingEmail:null,
                    BillingPhone:null,
                    BillingCity:null,
                    BillingCountry:null,
                    OrderId:null,
                    TransactionDate:null,
                    CardMask:null,
                    Txntype:null,
                    BillingCustomer:null,
                    AuthCode:null,
                    invoice_number:null,

                },
            
            }
        },

        methods: {
            showTransactionData(){
                var tpl_buy_policy_data = JSON.parse(localStorage.getItem('tpl_buy_policy_data'));
                localStorage.setItem('transaction_data', JSON.stringify(this.data));
                this.policy_details = JSON.parse(localStorage.getItem('tpl_buy_policy_data'));
               
                this.transaction_details = JSON.parse(localStorage.getItem('transaction_data'));
                var card_number = this.transaction_details.CardMask;

                this.data.CardMask = this. transaction_details.CardMask.slice(12);

                this.buy_policy_details = JSON.parse(localStorage.getItem('buy_policy'));
                console.log('data',this.data);
                console.log('data',this.transaction_details);

                //Setting values
                this.invoice_data.BillingEmail = this.transaction_details.BillingEmail;
                this.invoice_data.BillingCustomer = this.transaction_details.CardHolderName;
                this.invoice_data.BillingPhone = this.transaction_details.BillingPhone;
                this.invoice_data.BillingCity = this.transaction_details.BillingCity;
                this.invoice_data.BillingCountry = this.transaction_details.BillingCountry;
                this.invoice_data.OrderId = this.transaction_details.OrderId;
                this.invoice_data.TransactionDate = this.transaction_details.TransactionDate;
                this.invoice_data.CardMask = this.data.CardMask;
                if(this.buy_policy_details.policy_type =='c1bc21cfdda9'){
                    this.invoice_data.Currency = 'Lek';
                   
                }else{
                    this.invoice_data.Currency = 'Euro';

                }
                this.invoice_data.PurchAmount = this.transaction_details.PurchAmount;
                this.invoice_data.policy_name = this.policy_details.policy_name;
                this.invoice_data.policy_type = this.policy_details.policy_type;
                this.invoice_data.start_date = this.buy_policy_details.start_date;
                this.invoice_data.expiry_date = this.buy_policy_details.expiry_date;
                this.invoice_data.Txntype = this.transaction_details.TxnType;
                this.invoice_data.AuthCode = this.transaction_details.AuthCode;
                this.invoice_data.invoice_number = this.transaction_details.invoice_number;
                console.log(this.invoice_data)

                this.SendEmail();
            },

            ViewInvoice(){
                this.loading = true;
                window.location.href = this.base_url+'/invoice';

            },
            SendEmail(){
                axios.post(this.base_url+'/api/send-mail',
                this.invoice_data,
                    {headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        // Authorization: "Bearer "+this.token
                    }}
                    )
                    .then(res => {
                        this.$toastr.success('Email Sent in the mail');
                });
            }
        },
 
        mounted() {
            console.log('Component Dropdown.');
            this.showTransactionData();


        }
    }
</script>