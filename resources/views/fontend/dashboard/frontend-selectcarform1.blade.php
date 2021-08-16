@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

/*************** Select Car Form1 ******************/

<?php
        $user = Auth::user();
        $token = auth('api')->tokenById($user->id);

        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/layout-tpl-buy.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
    ?>

<h1>{{trans('layout-tpl-buy.policy_data')}}</h1>
<tpl-buy :Auth="{{json_encode($token)}}" :user="{{json_encode($user)}}" :base_url="'{{ url('/') }}'" 
:locale="{{json_encode($strings)}}" :lang="{{json_encode($lang)}}"></tpl-buy>


    
    

@endsection
