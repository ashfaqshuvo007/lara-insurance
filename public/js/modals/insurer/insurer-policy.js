function appendData(response) {
    if(response){
        var i = 0;
        var _html = '';
        $.each(response.policy, function(index, value) {
            i++;
            if(value.status == 1){
                status_check= `<input type="checkbox" class="insurer_policy_status" data-id="${value.insurer_policy_id}" checked /> <span class="thumb track"></span>`;
            }else{
                status_check= `<input type="checkbox" class="insurer_policy_status" data-id="${value.insurer_policy_id}" /> <span class="thumb track"></span>`;
            }
            if(value.policy_sub_type.policy_sub_type_id == 'c1bc21cfdda9' ){
                view = `<a class="delete_police" data-id="27273" href="${insurerPolicyUrl}/policy-tpl/${value.insurer_policy_id}">View</a>`;
            }else if(value.policy_sub_type.policy_sub_type_id == 'dfd3e39b733a'){
                view = `<a class="delete_police" data-id="27273" href="${insurerPolicyUrl}/policy-green-card/${value.insurer_policy_id}">View</a>`;
            }else if(value.policy_sub_type.policy_sub_type_id =='c7824ee08a59'){
                view = `<a class="delete_police" data-id="27273" href="${insurerPolicyUrl}/policy-full-casco/${value.insurer_policy_id}">View</a>`;              
            }else if(value.policy_sub_type .policy_sub_type_id == '74273e1bc257'){
                view = `<a class="delete_police" data-id="27273" href="${insurerPolicyUrl}/policy-home/${value.insurer_policy_id}">View</a>`;
            }else if(value.policy_sub_type .policy_sub_type_id == '0ac2b7cfc696'){
                view = `<a class="delete_police" data-id="27273" href="${insurerPolicyUrl}/policy-travel/${value.insurer_policy_id}">View</a>`;
            }else{
                view = `<a class="delete_police" data-id="27273" href="${insurerPolicyUrl}/policy-travel/${value.insurer_policy_id}">View</a>`;     
            }
            _html =_html+`<tr class="insurer_profile_tr">
                            <td>${value.policy_name}</td>
                            <td>${value.policy_type.name}</td>
                            <td>${value.policy_sub_type.name}</td>
                            <td>${value.commission}%</td>
                            <td>
                            <label class="checkbox-four">
                                ${status_check}
                            </label>
                            </td>
                            <td>${view}</td>
                        </tr>`;
        });       
    } 
    return _html;
}
function appendSelectData(response) {
    if(response){
        var i = 0;
        var _html = '';
        $.each(response.policy_selectbox_list, function(index, value) {
            i++;
            _html =_html+`<option value='${value.insurer_policy_id}'>${value.policy_name}</option>`;
        });       
    } 
    return _html;
}
$('#add-home-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-home-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_home',
        'modal':'policy-doc-Modal',
        'table':'policy_table',
        'policy_selectbox':'policy_name_of_comparision',
        'policy_selectbox1':'policy_offers_id',
        'policy_selectbox2':'policy_name_of_terms_condition',
    }
    globalSubmit(idObj);
});
$('#add-car-policy').submit(function(event){
    event.preventDefault();
    var inputIds = {};
    var $inputs = $('#add-car-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_car',
        'modal':'policy-doc-Modal',
        'table':'policy_table',
        'policy_selectbox':'policy_name_of_comparision',
        'policy_selectbox1':'policy_offers_id',
        'policy_selectbox2':'policy_name_of_terms_condition',
    }
    globalSubmit(idObj);
});
$('#add-travel-policy').submit(function(event){
    event.preventDefault();
    var country_value = $('#country').children("option:selected").val();
    if(country_value == 0){
        $('#country_error_travel').html('Please Select One Item');
    }
    var inputIds = {};
    var $inputs = $('#add-travel-policy :input');
    $inputs.each(function (index)
    {
        inputIds[$(this).attr('name')] = $(this).attr('id');
    });
    let id = $(this).attr('id');
    let idObj = {
        'id':id,
        'inputIds':inputIds,
        'error_msg':'error_travel',
        'modal':'policy-doc-Modal',
        'table':'policy_table',
        'policy_selectbox':'policy_name_of_comparision',
        'policy_selectbox1':'policy_offers_id',
        'policy_selectbox2':'policy_name_of_terms_condition',
    }
    globalSubmit(idObj);
});
$('#policy_name').keyup(function(){
    $('#policy_name_error_home').html('');
});
$('#commission').keyup(function(){
    $('#commission_error_home').html('');
});
$('#policy_name_car').keyup(function(){
    $('#policy_name_error_car').html('');
});
$('#commission_car').keyup(function(){
    $('#commission_error_car').html('');
});
$('#policy_name_travel').keyup(function(){
    $('#policy_name_error_travel').html('');
});
$('#commission_tarvel').keyup(function(){
    $('#commission_error_travel').html('');
});
$('#country').change(function(){
    $('#country_error_travel').html('');
});

$('#file-upload2').change(function () {
    var filepath = this.value;
    var m = filepath.match(/([^\/\\]+)$/);
    var filename = m[1];
    $('#filename2').html(filename);
});
