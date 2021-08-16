$('#add-home-sub-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-home-sub-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    console.log(inputIds);
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'success_msg':'Home Sub Policy Added',
        'error_msg':'error_home_sub'
    }
    toastr.error( 'Under development');
    // globalSubmit(idObj);
});
$('#square_m2').keyup(function(){
    $('#square_error_home_sub').html('');
});