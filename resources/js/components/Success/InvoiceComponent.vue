<template>
    <div>
        <div class="invoice-head">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo">
                        <img :src="base_url+'/frontend/images/Logo.png'" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="address">
                        <h4>MySig by Fidentia Sh.a</h4>
                        <p>L32410006N</p>
                        <p>Rr:'lsmail Qemali", Nr.27, Kuna "Fratari", Kati I Tirané, K.P. 1001</p>
                        <p>(+355) 69 20 45 790</p>
                        <p>mysig@fidentia.al</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="heading">
                        <h2>Invoice</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="invoice-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="bill-to">
                        <p class="strong">Bill To</p>
                        <div class="bill-to-info" v-if="policy_details!=null">
                            <p>mysig@fidentia.al</p>
                            <p>{{transaction_details.BillingEmail}}</p>
                            <p>{{transaction_details.BillingPhone}}</p>
                            <p>{{transaction_details.BillingCity}}, {{transaction_details.BillingCountry}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bill-detail" v-if="policy_details!=null">
                        <table>
                            <tr>
                                <th>Invoice Number</th>
                                <td>{{transaction_details.invoice_number}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td>{{ moment(transaction_details.TransactionDate).format("DD/MM/YYYY") }}</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td>app.mysig.al</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <table class="invoice-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span v-if="policy_details!=null">{{policy_details.policy_name}}</span> <span v-if="policy_details!=null&&(policy_details.policy_type=='c1bc21cfdda9' ||policy_details.policy_type=='dfd3e39b733a'  || policy_details.policy_type=='c7824ee08a59')">{{policy_details.car_registration_number}}</span> | <span v-if="policy_details!=null">{{ moment(buy_policy_details.start_date).format("DD/MM/YYYY") }} - {{ moment(buy_policy_details.expiry_date).format("DD/MM/YYYY") }}</span><br><br>
                            Payment Details:<br>
                            Master Card — 4 last digits Of the card: **** **** ****<span v-if="policy_details!=null"> {{transaction_details.CardMask}}</span><br>
                            Transactin Type: <span v-if="policy_details!=null">{{transaction_details.Txntype}}</span></td>
                        <td>
                            1
                        </td>
                        <td>
                            <span v-if="policy_details!=null && policy_details.policy_type=='c1bc21cfdda9'">Lek</span> <span v-if="policy_details!=null && policy_details.policy_type!='c1bc21cfdda9'">Euro</span> <span v-if="policy_details!=null">{{transaction_details.PurchAmount}} </span> 
                        </td>
                        <td>
                            <span v-if="policy_details!=null && policy_details.policy_type=='c1bc21cfdda9'">Lek</span> <span v-if="policy_details!=null && policy_details.policy_type!='c1bc21cfdda9'">Euro</span> <span v-if="policy_details!=null">{{transaction_details.PurchAmount}} </span> 
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">Total:</th>
                        <th>
                            <span v-if="policy_details!=null && policy_details.policy_type=='c1bc21cfdda9'">Lek</span> <span v-if="policy_details!=null && policy_details.policy_type!='c1bc21cfdda9'">Euro</span> <span v-if="policy_details!=null">{{transaction_details.PurchAmount}}</span> 
                        </th>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="total-amount">
                <p class="strong">Total</p>
                <p>Lek19532.00</p>
            </div> -->
        </div>
        <div class="invoice-footer">
            <p class="strong">Anullimi i polices realizohet vetem rne shoqerine e sigurimit.</p>
        </div>
    </div>
</template>
<script>
    import moment from "moment";

    export default {
        props: ['mysig_logo', 'base_url'],
        data: function () {
            return {
                moment: moment,
                policy_details:null,
                buy_policy_details:null,
                transaction_details:null,
                update_transaction:{
                    policy_id: null,
                    transaction_id: null,
                }
            }
        },
        methods: {
            getPolicyData(){
                this.policy_details = JSON.parse(localStorage.getItem('tpl_buy_policy_data'));
                var policy_created = JSON.parse(localStorage.getItem('policy_created'));
                this.update_transaction.policy_id = policy_created;

                this.transaction_details = JSON.parse(localStorage.getItem('transaction_data'));
                var card_number = this.transaction_details.CardMask;

                console.log(this.transaction_details);

                this. transaction_details.CardMask = this. transaction_details.CardMask.slice(12);
                this.update_transaction.transaction_id = this.transaction_details.transaction_id;

                this.buy_policy_details = JSON.parse(localStorage.getItem('buy_policy'));
                console.log(this.transaction_details);



                 axios.post(this.base_url + '/api/update-transaction-details',
                        this.update_transaction, {
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                            }
                        }
                    )
                    .then(res => {
    
                    }).catch((error) => {

                    })

            }
        },

        mounted() {
            this.getPolicyData();
        },
    }

</script>
