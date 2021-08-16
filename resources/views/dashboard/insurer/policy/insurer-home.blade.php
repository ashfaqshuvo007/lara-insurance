@extends('layouts.master')
@section('title','MySIg by Fidentia | Home')

@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Home
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Home</li>
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
                  {!! Form::open(['route'=>'home_sub_policy_add','role'=>'form','files'=>true,'autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                              @if(isset($insurer_sub_Policy))
                                    {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                    {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                              @endif
                      <!-- <div class="form-group">
                        {{Form::label('Square m2')}}
                        {{Form::text('square',null,['class'=>'form-control commission_persent','id'=>'square_m2'])}}
                        <div class="text-danger"><strong id="square_error_home_sub"></strong></div>
                      </div> -->
                      <div class="form-group">
                        {{Form::label('Type')}}
                        {{Form::select('home_sub_type_id',$policy_type,null,['class'=>'form-control','id'=>'home_sub_type'])}}
                        @error('home_sub_type_id')
                        <span class="color_red" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                        @enderror
                      </div>
                      <div class="form-group">
                      {!! Form::label('Price For Villa %')!!}
                      {{Form::text('price_of_villa',null,['class'=>'form-control number_only','id'=>'villa_price'])}}
                      @error('price_of_villa')
                        <span class="color_red" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                        @enderror
                      </div>
                      <div class="form-group">
                      {!! Form::label('Price For Apartment%')!!}
                      {{Form::text('price_of_aparment',null,['class'=>'form-control number_only','id'=>'apartment_price'])}}
                      @error('price_of_aparment')
                        <span class="color_red" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                        @enderror
                      </div>
                      <!-- <div class="form-group">
                        {{Form::label('City')}}
                        {{Form::select('address',array('Kolkata'=>'Kolkata',
                                                      'Noaida'=>'Noaida',
                                                      'Mumbai'=>'Mumbai',
                                                      'Delhi'=>'Delhi',
                                                      'Bangalore'=>'Bangalore'),null,['class'=>'form-control','id'=>'home_address'])}}
                      </div> -->
                      <!-- <div class="form-group">
                        {{Form::label('Administrative unit')}}
                        {{Form::select('unit',array('unit 1'=>'unit 1',
                                                              'unit 2'=>'unit 2',
                                                              'unit 3'=>'unit 3',
                                                              'unit 4'=>'unit 4'),null,['class'=>'form-control','id'=>'home_unit'])}}
                      </div> -->
                      <div class="form-group">
                      {!! Form::label('All')!!}
                      {!! Form::checkbox('all')!!}
                      </div>
                      @error('message')
                        <span class="color_red" role="alert">
                                       <strong>*{{ $message }}</strong>
                                 </span>
                      @enderror
                      <div class="form-group">
                      {!! Form::label('Only Home Value')!!}
                      {!! Form::checkbox('home_value')!!}
                      </div>
                        {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'home_sub_bttn'])}}
                    {{Form::close()}}
                  </div>
                </div>
                <div class="row">
              <div class="col-md-12">
                <div class="table-responsive document_div mt_5">
                  <table class="table table-bordered
                  table-hover
                  table-striped" id="home-table-id">
                    <thead>
                      <tr>
                        <th>Coverage Type</th>
                        <th>Price For Villa</th>
                        <th>Price For Apartment</th>
                        <th>All/Home Value</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id='home_table'>
                    @if(isset($store_home_policy))
                      @foreach($store_home_policy as $key => $details)
                        <tr class="customer_link open">
                          <td>{{$details['home_sub_type_id']}}</td>
                          <td>{{$details['price_of_villa']}}</td>
                          <td>{{$details['price_of_aparment']}}</td>
                          <td> 
                              @if(empty($details['all']))
                              {{"Home Value"}}
                              @else
                              {{"All"}}
                              @endif
                          </td>
                        <td>
                            <label class="checkbox-four">
                              @if($details['status'] == 1)
                                <input type="checkbox" data-id="{{$details['home_policy_id']}}" class="home_status" checked/> <span class="track thumb"></span>
                              @else
                                <input type="checkbox" data-id="{{$details['home_policy_id']}}" class="home_status"/> <span class="track thumb"></span>
                              @endif
                            </label>
                          </td>
                        </tr>
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
  <script src="{{URL::asset('js/modals/insurer/sub_policy/home-sub-policy.js')}}"></script>
  <script>
   $(function(){
     $(".number_only").keypress(function (e) {

      return isNumber(e, this);

     });
  });
  function isNumber(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode

    if (
        (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        return false;

    return true;
    }

    $(document).on('change','.home_status',function(){
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
            url: "{{ route('update_home_policy') }}",
            data: {'id':id,'active':active,"_token": " {{ csrf_token() }}"},
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if(response.status == 1){
                    if(active == 0){
                        toastr.success( 'Status disabled');
                        location.reload(true);
                    }
                    if(active == 1){
                        toastr.success( 'Status enabled');
                        location.reload(true);
                    }
                }
            }
        })
    });
    $('#home-table-id').DataTable({
    // 'responsive': true,
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': false,
  });
  </script>
@endsection