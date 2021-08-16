@extends('layouts.app')
@section('title', 'Email OTP Verification')
@section('content')
<body>
    <p>Hello</p>
    <p>Thank You For Your Interest</p>
    <p>please verifiy your OTP.Your Otp Number is</p>
    <p><h1>{{$otp_number}}</h1></p>
</body>
@endsection