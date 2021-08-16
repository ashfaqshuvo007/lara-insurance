$('#add-travel-sub1-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-travel-sub1-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_travel_sub1',
        'reload_page':'tpl',
    }
    globalSubmit(idObj);
});
$('#add-travel-sub2-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-travel-sub2-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_travel_sub2',
        'reload_page':'tpl',
    }
    globalSubmit(idObj);
});
$('#add-travel-student-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-travel-student-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_travel_student',
        'reload_page':'tpl',
    }
    globalSubmit(idObj);
});
$('#travel_sub2_price').keyup(function(){
    $('#price_error_travel_sub2').html('');
});
$('#travel_sub1_price').keyup(function(){
    $('#price_error_travel_sub1').html('');
});
$('#travel_student_price').keyup(function(){
    $('#price_error_travel_student').html('');
});