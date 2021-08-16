@extends('layouts.master')
@section('title','MySIg by Fidentia | Dashboard')
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Dashboard</li>
        </ol>
      </section>
    <div>
    <div>
      
      <example-component></example-component>
    </div>
    </div>
      


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
                      {{ Form::open() }}
                        @csrf
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlSelect1','Branch')}}
                          {{ Form::select('branch', array('branch_1' => 'branch 1', 'branch_2' => 'branch 2','branch_3'=>'Branch 3','branch_4'=>'Branch 4'), null, ['class'=>'form-control','id'=>'dis_branch','placeholder' => 'Branch'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlSelect1','Bussiness Owner')}}
                          {{ Form::select('owner', array('1' => '1', '2' => '2','3'=>' 3','4'=>' 4'), null, ['class'=>'form-control','id'=>'dis_owner','placeholder' => 'Bussiness Owner'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlSelect1','Client Name')}}
                          {{ Form::select('client_name', array('1' => '1', '2' => '2','3'=>' 3','4'=>' 4'), null, ['class'=>'form-control','id'=>'dis_client_name','placeholder' => 'Client Name'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('Insurer','Insurer',['class'=>'select_lebel col-sm-2 col-form-label'])}}
                          {{ Form::select('insurer', array('1' => 'Sigma', '2' => 'Sigal','3'=>' Intersig','4'=>' Insig'), null, ['class'=>'form-control','id'=>'dis_insurer','placeholder' => 'Insurer'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlSelect1','Policy Type')}}
                          {{ Form::select('Type', array('1' => 'All', '2' => '2','3'=>' 3','4'=>' 4'), null, ['class'=>'form-control','id'=>'dis_type','placeholder' => 'Type'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlSelect1','Policy Status')}}
                          {{ Form::select('Status', array('1' => 'All', '2' => '2','3'=>' 3','4'=>' 4'), null, ['class'=>'form-control','id'=>'dis_status','placeholder' => 'Status'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlInput1','Age Above')}}
                          {{Form::text('Age',null,['class'=>'form-control'])}}
                        </div>
                        <div class="form-group col-md-3">
                          {{Form::label('exampleFormControlSelect1','Booked In')}}
                          {{ Form::select('book', array('1' => '1', '2' => '2','3'=>' 3','4'=>' 4'), null, ['class'=>'form-control','id'=>'dis_book','placeholder' => 'Booked In'])}}
                        </div>
                        <div class="form-group col-md-3 mt_5">
                          {{Form::submit('Apply',['class'=>'btn btn-primary w-100'])}}
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
                  <table class="table table-bordered" id="dataTableDashboard">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Business Summery</th>
                        <th >Premium</th>
                        <th >Gross Premium</th>
                        <th >Net Premium</th>
                        <th >Brokerage</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Data is coming via AJAX and dynamically injecting rows containing data.-->
                    </tbody>
                  </table>
                </div>
                <section id="tabsContainer">
                    <div class="tabs-nav">
                        <ul class="tab__navList nav nav-tabs">
                            <li class="active tab__navListItem"> <a href="#tab1" class="tab__navListLink" role="tab" data-toggle="tab">All</a>
                            </li>
                            <li class="tab__navListItem"> <a href="#tab2" class="tab__navListLink" role="tab" data-toggle="tab">Due Today</a>
                            </li>
                            <li class="tab__navListItem"> <a href="#tab3" class="tab__navListLink" role="tab" data-toggle="tab">Due Tommorow</a>
                            </li>
                            <li class="tab__navListItem"> <a href="#tab4" class="tab__navListLink" role="tab" data-toggle="tab">Due This Week</a>
                            </li>
                            <li class="tab__navListItem"> <a href="#tab5" class="tab__navListLink" role="tab" data-toggle="tab">Due This Month</a>
                            </li>
                            <li class="tab__navListItem"> <a href="#tab6" class="tab__navListLink" role="tab" data-toggle="tab">Over Due</a>
                            </li>
                            <li class="tab__navListItem">	<a href="#tab7" class="tab__navListLink" role="tab" data-toggle="tab">Followups</a>
                            </li>
                            {{--  <li class="tab__navListItem">	<a href="#tab8" class="tab__navListLink" role="tab" data-toggle="tab">Calender</a>
                            </li>  --}}
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane tab_content active" id="tab1">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Renewal Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data['tab1'] as $item)
                                        <tr >

                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif



                                        </tr>

                                        @endforeach

                                        {{--  <tr >
                                            <td class="text-center">06-04-2018
                                                <br>27069
                                                <br>
                                                <br> <a class="delivered" href="#">due</a>
                                            </td>
                                            <td>Raja Das</td>
                                            <td>Renewe</td>
                                            <td>Two Wheeler Motor Vehicle</td>
                                            <td>PFS/I3912731/G2/06/006087</td>
                                            <td>Apollo munich</td>
                                            <td>0-10k</td>
                                            <td>Insatllment</td>
                                            <td>06-03-2018
                                                <br>12:00am
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Show your text here
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="text-center">06-04-2018
                                                <br>27069
                                                <br>
                                                <br> <a class="delivered" href="#">Escalated</a>
                                            </td>
                                            <td>Raja Das</td>
                                            <td>Renewe</td>
                                            <td>Two Wheeler Motor Vehicle</td>
                                            <td>PFS/I3912731/G2/06/006087</td>
                                            <td>Apollo munich</td>
                                            <td>0-10k</td>
                                            <td>Insatllment</td>
                                            <td>06-03-2018
                                                <br>12:00am
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Show your text here
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="text-center">06-04-2018
                                                <br>27069
                                                <br>
                                                <br> <a class="delivered" href="#">due</a>
                                            </td>
                                            <td>Raja Das</td>
                                            <td>Renewe</td>
                                            <td>Two Wheeler Motor Vehicle</td>
                                            <td>PFS/I3912731/G2/06/006087</td>
                                            <td>Apollo munich</td>
                                            <td>0-10k</td>
                                            <td>Insatllment</td>
                                            <td>06-03-2018
                                                <br>12:00am
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Show your text here
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">06-04-2018
                                                <br>27069
                                                <br>
                                                <br> <a class="delivered" href="#">Escalated</a>
                                            </td>
                                            <td>Raja Das</td>
                                            <td>Renewe</td>
                                            <td>Two Wheeler Motor Vehicle</td>
                                            <td>PFS/I3912731/G2/06/006087</td>
                                            <td>Apollo munich</td>
                                            <td>0-10k</td>
                                            <td>Insatllment</td>
                                            <td>06-03-2018
                                                <br>12:00am
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Show your text here
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="text-center">06-04-2018
                                                <br>27069
                                                <br>
                                                <br> <a class="delivered" href="#">Expired</a>
                                            </td>
                                            <td>Raja Das</td>
                                            <td>Renewe</td>
                                            <td>Two Wheeler Motor Vehicle</td>
                                            <td>PFS/I3912731/G2/06/006087</td>
                                            <td>Apollo munich</td>
                                            <td>0-10k</td>
                                            <td>Insatllment</td>
                                            <td>06-03-2018
                                                <br>12:00am
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Show your text here
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">06-04-2018
                                                <br>27069
                                                <br>
                                                <br> <a class="delivered" href="#">due</a>
                                            </td>
                                            <td>deev Das</td>
                                            <td>Renewe</td>
                                            <td>Two Wheeler Motor Vehicle</td>
                                            <td>PFS/I3912731/G2/06/006087</td>
                                            <td>Apollo munich</td>
                                            <td>0-10k</td>
                                            <td>Insatllment</td>
                                            <td>06-03-2018
                                                <br>12:00am
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Show your text here
                                                <button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>  --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{Form::open(array('url' => route('upcoming-policy-followup-update'), 'method' => 'post','class'=>'width-100','name' => 'edit_followup_update','files' => true))}}
                                            <div class="form-group">
                                                {{Form::label('validationTooltip01','Next Followup Date')}}
                                                {{Form::text('followup_date',null,['class'=>'form-control date_range','id'=>'datetimepicker','autocomplete'=>'off'])}}
                                                {{ Form::hidden('policy_id', "0") }}
                                                @error('followup_date')
                                                    <span class="color_red" role="alert">
                                                    <h5 class="message_text">*{{ $message }}</h5>
                                                    </span>
                                                @enderror
                                                {{Form::submit('Save changes',['class'=>'btn btn-primary'])}}
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{Form::open(array('url' => route('upcoming-policy-update'),'class'=>'width-100', 'method' => 'post','name' => 'upcoming-policy-update','files' => true))}}
                                            <div class="form-group">
                                                <label for="">Give Your Note Here</label>
                                                {{Form::textarea('notes',null,['class'=>'form-control','rows'=>'3'])}}
                                                @error('notes')
                                                    <span class="color_red" role="alert">
                                                    <h5 class="message_text">*{{ $message }}</h5>
                                                    </span>
                                                @enderror
                                                {{ Form::hidden('policy_id', "0") }}
                                            </div>
                                            <div class="form-group">
                                                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab2">
                            <div class="table-responsive">
                                <table class=" table table-bordered " id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Renewal Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tab2'] as $item)
                                        <tr >
                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif



                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab3">
                            <div class="table-responsive">
                                <table class=" table table-bordered  " id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Renewal Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tab3'] as $item)
                                        <tr >
                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif



                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab4">
                            <div class="table-responsive">
                                <table class=" table table-bordered " id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Renewal Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tab4'] as $item)
                                        <tr >
                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif



                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab5">
                            <div class="table-responsive">
                                <table class=" table table-bordered" id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Renewal Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tab5'] as $item)
                                        <tr >
                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif


                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab6">
                            <div class="table-responsive">
                                <table class=" table table-bordered" id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Renewal Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tab6'] as $item)
                                        <tr >
                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif



                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane tab_content" id="tab7">
                            <div class="table-responsive">
                                <table class=" table table-bordered " id="upcoming_table1">
                                    <thead>
                                        <tr>
                                            <th>Followup Date</th>
                                            <th>Prospect Name</th>
                                            <th>Type</th>
                                            <th>Policy</th>
                                            <th>Previous Policy N0.</th>
                                            <th>Insurer</th>
                                            <th>Premium Size</th>
                                            <th>Remarks</th>
                                            <th>Next Followup Date</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tab7'] as $item)
                                        <tr >
                                            <td>{{ $item['renewal_date'] }}</td>
                                            <td>{{$item['prospect_name']}}</td>
                                            <td>{{$item['type_name']}}</td>
                                            @if(!empty($item['policy_name_dtl']['policy_name']))
                                                <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                            @else
                                                <td> </td>
                                            @endif

                                            <td>{{$item['policy_number']}}</td>
                                            <td>{{$item['insured_name'] }}</td>
                                            <td>{{$item['premium']}}</td>
                                            <td>{{$item['remarks']}}</td>
                                             @if(!empty($item['next_followup_date']))
                                            <td>{{$item['next_followup_date']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_follwup(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif

                                            @if(!empty($item['note']))
                                            <td>{{$item['note']}}<button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button></td>
                                            @else
                                                <td><button type="button" class="popup_btn" id='{{$item['policy_id']}}' onclick="edit_note(this.id)"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button></td>
                                            @endif



                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--  <div class="tab-pane tab_content" id="tab8"></div>  --}}
                    </div>
                </section>

              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      </section>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('url' => route('upcoming-policy-followup-update'), 'method' => 'post','class'=>'width-100','name' => 'edit_followup_update','files' => true))}}
                        <div class="form-group">
                            {{Form::label('validationTooltip01','Next Followup Date')}}
                            {{Form::text('followup_date',null,['class'=>'form-control date_range','id'=>'datetimepicker','autocomplete'=>'off'])}}
                            {{ Form::hidden('policy_id', "0") }}
                            @error('followup_date')
                                <span class="color_red" role="alert">
                                <h5 class="message_text">*{{ $message }}</h5>
                                </span>
                            @enderror
                            {{Form::submit('Save changes',['class'=>'btn btn-primary'])}}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('url' => route('upcoming-policy-update'),'class'=>'width-100', 'method' => 'post','name' => 'upcoming-policy-update','files' => true))}}
                        <div class="form-group">
                            <label for="">Give Your Note Here</label>
                            {{Form::textarea('notes',null,['class'=>'form-control','rows'=>'3'])}}
                            @error('notes')
                                <span class="color_red" role="alert">
                                <h5 class="message_text">*{{ $message }}</h5>
                                </span>
                            @enderror
                            {{ Form::hidden('policy_id', "0") }}
                        </div>
                        <div class="form-group">
                            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('add-js')
<script>
    $(function () {
      function format() {
        // `d` is the original data object for the row
        return `<table cellpadding="5"
          cellspacing="0" border="0"
          style="padding-left: 50px;">
          <tr>
            <td>
              <a class="delete_police" data-id="27273" href="{{route('view_policy')}}">View Policy </a>
            </td>
          </tr>
        </table>`;
      }

      let table = $('#dataTableDashboard').DataTable({
        // 'responsive': true,
        "ajax": "{{route('dashboard_table_data')}}",
        "columns": [{
            "data": "id",
            "orderable": false,
          },
          {
            "data": "business_summary"
          },
          {
            "data": "premium"
          },
          {
            "data": "gross"
          },
          {
            "data": "net_premium"
          },
          {
            "data": "brokerage"
          }
        ],
        "order": [
          [1, 'asc']
        ],
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
      });

    //   $('#dataTableDashboard tbody').on('click', 'tr', function () {
    //     var tr = $(this).closest('tr');
    //     var row = table.row(tr);

    //     if (row.child.isShown()) {
    //       // This row is already open - close it
    //       row.child.hide();
    //       tr.removeClass('shown');
    //     } else {
    //       // Open this row
    //       row.child(format()).show();
    //       tr.addClass('shown');
    //     }
    //   });



      $('.table').parent().addClass('table-responsive');
    });
  </script>
  <script>
    $(document).ready(function() {
  $.datetimepicker.setLocale('pt-BR');
  $('#datetimepicker').datetimepicker();
});
</script>
<script>
    $(document).ready(function() {
  $.datetimepicker.setLocale('pt-BR');
  $('#datetimepicker2').datetimepicker();
});
</script>
  <script>
    $('select#dis_branch option:first').attr('disabled', true);
    $('select#dis_owner option:first').attr('disabled', true);
    $('select#dis_client_name option:first').attr('disabled', true);
    $('select#dis_insurer option:first').attr('disabled', true);
    $('select#dis_type option:first').attr('disabled', true);
    $('select#dis_status option:first').attr('disabled', true);
    $('select#dis_book option:first').attr('disabled', true);

    function edit_note(id){
        var getid=id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('upcoming-policy-edit') }}",
            data:{data:getid},
            success:function(data){
              console.log(data);

              $("#exampleModal2 textarea[name='notes']").val('');
              $("#exampleModal2 input[name='policy_id']").val('');


              $('#exampleModal2').modal('show');


              $("#exampleModal2 textarea[name='notes']").val(data.note);
              $("#exampleModal2 input[name='policy_id']").val(data.policy_id);


            }
        });
    }
    function edit_follwup(id){
        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('upcoming-policy-edit') }}",
            data:{data:getid},
            success:function(data){
              console.log(data);


              $("#exampleModal input[name='followup_date']").val('');
              $("#exampleModal input[name='policy_id']").val('');

              $('#exampleModal').modal('show');


              $("#exampleModal input[name='followup_date']").val(data.next_followup_date);
              $("#exampleModal input[name='policy_id']").val(data.policy_id);



            }
        });
    }
  </script>
@endsection
