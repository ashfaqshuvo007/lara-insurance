
@extends('layouts.master')
@section('title','MySIg by Fidentia | View Claim')
@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          View Claim
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem">
            <a href="#" class="breadcrumb_listLink"> <i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="breadcrumb_listItem active">View Claim</li>
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
                    <div class="custom_scoll">
                      <div class="ui steps">
                        @if ($claim_status)
                        @foreach ($claim_status as $item)
                            <div class="content2">
                                @if( $item->status == '1' )

                                <div class="title">Claim Initiated</div>

                                @elseif($item->status == '2' )

                                <div class="title">Documents Received</div>
                                @elseif($item->status == '3' )

                                <div class="title">Sent to Processor</div>
                                @elseif($item->status == '4' )

                                <div class="title">Queried</div>
                                @elseif($item->status == '5' )

                                <div class="title">Query Response Sent</div>
                                @elseif($item->status == '6' )

                                <div class="title">Settled</div>
                                @endif

                            <div class="description">{{ date('d-m-Y', strtotime($item->created_at))}}</div>

                          </div>
                        @endforeach

                        @else
                            <div class="content3">
                                <div class="title"></div>
                                <div class="description"></div>
                            </div>
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mt_5">
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered">
                        <thead>
                          <tr>
                            <th>Claim Info</th>
                            <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#edit-claim-Modal1"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button> &nbsp;
                              <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr >
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Claim Id:</th>
                                      <td></td>
                                      <td >{{ $claim_data['claims_id'] }}</td>
                                    </tr>
                                    <tr>
                                      <th>customer:</th>
                                      <td ></td>
                                      <td><a href="#">{{ $get_customer['name'] }}</a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th >Status:</th>
                                      <td ></td>
                                        @if ($last_claim_status)


                                                    @if( $last_claim_status['status'] == '1' )

                                                        <td>Claim Initiated</td>

                                                    @elseif($last_claim_status['status'] == '2' )

                                                        <td>Documents Received</td>
                                                    @elseif($last_claim_status['status'] == '3' )

                                                        <td>Sent to Processor</td>
                                                    @elseif($last_claim_status['status'] == '4' )

                                                        <td>Queried</td>
                                                    @elseif($last_claim_status['status'] == '5' )

                                                        <td>Query Response Sent</td>

                                                    @elseif($last_claim_status['status'] == '6' )

                                                        <td>Settled</td>

                                                    @endif

                                        @else
                                            <td ></b>
                                        @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <th >Incident/Loss date:</th>
                                      <td ></td>
                                        @if(!empty($last_claim_status['loss_date']))
                                            <td >{{ date('d-m-Y', strtotime($last_claim_status['loss_date']))}}</td>
                                        @else
                                            <td ></td>
                                        @endif

                                    </tr>
                                    <tr>
                                      <th>Date Submitted to broker:</th>
                                      <td ></td>
                                        @if(!empty($last_claim_status['date_submitted_broker']))
                                            <td >{{ date('d-m-Y', strtotime($last_claim_status['date_submitted_broker']))}}</td>
                                        @else
                                            <td ></td>
                                        @endif

                                    </tr>
                                    <tr>
                                      <th>Settlement Date:</th>
                                      <td></td>
                                        @if(!empty($last_claim_status['settlement_date']))
                                            <td >{{ date('d-m-Y', strtotime($last_claim_status['settlement_date']))}}</td>
                                        @else
                                            <td ></td>
                                        @endif

                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered">
                        <thead>
                          <tr>
                            <th >Policy</th>
                           <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#edit-claim-Modal2"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button> &nbsp;
                              <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th >Policy No.:</th>
                                      <td ></td>
                                      <td >{{ $claim_policy_data['policy_number'] }}</td>
                                    </tr>
                                    <tr>
                                      <th>Insurer</th>
                                      <td></td>
                                      <td>{{ $get_insurer->getinsurer->name }}</td>
                                    </tr>
                                    <tr>
                                      <th >Product</th>
                                      <td ></td>
                                      <td >{{ $get_insurer->getsubPolicy->name }}</td>
                                    </tr>
                                    <tr>
                                      <th >Start Date</th>
                                      <td ></td>
                                      <td >{{ date('d-m-Y', strtotime($claim_policy_data['start_date']))}}</td>
                                    </tr>
                                    <tr>
                                      <th>End Date</th>
                                      <td></td>
                                      <td>{{ $claim_policy_data['expiry_date']!=''?date('d-m-Y', strtotime($claim_policy_data['expiry_date'])):''}}</td>
                                    </tr>
                                    <tr>
                                      <th>Insured Name</th>
                                      <td></td>
                                      <td>{{ $claim_policy_data['prospect_name'] }}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered">
                        <thead>
                          <tr>
                            <th>Loss Information</th>
                            <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#edit-claim-Modal3"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>

                            </th>

                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>

                                      <td>Location of loss or incident</td>
                                        @if(!empty($data['loss']['loss_location']))
                                        <td>{{$data['loss']['loss_location'] }}</td>
                                        @else
                                            <td ></td>
                                        @endif

                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        @if(!empty($data['loss']['loss_description'] ))
                                        <td>{{$data['loss']['loss_description'] }}</td>
                                        @else
                                            <td ></td>
                                        @endif


                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <div class="modal-body">
                                    are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-danger btn-ok">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit-claim-Modal1" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Policy Info</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('add_claim_status'), 'method' => 'post','name' => 'add_claim_status','files' => true))}}
                                  <div class="form-group">
                                    {{Form::label('Claim Id')}}
                                    {{Form::text('claim',$claim_data['claims_id'],['class'=>'form-control','readonly'=>'true'])}}
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Customer')}}
                                    {{Form::text('customer', $get_customer['name'],['class'=>'form-control','readonly'=>'true'])}}
                                  </div>
                                  <div class="form-group">
                                    <label for="">Status</label>
                                    @if ($last_claim_status)
                                    <select class="form-control" name="status">

                                      <option value="1" {{ ( $last_claim_status['status'] == '1') ? 'selected' : '' }}>Claim Initiated</option>
                                      <option value="2" {{ ( $last_claim_status['status'] == '2') ? 'selected' : '' }}>Documents Received</option>
                                      <option value="3" {{ ( $last_claim_status['status'] == '3') ? 'selected' : '' }}>Sent to Processor</option>
                                      <option value="4" {{ ( $last_claim_status['status'] == '4') ? 'selected' : '' }}>Queried</option>
                                      <option value="5" {{ ( $last_claim_status['status'] == '5') ? 'selected' : '' }}>Query Response Sent</option>
                                      <option value="6" {{ ( $last_claim_status['status'] == '6') ? 'selected' : '' }}>Settled</option>

                                    </select>
                                    @else
                                    <select class="form-control" name="status">
                                        <option value="1">Claim Initiated</option>
                                        <option value="2">Documents Received</option>
                                        <option value="3">Sent to Processor</option>
                                        <option value="4">Queried</option>
                                        <option value="5">Query Response Sent</option>
                                        <option value="6">Settled</option>
                                    </select>
                                    @endif
                                  </div>
                                  <div class="form-group wrapper date_div">
                                    {{Form::label('Incident/Loss date')}}
                                        @if(!empty($last_claim_status['loss_date']))
                                        {{Form::text('datepicker',date('d-m-Y', strtotime($last_claim_status['loss_date'])),['class'=>'form-control','id'=>'datepicker1','autocomplete'=>'off'])}}
                                        @else
                                        {{Form::text('datepicker',null,['class'=>'form-control','id'=>'datepicker1','autocomplete'=>'off'])}}
                                        @endif

                                  </div>
                                  <div class="form-group wrapper date_div">
                                    {{Form::label('Date Submitted to broker')}}
                                    @if(!empty($last_claim_status['date_submitted_broker']))
                                        {{Form::text('broker',date('d-m-Y', strtotime($last_claim_status['date_submitted_broker'])),['class'=>'form-control','id'=>'datepicker2','autocomplete'=>'off'])}}
                                    @else
                                        {{Form::text('broker',null,['class'=>'form-control','id'=>'datepicker2','autocomplete'=>'off'])}}
                                    @endif


                                  </div>
                                  <div class="form-group wrapper date_div">
                                    {{Form::label('Settlement Date')}}
                                    @if(!empty($last_claim_status['settlement_date']))
                                        {{Form::text('settlement_date',date('d-m-Y', strtotime($last_claim_status['settlement_date'])),['class'=>'form-control','id'=>'datepicker3','autocomplete'=>'off'])}}
                                    @else
                                    {{Form::text('settlement_date',null,['class'=>'form-control','id'=>'datepicker3','autocomplete'=>'off'])}}
                                    @endif

                                  </div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="edit-claim-Modal2" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Policy Info</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('update_policy_info'), 'method' => 'post','name' => 'update_policy_info','files' => true))}}
                                  <div class="form-group">
                                    {{Form::label('Policy No.')}}
                                    {{Form::text('policy_no',$claim_policy_data['policy_number'],['class'=>'form-control'])}}
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Insurer')}}
                                    {{Form::text('Insurer',$get_insurer->getinsurer->name,['class'=>'form-control','readonly'=>'true'])}}
                                  </div>
                                  {{ Form::hidden('clamin_id',$claim_data['claims_id']) }}
                                  {{ Form::hidden('policy_id',$claim_policy_data['policy_id']) }}

                                  <div class="form-group">
                                    {{Form::label('Product')}}
                                    {{Form::text('Product',$get_insurer->getsubPolicy->name,['class'=>'form-control','readonly'=>'true'])}}
                                  </div>

                                  <div class="form-group wrapper date_div">
                                    {{Form::label('Start date')}}
                                    {{Form::text('datepicker',date('d-m-Y', strtotime($claim_policy_data['start_date'])),['class'=>'form-control','readonly'=>'true','autocomplete'=>'off'])}}
                                  </div>
                                  <div class="form-group wrapper date_div">
                                    {{Form::label('End Date')}}

                                    {{Form::text('end_date',$claim_policy_data['expiry_date']!=''?date('d-m-Y', strtotime($claim_policy_data['expiry_date'])):'',['class'=>'form-control','id'=>'datepicker5','autocomplete'=>'off'])}}
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Insured Name')}}
                                    {{Form::text('insured',$claim_policy_data['prospect_name'],['class'=>'form-control'])}}
                                  </div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="edit-claim-Modal3" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Loss Information</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('update_Claim_Loss'), 'method' => 'post','name' => 'update_Claim_Loss','files' => true))}}
                                  <div class="form-group">
                                    {{Form::label('Loss Location')}}
                                    @if(!empty($data['loss']['loss_location']))
                                        {{Form::text('loss_location',$data['loss']['loss_location'],['class'=>'form-control'])}}
                                    @else
                                        {{Form::text('loss_location',null,['class'=>'form-control'])}}
                                    @endif

                                  </div>
                                  {{ Form::hidden('clamin_id',$claim_data['claims_id']) }}
                                    @if(!empty($data['loss']['loss_id']))
                                        {{ Form::hidden('loss_id',$data['loss']['loss_id']) }}
                                    @else

                                        <input type="hidden" name="loss_id">
                                    @endif

                                  <div class="form-group">
                                    {{Form::label('Description')}}
                                    @if(!empty($data['loss']['loss_description']))
                                        {{Form::textarea('description',$data['loss']['loss_description'],['class'=>'form-control','rows'=>'3'])}}
                                    @else

                                            {{Form::textarea('description',null,['class'=>'form-control','rows'=>'3'])}}
                                    @endif

                                  </div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="document_div">
                      <div class="dis-flex heading_bod">
                        <div class="doc_table_title">
                          <h5> Document From Customer</h5>
                        </div>
                        <div>
                          <button type="button" class="popup_btn" data-toggle="modal" data-target="#policy-doc-Modal"><i
                              class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="view_claim_table1">
                          <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>File</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Added</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($documents_customer)

                            @foreach ($documents_customer as $key =>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->document_name }}</td>
                                <td>{{$item->comments }}</td>
                                @if( $item->status == '1' )

                                    <td>Claim Initiated</td>

                                @elseif($item->status == '2' )

                                    <td>Documents Received</td>
                                @elseif($item->status == '3' )

                                    <td>Sent to Processor</td>
                                @elseif($item->status == '4' )

                                    <td>Queried</td>
                                @elseif($item->status == '5' )

                                    <td>Query Response Sent</td>
                                @elseif($item->status == '6' )
                                    <td>Settled</td>

                                @endif
                                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <button type="button" class="popup_btn" id="{{$item->id }}" onclick="edit_claim_customer_documents(this.id)">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>

                                    </button>

                                    <button type="button" class="popup_btn" data-href="{{ route('policy_documnets_delete',$item->document_id) }}" data-toggle="modal" data-target="#confirm-delete">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>

                                </td>
                              </tr>

                            @endforeach
                          @else



                        <tr>
                          <td>No Documents</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal fade" id="policy-doc-Modal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Document</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('create_document_claim_customer'), 'method' => 'post','name' => 'create_document_customer','files' => true))}}
                                <div class="file-upload-div"> <span id="filename">Select your file</span>
                                    <label for="customer-file-upload">Browse
                                      <input type="file" id="customer-file-upload" name="browse" class="file-upload">
                                    </label>
                                  </div>

                                  <div class="form-group">
                                    {{Form::label('Status')}}
                                    {{ Form::select('status', array('1' => 'Claim Initiated',
                                                                      '2' => 'Documents Received',
                                                                      '3'=>'Sent to Processor',
                                                                      '4'=>'Queried',
                                                                      '5'=>'Query Response Sent',
                                                                      '6'=>'Settled'), null, ['class'=>'form-control'])}}
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Comments')}}
                                    {{Form::textarea('message',null,['class'=>'form-control'.( $errors->has('message') ? ' is-invalid' : '' ),'class'=>'form-control','rows'=>'3'])}}
                                    @error('message')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror


                                  </div>
                                  {{ Form::hidden('clamin_id',$claim_data['claims_id']) }}
                                  <div class="form-group">
                                    <label for="">Policy No.</label>
                                    <input type="text" class="form-control"  name="policy_no" readonly value="{{ $claim_policy_data['policy_number'] }}">
                                  </div>
                                  <div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                  </div>
                                  {{Form::close()}}

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="edit-policy-doc-Modal" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Document</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  {{Form::open(array('url' => route('update_document_claim_customer'), 'method' => 'post','name' => 'update_document_customer','files' => true))}}
                                  <div class="file-upload-div"> <span id="filename">Select your file</span>
                                      <label for="edit-customer-file-upload">Browse
                                        <input type="file" id="edit-customer-file-upload" name="document-file" class="file-upload">
                                      </label>
                                    </div>

                                    <div class="form-group">
                                      {{Form::label('Status')}}
                                      {{ Form::select('status', array('1' => 'Claim Initiated',
                                                                        '2' => 'Documents Received',
                                                                        '3'=>'Sent to Processor',
                                                                        '4'=>'Queried',
                                                                        '5'=>'Query Response Sent',
                                                                        '6'=>'Settled'), null, ['class'=>'form-control'])}}
                                    </div>
                                    <div class="form-group">
                                      {{Form::label('Comments')}}
                                      {{Form::textarea('message',null,['class'=>'form-control'.( $errors->has('message') ? ' is-invalid' : '' ),'class'=>'form-control','rows'=>'3'])}}
                                      @error('message')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror


                                    </div>
                                    {{ Form::hidden('clamin_id',$claim_data['claims_id']) }}
                                    {{ Form::hidden('documents_id',"") }}
                                    <div class="form-group">
                                      <label for="">Policy No.</label>
                                      <input type="text" class="form-control"  name="policy_no" readonly value="{{ $claim_policy_data['policy_number'] }}">
                                    </div>
                                    <div>
                                      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                      <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                    {{Form::close()}}

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit-claim-doc" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Document</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  {{Form::open(array('url' => route('updateDocumentClaim'), 'method' => 'post','name' => 'updateDocumentClaim','files' => true))}}
                                  <div class="file-upload-div"> <span id="filename">Select your file</span>
                                      <label for="edit-claim-file-upload">Browse
                                        <input type="file" id="edit-claim-file-upload" name="document-file" class="file-upload">
                                      </label>
                                    </div>

                                    <div class="form-group">
                                      {{Form::label('Status')}}
                                      {{ Form::select('status', array('1' => 'Claim Initiated',
                                                                        '2' => 'Documents Received',
                                                                        '3'=>'Sent to Processor',
                                                                        '4'=>'Queried',
                                                                        '5'=>'Query Response Sent',
                                                                        '6'=>'Settled'), null, ['class'=>'form-control'])}}
                                    </div>
                                    <div class="form-group">
                                      {{Form::label('Comments')}}
                                      {{Form::textarea('message',null,['class'=>'form-control'.( $errors->has('message') ? ' is-invalid' : '' ),'class'=>'form-control','rows'=>'3'])}}
                                      @error('message')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror


                                    </div>
                                    {{ Form::hidden('clamin_id',$claim_data['claims_id']) }}
                                    {{ Form::hidden('documents_id',"") }}
                                    <div class="form-group">
                                      <label for="">Policy No.</label>
                                      <input type="text" class="form-control"  name="policy_no" readonly value="{{ $claim_policy_data['policy_number'] }}">
                                    </div>
                                    <div>
                                      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                      <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                    {{Form::close()}}

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="document_div">
                      <div class="dis-flex heading_bod">
                        <div class="doc_table_title">
                          <h5>Document From Us</h5>
                        </div>
                        <div>
                          <button type="button" class="popup_btn" data-toggle="modal"
                            data-target="#customer-doc-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="view_claim_table2">
                          <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>File</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Added</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($claim_documents)

                            @foreach ($claim_documents as $key =>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->document_name }}</td>
                                <td>{{$item->comments }}</td>
                                @if( $item->status == '1' )

                                    <td>Claim Initiated</td>

                                @elseif($item->status == '2' )

                                    <td>Documents Received</td>
                                @elseif($item->status == '3' )

                                    <td>Sent to Processor</td>
                                @elseif($item->status == '4' )

                                    <td>Queried</td>
                                @elseif($item->status == '5' )

                                    <td>Query Response Sent</td>
                                @elseif($item->status == '6' )
                                    <td>Settled</td>

                                @endif
                                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <button type="button" class="popup_btn" id="{{$item->id }}" onclick="edit_claim_documents(this.id)">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>

                                    </button>

                                    <button type="button" class="popup_btn" data-href="{{ route('policy_documnets_delete',$item->document_id) }}" data-toggle="modal" data-target="#confirm-delete">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>

                                </td>
                              </tr>

                            @endforeach
                          @else



                        <tr>
                          <td>No Documents</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal fade" id="customer-doc-modal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Document</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('create_document_claim'), 'method' => 'post','name' => 'create_document_claim','files' => true))}}
                                <div class="file-upload-div"> <span id="filename">Select your file</span>
                                    <label for="claim-doc-file-upload">Browse
                                      <input type="file" id="claim-doc-file-upload" name="browse" class="file-upload">
                                    </label>
                                  </div>

                                  <div class="form-group">
                                    {{Form::label('Status')}}
                                    {{ Form::select('status', array('1' => 'Claim Initiated',
                                                                      '2' => 'Documents Received',
                                                                      '3'=>'Sent to Processor',
                                                                      '4'=>'Queried',
                                                                      '5'=>'Query Response Sent',
                                                                      '6'=>'Settled'), null, ['class'=>'form-control'])}}
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Comments')}}
                                    {{Form::textarea('message',null,['class'=>'form-control'.( $errors->has('message') ? ' is-invalid' : '' ),'class'=>'form-control','rows'=>'3'])}}
                                    @error('message')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror


                                  </div>
                                  {{ Form::hidden('clamin_id',$claim_data['claims_id']) }}
                                  <div class="form-group">
                                    <label for="">Policy No.</label>
                                    <input type="text" class="form-control"  name="policy_no" readonly value="{{ $claim_policy_data['policy_number'] }}">
                                  </div>
                                  <div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                  </div>
                                  {{Form::close()}}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mt_5">
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered">
                        <thead>
                          <tr>
                            <th>Amounts</th>
                            <th></th>
                            <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#amount-editModal"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Settled Amount:</th>
                                      <td></td>
                                      <td>{{ ($claim_data['settled_amount']) ? $claim_data['settled_amount'] : "0" }} EUR</td>
                                    </tr>
                                    <tr>
                                      <th>Outstanding Reserve:</th>
                                      <td></td>
                                      <td>{{ ($claim_data['reserve']) ? $claim_data['reserve'] : "0" }} EUR</td>
                                    </tr>
                                    <tr>
                                      <th>Deduction:</th>
                                      <td></td>
                                      <td>{{ ($claim_data['deduction']) ? $claim_data['deduction'] : "0" }} EUR</td>
                                    </tr>
                                    <tr>
                                      <th>Final Amount:</th>
                                      <td></td>
                                      <td>{{ ($claim_data['final_amount']) ? $claim_data['final_amount'] : "0" }} EUR</td>
                                    </tr>
                                    <tr>
                                      <th>Our Part:</th>
                                      <td></td>
                                      <td>{{ ($claim_data['our_part']) ? $claim_data['our_part'] : "0" }} EUR</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="document_div">
                      <div class="dis-flex heading_bod">
                        <div class="doc_table_title">
                          <h5>Tasks</h5>
                        </div>
                        <div class="text-right">
                          <button type="button" class="popup_btn" data-toggle="modal"
                            data-target=".bd-example-modal-lg"><i class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="view_claim_table3">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th >Person</th>
                                    <th >Task</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (count($get_task_detalis)>0)


                                @foreach ($get_task_detalis as $key =>$item)
                                <tr>
                                    <td>{{ date('d/m/Y',strtotime($item->date)) }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{$item->subject }}</td>
                                    <td>{{$item->description }}</td>
                                    <td>{{($item->is_complete=='0')?'Incomplete':'Complete' }}</td>
                                    <td>
                                        <button type="button" class="popup_btn" id="{{$item->id }}" onclick="edittask(this.id)">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>

                                        </button>

                                        <button type="button" class="popup_btn" data-href="{{ route('customer_task_delete',$item->id  ) }}" data-toggle="modal" data-target="#confirm-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>

                                    </td>
                                </tr>
                                @endforeach

                            @else

                            <tr>
                              <td colspan="6">No tasks were found</td>

                            </tr>
                            @endif

                              </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade bd-example-modal-lg task-modal" tabindex="-1" role="dialog"
                  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add A Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12">
                                {{Form::open(array('url' => route('create_task_claim'), 'method' => 'post','name' => 'add_task','files' => true))}}
                                <div class="form-group">
                                  <label for="" for="inputPassword"
                                    class="select_lebel col-sm-2 col-form-label">Responsible</label>
                                  <select class="form-control" name="responsible">
                                    <option value="">--add to myself--</option>
                                    @foreach ($get_all_user as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                  </select>
                                  @error('responsible')
                                            <span class="color_red" role="alert">
                                            <h5 class="message_text">*{{ $message }}</h5>
                                            </span>
                                    @enderror
                                </div>
                                {{ Form::hidden('clamim_id',$claim_data['claims_id'], array('id' => "claim_id")) }}
                                {{ Form::hidden('customer_id',$get_customer['user_id'], array('id' => "customer_id")) }}


                                <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-12 col-form-label">Customer <span
                                      class="form-control-plaintext">{{ $get_customer['name'] }}</span>
                                  </label>
                                </div>
                                <div class="form-group wrapper date_div">
                                  <label for="datepicker">Date
                                    <input class="form-control" type="text" id="datepicker" autocomplete="off"
                                      name="datepicker">
                                  </label>
                                    @error('datepicker')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="">Subject</label>
                                  <input type="text" class="form-control"  name="subject">
                                    @error('subject')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Description</label>
                                  <textarea class="form-control" name="message" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                                    @error('message')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-5">
                                    {{ Form::submit('Add Task',['class'=>'btn btn-primary']) }}
                                    {{Form::reset('Cancel',['class'=>'btn btn-light','data-dismiss'=>'modal','aria-label'=>'Close'])}}
                                </div>
                                {{Form::close()}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="edittaskModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Edit A Task</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                              aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('update_task_claim'), 'method' => 'post','name' => 'upadte_task','files' => true))}}
                                  <div class="form-group">
                                    {{Form::label('Responsible',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}

                                      <select class="form-control" name="edit_Responsible">
                                          <option value="">--add to myself--</option>
                                          @foreach ($get_all_user as $key =>$item)

                                          <option value="{{ $item->id }}">{{ $item->name }}</option>

                                          @endforeach
                                      </select>

                                      @error('edit_Responsible')
                                              <span class="color_red" role="alert">
                                              <h5 class="message_text">*{{ $message }}</h5>
                                              </span>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Status',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}

                                      <select class="form-control" name="status">
                                          <option value="">--Select Status--</option>
                                          <option value="0">Incomplete</option>
                                          <option value="1">complete</option>

                                      </select>

                                      @error('status')
                                              <span class="color_red" role="alert">
                                              <h5 class="message_text">*{{ $message }}</h5>
                                              </span>
                                      @enderror
                                  </div>
                                  {{ Form::hidden('claim_id',$claim_data['claims_id'], array('id' => "")) }}
                                  {{ Form::hidden('customer_id',$get_customer['user_id'], array('id' => "customer_id")) }}
                                  {{ Form::hidden('task_id', '', array('id' => "task_id")) }}


                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Customer <span
                                        class="form-control-plaintext">{{ $get_customer['name'] }}</span>
                                    </label>
                                  </div>
                                  <div class="form-group wrapper date_div">
                                    <label for="datepicker">Date
                                      <input class="form-control" type="text" id="datepicker-task" autocomplete="off"
                                        name="edit_datepicker" >
                                    </label>
                                      @error('edit_datepicker')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                </div>

                                  <div class="form-group">
                                    {{Form::label('Subject')}}
                                    {{Form::text('edit_subject',null,['class'=>'form-control'])}}
                                      @error('edit_subject')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Description')}}
                                    {{Form::textarea('edit_task_message',null,['class'=>'form-control','id'=>'exampleFormControlTextarea1','rows'=>'3'])}}
                                      @error('edit_task_message')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                  </div>

                                  <div class="mt-5">
                                      {{ Form::submit('Add Task',['class'=>'btn btn-primary']) }}
                                      {{Form::reset('Cancel',['class'=>'btn btn-light','data-dismiss'=>'modal','aria-label'=>'Close'])}}
                                  </div>
                                  {{Form::close()}}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="modal fade" id="amount-editModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Amount</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">

                            {{Form::open(array('url' => route('update_amount'), 'method' => 'post','name' => 'update_amount','files' => true))}}
                              <div class="form-group">
                                {{Form::label('Settled Amount')}}
                                {{Form::text('amount', ($claim_data['settled_amount']) ? $claim_data['settled_amount'] : "0" ,['class'=>'form-control'])}}
                              </div>
                              <div class="form-group">
                                {{Form::label('Outstanding Reserve')}}
                                {{Form::text('reserve', ($claim_data['reserve']) ? $claim_data['reserve'] : "0" ,['class'=>'form-control'])}}
                              </div>
                              <div class="form-group">
                                {{Form::label('Deduction')}}
                                {{Form::text('deduction',($claim_data['deduction']) ? $claim_data['deduction'] : "0",['class'=>'form-control'])}}
                              </div>
                              <div class="form-group">
                                {{Form::label('Final Amount:')}}
                                {{Form::text('final_amount', ($claim_data['final_amount']) ? $claim_data['final_amount'] : "0" ,['class'=>'form-control'])}}
                              </div>
                              {{ Form::hidden('claim_id',$claim_data['claims_id'])}}
                              <div class="form-group">
                                {{Form::label('Our Part:')}}
                                {{Form::text('part_amount', ($claim_data['our_part']) ? $claim_data['our_part'] : "0" ,['class'=>'form-control'],['class'=>'form-control'])}}
                              </div>
                              {{Form::submit('Add',['class'=>'btn btn-primary'])}}
                            {{ Form::close() }}
                          </div>
                        </div>
                      </div>
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

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#file-upload').change(function () {
      var filepath = this.value;
      var m = filepath.match(/([^\/\\]+)$/);
      var filename = m[1];
      $('#filename').html(filename);

    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker2").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
      $("#datepicker-task").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker3").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });

    function edit_claim_customer_documents(id){

        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('edit_document_claim_customer') }}",
            data:{data:getid},
            success:function(data){

                console.log(data);



                $('#edit-policy-doc-Modal').modal('show');
                $("#edit-policy-doc-Modal input[name='documents_id']").val('');
                $("#edit-policy-doc-Modal input[name='documents_id']").val(data.id);
                $('#edit-policy-doc-Modal  select[name="status"] option[value="'+data.status+'"]').attr('selected','selected');
                $("#edit-policy-doc-Modal textarea[name='message']").val(data.comments);

            }
        });
    }

    function edit_claim_documents(id){

        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('edit_document_claim') }}",
            data:{data:getid},
            success:function(data){





                $('#edit-claim-doc').modal('show');
                $("#edit-claim-doc input[name='documents_id']").val('');
                $("#edit-claim-doc input[name='documents_id']").val(data.id);
                $('#edit-claim-doc  select[name="status"] option[value="'+data.status+'"]').attr('selected','selected');
                $("#edit-claim-doc textarea[name='message']").val(data.comments);

            }
        });
    }

    function edittask(id){
        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('customer_task_edit') }}",
            data:{data:getid},
            success:function(data){
              $('#edittaskModal').modal('show');


                 $('#task_id').val(" ");
                 $('#task_id').val(data.id);
                 $("#edittaskModal input[name='edit_subject']").val(data.subject);
                 $("#edittaskModal textarea[name='edit_task_message']").val(data.description);
                 $('#edittaskModal  select[name="edit_Responsible"] option[value="'+data.user.id+'"]').attr('selected','selected');
                 $('#edittaskModal  select[name="status"] option[value="'+data.is_complete+'"]').attr('selected','selected');
                 $("#edittaskModal #datepicker-task").val(dateformat(data.date));

            }
         });

    }

    function dateformat(date){
        var new_date=date.split('-');
        var year=new_date[0];
        var month=new_date[1];
        var dat=new_date[2];
        return month+'/'+dat+'/'+year;
    }





  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker1").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker4").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker5").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>
  <script>
    $('#file-upload').click(function (){
      $(this).attr('type', 'file');
    });

    $(function() {


        $("form[name='create_document_customer']").validate({
            rules: {
              browse: {
                  required: true
                },
              message: "required",
              status:"required",            },
            messages: {
              message: "Please Enter your Comments",
              document_file: "Please Select Your File",
              status: "Please Enter your status"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });
        $("form[name='update_document_customer']").validate({
            rules: {

                status: "required",
                message:"required",
            },
            messages: {
              message: "Please Enter your Comments",
              status: "Please Enter your status"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });

        $("form[name='create_document_claim']").validate({
            rules: {
              browse: {
                  required: true
                },
              message: "required",
              status:"required",            },
            messages: {
              message: "Please Enter your Comments",
              document_file: "Please Select Your File",
              status: "Please Enter your status"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });

        $("form[name='updateDocumentClaim']").validate({
            rules: {

                status: "required",
                message:"required",
            },
            messages: {
              message: "Please Enter your Comments",
              status: "Please Enter your status"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });


        $("form[name='add_task']").validate({
            rules: {
                responsible: "required",
                datepicker: "required",
                subject: "required",
                message: "required"


            },
            messages: {
                responsible: "Please Select Responsible",
                datepicker: "Please Select your Date",
                subject: "Please Enter your Subject",
                message: "Please Enter your Description"
            },
            submitHandler: function(form) {
              form.submit();
            }
        });
        $("form[name='upadte_task']").validate({
            rules: {
                edit_Responsible: "required",
                status: "required",
                edit_datepicker: "required",
                edit_subject: "required",
                edit_task_message: "required"


            },
            messages: {
                edit_Responsible: "Please Select Responsible",
                status: "Please Select your Status",
                edit_datepicker: "Please Select your Date",
                edit_subject: "Please Enter your Subject",
                edit_task_message: "Please Enter your Description"
            },
            submitHandler: function(form) {
              form.submit();
            }
        });

        $("form[name='update_Claim_Loss']").validate({
            rules: {
                loss_location: "required",
                description: "required"



            },
            messages: {
                loss_location: "Please Select Location",
                description: "Please Select Description"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });


        $("form[name='update_policy_info']").validate({
            rules: {
                policy_no: "required",
                end_date: "required",
                insured: "required"



            },
            messages: {
                policy_no: "Please Select Policy No.",
                end_date: "Please Select End Date",
                insured: "Please Select Insured Name"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });


        $("form[name='add_claim_status']").validate({
            rules: {
                status: "required",
                datepicker: "required",
                broker: "required",
                settlement_date: "required"



            },
            messages: {
                status: "Please Select Status",
                datepicker: "Please Select Incident/Loss Date",
                broker: "Please Select Broker",
                settlement_date: "Please Select Settlement Date"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });

        $("form[name='update_amount']").validate({
            rules: {
                amount: {
                    required: true,
                    number: true
                  },
                reserve: {
                    required: true,
                    number: true
                  },
                deduction: {
                    required: true,
                    number: true
                  },
                final_amount: {
                    required: true,
                    number: true
                  },
                part_amount: {
                    required: true,
                    number: true
                  }



            },
            messages: {
                amount: "Please Select Amount",
                reserve: "Please Select Reserve",
                deduction: "Please Select Deduction",
                final_amount: "Please Select Final_amount",
                part_amount: "Please Select Our Part"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });

















      });
  </script>
@endsection
