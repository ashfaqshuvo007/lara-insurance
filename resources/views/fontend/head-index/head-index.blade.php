@extends('fontend.layouts.head-master')
@section('title','MySIg by Fidentia | Home')
@section('content')
 

    @include('fontend.layout-index.layout-index-header')
    
    @include('fontend.layout-index.layout-index-body')
    
    @include('fontend.layouts.head-footer')
@endsection

@section('add-js')
<script>
$( document ).ready(function() {
    $('#registration_number_div').hide();
});

    $(document).on("change", "#insurance_name" , function() {
        //insurance name
        var insuranceName = $(this).children("option:selected").val();
        $.ajax({
            url: "{{ route('get_insurance_product') }}",
            type: 'POST',
            data: {'insuranceName': insuranceName,'_token': '{{ csrf_token() }}'},
            dataType: 'json',
            success: function (response) {
                if(response.success === true){

                    var insurance_product =[];
                   
                    $.each(response.get_policy_subType, function(key, value)
                    {
                        insurance_product.push('<option value="'+ key +'">'+ value +'</option>');
                    });

                    $('#product_of_insurance').html(insurance_product.join(''));

                }
      
            },
            error: function(e) {
            }
        });
    });

    $('.select-date').datetimepicker({
        format: 'd-m-Y'
    });

    $("#save_reminder").submit(function(){

        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $(".reminder_button").prop('disabled', true);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache:false,
            data: formData,
            success: function (response) {   // success callback function

            if(response.success === true)
            {
                $(".reminder_button").prop('disabled', false);
                toastr.success('Reminder Added Sucessfully','Success');
                $("#save_reminder")[0].reset();
                $('#registration_number_div').hide();
            }

            },error: function (jqXHR) {
                $(".reminder_button").prop('disabled', false);
                var errormsg = jQuery.parseJSON(jqXHR.responseText);
                $.each(errormsg.errors,function(key,value) {
                    $(".text-danger").show();
                    $('#'+key+'_error').html(value);
                });
            }
        });
    });


    $('#full_name_id').keyup(function(){
      $('#name_error').html('');

    });
    $("#mobile_number_id").keyup(function(){
      $("#mobile_number_error").html('');
      
    });
    $("#email_id").keyup(function(){
      $("#email_error").html('');
    });
    $('#due_date_id').click(function(){
      $('#due_date_error').html('');
    });
    $('#insurance_name').click(function(){
      $('#insurance_type_error').html('');
      $('#insurance_product_error').html('');

    });

    $('#product_of_insurance').click(function(){
      $('#insurance_product_error').html('');
    });

    $('#registration_number_id').click(function(){
      $('#registration_number_error').html('');
    });

    $(document).on("change", "#insurance_name" , function() {
        if($('#insurance_name').val()=="71de088c1a2d")
        {
            $('#registration_number_div').show();
        }
        else
        {
            $('#registration_number_div').hide();
        }
    });
</script>
@endsection


 