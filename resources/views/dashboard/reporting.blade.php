@extends('layouts.master')
@section('title','MySIg by Fidentia | Reporting')
@section('content')
<div class="content-wrapper">
			<section class="content-header">
				<h1>
        Reporting View
      </h1>
				<ol class="breadcrumb">
					<li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i> Home</a>
					</li>
					<li class="active breadcrumb_listItem">Reporting View</li>
				</ol>
			</section>
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<div class="btnGrp">
									<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">	<i class="fa fa-filter" aria-hidden="true"></i> Apply Filter</button>
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
													{{Form::label('Claiming')}}
													{{Form::select('claiming',array(''=>'Select Claiming','1'=>'Yes',
																					'2'=>'No'),null,['class'=>'form-control','id'=>'claiming'])}}
                                                </div>
                                                <div class="form-group col-md-3">
                                                    {{Form::label('Policy Name')}}
                                                    <select class="form-control" name="policy_name_filter" id="policy_name_filter">
                                                            <option value="">Policy Name</option>
                                                            @foreach ($InsurerPolicy as $item)
                                                                <option value="{{ $item->insurer_policy_id  }}">{{ $item->policy_name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
												<div class="form-group col-md-3">
													{{Form::label('payment method')}}
													{{Form::select('method',array(''=>'Select Payment Mode','1'=>'Paypal',
																					'2'=>'BKT'),null,['class'=>'form-control','id'=>'payment_mode'])}}
												</div>
												<div class="form-group col-md-3">
													{{Form::label('Date range:')}}
													<div class="input-group">
														<div class="input-group-addon">	<i class="fa fa-calendar"></i>
														</div>
														{{Form::text('Date',null,['class'=>'form-control pull-right','id'=>'reservation','autocomplete'=>'off'])}}
													</div>
													<!-- /.input group -->
												</div>
												<div class="form-group col-md-3 mt_5">
													<button type="button" class="btn btn-primary  w-100 " id="filter-col" onclick="filterRecord()">Apply</button>
												</div>
												<div class="form-group col-md-3 mt_5">
													{{Form::button('Export',['class'=>'btn btn-danger w-100'])}}
												</div>

										</div>
									</div>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class=" table table-bordered " id="reporting_table">
												<thead>
													<tr>
														<th>PL ID</th>
														<th>Date</th>
														<th >Client Name</th>
														<th>Insurer</th>
														<th >Claimed Paid</th>
														<th >Method</th>
														<th >Policy</th>
														<th >Policy Number</th>
														<th >Insurer Part</th>
														<th >Our Part</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
												@php
												$i =1;
												@endphp
												@foreach($report_data as $details)
													<tr class="view">
														<td>
															<div class="pl">PL</div>200{{$i++}}</td>
														<td >{{$details['start_date']}}</td>
														<td >{{$details['client_name']}}</td>
														<td >{{$details['insuer']}}</td>
														<td>
															<div class="tag">{{$details['claimed_paid']}}</div>
														</td>
														<td> <a href="#">{{$details['method']}}</a>
														</td>
														<td >{{$details['policy_name']}}</td>
														<td >{{$details['policy_number']}}</td>
														<td >${{$details['insurer_part']}}</td>
														<td >${{$details['our_part']}}</td>
														<td ><a class="delivered" href="#">${{$details['total']}}</a>
														</td>
													</tr>
												@endforeach
													<!-- <tr class="view">
														<td>
															<div class="pl">PL</div>27273</td>
														<td >04-04-2020</td>
														<td >Raju Das</td>
														<td >Sigal</td>
														<td>$2.00
															<br>
															<div class="tag">No</div>
														</td>
														<td> <a href="#">BKT</a>
														</td>
														<td >Group Mediclaim Insurance</td>
														<td >PFS/I3912731/G2/06/006087</td>
														<td >$85.00</td>
														<td >$15.00</td>
														<td ><a class="delivered" href="#">$102.00</a>
														</td>
													</tr> -->
                                                </tbody>
                                                <tfoot>
                                                <tr class="view">
                                                    <td>--</td>
                                                    <td >--</td>
                                                    <td >--</td>
                                                    <td >--</td>
                                                    <td>--</td>
                                                    <td>--</td>
                                                    <td >--</td>
                                                    <td >--</td>
                                                    <td >
                                                        <b>Total: </b>${{ !empty($amount['insuer_amount']) ? $amount['insuer_amount'] : '0' }}
                                                    </td>
                                                    <td>
                                                        <b>Total: </b>${{ !empty($amount['our_part_amount']) ? $amount['our_part_amount'] : '0' }}
                                                    </td>
                                                    <td>
                                                        <b>Total: </b>${{ !empty($amount['total']) ? $amount['total'] : '0' }}
                                                    </td>
                                                </tr>
                                                </tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
@endsection
@section('add-js')
<script>
		$(function () {
		      //Initialize Select2 Elements
		      $('.select2').select2()

		      //Datemask dd/mm/yyyy
		      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		      //Datemask2 mm/dd/yyyy
		      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
		      //Money Euro
		      $('[data-mask]').inputmask()

		      //Date range picker
              //$('#reservation').daterangepicker()
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
		      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
		      //Date range as a button
		      $('#daterange-btn').daterangepicker(
		        {
		          ranges   : {
		            'Today'       : [moment(), moment()],
		            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
		            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
		            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		          },
		          startDate: moment().subtract(29, 'days'),
		          endDate  : moment()
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
		        radioClass   : 'iradio_minimal-blue'
		      })
		      //Red color scheme for iCheck
		      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		        checkboxClass: 'icheckbox_minimal-red',
		        radioClass   : 'iradio_minimal-red'
		      })
		      //Flat red color scheme for iCheck
		      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		        checkboxClass: 'icheckbox_flat-green',
		        radioClass   : 'iradio_flat-green'
              });

                var url = window.location.href;
                var newurl=url.split("reporting");
                var get_encrept_data_new = newurl[1].split('/');
                var get_encrept_data = get_encrept_data_new[1];

                if(get_encrept_data){
                    $('#collapseExample').addClass('in');

                    decrept_data=window.atob(get_encrept_data);
                    var new_data = JSON.parse(decrept_data);
                    console.log(new_data);
                    $('#insurance_company option[value="'+new_data.insurance_company+'"]').attr('selected','selected');
                    $('#claiming option[value="'+new_data.claiming+'"]').attr('selected','selected');
                    $('#payment_mode option[value="'+new_data.payment_mode+'"]').attr('selected','selected');
                    $('#policy_name_filter option[value="'+new_data.policy_name_filter+'"]').attr('selected','selected');



                    if(new_data.date1){
                        $('#reservation').val(new_data.date1+" - "+new_data.date2);
                    }

                }


		    })
	</script>
	<script>
     $('select#this_insurer option:first').attr('disabled', true);

     function filterRecord(){




        var insurance_company=  $('#insurance_company').val();
        var claiming =  $('#claiming').val();
        var payment_mode =  $('#payment_mode').val();
        var policy_name_filter =  $('#policy_name_filter').val();
        var reservation=  $('#reservation').val();
        var date = reservation.split(" - ");
        var date1 = date[0];
        var date2 = date[1];

        var myArray = {"insurance_company":insurance_company,"claiming":claiming,"payment_mode":payment_mode,"date1":date1,"date2":date2,'policy_name_filter':policy_name_filter};
        var newmyArray=JSON.stringify(myArray);
         encrept_data=btoa(newmyArray);


        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

         $.ajax({
             type:'get',
             url:"{{ route('user_reporting') }}"+'/'+encrept_data,
             success:function(data){
                window.location.href = this.url;


             }
          });

    }
	</script>
@endsection
