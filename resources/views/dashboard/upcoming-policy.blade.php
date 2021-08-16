@extends('layouts.master')
@section('title','MySIg by Fidentia | Upcoming Policy')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Upcoming Policy
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active breadcrumb_listItem">Upcoming Policy</li>
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
                    @if (!empty($datanewa->date1))

                        <div class="collapse in" id="collapseExample">
                    @else
                        <div class="collapse" id="collapseExample">
                    @endif
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
                                        {{Form::label('Policy Type')}}
                                        <select class="form-control" name="type" id="filter_type">
                                            <option value="">Select Insurance Company </option>
                                                @foreach ($policySubType as $item)
                                                    <option value="{{ $item->policy_sub_type_id  }}">{{ $item->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        {{Form::label('Insurance Category')}}
                                        <select class="form-control" name="catagory_insurer" id="insurance_catagory">
                                            <option value="">Select Insurance Company </option>
                                            @foreach ($insurer_policy as $item)
                                                <option value="{{ $item->policy_sub_type_id }}">{{ $item->policy_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--  <div class="form-group col-md-3">
                                        {{Form::label('Insurance Category')}}
                                        {{ Form::select('category', array('1' => '1', '2' => '2','3'=>' 3','4'=>' 4'), null, ['class'=>'form-control','id'=>'dis_insurance_catagory','placeholder' => 'insurance category'])}}
                                    </div>  --}}

                                    <div class="form-group col-md-3">
                                        {{Form::label('Status')}}
                                        {{ Form::select('Status', array(''=>'Select Status','1' => 'due', '2' => 'Escalated','3'=>' Expired'), null, ['class'=>'form-control','id'=>'upcomeing_status'])}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Next Followup Date</label>
                                        {{Form::text('followup_date',null,['class'=>'form-control date_range','id'=>'datetimepicker2','autocomplete'=>'off'])}}

                                        <!-- <input id="datetimepicker2" type="text" class="form-control date_range" name="followup_date"> -->
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Renewel Date range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">	<i class="fa fa-calendar"></i>
                                            </div>
                                            {{Form::text('renewal_date_range',null,['class'=>'form-control pull-right','id'=>'reservation','autocomplete'=>'off'])}}
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }

                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }
                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }
                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }
                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }
                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }
                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
                                                        <?php
                                                            if(date('Y-m-d',strtotime(' +1 day'))==date('Y-m-d', strtotime($item['renewal_date']))){
                                                                ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">due</a>
                                                                </td>
                                                                <?php
                                                            }
                                                            elseif(date('Y-m-d')>=date('Y-m-d', strtotime($item['renewal_date']))){
                                                            ?>
                                                                <td> {{ date('d-m-Y', strtotime($item['renewal_date'])) }}
                                                                    <br>
                                                                    <br> <a class="delivered" href="#">Expired</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            else{
                                                                echo "<td>".date('d-m-Y', strtotime($item['renewal_date']))."</td>";
                                                            }
                                                        ?>
                                                        <td>{{$item['prospect_name']}}</td>
                                                        <td>{{$item['type_name']}}</td>
                                                        @if(!empty($item['policy_name_dtl']['policy_name']))
                                                            <td>{{$item['policy_name_dtl']['policy_name']}}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif

                                                        <td>{{$item['policy_number']}}</td>
                                                        <td>{{$item['insurer_name'] }}</td>
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
		  })


		})
	</script>
	<script>
		$(document).ready(function() {
            /*$('#reservation').click(function(){
                //Date range picker
		        $('#reservation').daterangepicker();
            });*/



                $('input[name="renewal_date_range"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="renewal_date_range"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                });

                $('input[name="renewal_date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

      $.datetimepicker.setLocale('pt-BR');
      $('#datetimepicker').datetimepicker();
    });
	</script>
	<script>
		$(document).ready(function() {
      $.datetimepicker.setLocale('pt-BR');
      $('#datetimepicker2').datetimepicker();


    var url = window.location.href;
    var newurl=url.split("user-upcoming-policy");
    var get_encrept_data_new = newurl[1].split('/');
    var get_encrept_data = get_encrept_data_new[1];

    if(get_encrept_data){
        $('#collapseExample').addClass('in');

        decrept_data=window.atob(get_encrept_data);
        var new_data = JSON.parse(decrept_data);
        console.log(new_data);
        $('#insurance_company option[value="'+new_data.insurance_company+'"]').attr('selected','selected');
        $('#filter_type option[value="'+new_data.filter_type+'"]').attr('selected','selected');
        $('#insurance_catagory option[value="'+new_data.insurance_catagory+'"]').attr('selected','selected');
        $('#upcomeing_status option[value="'+new_data.upcomeing_status+'"]').attr('selected','selected');
        $('#datetimepicker2').val(new_data.next_followup_date);
        if(new_data.date1){
            $('#reservation').val(new_data.date1+" - "+new_data.date2);
        }

    }


    });
	</script>
    <script>
        $('select#dis_insurance_catagory option:first').attr('disabled', true);
        $('select#dis_policy_type option:first').attr('disabled', true);
        $('select#dis_status option:first').attr('disabled', true);

        $(function() {

            $("form[name='upcoming-policy-update']").validate({
              rules: {

                notes: "required"
              },
              messages: {
                notes: "Please Enter your Notes"
              },
              submitHandler: function(form) {
                form.submit();
              }
            });


            $("form[name='edit_followup_update']").validate({
                rules: {

                    followup_date: "required"
                },
                messages: {
                    followup_date: "Please Enter your Next Followup Date"
                },
                submitHandler: function(form) {
                  form.submit();
                }
              });



          });

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

    function filterRecord(){




        var insurance_company=  $('#insurance_company').val();
        var filter_type=  $('#filter_type').val();
        var filter_city=  $('#filter_city').val();
        var status =  $('#status').val();
        var upcomeing_status =  $('#upcomeing_status').val();
        var insurance_catagory =  $('#insurance_catagory').val();
        var reservation=  $('#reservation').val();
        var next_followup_date =  $('#datetimepicker2').val();
        var date = reservation.split(" - ");
        var date1 = date[0];
        var date2 = date[1];

        var myArray = {"insurance_company":insurance_company,"filter_type": filter_type,"date1":date1,"date2":date2,"next_followup_date":next_followup_date,"insurance_catagory":insurance_catagory,'upcomeing_status':upcomeing_status};
        var newmyArray=JSON.stringify(myArray);
         encrept_data=btoa(newmyArray);


        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

         $.ajax({
             type:'get',
             url:"{{ route('user_upcoming_policy') }}"+'/'+encrept_data,
             success:function(data){
                 window.location.href = this.url;

             }
          });

     }





    </script>
@endsection
