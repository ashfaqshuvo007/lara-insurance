@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

<?php
    $user = Auth::user();
    $token = auth('api')->tokenById($user->id);

    $lang = config('app.locale');
    $files = glob(resource_path('lang/' . $lang . '/layout-shipping.php'));
    foreach ($files as $file) {
        $strings = require $file;
    }
?>

<h1 style="margin-top: 165px ">{{$strings['shipping_details']}}</h1>

<shipping :base_url="'{{ url('/') }}'" :Auth="{{json_encode($token)}}" :locale="{{json_encode($strings)}}"></shipping>

    
@endsection
