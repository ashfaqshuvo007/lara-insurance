@extends('layouts.master')
@section('title','MySIg by Fidentia | Full Casco')

@section('content')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Full Casco
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a>
          </li>
          <li class="active">Full Casco</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
              {!! Form::open(['route'=>'add_policy_full_casco','role'=>'form','files'=>true,'id'=>'add-car-fullcasco-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                  @if(isset($insurer_sub_Policy))
                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                  @endif
                  <div class="form-group">
                    {{Form::label('Variant I')}}
                    @php
                      $varient_coverage = array(
                                          'Dëmtime Aksidentale'=>'Dëmtime Aksidentale',
                                          'Thyerja Xhamave'=>'Thyerja Xhamave',
                                          'Përmbysja' => 'Përmbysja',
                                          'Përplasja' => 'Përplasja',
                                          'Transporti  me karroatrec' => 'Transporti  me karroatrec',
                                          'Vjedhja' => 'Vjedhja',
                                          'Zjarr' => 'Zjarr',
                                          'Rrufe' => 'Rrufe',
                                          'Eksplozion' => 'Eksplozion',
                                          'Katastrofa Natyrore' => 'Katastrofa Natyrore',
                                          'Vjedhja (Totale e mjetit)'=>'Vjedhja (Totale e mjetit)',
                                          'Vjedhja e pjesshme'=>'Vjedhja e pjesshme',
                                          'Dëmtim në parkim nga mjet tjetër'=>'Dëmtim ne parkim nga mjet tjetër',
                                          'Dëmtim nga akte keqdashëse'=>'Dëmtim nga akte keqdashëse'
                                        );
                    @endphp
                    {{Form::select('varient_coverage1[]',$varient_coverage, null,['class'=>'form-control select2','multiple'=>'multiple','autocomplete' => 'off','data-placeholder'=>'Select a State','style'=>'width: 100%;','id'=>'varient_1'])}}
                    <div class="text-danger"><strong id="varient_coverage1_error_fullcasco"></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Percentage')}}
                    {{--  {{Form::text('percentage[]',null,['class'=>'form-control commission_input','id'=>'full_casco_percentage1'])}}  --}}
                    <input type="text" name="percentage[]" class="form-control per-val number_only" id="full_casco_percentage1">
                    <div class="text-danger"><strong id="varient_coverage1_percentage_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>
                  </div>
                  <div class="form-group">
                    {{Form::label('Price(Including coverage outside country)(in percentage)')}}
                    {{--  {{Form::text('price[]',null,['class'=>'form-control commission_input','id'=>'full_casco_price1'])}}  --}}
                    {{Form::text('price[]',null,['class'=>'form-control  per-val number_only','id'=>'full_casco_price1'])}}

                    <div class="text-danger"><strong id="varient_coverage1_price_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    {{Form::label('Variant II')}}
                    {{Form::select('varient_coverage2[]',$varient_coverage, null,['class'=>'form-control select2','multiple'=>'multiple','autocomplete' => 'off','data-placeholder'=>'Select a State','style'=>'width: 100%;','id'=>'varient_2'])}}
                    <div class="text-danger"><strong id="varient_coverage2_error_fullcasco"></strong></div>
                  </div>
                  <div class="form-group">
                  {{Form::label('Percentage')}}
                    {{Form::text('percentage[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_percentage2'])}}
                    {{--  {{Form::text('percentage[]',null,['class'=>'form-control commission_input','id'=>'full_casco_percentage2'])}}  --}}
                    <div class="text-danger"><strong id="varient_coverage2_percentage_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Price(Including coverage outside country)(in percentage)')}}
                    {{--  {{Form::text('price[]',null,['class'=>'form-control commission_input','id'=>'full_casco_price2'])}}  --}}
                    {{Form::text('price[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_price2'])}}
                    <div class="text-danger"><strong id="varient_coverage2_price_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Variant III')}}
                    {{Form::select('varient_coverage3[]', $varient_coverage, null,['class'=>'form-control select2','multiple'=>'multiple','autocomplete' => 'off','data-placeholder'=>'Select a State','style'=>'width: 100%;','id'=>'varient_3'])}}
                    <div class="text-danger"><strong id="varient_coverage3_error_fullcasco"></strong></div>
                  </div>
                  <div class="form-group">
                    {{Form::label('Percentage')}}
                    {{--  {{Form::text('percentage[]',null,['class'=>'form-control commission_input','id'=>'full_casco_percentage3'])}}  --}}
                    {{Form::text('percentage[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_percentage3'])}}
                    <div class="text-danger"><strong id="varient_coverage3_percentage_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Price(Including coverage outside country)(in percentage)')}}
                    {{--  {{Form::text('price[]',null,['class'=>'form-control commission_input','id'=>'full_casco_price3'])}}  --}}
                    {{Form::text('price[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_price3'])}}
                    <div class="text-danger"><strong id="varient_coverage3_price_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Variant IV')}}
                    {{Form::select('varient_coverage4[]', $varient_coverage, null,['class'=>'form-control select2','multiple'=>'multiple','autocomplete' => 'off','data-placeholder'=>'Select a State','style'=>'width: 100%;','id'=>'varient_4'])}}
                    <div class="text-danger"><strong id="varient_coverage4_error_fullcasco"></strong></div>
                  </div>
                  <div class="form-group">
                    {{Form::label('Percentage')}}
                    {{--  {{Form::text('percentage[]',null,['class'=>'form-control commission_input','id'=>'full_casco_percentage4'])}}  --}}
                    {{Form::text('percentage[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_percentage4'])}}
                    <div class="text-danger"><strong id="varient_coverage4_percentage_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Price(Including coverage outside country)(in percentage)')}}
                    {{--  {{Form::text('price[]',null,['class'=>'form-control commission_input','id'=>'full_casco_price4'])}}  --}}
                    {{Form::text('price[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_price4'])}}
                    <div class="text-danger"><strong id="varient_coverage4_price_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Variant V')}}
                    {{Form::select('varient_coverage5[]',$varient_coverage, null,['class'=>'form-control select2','multiple'=>'multiple','autocomplete' => 'off','data-placeholder'=>'Select a State','style'=>'width: 100%;','id'=>'varient_5'])}}
                    <div class="text-danger"><strong id="varient_coverage5_error_fullcasco"></strong></div>
                  </div>
                  <div class="form-group">
                    {{Form::label('Percentage')}}
                    {{--  {{Form::text('percentage[]',null,['class'=>'form-control commission_input','id'=>'full_casco_percentage5'])}}  --}}
                    {{Form::text('percentage[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_percentage5'])}}
                    <div class="text-danger"><strong id="varient_coverage5_percentage_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  <div class="form-group">
                    {{Form::label('Price(Including coverage outside country)(in percentage)')}}
                    {{--  {{Form::text('price[]',null,['class'=>'form-control commission_input','id'=>'full_casco_price5'])}}  --}}
                    {{Form::text('price[]',null,['class'=>'form-control per-val number_only','id'=>'full_casco_price5'])}}
                    <div class="text-danger"><strong id="varient_coverage5_price_error_fullcasco"></strong></div>
                    <div class="text-success"><strong></strong></div>

                  </div>
                  {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'fullcasco_bttn'])}}
                {{Form::close()}}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive document_div mt_5">
                  <table class="table table-bordered
                  table-hover
                  table-striped">
                    <thead>
                      <tr>
                        <th>Variant name</th>
                        <th>variant coverage </th>
                        <th>%</th>
                        <th>% including coverage outside country</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id='fullcasco_table'>
                    @if(isset($fullCasco_list_details))
                      @foreach($fullCasco_list_details as $key => $sub1)
                        <tr class="customer_link open">
                          <td>{{$sub1['variant']}}</td>
                          <td>{{$sub1['variant_coverage']}}</td>
                          <td>{{$sub1['percentage']}}</td>
                          <td>€ {{$sub1['price']}}</td>
                        <td>
                            <label class="checkbox-four">
                              @if($sub1['status'] == 1)
                                <input type="checkbox" data-id="{{$sub1['full_casco_id']}}" class="casco_status" checked/> <span class="track thumb"></span>
                              @else
                                <input type="checkbox" data-id="{{$sub1['full_casco_id']}}" class="casco_status"/> <span class="track thumb"></span>
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
      </section>
      <!-- /.content -->
    </div>
@endsection
@section('add-js')
<script src="{{URL::asset('js/modals/insurer/sub_policy/car-fullcasco-policy.js')}}"></script>
<script>








    $(".per-val").on("keydown blur keyup change", function(){

        var value = $(this).val().trim();
        if(parseFloat(value)<=100 && value !='' && value>0){
            $(this).closest('.form-group').find('.text-success').children().text("Valid Percentage");
           $( "#fullcasco_bttn").prop('disabled', false);

        }else{
            $(this).closest('.form-group').find('.text-danger').children().text("Please enter your valid Percentage");
            $(this).closest('.form-group').find('.text-success').children().text(" ");
            $( "#fullcasco_bttn").prop('disabled', true);
        }

    });

    $(".number_only").keypress(function (e) {
        return isNumber(e, this);

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


    $(function () {
      $('.sort').DataTable({
        // 'responsive': true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
      });

      $('.table').parent().addClass('table-responsive');
    });
  </script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      $('[data-mask]').inputmask()

    });
    $(document).on('change','.casco_status',function(){
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
            url: "{{ route('change_policy_full_casco_status') }}",
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







  </script>









@endsection
