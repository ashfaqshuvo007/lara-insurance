@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

/*************** File a claim-Form ******************/
<?php
        $user = Auth::user();
        $token = auth('api')->tokenById($user->id);
    ?>
<h1>File a Claim For Home Form</h1>

<file-claim-home :base_url="'{{ url('/') }}'" :Auth="{{json_encode($token)}}"></file-claim-home>


    
    

@endsection
