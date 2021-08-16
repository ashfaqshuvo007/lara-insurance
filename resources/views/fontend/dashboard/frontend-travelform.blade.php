@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

/*************** Travel Form ******************/

<?php
    $user = Auth::user();
    $token = auth('api')->tokenById($user->id);


    $lang = config('app.locale');
    $files = glob(resource_path('lang/' . $lang . '/layout-tpl-buy.php'));
    foreach ($files as $file) {
        $strings = require $file;
    }
?>

<h1>{{trans('layout-body.policy_details_for_header')}}</h1>

<travel-albania-buy :Auth="{{json_encode($token)}}" 
    :user="{{json_encode($user)}}"
    :lang="{{json_encode($lang)}}" 
    :base_url="'{{ url('/') }}'" 
    :locale="{{json_encode($strings)}}">
</travel-albania-buy>

    
    

@endsection
