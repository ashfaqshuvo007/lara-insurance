@extends('layouts.master')
@section('title','MySIg by Fidentia | Tpl')
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Tpl
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Tpl</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                  {!! Form::open(['route'=>'car_tpl_policy_add','role'=>'form','files'=>true,'id'=>'add-tpl-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                        @if(isset($insurer_sub_Policy))
                              {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                              {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                        @endif 
                      <!--Size dropdown menu-->
                      {{Form::select('tpl_type_id',$tpl_type_list,null,['class'=>'form-control','id'=>'tpl_type'])}}
                      <!--Size dropdown content-->
                      <div id="option1" class="size_chart">
                        <div class="form-group mt_5">
                          {{Form::label('Another Dropdown for Sub Catagory')}}
                          {{Form::select('tpl_sub_type_id',$tpl_sub_type_list,null,['class'=>'form-control','id'=>'tpl_sub_type'])}}
                        </div>
                       
                          
                      </div>
                      <div class="form-group">
                          {{Form::label('Price')}}
                          {{Form::text('price',null,['class'=>'form-control commission_input','id'=>'tpl_price'])}}
                          <div class="text-danger"><strong id="price_error_tpl"></strong></div>
                        </div>
                      {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                    {{Form::close()}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Car</h4>
                    <div class="table-responsive">
                      <table class=" 
                        table table-bordered 
                        table-hover 
                        table-striped" id="tpl_table1">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th >CC</th>
                            <th >price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == '5387b8bf5632')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td >{{$tpl_entry['tpl_sub_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Bike</h4>
                    <div class="table-responsive document_div">
                      <table class=" 
                        table table-bordered 
                        table-hover 
                        table-striped" id="tpl_table2">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th >CC</th>
                            <th >price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == 'd931b542bcad')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td >{{$tpl_entry['tpl_sub_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-md-12">
                    <h4>Car engine</h4>
                    <div class="table-responsive document_div">
                      <table class=" table 
                        table-bordered table-hover 
                        table-striped" id="tpl_table3">
                        <thead>
                          <tr>
                            <th >type</th>
                            <th >CC</th>
                            <th >price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == 'd88ed7fda1fa')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td >{{$tpl_entry['tpl_sub_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-12">
                    <h4>Van</h4>
                    <div class="table-responsive document_div">
                      <table class=" 
                        table table-bordered 
                        table-hover 
                        table-striped" id="tpl_table4">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th >seater</th>
                            <th >price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == '0c0361f6647e')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td >{{$tpl_entry['tpl_sub_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Bus</h4>
                    <div class="table-responsive document_div">
                      <table class=" table 
                        table-bordered table-hover 
                        table-striped" id="tpl_table5">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th>price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == '22b8a3a60595')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Trucks</h4>
                    <div class="table-responsive document_div">
                      <table class=" 
                        table table-bordered 
                        table-hover 
                        table-striped" id="tpl_table6">
                        <thead>
                          <tr>
                            <th >type</th>
                            <th >CC</th>
                            <th >price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == 'bacb3f1ffff6')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td >{{$tpl_entry['tpl_sub_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Trailer</h4>
                    <div class="table-responsive document_div">
                      <table class=" table 
                        table-bordered table-hover 
                        table-striped" id="tpl_table7">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th>price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == 'c32b0536df2f')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Agricultural Vehicle</h4>
                    <div class="table-responsive document_div">
                      <table class=" table 
                        table-bordered table-hover 
                        table-striped" id="tpl_table8">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th>price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == '497a41074388')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Firefighters</h4>
                    <div class="table-responsive document_div">
                      <table class=" table 
                        table-bordered table-hover 
                        table-striped" id="tpl_table9">
                        <thead>
                          <tr>
                            <th>type</th>
                            <th>price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($tpl_list_details))
                          @foreach($tpl_list_details as $key => $tpl_entry)
                          @if($tpl_entry['tpl_type']['tpl_type_id'] == 'a51933d621cb')
                          <tr class="customer_link open">
                            <td>{{$tpl_entry['tpl_type']['name']}}</td>
                            <td>€{{$tpl_entry['price']}}</td>
                            <td>
                              <label class="checkbox-four">
                                @if($tpl_entry['status'] == 1)
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" checked class="tpl_status"/> <span class="track thumb"></span>
                                @else
                                <input type="checkbox" data-id="{{$tpl_entry['tpl_entry_id']}}" class="tpl_status"/> <span class="track thumb"></span>
                                @endif
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
@section('add-js')
<script src="{{URL::asset('js/modals/insurer/sub_policy/car-tpl-policy.js')}}"></script>
<script>
$(document).ready(function () {
  function appendData(response) {
    if(response){
        var i = 0;
        var _html = '';
        $.each(response.subcatagory, function(index, value) {
            i++;
            _html =_html+`<option value='${value.tpl_sub_type_id}'>${value.name}</option>`;
        });       
    } 
    return _html;
}
  $('#tpl_type').change(function(){
      if($(this).val() != '')
         {
            var value = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
               url:"{{ route('car_tpl_change_catagory') }}",
               method:"post",
               data:{value:value, _token:_token},
               success:function(response)
               {
                 if(response.success === true){
                  $('#tpl_sub_type').html(appendData(response));
                 }
               },
               error:function(){

               }

            })
         }
   });  
   $(document).on('change','.tpl_status',function(){
        var ischecked = $(this).is(':checked');
        var id = $(this).attr('data-id');
        var active = 0;
        if(ischecked) {
            active = 1;
        } else {
            active = 0;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('car_tpl_policy_add_status') }}",
            data: {'id':id,'active':active,"_token": " {{ csrf_token() }}"},
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if(response.status == 1){
                    if(active == 0){   
                        toastr.success( 'Status disabled');
                    }
                    if(active == 1){
                        toastr.success( 'Status enabled');
                        
                    }
                }
            }
        })
    });
   
});
</script>

@endsection