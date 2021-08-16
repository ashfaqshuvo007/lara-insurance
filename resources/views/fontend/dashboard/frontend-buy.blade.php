@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')
<?php
        $user = Auth::user();
        $token = auth('api')->tokenById($user->id);

        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/layout-tpl-buy.php'));
        foreach ($files as $file) {
            $strings = require $file;
        }
    ?>

<h1>Green Card Buy Now Form</h1>

<buy-form :Auth="{{json_encode($token)}}" 
    :Auth="{{json_encode($token)}}" 
    :user="{{json_encode($user)}}" 
    :locale="{{json_encode($strings)}}" 
    :lang="{{json_encode($lang)}}"
    :base_url="'{{ url('/') }}'">
<buy-form>

    
    

@endsection
