function form_reset(idObj) {
    if (idObj.inputIds.policy_name != undefined) {
        $('#' + idObj.inputIds.policy_name).val('');
    }
    if (idObj.inputIds.name != undefined) {
        $('#' + idObj.inputIds.name).val('');
    }
    if (idObj.inputIds.commission != undefined) {
        $('#' + idObj.inputIds.commission).val('');
    }
    if (idObj.inputIds.country != undefined) {
        $('#' + idObj.inputIds.country).prop('selectedIndex', 0);
    }
    if (idObj.inputIds.policy_sub_type != undefined) {
        $('#' + idObj.inputIds.policy_sub_type).prop('selectedIndex', 0);
    }
    //travel form
    if (idObj.inputIds.price != undefined) {
        $('#' + idObj.inputIds.price).val('');
    }
    if (idObj.inputIds.zone != undefined) {
        $('#' + idObj.inputIds.zone).prop('selectedIndex', 0);
    }
    if (idObj.inputIds.validity != undefined) {
        $('#' + idObj.inputIds.validity).prop('selectedIndex', 0);
    }
    //end travel
    //home form
    if (idObj.inputIds.square != undefined) {
        $('#' + idObj.inputIds.square).val('');
    }
    if (idObj.inputIds.home_sub_type_id != undefined) {
        $('#' + idObj.inputIds.home_sub_type_id).prop('selectedIndex', 0);
    }
    if (idObj.inputIds.address != undefined) {
        $('#' + idObj.inputIds.address).prop('selectedIndex', 0);
    }
    if (idObj.inputIds.unit != undefined) {
        $('#' + idObj.inputIds.unit).prop('selectedIndex', 0);
    }
    // end form
}

function buttonDisabled(btnid) {
    $('#' + btnid).attr('disabled', true);
}

function buttonEnabled(btnid) {
    $('#' + btnid).attr('disabled', false);
}

function globalSubmit(idObj) {
    var formData = new FormData($('#' + idObj.id)[0]);
    buttonDisabled(idObj.inputIds.submit_button);
    $.ajax({
        url: $('#' + idObj.id).attr('action'),
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success: function(response) { // success callback function
            if (response.success === true) {
                form_reset(idObj);
                buttonEnabled(idObj.inputIds.submit_button);
                if (response.update != undefined) {
                    toastr.success('Policy Updated', 'Success');
                }
                if (response.error_match != undefined) {
                    toastr.success('policy match', 'Success');
                }
                if (response.add != undefined) {
                    toastr.success('Policy Added', 'Success');
                }
                if (idObj.success_msg != undefined) {
                    toastr.success(idObj.success_msg, 'Success');
                }
                if (idObj.modal !== undefined) {
                    $('#' + idObj.modal).modal('hide');
                }
                if (idObj.table != undefined) {
                    $('#' + idObj.table).html(appendData(response));
                }
                if (idObj.reload_page == 'tpl') {
                    location.reload(true);
                }
                if (idObj.policy_selectbox != undefined) {
                    if (response.policy_selectbox_list) {
                        $('#' + idObj.policy_selectbox).html(appendSelectData(response));
                    }
                }
                if (idObj.policy_selectbox1 != undefined) {
                    if (response.policy_selectbox_list) {
                        $('#' + idObj.policy_selectbox1).html(appendSelectData(response));
                    }
                }
                if (idObj.policy_selectbox2 != undefined) {
                    if (response.policy_selectbox_list) {
                        $('#' + idObj.policy_selectbox2).html(appendSelectData(response));
                    }
                }
            }
        },
        error: function(jqXHR) {
            buttonEnabled(idObj.inputIds.submit_button);
            var errormsg = jQuery.parseJSON(jqXHR.responseText);
            if (errormsg.error != undefined) {
                toastr.error(errormsg.error, 'Error');
            }
            $.each(errormsg.errors, function(key, value) {
                $('#' + key + '_' + idObj.error_msg).html(value);
            });
        }
    });
}
$('.commission_persent').on('input', function(e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});

$('.commission_input').mask("#,##0.00", { reverse: true });
