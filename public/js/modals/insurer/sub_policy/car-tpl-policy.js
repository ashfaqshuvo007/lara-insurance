$('#add-tpl-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-tpl-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_tpl',
        'reload_page':'tpl',
    }
    globalSubmit(idObj);
});
$('#tpl_price').keyup(function(){
    $('#price_error_tpl').html('');
});
