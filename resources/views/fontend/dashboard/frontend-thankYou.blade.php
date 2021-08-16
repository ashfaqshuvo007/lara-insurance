@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Home')
@section('content')
       
<?php
// dd($transaction_data['ShippingNameSurname']);

?>
    
        <thank-you :base_url="'{{ url('/') }}'" :data="{{json_encode($transaction_data)}}"></thank-you>
        
@endsection

<!-- @section('add-js') -->
<!-- <script>
    Test();
    console.log('test');
    function Test(){
        console.log('test');

        var test = "{{ request() }}";
        console.log('test');
        var dd = '
         // $input= $request->all();
        // dd($input);
        console.log(dd);
    }

</script> -->
<!-- @endsection -->
