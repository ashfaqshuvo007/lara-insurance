@extends('layouts.master')
@section('title','MySIg by Fidentia | Claims')
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Claimed
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Claimed</li>
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
                          {{-- {{Form::select('company',array('2'=>'2','3'=>'3','4'=>'4','5'=>'5'),null,['class'=>'form-control','id'=>'this_company','placeholder'=>'insurance company'])}} --}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Policy Type')}}
                            <select class="form-control" name="policy_type" id="policy_type">
                                <option value="">Select Policy Type </option>
                                @foreach ($policySubType as $item)
                                    <option value="{{ $item->policy_sub_type_id  }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                          {{--  {{Form::select('category',array('1'=>'All','2'=>'2','3'=>'3','4'=>'4','5'=>'5'),null,['class'=>'form-control','id'=>'insurance_category'])}}  --}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Type')}}
                          {{Form::select('type',array(''=>'Select Type','1'=>'Fixed','2'=>'%'),null,['class'=>'form-control','id'=>'filter_type'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('status')}}
                          {{Form::select('status',array(''=>'Select Status','1'=>'Claim Initiated','2'=>'Documents Received','3'=>'Sent to Processor','4'=>'Queried','5'=>'Query Response Sent','6'=>'Settled'),null,['class'=>'form-control','id'=>'claim_status'])}}

                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Date range:')}}
                          <div class="input-group">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i>
                            </div>
                            {{Form::text('date_range',null,['class'=>'form-control pull-right','id'=>'reservation','autocomplete'=>'off'])}}
                          </div>
                          <!-- /.input group -->
                        </div>
                        <div class="form-group col-md-3 mt_5">
                          {{-- {{Form::submit('Apply',['class'=>'btn btn-primary  w-100'])}} --}}
                          <button type="button" class="btn btn-primary  w-100 " id="filter-col" onclick="filterRecord()">Apply</button>
                        </div>
                        <div class="form-group col-md-3 mt_5">
                          {{Form::submit('Export',['class'=>'btn btn-danger  w-100'])}}
                        </div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="dataTable__wrapper table-responsive">
                      <table class="table table-bordered" id="dataTableClaimd">
                        <thead>
                          <tr>
                            <th></th>
                            <th>CL ID</th>
                            <th>Date</th>
                            <th>Client Name</th>
                            <th>Insurer</th>
                            <th>Policy Type</th>
                            <th>Policy No.</th>
                            <th>Claming Type</th>
                            <th>Settled Amount</th>
                            <th>Our Part</th>
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
                            <th>Total: 4000</th>
                            <th>Total: 200.00 EUR</th>
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
     // $('#reservation').daterangepicker()
     $('#reservation').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
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


    });
  </script>
  <script>


    var table;
    var encrept_data='';

    function myFunction(){


      function format(data) {
        // `d` is the original data object for the row
        var claim_id= `${data.claims_id}`;
        var url = '{{ route("view_claim-data", ":newapproval_id") }}';
        url = url.replace(':newapproval_id', claim_id);
        var text = "";
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
                                            newStatus="Claim Initiated";
                                        }
                                        else if(value.status==2){
                                            newStatus="Documents Received";
                                        }
                                        else if(value.status==3){
                                            newStatus= "Sent to Processor";
                                        }
                                        else if(value.status==4){
                                            newStatus= "Queried";
                                        }
                                        else if(value.status==5){
                                            newStatus= "Query Response Sent";
                                        }
                                        else if(value.status==6){
                                            newStatus= "Settled";
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
							<div class="">
								<table class="table_style table_style_info">
									<thead></thead>
									<tbody></tbody>
								</table>
							</div><a class="delete_police" data-id="27273" href=`+url+`>View Claim</a>
						</td>
					</tr>
                    </table>`;
                    return newdata;
      }


       table = $('#dataTableClaimd').DataTable({
        // 'responsive': true,
        ajax: "{{ url('dashboard/claimed-record/') }}"+'/'+encrept_data,
        "columns": [{
            "className": 'details-control',
            "orderable": false,
            "data": null,
            "defaultContent": ''
          },

          {
            "render": function (data, type, full, meta) {
                return "US"+(10000+full.claim_main_id);
            }
          },
          {
            "render": function (data, type, full, meta) {
                var new_date2=full.claim_date.split(' ');
                var newdatespilt=new_date2[0];
                var new_date=newdatespilt.split('-');
                var year=new_date[0];
                var month=new_date[1];
                var dat=new_date[2];
                return month+'/'+dat+'/'+year;
            }
          },

          {
            "data": "prospect_name"
          },
          {
            "data": "insurer_name"
          },
          /*{
            "data": "policyName"
          },*/
          {
            "render": function (data, type, full, meta) {

                if(full.policy_type_name){

                     return full.policy_type_name.name;
                }
                else{
                    return "-";
                }
            }
          },
          {
            "data": "policy_number"
          },
          {
            "render": function (data, type, full, meta) {

                if(full.claming_type){
                    return "Yes";
                }
                else{
                    return "No";
                }
            }
          },

          {
            "data": "settled_amount"
          },
          {
            "data": "our_part"
          },

          {
            "render": function (data, type, full, meta) {
                if(full.dd_all_status.length>0){
                    if(full.dd_status.status==1){
                        return "<a class=\"\" href=\"#\">Claim Initiated<\/a>";
                    }
                    else if(full.dd_status.status==2){
                        return "<a class=\"\" href=\"#\">Documents Received<\/a>";
                    }
                    else if(full.dd_status.status==3){
                        return "<a class=\"\" href=\"#\">Sent to Processor<\/a>";
                    }
                    else if(full.dd_status.status==4){
                        return "<a class=\"\" href=\"#\">Queried<\/a>";
                    }
                    else if(full.dd_status.status==5){
                        return "<a class=\"\" href=\"#\">Query Response Sent<\/a>";
                    }
                    else if(full.dd_status.status==6){
                        return "<a class=\"\" href=\"#\">Settled<\/a>";
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
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            total2 = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 8 ).footer() ).html(
                "Total: " +total+" EUR"

            );
            $( api.column( 9 ).footer() ).html(
                "Total: " +total2+" EUR"

            );
        }
      });



      $('#dataTableClaimd tbody').on('click', 'tr', function () {

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




    function filterRecord(){

       // alert("filter");
        var insurance_company=  $('#insurance_company').val();
        var filter_type=  $('#filter_type').val();
        var claim_status=  $('#claim_status').val();
        var reservation=  $('#reservation').val();
        var policy_type=  $('#policy_type').val();




        var date = reservation.split(" - ");
        var date1 = date[0];
        var date2 = date[1];
        var myArray = {"insurance_company": insurance_company,"policy_type": policy_type, "filter_type": filter_type, "claim_status": claim_status,"date1":date1,"date2":date2};
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
    $('select#this_company option:first').attr('disabled', true);
  </script>
@endsection
