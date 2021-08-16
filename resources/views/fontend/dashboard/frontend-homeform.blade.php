@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

/*************** Home Form ******************/
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
<home-buy :Auth="{{json_encode($token)}}" 
    :user="{{json_encode($user)}}" 
    :base_url="'{{ url('/') }}'"
    :lang="{{json_encode($lang)}}" 
    :locale="{{json_encode($strings)}}">
</home-buy>


    

@endsection
