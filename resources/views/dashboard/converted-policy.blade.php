@extends('layouts.master')
@section('title','MySIg by Fidentia | Converted Policy')
@section('css')
	<link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Converted Policy
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Converted Policy</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="btnGrp">
                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample"> <i class="fa fa-filter"
                      aria-hidden="true"></i> Apply Filter</button>
                </div>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <div class="row">
                      <div class="form-group col-md-3">
                        {{Form::label('Insurance Company')}}
                          <select class="form-control" name="company" id="insurance_company">
                                <option value="">Select Insurance Company </option>
                                  @foreach ($Insurerdata as $item)
                                      <option value="{{ $item->insurer_id  }}">{{ $item->name}}</option>
                                  @endforeach
                          </select>
                      </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Insurance Type')}}
                          {{--  {{ Form::select('insurance_category', array('1' => '1', '2' => '2','3'=>'3','4'=>'4'), null, ['class'=>'form-control','id'=>'dis_insurance_category','placeholder' => 'insurance category'])}}  --}}
                          <select class="form-control" name="type" id="filter_type">
                            <option value="">Select Insurance Company </option>
                              @foreach ($policySubType as $item)
                                  <option value="{{ $item->policy_sub_type_id  }}">{{ $item->name}}</option>
                              @endforeach
                      </select>
                        </div>

                        <div class="form-group col-md-3">
                        {{Form::label('status')}}
                        {{Form::select('status',array(''=>'Select Status','1'=>'Requested','2'=>'Not Issued','3'=>'Issued','4'=>'Sent','5'=>'Delivered'),null,['class'=>'form-control','id'=>'policy_status'])}}

                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Date range:')}}
                          <div class="input-group">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i>
                            </div>
                            {{Form::text('con_policy_date_range',null,['class'=>'form-control pull-right','id'=>'reservation','autocomplete'=>'off'])}}
                          </div>
                          <!-- /.input group -->
                        </div>
                        <div class="form-group col-md-3 mt_5">
                          <button type="button" class="btn btn-primary  w-100 " id="filter-col" onclick="filterRecord()">Apply</button>

                        </div>
                        <div class="form-group col-md-3 mt_5">
                          {{Form::submit('Export',['class'=>'btn btn-danger w-100'])}}
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">

                    <!-- <div class="dataTable__wrapper">
                        <table class="table table-bordered" id='s'>
                          <thead>
                            <tr>
                              <th></th>
                              <th>PL ID</th>
                              <th>Date</th>
                              <th>Client Name</th>
                              <th>Insurer</th>
                              <th>Claiming Paid</th>
                              <th>Policy</th>
                              <th>Policy Number</th>
                              <th>Type</th>
                              <th>Policy</th>
                              <th>Premium</th>
                            </tr>
                          </thead>
                          <tbody>



                          @foreach ($data as $item)
                            <tr onclick="window.open('{{route('add_policy_data',  $item->policy_id )}}','_self')">
                                <td>
                                        <a class="btn btn-primary" href="{{route('add_policy_data',  $item->policy_id )}}">
                                            View
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                </td>
                                <td>{{ $item->policy_id }}</td>
                                <td>{{ $item->policy_date }}</td>
                                <td></td>
                                <td>{{$item->insured_name }}</td>
                                <td></td>
                                <td>{{$item->type_name}}</td>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a class="delivered" href="#">Delivered</a></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    -->
                    <div class="dataTable__wrapper" >

                      <table class="table table-bordered" id="dataTablePolicy">
                        <thead>
                          <tr>
                            <th></th>
                            <th>PL ID</th>
                            <th>Date</th>
                            <th>Client Name</th>
                            <th>Insurer</th>
                            <th>Claiming Paid</th>
                            <th>Policy</th>
                            <th>Type</th>
                            <th>Policy Number</th>
                            <th>Premium</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data is coming via AJAX and dynamically injecting rows containing data.-->
                        </tbody>
                        <tfoot>
                            <tr>
                              <th></th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                              <th>--</th>
                            </tr>
                          </tfoot>
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
    {{--  modal strat  --}}
    <div class="modal fade" id="policy-doc-Modal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Policy Document</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  {{Form::open(array('url' => route('create_policy_document'), 'method' => 'post','name' => 'create_policy_document','files' => true))}}
                    <div class="file-upload-div"> <span id="filename">Select your file</span>
                      <label for="file-upload">Browse
                        <input type="file" id="file-upload" name="browse">
                      </label>
                    </div>
                      @error('browse')
                          <span class="color_red" role="alert">
                          <h5 class="message_text">*{{ $message }}</h5>
                          </span>
                      @enderror
                    <div class="form-group">
                      <label for="">Policy No.</label>
                      <input type="text" class="form-control"  name="policy_no"  >
                      {{ Form::hidden('policy_id',null) }}

                    </div>
                    <div class="form-group">
                      {{Form::label('Comments')}}
                      {{Form::textarea('message',null,['class'=>'form-control','rows'=>'3'])}}
                        @error('message')
                            <span class="color_red" role="alert">
                            <h5 class="message_text">*{{ $message }}</h5>
                            </span>
                        @enderror
                    </div>
                    {{--  <div class="form-group">
                      <label class="hover">
                        <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><div class="icheckbox_flat-green hover" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                        Add Notification
                      </label>
                    </div>  --}}
                    <div>
                      <button type="submit" class="btn btn-primary">Add Policy Documents</button>
                      <button type="submit" class="btn btn-danger">Cancel</button>
                    </div>
                  {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
      {{--  modal end  --}}
@endsection
@section('add-js')
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      //$('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //custom datetime select
      $('input[name="con_policy_date_range"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="con_policy_date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="con_policy_date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
              'month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      })


    })
  </script>
  <script>

    var table;
    var encrept_data='';

    function myFunction(){
      function format(data) {

       

        var policy_id= `${data.policy_id}`;
        var policy_number= `${data.policy_number}`;
        var url = '{{ route("add_policy_data", ":newapproval_id") }}';
        url = url.replace(':newapproval_id', policy_id);

        var new_date2=data.policy_date.split('T');
        var newdatespilt=new_date2[0];
        var new_date=newdatespilt.split('-');
        var year=new_date[0];
        var month=new_date[1];
        var dat=new_date[2];



        var newdata= `<table cellpadding="5"
					  cellspacing="0" border="0"
					  style="padding-left: 50px;">
					  <tr>
						<td class="no-padding pb_36" colspan="10">
							<div class="custom_scoll">
								<div class="ui steps">`;

                                    $.each( data.dd_all_status, function( key, value ) {
                                        var newStatus='';
                                        if(value.status==1){
                                            newStatus="Requested";
                                        }
                                        else if(value.status==2){
                                            newStatus="Not Issued";
                                        }
                                        else if(value.status==3){
                                            newStatus= "Issued";
                                        }
                                        else if(value.status==4){
                                            newStatus= "Sent";
                                        }
                                        else if(value.status==5){
                                            newStatus= "Delivered";
                                        }


                                        var new_date2=value.created_at.split('T');
                                        var newdatespilt=new_date2[0];
                                        var new_date=newdatespilt.split('-');
                                        var year=new_date[0];
                                        var month=new_date[1];
                                        var dat=new_date[2];

                                        newdata+=`<div class="content3">
                                        <div class="description">`+newStatus+`</div><div class="description">`+month+'/'+dat+'/'+year+`</div>
                                        </div>`;
                                    });






                                    newdata+=`	</div>
                            </div>
                            <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Insured Name</th>


                                      <td class="prece_td" style="width: 25%">${data.insured_name ? data.insured_name : '-' }</td>
                                      <th>Insurer</th>
                                      <td>${data.insurer_name ? data.insurer_name : '-'}</td>
                                    </tr>
                                    <tr>
                                      <th>Second Insured Name</th>
                                      <td class="prece_td" style="width: 25%">${data.prospect_name ? data.prospect_name : '-'}</td>
                                      <th>Start Date</th>
                                      <td>${data.policy_date ? data.policy_date : '-'}</td>
                                    </tr>
                                    <tr>
                                      <th>Offer</th>
                                      <td class="prece_td" style="width: 25%">${data.offer_details ? data.offer_details : '-'}</td>
                                      <th>Validity Period</th>
                                      <td>${data.validity_period ? data.validity_period : '-'}</td>
                                    </tr>
                                    <tr>
                                      <th>Object</th>
                                      <td class="prece_td" style="width: 25%">${data.object_details_one ? data.object_details_one.object_1 : '-'}</td>
                                      <th>Variant</th>
                                      <td>${data.varient_type ? data.varient_type : '-'}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
							<div class="">
								<table class="table_style table_style_info">
									<thead></thead>
									<tbody></tbody>
								</table>
                            </div><a class="delete_police" data-toggle="modal" data-target="#policy-doc-Modal" data-number-id=`+policy_number+` data-policy-id=`+policy_id+` id=`+policy_id+` onclick='myPocicyDoc(this.id)'>Add Policy Document</a>

                            <a class="delete_police" data-id="27273" href=`+url+`>View</a>
						</td>
					</tr>
                    </table>`;
                    return newdata;
      }

       table = $('#dataTablePolicy').DataTable({

        ajax: "{{ url('dashboard/get-converted-data/') }}"+'/'+encrept_data,

        "columns": [{
            "className": 'details-control',
            "orderable": false,
            "data": null,
            "defaultContent": ''

          },
          {
            "render": function (data, type, full, meta) {
                return "PL"+(10000+full.main_id);
            }
          },
          {
            "data": "policy_date"
          },
          {
            "data": "prospect_name"
          },
          {
            "data": "insurer_name"
          },
          {
            "render": function (data, type, full, meta) {

                if(full.claiming_paid){
                    return "Yes";
                }
                else{
                    return "No";
                }
            }
          },
          {
            "render": function (data, type, full, meta) {

                if(full.policy_name_dtl){
                    return full.policy_name_dtl.policy_name;
                }
                else{
                    return "-";
                }
            }
          },

          {
            "data": "type_name"
          },
          {
            "render": function (data, type, full, meta) {

                if(full.policy_number){
                    return full.policy_number;
                }
                else{
                  return "PL"+(10000+full.main_id);
                }
            }
          },
          {
            "data": "premium"
          },
          {
            "render": function (data, type, full, meta) {
                if(full.dd_all_status.length>0){
                    if(full.dd_status.status==1){
                        return "<a class='delivered' href=\"#\">Requested</a>";
                    }
                    else if(full.dd_status.status==2){
                        return "<a class='delivered' href=\"#\">Not Issued</a>";
                    }
                    else if(full.dd_status.status==3){
                        return "<a class='delivered' href=\"#\">Issued</a>";
                    }
                    else if(full.dd_status.status==4){
                        return "<a class='delivered' href=\"#\">Sent</a>";
                    }
                    else if(full.dd_status.status==5){
                        return "<a class='delivered' href=\"#\">Delivered</a>";
                    }

                }
                else{
                    return "";
                }

            }
        }

        ],
        "order": [
          [1, 'asc']
        ],
        'destroy': true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        columnDefs: [
            { width: '10%', targets: 10 }
        ],

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );



            // Total over this page
            pageTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 9 ).footer() ).html(
                "Total: " +total+" EUR"

            );

        }
      });

      $('#dataTablePolicy tbody').on('click', 'tr', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Open this row
          row.child(format(row.data())).show();
          tr.addClass('shown');
        }
      });

      $('.table').parent().addClass('table-responsive');
    }
    function myPocicyDoc(id){

        var GetPoNo = $('#'+id).attr('data-number-id');
        var GetPoId = $('#'+id).attr('data-policy-id');

        $("#policy-doc-Modal input[name='policy_no']").val(' ');
        $("#policy-doc-Modal input[name='policy_id']").val(' ');
        $("#policy-doc-Modal input[name='policy_id']").val(GetPoId);
        $("#policy-doc-Modal input[name='policy_no']").val(GetPoNo);

    }
    function filterRecord(){

         var insurance_company=  $('#insurance_company').val();
         var filter_type=  $('#filter_type').val();
         var policy_status=  $('#policy_status').val();
         var reservation=  $('#reservation').val();


         var date = reservation.split(" - ");
         var date1 = date[0];
         var date2 = date[1];
         var myArray = {"insurance_company": insurance_company,"filter_type": filter_type, "policy_status": policy_status,"date1":date1,"date2":date2};

         var newmyArray=JSON.stringify(myArray);
          encrept_data=btoa(newmyArray);




           // $('#example').data.reload();



          myFunction();



     }

     $("#filter-col").click(function() {
         filterRecord();
     });

     myFunction();
  </script>
  <script>
    $('select#dis_insurance_company option:first').attr('disabled', true);
    $('select#dis_insurance_category option:first').attr('disabled', true);
    $('select#dis_status option:first').attr('disabled', true);
    $(document).ready(function(){
        $("form[name='create_policy_document']").validate({
            rules: {
              browse: {
                  required: true
                },
              message: "required"
            },
            messages: {
              message: "Please Enter your Comments",
              document_file: "Please Select Your File"

            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
  </script>
@endsection
