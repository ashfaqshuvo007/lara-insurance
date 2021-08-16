@extends('layouts.master')
@section('title','MySIg by Fidentia | Green Card')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Green Card
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Green Card</li>
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
                    <section id="tabsContainer">
                      <div class="tabs-nav">
                        <ul class="tab__navList nav nav-tabs">
                          <li class="active tab__navListItem"> <a href="#tab1" class="tab__navListLink" role="tab"
                              data-toggle="tab">Green card for all countries</a>
                          </li>
                          <li class="tab__navListItem"> <a href="#tab2" class="tab__navListLink" role="tab"
                              data-toggle="tab">Green card for Montenegro</a>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane tab_content active" id="tab1">
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="green_card_table1">
                              <thead>
                                <tr>
                                  <th >Green card for all countries</th>
                                  <th >15 days</th>
                                  <th >1 Month</th>
                                  <th >3 Months</th>
                                  <th >6 Months</th>
                                  <th >12 Months</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                              @if(isset($green_list_details))
                                @foreach($green_list_details as $key => $sub1)
                                @if($sub1['green_card_type'] == 'Green card for all countries')
                                  <tr class="customer_link open">
                                    <td>{{$sub1['name']}}</td>
        
                                    <td>€ {{$sub1['15_days_price']}}</td>
                                    <td>€ {{$sub1['30_days_price']}}</td>
                                    <td>€ {{$sub1['3_months_price']}}</td>
                                    <td>€ {{$sub1['6_months_price']}}</td>
                                    <td>€ {{$sub1['12_months_price']}}</td>
                                  <td>
                                      <label class="checkbox-four">
                                        @if($sub1['status'] == 1)
                                          <input type="checkbox" data-id="{{$sub1['green_card_id']}}" checked class="green_status"/> <span class="track thumb"></span>
                                        @else
                                          <input type="checkbox" data-id="{{$sub1['green_card_id']}}" class="green_status"/> <span class="track thumb"></span>
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
                          <div class="table-responsive">
                            <table
                            class=" fold-table table table-bordered table-hover  mt_5 pt-5">
                            <thead>
                              <tr>
                                <th>Green card for all countries</th>
                                <th>15 days</th>
                                <th >1 Month</th>
                                <th >3 Months</th>
                                <th >6 Months</th>
                                <th >12 Months</th>
                                <th >Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="customer_link open">
                              {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-car-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Cars',['id'=>'name']) !!}
                                  <td>Cars</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bikesup-to-150cc-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bikes up to 150cc',['id'=>'name']) !!}
                                  <td>Bikes up to 150cc</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bikes-more-than-150cc-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bikes more than 150cc',['id'=>'name']) !!}
                                  <td>Bikes more than 150cc</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Loading-Vehicle-more-than-15-34kv-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Loading Vehicle 15kv to 34.99kv',['id'=>'name']) !!}
                                  <td>Loading Vehicle 15kv to 34.99kv</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Loading-Vehicle-more-than-34-99kv-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Loading Vehicle more than 34.99kv',['id'=>'name']) !!}
                                  <td>Loading Vehicle more than 34.99kv</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Ambulances-Funeral-cars-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Ambulances,Funeral,cars',['id'=>'name']) !!}
                                  <td>Ambulances,Funeral,cars</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                              {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Cyclomotor-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Cyclomotor',['id'=>'name']) !!}
                                  <td>Cyclomotor</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
      
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bus-9-1-to-18-1-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bus 9+1 to 18+1',['id'=>'name']) !!}
                                  <td>Bus 9+1 to 18+1</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                      
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bus-19-1-to-28-1-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bus 19+1 to 28+1',['id'=>'name']) !!}
                                  <td>Bus 19+1 to 28+1</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
              
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bus-29-1-and-up-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bus 29+1 and up',['id'=>'name']) !!}
                                  <td>Bus 29+1 and up</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Truck-Trailer-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Truck Trailer',['id'=>'name']) !!}
                                  <td>Truck Trailer</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                        
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bus-Trailer-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bus Trailer',['id'=>'name']) !!}
                                  <td>Bus Trailer</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                               
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Other-trailers-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for all countries',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Other trailers',['id'=>'name']) !!}
                                  <td>Other trailers</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                            </tbody>
                            <tfoot></tfoot>
                          </table>
                          </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab2">
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover  table-striped mt_5 pt-5" id="green_card_table2">
                            <thead>
                              <tr>
                                <th>Green card for Montenegro</th>
                                <th >15 days</th>
                                <th >30 days</th>
                                <th>45 days</th>
                                <th>3 Months</th>
                                <th>6 Months</th>
                                <th>12 Months</th>
                                <th >Status</th>
                              </tr>
                            </thead>
                            <tbody>
                            @if(isset($green_list_details))
                                @foreach($green_list_details as $key => $sub1)
                                @if($sub1['green_card_type'] == 'Green card for Montenegro')
                                  <tr class="customer_link open">
                                    <td>{{$sub1['name']}}</td>
        
                                    <td>€ {{$sub1['15_days_price']}}</td>
                                    <td>€ {{$sub1['30_days_price']}}</td>
                                    <td>€ {{$sub1['45_days_price']}}</td>
                                    <td>€ {{$sub1['3_months_price']}}</td>
                                    <td>€ {{$sub1['6_months_price']}}</td>
                                    <td>€ {{$sub1['12_months_price']}}</td>
                                  <td>
                                      <label class="checkbox-four">
                                        @if($sub1['status'] == 1)
                                          <input type="checkbox" data-id="{{$sub1['green_card_id']}}" checked class="green_status"/> <span class="track thumb"></span>
                                        @else
                                          <input type="checkbox" data-id="{{$sub1['green_card_id']}}" class="green_status"/> <span class="track thumb"></span>
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
                          <div class="table-responsive">
                            <table class="fold-table table table-bordered table-hover  mt_5 pt-5">
                            <thead>
                              <tr>
                                <th >Green card for Montenegro</th>
                                <th >15 days</th>
                                <th >30 days</th>
                                <th >45 days</th>
                                <th >3 Months</th>
                                <th >6 Months</th>
                                <th>12 Months</th>
                                <th >Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="customer_link open">
                               
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Cars-Up-to-8-seats-3-4-tons-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Cars Up to 8 seats & 3.4 tons',['id'=>'name']) !!}
                                  <td>Cars Up to 8 seats & 3.4 tons</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                               
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bikes-up-to-150cc-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bikes up to 150cc',['id'=>'name']) !!}
                                  <td>Bikes up to 150cc</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bikes-more-than-150cc-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bikes more than 150cc',['id'=>'name']) !!}
                                  <td>Bikes more than 150cc</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                               
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Loading-Vehicle-more-than-34-99kv-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Loading Vehicle more than 34.99kv',['id'=>'name']) !!}
                                  <td>Loading Vehicle more than 34.99kv</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Ambulances-Funeral-cars-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Ambulances,Funeral cars',['id'=>'name']) !!}
                                  <td>Ambulances,Funeral cars</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                               
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Bus-19-1-to-28-1-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Bus 19+1 to 28+1',['id'=>'name']) !!}
                                  <td>Bus 19+1 to 28+1</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                                
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Truck-Traile-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Truck Trailer',['id'=>'name']) !!}
                                  <td>Truck Trailer</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
                              <tr class="customer_link open">
                               
                                  {!! Form::open(['route'=>'add_policy_green_card','role'=>'form','files'=>true,'id'=>'add-green-card-Other-trailers-policy2','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                  @if(isset($insurer_sub_Policy))
                                        {!! Form::hidden('insurer_id',$insurer_sub_Policy->insurer_id,['id'=>'insurer_id']) !!}
                                        {!! Form::hidden('insurer_policy_id',$insurer_sub_Policy->insurer_policy_id,['id'=>'insurer_policy_id']) !!}
                                  @endif
                                  {!! Form::hidden('green_card_type','Green card for Montenegro',['id'=>'green_card_type']) !!}
                                  {!! Form::hidden('name','Other trailers',['id'=>'name']) !!}
                                  <td>Other trailers</td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('15_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('30_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                 
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('45_days_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('3_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('6_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td >
                                    <div class="form-group">
                                      {{Form::text('12_months_price',null,['class'=>'form-control commission_input'])}}
                                    </div>
                                  </td>
                                  <td>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary','name'=>'submit_button','id'=>'tpl_bttn'])}}
                                  </td>
                                {{Form::close()}}
                              </tr>
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
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <!-- /.box-body -->
  </div>
  </section>
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('add-js')
<script src="{{URL::asset('js/modals/insurer/sub_policy/car-green-card-policy.js')}}"></script>
<script>
    $(document).on('change','.green_status',function(){
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
            url: "{{ route('change_policy_green_card_status') }}",
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