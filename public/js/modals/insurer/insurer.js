function viewInsurer(insurer_id){
    var click = `${insurerUrl}/${insurer_id}`;
    var self = '_self';
    window.open(click,self);
}
function appendData(response) {
    if(response){
        var i = 0;
        var _html = '';
        $.each(response.insurer, function(index, value) {
            i++;
           
            if(value.status == 1){
                status_check= `<a class="active-btn" href="${insurerUrl}/${value.insurer_id}">Active</a>`;
            }else{
                status_check= `<a class="delivered in" href="${insurerUrl}/${value.insurer_id}">Inactive</a>`;
            }
            _html =_html+`<tr role="row" class="odd insurer_tr" onclick='viewInsurer("${value.insurer_id}")'>
                            <td class="sorting_1">${value.name}</td>
                            <td>
                                ${status_check}
                            </td>
                        </tr>`;
        });       
    } 
    return _html;
}
$('#form-add-insurer').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#form-add-insurer :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'success_msg':'Insurer Added',
        'error_msg':'error_name',
        'modal':'exampleModal',
        'table':'insurers_table'
    }
    globalSubmit(idObj);
});
$('#insurer_name').keyup(function(){
    $('#name_error_name').html('');
});