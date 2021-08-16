@extends('layouts.master')
@section('title','MySIg by Fidentia | Travel')

@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Travel
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Travel</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
            <!-- '1-9 days'=>'1-9 days', -->
            <!-- '11-15 days'=>'11-15 days', -->
             <!-- '181-365 days'=>'181-365 days', -->
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <section id="tabsContainer">
                      <div class="tabs-nav">
                        <ul class="tab__navList nav nav-tabs">
                          <li class="active tab__navListItem"> <a href="#tab1" class="tab__navListLink" role="tab"
                              data-toggle="tab">For Age 0-69</a>
                          </li>
                          <li class="tab__navListItem"> <a href="#tab2" class="tab__navListLink" role="tab"
                              data-toggle="tab">For Age 70-79</a>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane tab_content active" id="tab1">
                            {{--  this form is submmited is ajax global-post  --}}
                        {!! Form::open(['route'=>'travel_sub_policy_add','role'=>'form','files'=>true,'id'=>'add-travel-sub1-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                              @if(isset($insurer_sub_Policy))
                                    {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                    {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                    {!! Form::hidden('policy_sub_type_id',$insurer_sub_Policy->policy_sub_type_id,['id'=>'policy_sub_type_id']) !!}
                              @endif
                              {!! Form::hidden('age_group','0-69',['id'=>'age_group']) !!}
                            <div class="form-group">
                              {{Form::label('Zone')}}
                              {{Form::select('zone',array('Zone A all countries'=>'Zone A all countries',
                                                            'Zone B all excluding USA&CA'=>'Zone B all excluding USA&CA',
                                                            'Zone C europe'=>'Zone C europe',
                                                            'Zone D Turkey'=>'Zone D Turkey'),null,['class'=>'form-control','id'=>'travel_sub1_zone'])}}
                            </div>
                            <div class="form-group">
                            {{Form::label('validity')}}
                            @php
                              $validity=array('1-6 days'=>'1-6 days',
                                              '1-9 days'=>'1-9 days',
                                                '7-10 days'=>'7-10 days',
                                                '10-15 days'=>'10-15 days',
                                                '11-15 days'=>'11-15 days',
                                                '16-20 days'=>'16-20 days',
                                                '21-30 days'=>'21-30 days',
                                                '31-45 days'=>'31-45 days',
                                                '46-60 days'=>'46-60 days',
                                                '61-90 days'=>'61-90 days',
                                                '91-120 days'=>'91-120 days',
                                                '121-150 days' => '121-150 days',
                                                '151-180 days'=>'151-180 days',
                                                '181-270 days'=>'181-270 days',
                                                '181-365 days'=>'181-365 days',
                                                '271-365 days'=>'271-365 days');
                            @endphp
                            {{Form::select('validity',$validity,null,['class'=>'form-control','id'=>'travel_sub1_validity'])}}
                            </div>
                            <div class="form-group">
                              {{Form::label('Price')}}
                              {{Form::text('price',null,['class'=>'form-control commission_input','id'=>'travel_sub1_price'])}}
                              <div class="text-danger"><strong id="price_error_travel_sub1"></strong></div>
                            </div>
                            {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'travel_sub1_bttn'])}}
                          {{Form::close()}}
                          <br>
                         <div class="table-responsive">
                          <table class=" table table-bordered table-hover   table-striped" id="travel_table1">
                            <thead>
                              <tr>
                                <th>Zone</th>
                                <th>Validity</th>
                                <th>Price</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody id="travel_sub1_table">
                              @if(isset($travel_list))
                                @foreach($travel_list as $key => $sub1)
                                @if($sub1['age_group'] == '0-69')
                                  <tr class="customer_link open">
                                    <td>{{$sub1['zone']}}</td>
                                    <td>{{$sub1['validity']}}</td>
                                    <td>€ {{$sub1['price']}}</td>
                                  <td>
                                      <label class="checkbox-four">
                                        @if($sub1['status'] == 1)
                                          <input type="checkbox" data-id="{{$sub1['travel_id']}}" checked class="travel_status"/> <span class="track thumb"></span>
                                        @else
                                          <input type="checkbox" data-id="{{$sub1['travel_id']}}" class="travel_status"/> <span class="track thumb"></span>
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
                        <div class="tab-pane tab_content" id="tab2">
                          {!! Form::open(['route'=>'travel_sub_policy_add','role'=>'form','files'=>true,'id'=>'add-travel-sub2-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                              @if(isset($insurer_sub_Policy))
                                    {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                    {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                    {!! Form::hidden('policy_sub_type_id',$insurer_sub_Policy->policy_sub_type_id,['id'=>'policy_sub_type_id']) !!}
                              @endif
                              {!! Form::hidden('age_group','70-79',['id'=>'age_group']) !!}
                            <div class="form-group">
                              {{Form::label('Zone')}}
                              {{Form::select('zone',array(
                                                          'Zone C europe'=>'Zone C europe',
                                                           ),null,['class'=>'form-control','id'=>'travel_sub1_zone'])}}
                            </div>
                            <div class="form-group">
                            {{Form::label('validity')}}
                            @php

                                                $validity=array('1-6 days'=>'1-6 days',
                                                '1-9 days'=>'1-9 days',
                                                '7-10 days'=>'7-10 days',
                                                '10-15 days'=>'10-15 days',
                                                '11-15 days'=>'11-15 days',
                                                '16-20 days'=>'16-20 days',
                                                '21-30 days'=>'21-30 days',
                                                '31-45 days'=>'31-45 days',
                                                '46-60 days'=>'46-60 days',
                                                '61-90 days'=>'61-90 days',
                                                '91-120 days'=>'91-120 days',
                                                '121-150 days' => '121-150 days',
                                                '151-180 days'=>'151-180 days',
                                                '181-270 days'=>'181-270 days',
                                                '181-365 days'=>'181-365 days',
                                                '271-365 days'=>'271-365 days');
                            @endphp
                            {{Form::select('validity',$validity,null,['class'=>'form-control','id'=>'travel_sub2_validity'])}}
                            </div>
                            <div class="form-group">
                              {{Form::label('Price')}}
                              {{Form::text('price',null,['class'=>'form-control commission_input','id'=>'travel_sub2_price'])}}
                              <div class="text-danger"><strong id="price_error_travel_sub2"></strong></div>
                            </div>
                            {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'travel_sub2_bttn'])}}
                          {{Form::close()}}
                          <br>
                          <div class="table-responsive">
                            <table class=" table table-bordered table-hover   table-striped" id="travel_table2">
                              <thead>
                                <tr>
                                  <th>Zone</th>
                                  <th>Validity</th>
                                  <th>Price</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody id='travel_sub2_table'>
                              @if(isset($travel_list))
                                @foreach($travel_list as $key => $sub1)
                                @if($sub1['age_group'] == '70-79')
                                  <tr class="customer_link open">
                                    <td>{{$sub1['zone']}}</td>
                                    <td>{{$sub1['validity']}}</td>
                                    <td>€ {{$sub1['price']}}</td>
                                  <td>
                                      <label class="checkbox-four">
                                        @if($sub1['status'] == 1)
                                          <input type="checkbox" data-id="{{$sub1['travel_id']}}" class="travel_status" checked/> <span class="track thumb"></span>
                                        @else
                                          <input type="checkbox" data-id="{{$sub1['travel_id']}}" class="travel_status"/> <span class="track thumb"></span>
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
                    </section>
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
  <script src="{{URL::asset('js/modals/insurer/sub_policy/travel-policy.js')}}"></script>
  <script>
    $(document).on('change','.travel_status',function(){
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
            url: "{{ route('change_insurer_travel_policy_status') }}",
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
