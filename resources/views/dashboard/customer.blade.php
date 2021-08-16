@extends('layouts.master')
@section('title','MySIg by Fidentia | Customer')
@section('css')
    <style>
        .box-body {
        margin-top: 20px;
        }

        #dataTableCustomer tbody tr {
        cursor: pointer;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Customer
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Customer</li>
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
                @if (!empty($datanewa->date1))
                    <div class="collapse in" id="collapseExample">
                @else
                    <div class="collapse" id="collapseExample">
                @endif
                {{-- <div class="collapse" id="collapseExample"> --}}
                  <div class="card card-body">
                    <div class="row">
                      {{ Form::open() }}
                        <div class="form-group col-md-3">
                          {{Form::label('City',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}
                          {{Form::select('city',array(''=>'Select City',
                                                        '1'=>'Andalusia',
                                                        '2'=>'Bay Minette',
                                                        '3'=>'Camden',
                                                        'kolkata'=>'kolkata',
                                                        '5'=>'Elba'),null,['class'=>'form-control','id'=>'filter_city'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Type')}}
                          {{Form::select('type',array(''=>'Select Type',
                                                        'Individual'=>'Individual',
                                                        'Business'=>'Business'
                                                        ),(!empty($datanewa->filter_type)&&$datanewa->filter_type=="Business")?"Business":((!empty($datanewa->filter_type)&&$datanewa->filter_type=="Individual")?"Individual":'') ,['class'=>'form-control','id'=>'filter_type'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('status')}}
                            @if (!empty($datanewa->status))

                                {{Form::select('status',array(''=>'Select Status',
                                                        '0'=>'User',
                                                        '1'=>'Customer',
                                                        ),$datanewa->status=="1" ?"1":'',['class'=>'form-control','id'=>'status'])}}

                            @else

                                {{Form::select('status',array(''=>'Select Status',
                                '0'=>'User',
                                '1'=>'Customer',
                                ),null,['class'=>'form-control','id'=>'status'])}}
                            @endif

                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Date range:')}}
                          <div class="input-group">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i>
                            </div>

                            @if (!empty($datanewa->date1))
                                {{Form::text('Date',date('m-d-Y', strtotime($datanewa->date1)).' - '.date('m-d-Y', strtotime($datanewa->date2)),['class'=>'form-control pull-right','id'=>'reservation','autocomplete'=>'off'])}}
                                @else
                                {{Form::text('Date',null,['class'=>'form-control pull-right','id'=>'reservation','autocomplete'=>'off'])}}

                            @endif


                          </div>
                          <!-- /.input group -->
                        </div>
                        <div class="form-group col-md-3 mt_5">
                            <button type="button" class="btn btn-primary  w-100 " id="filter-col" onclick="filterRecord()">Apply</button>
                        </div>
                        <div class="form-group col-md-3 mt_5">
                          {{Form::submit('Export',['class'=>'btn btn-danger w-100'])}}
                        </div>
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="dataTable__wrapper table-responsive">
                  <table class="table
                    table-bordered" id="dataTableCustomer">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Customer Type</th>
                        <th>City</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach($customers as $customer)
                        @if(!empty($customer->customer->customer_id))
                                <tr class="view customer_link" onclick="window.open('{{route('customer_view',  $customer->customer->customer_id )}}','_self')">



                            @endif

                            @if(!empty($customer->customer))
                                <td>
                                    <h6>US{{ 10000+($customer->customer->id) }}</h6>
                                </td>
                                <td>{{ date('d-m-Y', strtotime($customer->customer->created_at))}}</td>
                            @else
                            <td>
                                <h6></h6>
                            </td>
                            <td></td>
                            @endif



                            <td>{{ $customer->name }}</td>

                            <td>{{ $customer->user_type }}</td>
                            @if(!empty($customer->customer))
                                <td>{{ $customer->customer->city }}</td>
                            @else
                            <td></td>
                            @endif
                            @if($customer->is_policy==1)
                                     <td> <a class="delivered" href="#">Customer</a></td>
                            @else
                                <td> <a class="delivered" href="#">User</a></td>

                            @endif
                            {{-- <td> <a class="delivered" href="#">Customer</a></td> --}}


                        </tr>
                        @endforeach

                        <!-- <td>
                          <h6>US1990</h6>
                        </td>
                        <td>16-04-2020</td>
                        <td>Vinaya Prasad</td>
                        <td>Business</td>
                        <td>Tirana</td>
                        <td> <a class="delivered" href="#">User</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1994</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td >Rabi Prasad</td>
                        <td >Individual</td>
                        <td>Tirana</td>
                        <td > <a class="delivered" href="#">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td >04-04-2020</td>
                        <td >Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class="delivered" href="#">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1994</h6>
                        </td>
                        <td >04-04-2020</td>
                        <td >Palash Prasad</td>
                        <td >Individual</td>
                        <td >Kirana</td>
                        <td > <a class="delivered" href="#">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1990</h6>
                        </td>
                        <td >16-04-2020</td>
                        <td >Vinaya Prasad</td>
                        <td >Business</td>
                        <td >Tirana</td>
                        <td > <a class="delivered" href="#">User</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1994</h6>
                        </td>
                        <td >04-04-2020</td>
                        <td >Rabi Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td> <a class="delivered" href="">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td >04-04-2020</td>
                        <td >Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class="delivered" href="">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1994</h6>
                        </td>
                        <td >04-04-2020</td>
                        <td >Palash Prasad</td>
                        <td>Individual</td>
                        <td >Kirana</td>
                        <td > <a class="delivered" href="">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1990</h6>
                        </td>
                        <td >16-04-2020</td>
                        <td >Vinaya Prasad</td>
                        <td >Business</td>
                        <td >Tirana</td>
                        <td > <a class="delivered" href="#">User</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')">
                        <td>
                          <h6>US1994</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td >Rabi Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class="delivered" href="">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class=" view customer_link " onclick=" window.open( '{{route('customer_view')}}' , '_self' ) ">
                        <td>
                          <h6>US1994</h6>
                        </td>
                        <td >04-04-2020</td>
                        <td>Palash Prasad</td>
                        <td>Individual</td>
                        <td>Kirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class=" view customer_link " onclick=" window.open( '{{route('customer_view')}}' , '_self' ) ">
                        <td>
                          <h6>US1990</h6>
                        </td>
                        <td>16-04-2020</td>
                        <td>Vinaya Prasad</td>
                        <td>Business</td>
                        <td>Tirana</td>
                        <td> <a class=" delivered " href=" # ">User</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class=" view customer_link " onclick=" window.open( '{{route('customer_view')}}' , '_self' ) ">
                        <td>
                          <h6>US1990</h6>
                        </td>
                        <td>16-04-2020</td>
                        <td>Vinaya Prasad</td>
                        <td>Business</td>
                        <td>Tirana</td>
                        <td> <a class=" delivered " href=" # ">User</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>
                      <tr class="view customer_link" onclick="window.open('{{route('customer_view')}}','_self')" >
                        <td>
                          <h6>US1982</h6>
                        </td>
                        <td>04-04-2020</td>
                        <td>Anand Prasad</td>
                        <td >Individual</td>
                        <td >Tirana</td>
                        <td > <a class=" delivered " href=" ">Customer</a>
                        </td>
                      </tr>  -->

                    </tbody>
                  </table>
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
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      //$('#reservation').daterangepicker()
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

      //iCheck for checkbox and radio inputs
      $('input[type=" checkbox "].minimal, input[type=" radio "].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type=" checkbox "].minimal-red, input[type=" radio "].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type=" checkbox "].flat-red, input[type=" radio "].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      })


    })

    function filterRecord(){
       // alert("filter");
       var insurance_company=  $('#insurance_company').val();
       var filter_type=  $('#filter_type').val();
       var filter_city=  $('#filter_city').val();
       var status =  $('#status').val();

       //var claim_status=  $('#claim_status').val();
       var reservation=  $('#reservation').val();


       var date = reservation.split(" - ");
       var date1 = date[0];
       var date2 = date[1];
       var myArray = {"filter_type": filter_type,"status":status,"filter_city": filter_city,"date1":date1,"date2":date2};
       var newmyArray=JSON.stringify(myArray);
        encrept_data=btoa(newmyArray);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('user_customer_policy') }}"+'/'+encrept_data,
            success:function(data){
                window.location.href = this.url;

            }
         });

    }
  </script>
@endsection
