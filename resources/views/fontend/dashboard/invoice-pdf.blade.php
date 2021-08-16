<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice-PDF</title>

    <style>
        .invoice-wrap {
    padding: 40px 50px 40px 50px;
}

        .invoice-head {
    border-bottom: 4px solid #000;
    padding-bottom: 20px;
    width: 100%;
    display: inline-block;
}

        .invoice-head .logo {
            width: 30%;
            float: left;
        }

.invoice-head .address{
    width: 50%;
    float: left;
}

.invoice-head .heading{
    width: 20%;
    float: left;
}
        .invoice-head .heading h2 {
            font-weight: 900;
            font-size: 30px;
        }

        .invoice-head .logo img {
            height: 170px;
        }

        .invoice-body {
            margin-top: 40px;
            margin-bottom: 40px;
            width: 100%;
        }

        .invoice-body .bill-to {
            width: 50%;
            float: left;
        }

        .invoice-body .bill-detail {
            width: 50%;
            float: right;
        }

        .invoice-body .strong {
            font-weight: 900;
            padding-right: 20px;
        }

        .invoice-body .bill-detail table {
            float: right;
        }

        .invoice-body .bill-detail table tr,
        .invoice-body .bill-to table tr {
            height: 35px;
        }

        .invoice-body .bill-detail table th,
        .invoice-body .bill-to table th {
            text-align: right;
            padding-right: 15px;
        }

        .invoice-table {
            margin-top: 40px;
        }

        .invoice-table,
        .invoice-table th,
        .invoice-table td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .invoice-table thead {
            background-color: #efefef;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 15px;
            text-align: left;
        }

        .invoice-body .total-amount {
            display: flex;
            padding-bottom: 0px;
            border-bottom: 2px solid #000;
            float: right;
            padding-top: 15px;
        }

        .invoice-body .total-amount .strong {
            padding-right: 30px;
            font-weight: 900;
        }

        .invoice-footer {
            margin-top: 40px;
        }

        .invoice-body .strong {
            font-weight: 900;
        }
    </style>

</head>

<body>

    <section class="invoice-wrap">
        <div class="container">
            <div>
                <div class="invoice-head">
                            <div class="logo">
                                <img src="https://app.mysig.al/frontend/images/Logo.png" alt="">
                            </div>
                            <div class="address">
                                <h4>MySig by Fidentia Sh.a</h4>
                                <p>L32410006N</p>
                                <p>Rr:'lsmail Qemali", Nr.27, Kulla "Fratari", Kati I Tirané, K.P. 1001</p>
                                <p>(+355) 69 20 45 790</p>
                                <p>mysig@fidentia.al</p>
                            </div>
                            <div class="heading">
                                <h2>Invoice</h2>
                            </div>
                </div>
                
                <div class="invoice-body">
                    <div class="bill-to">
                        <table>
                            <tr>
                                <th>Bill To</th>
                                <td>{{$invoice_pdf_data['BillingCustomer']}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{{$invoice_pdf_data['BillingEmail']}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>+{{$invoice_pdf_data['BillingPhone']}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{{$invoice_pdf_data['BillingCity']}}, {{$invoice_pdf_data['BillingCountry']}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="bill-detail">
                        <table>
                            <tr>
                                <th>Invoice Number</th>
                                <td>{{$invoice_pdf_data['invoice_number']}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td>{{$invoice_pdf_data['TransactionDate']}}</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td>mysig.al</td>
                            </tr>
                        </table>
                    </div>
                    <br clear="all">
                    <table class="invoice-table" style="width: 100%; margin-top:35px">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$invoice_pdf_data['policy_name']}} | {{$invoice_pdf_data['start_date']}} - {{$invoice_pdf_data['expiry_date']}}<br>
                                    Order Id: {{$invoice_pdf_data['OrderId']}}<br><br>

                                    Payment Details: Master Card — 4 last digits Of the card: {{$invoice_pdf_data['CardMask']}}<br>
                                    Transactin Type: {{$invoice_pdf_data['Txntype']}}<br>
                                    Authorization Code: {{$invoice_pdf_data['AuthCode']}}
                                </td>
                                <td>
                                    {{$invoice_pdf_data['Currency']}} {{$invoice_pdf_data['PurchAmount']}}
                                </td>
                            </tr>
                            <tr>
                                <th >Total:</th>
                                <th>
                                {{$invoice_pdf_data['Currency']}} {{$invoice_pdf_data['PurchAmount']}}
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
        </div>
    </section>

</body>

</html>