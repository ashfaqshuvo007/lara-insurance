$('#add-car-fullcasco-policy').submit(function(event) {
    event.preventDefault();





    var inputIds = {};
    var $inputs = $('#add-car-fullcasco-policy :input');
    $inputs.each(function(index) {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });

    let id = $(this).attr('id');
    let idObj = {
        'id': id,
        'inputIds': inputIds,
        'success_msg': 'Car Full Casco Policy Added',
        'error_msg': 'error_fullcasco',
        'reload_page': 'tpl',
    }
    var varient_1 = $("#varient_1").val();
    var varient_2 = $("#varient_2").val();
    var varient_3 = $("#varient_3").val();
    var varient_4 = $("#varient_4").val();
    var varient_5 = $("#varient_5").val();
    if ($('#full_casco_percentage1').val() != '') {
        if (varient_1.length == 0) {
            toastr.error('Please Seclect  Varient I', 'Error');
            return true;
        }
    }
    if ($('#full_casco_price1').val() != '') {
        if (varient_1.length == 0) {
            toastr.error('Please Seclect  Varient I', 'Error');
            return true;
        }
    }
    if ($('#full_casco_percentage2').val() != '') {
        if (varient_2.length == 0) {
            toastr.error('Please Seclect  Varient II', 'Error');
            return true;
        }
    }
    if ($('#full_casco_price2').val() != '') {
        if (varient_2.length == 0) {
            toastr.error('Please Seclect  Varient II', 'Error');
            return true;
        }
    }
    if ($('#full_casco_percentage3').val() != '') {
        if (varient_3.length == 0) {
            toastr.error('Please Seclect  Varient III', 'Error');
            return true;
        }
    }
    if ($('#full_casco_price3').val() != '') {
        if (varient_3.length == 0) {
            toastr.error('Please Seclect  Varient III', 'Error');
            return true;
        }
    }
    if ($('#full_casco_percentage4').val() != '') {
        if (varient_4.length == 0) {
            toastr.error('Please Seclect  Varient IV', 'Error');
            return true;
        }
    }
    if ($('#full_casco_price4').val() != '') {
        if (varient_4.length == 0) {
            toastr.error('Please Seclect  Varient IV', 'Error');
            return true;
        }
    }
    if ($('#full_casco_percentage5').val() != '') {
        if (varient_5.length == 0) {
            toastr.error('Please Seclect  Varient V', 'Error');
            return true;
        }
    }
    if ($('#full_casco_price5').val() != '') {
        if (varient_5.length == 0) {
            toastr.error('Please Seclect  Varient V', 'Error');
            return true;
        }
    }
    if (varient_1.length > 0 ||
        varient_2.length > 0 ||
        varient_3.length > 0 ||
        varient_4.length > 0 ||
        varient_5.length > 0) {
        if (varient_1.length > 0) {
            var full_casco_percentage1 = $('#full_casco_percentage1').val();
            var full_casco_price1 = $('#full_casco_price1').val();
            if ($('#full_casco_percentage1').val() == '' || parseFloat(full_casco_percentage1) > 100) {
                $('#varient_coverage1_percentage_error_fullcasco').html('Percentage field is required');
                return true;
            }
            if ($('#full_casco_price1').val() == '' || parseFloat(full_casco_price1) > 100) {
                $('#varient_coverage1_price_error_fullcasco').html('Price field is required');
                return true;
            }

        }
        if (varient_2.length > 0) {
            var full_casco_percentage2 = $('#full_casco_percentage2').val();
            var full_casco_price2 = $('#full_casco_price2').val();
            if ($('#full_casco_percentage2').val() == '' || parseFloat(full_casco_percentage2) > 100) {
                $('#varient_coverage2_percentage_error_fullcasco').html('Percentage field is required');
                return true;

            }
            if ($('#full_casco_price2').val() == '' || parseFloat(full_casco_price2) > 100) {
                $('#varient_coverage2_price_error_fullcasco').html('Price field is required');
                return true;
            }

        }
        if (varient_3.length > 0) {
            var full_casco_percentage3 = $('#full_casco_percentage3').val();
            var full_casco_price3 = $('#full_casco_price3').val();
            if ($('#full_casco_percentage3').val() == '' || parseFloat(full_casco_percentage3) > 100) {
                $('#varient_coverage3_percentage_error_fullcasco').html('Percentage field is required');
                return true;
            }
            if ($('#full_casco_price3').val() == '' || parseFloat(full_casco_price3) > 100) {
                $('#varient_coverage3_price_error_fullcasco').html('Price field is required');
                return true;
            }

        }
        if (varient_4.length > 0) {
            var full_casco_percentage4 = $('#full_casco_percentage4').val();
            var full_casco_price4 = $('#full_casco_price4').val();

            if ($('#full_casco_percentage4').val() == '' || parseFloat(full_casco_percentage4) > 100) {
                $('#varient_coverage4_percentage_error_fullcasco').html('Percentage field is required');
                return true;
            }
            if ($('#full_casco_price4').val() == '' || parseFloat(full_casco_price4) > 100) {
                $('#varient_coverage4_price_error_fullcasco').html('Price field is required');
                return true;
            }

        }
        if (varient_5.length > 0) {
            var full_casco_percentage5 = $('#full_casco_percentage5').val();
            var full_casco_price5 = $('#full_casco_price5').val();
            if ($('#full_casco_percentage5').val() == '' || parseFloat(full_casco_percentage5) > 100) {
                $('#varient_coverage5_percentage_error_fullcasco').html('Percentage field is required');
                return true;
            }
            if ($('#full_casco_price5').val() == '' || parseFloat(full_casco_price5) > 100) {
                $('#varient_coverage5_price_error_fullcasco').html('Price field is required');
                return true;
            }

        }

        globalSubmit(idObj);
    } else {
        toastr.error('Please Seclect Minimum One Varient', 'Error');
        return true;
    }
});
$('#full_casco_percentage5').keyup(function() {
    $('#varient_coverage5_percentage_error_fullcasco').html('');
});
$('#full_casco_price5').keyup(function() {
    $('#varient_coverage5_price_error_fullcasco').html('');
});
$('#full_casco_percentage4').keyup(function() {
    $('#varient_coverage4_percentage_error_fullcasco').html('');
});
$('#full_casco_price4').keyup(function() {
    $('#varient_coverage4_price_error_fullcasco').html('');
});
$('#full_casco_price3').keyup(function() {
    $('#varient_coverage3_price_error_fullcasco').html('');
});
$('#full_casco_percentage3').keyup(function() {
    $('#varient_coverage3_percentage_error_fullcasco').html('');
});
$('#full_casco_percentage2').keyup(function() {
    $('#varient_coverage2_percentage_error_fullcasco').html('');
});
$('#full_casco_price2').keyup(function() {
    $('#varient_coverage2_price_error_fullcasco').html('');
});
$('#full_casco_percentage1').keyup(function() {
    $('#varient_coverage1_percentage_error_fullcasco').html('');
});
$('#full_casco_price1').keyup(function() {
    $('#varient_coverage1_price_error_fullcasco').html('');
});