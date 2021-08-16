@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

/*************** File a claim-Form ******************/
<?php
    $user = Auth::user();
    $token = auth('api')->tokenById($user->id);

    $lang = config('app.locale');
    $files = glob(resource_path('lang/' . $lang . '/layout-file-claim.php'));
    foreach ($files as $file) {
        $strings = require $file;
    }
?>
<h1>{{trans('layout-file-claim.file_a_claim')}}</h1>

<file-claim :base_url="'{{ url('/') }}'" :Auth="{{json_encode($token)}}" :locale="{{json_encode($strings)}}"></file-claim>
    

@endsection
