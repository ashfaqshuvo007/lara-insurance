@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Home')
<style>
    .invoice-wrap {
        padding: 150px 0 80px 0;
    }

    .invoice-head {
        border-bottom: 4px solid #000;
        padding-bottom: 20px;
    }

    .invoice-head .logo {
        text-align: center;
        width: 100%;
    }

    .invoice-head .heading h2 {
        font-weight: 900;
    }

    .invoice-head .logo img {
        height: 170px;
    }

    .invoice-body {
        margin-top: 40px;
    }

    .invoice-body .bill-to {
        display: flex;
        flex-wrap: wrap;
    }

    .invoice-body .bill-detail {
        float: right;
    }

    .invoice-body .bill-detail .bill-detail-info {
        display: flex;
    }

    .invoice-body .strong {
        font-weight: 900;
        padding-right: 20px;
    }

    .invoice-body .bill-detail table {
        float: right;
    }

    .invoice-body .bill-detail table tr {
        height: 35px;
    }

    .invoice-body .bill-detail table th {
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

    .invoice-footer{
        margin-top: 40px;
    }

    .invoice-body .strong {
        font-weight: 900;
    }

</style>
@section('content')

<section class="invoice-wrap">
    <div class="container">
    <invoice 
        :insaurance_logo="{{json_encode(URL::asset('frontend/images/Logo.png'))}}"
        :base_url="'{{ url('/') }}'">
    </invoice>
    </div>
</section>

@endsection
