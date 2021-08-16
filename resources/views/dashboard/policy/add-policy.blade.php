@extends('layouts.master')
@section('title','MySIg by Fidentia |Policy Info')
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Policy Info
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </l>
          <li class="active breadcrumb_listItem">Policy Info</li>
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
                          @foreach ($policy_status as $item)
                          <div class="content2">
                                @if( $item->status == '1' )

                                <div class="title">Requested</div>

                                @elseif($item->status == '2' )

                                <div class="title">Not Issued</div>
                                @elseif($item->status == '3' )

                                <div class="title">Issued</div>
                                @elseif($item->status == '4' )

                                <div class="title">Sent</div>
                                @elseif($item->status == '5' )

                                <div class="title">Delivered</div>
                                @endif

                            <div class="description">{{ date('d-m-Y', strtotime($item->created_at))}}</div>

                          </div>
                          @endforeach
                          @php 
                          
                          $count = \App\Models\TransactionPayment::where('policy_id', $policy_data['policy_id'])->count();
                          $CodPaidCount = \App\Models\CodTransaction::where('policy_id', $policy_data['policy_id'])->count();
                        
                          if($count >= 1 && $CodPaidCount < 1):
                          @endphp
                         @if($getPaymentMethod['payment_method']=='Cod')
                          <a href="#" class="cod-btn" data-toggle="modal" data-target="#myModal"> <i class="fa fa-money" aria-hidden="true"></i>
                            <span>COD Payment</span>
                          </a>
                          @endif

                          @php 
                          endif;
                          @endphp

                         <!-- <div class="content2">
                          <div class="title">Turn Over Time</div>
                          <div class="description">4 days</div>
                        </div>
                        <div class="content2">
                          <div class="title">Not Issued</div>
                          <div class="description">on 04-04-2020</div>
                        </div>
                        <div class="content2">
                          <div class="title">Issued</div>
                          <div class="description">on 04-04-2020</div>
                        </div>
                        <div class="content2">
                          <div class="title">Sent</div>
                          <div class="description">on 06-04-2020</div>
                        </div>
                        <div class="content2">
                          <div class="title">Delivered</div>
                          <div class="description">on 07-04-2020</div>
                        </div>  -->
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
                            <th>Policy Info</th>
                            <th></th>
                            {{-- <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#edit-policy-Modal1"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>customer:</th>
                                      <td></td>
                                      <td><a href="#">{{ $get_customer['name'] }}
                                          </a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Coverage:</th>
                                      <td ></td>
                                      <td>{{$get_policy_type}}/{{$get_sub_type}}</td>
                                    </tr>
                                    <tr>
                                      <th >Objectss:</th>
                                      <td ></td>
                                      <td>{{ $object }}</td>
                                    </tr>
                                    <tr>
                                      <th>Variant:</th>
                                      <td ></td>
                                      <td >{{ $get_varient }}</td>
                                    </tr>
                                    <tr>
                                      <th>Vin No:</th>
                                      <td ></td>
                                      <td >{{ $car_vin_number }}</td>
                                    </tr>
                                    <tr>
                                      <th>Insurer:</th>
                                      <td ></td>
                                      <td>{{ $data['getInsurer']->insurer->name }}</td>
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
                            <th>Policy Info</th>
                            <th></th>
                            <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#edit-policy-Modal2"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_12" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Policy No.:</th>
                                      <td></td>
                                      <td >
                                      @if(!empty($policy_data['policy_number']))
                                        {{ $policy_data['policy_number']}}
                                      @else
                                        PL100{{ $policy_data['id']}}
                                      @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>policy Status</th>
                                      <td></td>

                                        @if(!empty($last_policy_status['status']))
                                                    @if( $last_policy_status['status'] == '1' )

                                                        <td>Requested</td>

                                                    @elseif($last_policy_status['status'] == '2' )

                                                        <td>Not Issued</td>
                                                    @elseif($last_policy_status['status'] == '3' )

                                                        <td>Issued</td>
                                                    @elseif($last_policy_status['status'] == '4' )

                                                        <td>Sent</td>
                                                    @elseif($last_policy_status['status'] == '5' )

                                                        <td>Delivered</td>
                                                    @endif
                                        @else

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
                    <div class="modal fade" id="edit-policy-Modal1" role="dialog">
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
                                <form action="" method="post">
                                  <div class="form-group">
                                    <label for="">Customer</label>
                                    <input type="text" class="form-control"  name="customer">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Coverage</label>
                                    <select id="size_select" class="form-control" name="coverage">
                                      <option value="option1">Motor Insurance-TPL</option>
                                      <option value="option2">Motor Insurance-Green Card</option>
                                      <option value="option3">Motor Insurance-Full Casco</option>
                                      <option value="option4">Home Insurance</option>
                                      <option value="option5">Travel Insurance</option>
                                      <option value="option5">Travel Insurance-Travel outside state</option>
                                      <option value="option5">Travel Insurance-Student outside state</option>
                                      <option value="option5">Home Insurance-Apartment</option>
                                      <option value="option5">Home Insurance-Villa</option>
                                      </select>
                                    </div>
                                    <!--Size dropdown content-->
                                    <div class="form-group">
                                      <label for="">Object</label>
                                      <input type="text" class="form-control"  name="object">
                                    </div>
                                    <div class="form-group">
                                        <label for="">variants</label>
                                        <select class="form-control"  name="variant">
                                          <option>variants I</option>
                                          <option>variants II</option>
                                          <option>variants III</option>
                                          <option>variants IV</option>
                                          <option>variants V</option>
                                        </select>
                                    </div>

                                 <div class="form-group">
                                    <label for="" for="inputPassword"
                                      class="select_lebel col-sm-2 col-form-label">Insurer</label>
                                    <select class="form-control"  name="insurer">
                                      <option>Sigma</option>
                                      <option>Sigal</option>
                                      <option>Intersig</option>
                                      <option>Insig</option>
                                      <option>Ansig</option>
                                      <option>Eurosig</option>
                                      <option>Albsig</option>
                                      <option>Atlantik</option>
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="edit-policy-Modal2" role="dialog">
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
                                {{Form::open(array('url' => route('add_policy_status'), 'method' => 'post','name' => 'add_policy_status','files' => true))}}
                                  <div class="form-group">
                                    <label for="">Policy No.</label>
                                    @if(!empty($policy_data['policy_number']))
                                      {{Form::text('policy_no',$policy_data['policy_number'],['class'=>'form-control'])}}
                                    @else
                                      {{Form::text('policy_no',"PL100".$policy_data['id'],['class'=>'form-control'])}}
                                    @endif
                                    <!-- <input type="text" class="form-control"  name="policy_no"  value="{{ $policy_data['policy_number']}}"> -->
                                    {{ Form::hidden('policy_id',$policy_data['policy_id']) }}
                                  </div>
                                  <div class="form-group">
                                    <label for="">Policy Status</label>
                                    @if(!empty($last_policy_status['status']))
                                        <select class="form-control" name="status">
                                        <option value="1" {{ ( $last_policy_status['status'] == '1') ? 'selected' : '' }}>Requested</option>
                                        <option value="2" {{ ( $last_policy_status['status'] == '2') ? 'selected' : '' }}>Not Issued</option>
                                        <option value="3" {{ ( $last_policy_status['status'] == '3') ? 'selected' : '' }}>Issued</option>
                                        <option value="4" {{ ( $last_policy_status['status'] == '4') ? 'selected' : '' }}>Sent</option>
                                        <option value="5" {{ ( $last_policy_status['status'] == '5') ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                    @else
                                    <select class="form-control" name="status">
                                        <option value="1" >Requested</option>
                                        <option value="2" >Not Issued</option>
                                        <option value="3" >Issued</option>
                                        <option value="4" >Sent</option>
                                        <option value="5" >Delivered</option>
                                    </select>
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
                          <h5>Policy Document</h5>
                        </div>
                        <div class="text-right">
                          <button type="button" class="popup_btn" data-toggle="modal" data-target="#policy-doc-Modal"><i
                              class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped sort" id="add_policy_documenttable1">
                          <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>File</th>
                                <th >Comment</th>
                                <th>Added</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($get_documents)
                            @foreach ($get_documents as $key =>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->document_name }}</td>
                                <td>{{$item->comments }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <button type="button" class="popup_btn" id="{{$item->id }}" onclick="edit_documents(this.id)">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>

                                    </button>

                                    <button type="button" class="popup_btn" data-href="{{ route('policy_documnets_delete',$item->document_id  ) }}" data-toggle="modal" data-target="#confirm-delete">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>

                                    <a href="{{ asset('storage/policy-documents') }}/<?php echo $item->file_name; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                            <h4 class="modal-title">Add Policy Document</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('create_policy_document'), 'method' => 'post','name' => 'create_policy_document','files' => true))}}
                                  <div class="file-upload-div"> <span id="filename">Select your file</span>
                                    <label for="file-upload">Browse
                                      <input type="file" id="file-upload" name="browse">
                                    </label>
                                  </div>
                                    @error('browse')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                  <div class="form-group">
                                    <label for="">Policy No.</label>
                                    @if(!empty($policy_data['policy_number']))
                                      {{Form::text('policy_no',$policy_data['policy_number'],['class'=>'form-control'])}}
                                    @else
                                      {{Form::text('policy_no',"PL1000".$policy_data['id'],['class'=>'form-control'])}}
                                    @endif
                                    <!-- <input type="text" class="form-control"  name="policy_no"  value="{{ $policy_data->policy_number}}"> -->
                                    {{ Form::hidden('policy_id',$policy_data['policy_id']) }}

                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Comments')}}
                                    {{Form::textarea('message',null,['class'=>'form-control','rows'=>'3'])}}
                                      @error('message')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                    <label class="hover">
                                      <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><div class="icheckbox_flat-green hover" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                      Add Notification
                                    </label>
                                  </div>
                                  <div>
                                    <button type="submit" class="btn btn-primary">Add Policy</button>
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
                              <h4 class="modal-title">Edit Policy Document</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  {{Form::open(array('url' => route('update_policy_document'), 'method' => 'post','name' => 'edit_policy_document','files' => true))}}
                                  <div class="file-upload-div"> <span id="add-filename" class="filename">Select your file</span>
                                    <label for="add-file-upload">Browse
                                      {{ Form::file('document-file', $attributes = array('id'=>'add-file-upload','class'=>'file-upload'))}}


                                    </label>

                                  </div>
                                      @error('edit_browse')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                    <div class="form-group">
                                      <label for="">Policy No.</label>
                                      <input type="text" class="form-control"  name="policy_no"  value="{{ $policy_data['policy_number']}}">
                                      {{ Form::hidden('documents_id',"") }}
                                      {{ Form::hidden('policy_id',$policy_data['policy_id']) }}

                                    </div>
                                    <div class="form-group">
                                      {{Form::label('Comments')}}
                                      {{Form::textarea('message',null,['class'=>'form-control','rows'=>'3'])}}
                                        @error('message')
                                            <span class="color_red" role="alert">
                                            <h5 class="message_text">*{{ $message }}</h5>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                      <label class="hover">
                                        <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><div class="icheckbox_flat-green hover" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                        Add Notification
                                      </label>
                                    </div>
                                    <div>
                                      <button type="submit" class="btn btn-primary">Add Policy</button>
                                      <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                  {{Form::close()}}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit-customer-doc-Modal" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Customer Document</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  {{Form::open(array('url' => route('update_customer_document'), 'method' => 'post','name' => 'edit_document_customer','files' => true))}}
                                  <div class="file-upload-div"> <span id="add-filename" class="edit-filename">Select your file</span>
                                    <label for="customer-edit-file-upload">Browse
                                      {{ Form::file('document-file', $attributes = array('id'=>'customer-edit-file-upload','class'=>'edit-file-upload'))}}


                                    </label>

                                  </div>
                                      @error('edit_browse')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                    <div class="form-group">
                                      <label for="">Policy No.</label>
                                      <input type="text" class="form-control"  name="policy_no" readonly value="{{ $policy_data['policy_number']}}">
                                      {{ Form::hidden('documents_id',"") }}

                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select class="form-control"  name="status">
                                          <option value="1">Requested</option>
                                          <option value="2">Not Issued</option>
                                          <option value="3">Issued</option>
                                          <option value="4">Sent</option>
                                          <option value="5">Delivered</option>
                                        </select>
                                      </div>
                                    <div class="form-group">
                                      {{Form::label('Comments')}}
                                      {{Form::textarea('message',null,['class'=>'form-control','rows'=>'3'])}}
                                        @error('message')
                                            <span class="color_red" role="alert">
                                            <h5 class="message_text">*{{ $message }}</h5>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                      <label class="hover">
                                        <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><div class="icheckbox_flat-green hover" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                        Add Notification
                                      </label>
                                    </div>
                                    <div>
                                      <button type="submit" class="btn btn-primary">Add Policy</button>
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
                          <h5>Document From Customer</h5>
                        </div>
                        <div>
                          <button type="button" class="popup_btn" data-toggle="modal"
                            data-target="#customer-doc-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="add_policy_documenttable2">
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

                                                <td>Requested</td>

                                            @elseif($item->status == '2' )

                                                <td>Not Issued</td>
                                            @elseif($item->status == '3' )

                                                <td>Issued</td>
                                            @elseif($item->status == '4' )

                                                <td>Sent</td>
                                            @elseif($item->status == '5' )

                                                <td>Delivered</td>
                                            @endif
                                <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <button type="button" class="popup_btn" id="{{$item->id }}" onclick="edit_customer_documents(this.id)">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>

                                    </button>

                                    <button type="button" class="popup_btn" data-href="{{ route('policy_documnets_delete',$item->document_id  ) }}" data-toggle="modal" data-target="#confirm-deleteh">
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
                        
                        @if($get_policy_type=='Car')
                  
                            @if($object_data['document_image_1'])
                              <tr>
                                <td>1</td>
                                <td>{{ @$object_data['document_image_1'] }}</td>
                                <td>Not Available</td>
                                <td>Not Available</td>
                                <td>{{ @date('d-m-Y', strtotime($object_data['created_at']))}}</td>
                                <td><a href="{{ URL::asset('/storage/car/car-image/'.$object_data['document_image_1'])}}" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                              </tr>
                            @endif
                            @if($object_data['document_image_2'])
                              <tr>
                                <td>2</td>
                                <td>{{ @$object_data['document_image_2'] }}</td>
                                <td>Not Available</td>
                                <td>Not Available</td>
                                <td>{{ @date('d-m-Y', strtotime($object_data['created_at']))}}</td>
                                <td><a href="{{ URL::asset('/storage/car/car-image/'.$object_data['document_image_2'])}}" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                              </tr>
                            @endif
                            @if($object_data['document_image_3'])
                              <tr>
                                <td>3</td>
                                <td>{{ @$object_data['document_image_3'] }}</td>
                                <td>Not Available</td>
                                <td>Not Available</td>
                                <td>{{ @date('d-m-Y', strtotime($object_data['created_at']))}}</td>
                                <td><a href="{{ URL::asset('/storage/car/car-image/'.$object_data['document_image_3'])}}" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                              </tr>
                            @endif
                            @if($object_data['document_image_3'])
                              <tr>
                                <td>4</td>
                                <td>{{ @$object_data['document_image_4'] }}</td>
                                <td>Not Available</td>
                                <td>Not Available</td>
                                <td>{{ @date('d-m-Y', strtotime($object_data['created_at']))}}</td>
                                <td><a href="{{ URL::asset('/storage/car/car-image/'.$object_data['document_image_4'])}}" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                              </tr>
                            @endif

                        @elseif($home_documents)
                            <tr>
                              <td>1</td>
                              <td>{{ @$home_documents['inside_image_1'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['inside_image_1']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>

                            <tr>
                              <td>2</td>
                              <td>{{ @$home_documents['inside_image_2'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['inside_image_2']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>

                            <tr>
                              <td>3</td>
                              <td>{{ @$home_documents['inside_image_3'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['inside_image_3']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>

                            <tr>
                              <td>4</td>
                              <td>{{ @$home_documents['outside_image_1'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['outside_image_1']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>

                            <tr>
                              <td>5</td>
                              <td>{{ @$home_documents['outside_image_2'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['outside_image_2']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>

                            <tr>
                              <td>6</td>
                              <td>{{ @$home_documents['outside_image_3'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['outside_image_3']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>

                            <tr>
                              <td>7</td>
                              <td>{{ @$home_documents['image_4'] }}</td>
                              <td>Not Available</td>
                              <td>Not Available</td>
                              <td>{{ @date('d-m-Y', strtotime($home_documents['created_at']))}}</td>
                              <td><a href="{{ asset('storage/home') }}/<?php echo $home_documents['image_4']; ?>" target = "_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
                         @else                          
                        @endif

                          </tbody>
                        </table>
                      </div>
                    </div>
                    @if($getPaypalDetails!=null)

                      <div class="table-responsive">
                        <table class="fold-table table table-bordered">
                          <thead>
                            <tr>
                              <th>Paypal Details</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="">
                              <td class="no-padding pb_12" colspan="10">
                                <div class="history-infoTablDiv table-responsive">
                                  <table class="table_style table_style_info">
                                    <tbody>
                                      <tr>
                                        <th>Payment Id:</th>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($getPaypalDetails['Payment_id'])?$getPaypalDetails['Payment_id']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Paypal Status:</th>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($getPaypalDetails['Paypal_status'])?$getPaypalDetails['Paypal_status']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Payer Id:</th>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($getPaypalDetails['payer_id'])?$getPaypalDetails['payer_id']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Payer Email:</th>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($getPaypalDetails['payer_email'])?$getPaypalDetails['payer_email']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Payer Name:</th>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($getPaypalDetails['payer_name'])?$getPaypalDetails['payer_name']:"" }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    @endif

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
                    <div class="modal fade" id="customer-doc-modal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Customer Document</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('create_document_customer'), 'method' => 'post','name' => 'create_document_customer','files' => true))}}
                                <div class="file-upload-div"> <span id="customer-filename">Select your file</span>
                                    <label for="customer-file-upload">Browse
                                      <input type="file" id="customer-file-upload" name="browse" class="file-upload">
                                    </label>
                                  </div>

                                  <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control"  name="status">
                                      <option value="1">Requested</option>
                                      <option value="2">Not Issued</option>
                                      <option value="3">Issued</option>
                                      <option value="4">Sent</option>
                                      <option value="5">Delivered</option>
                                    </select>
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
                                  {{ Form::hidden('policy_id',$policy_data['policy_id']) }}
                                  <div class="form-group">
                                    <label for="">Policy No.</label>
                                    <input type="text" class="form-control"  name="policy_no" readonly value="{{ $policy_data['policy_number']}}">
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
                      <table class="fold-table table table-bordered dataTable">
                        <thead>
                          <tr>
                            <th>Details</th>
                            <th></th>
                            {{-- <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#details-editModal"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_12" colspan="10">
                              <div class="history-infoTablDiv table-responsive">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Insurerd Name:</th>
                                      <td></td>
                                      <td><a href="#">{{ $data['getInsurer']->insured_name }}/
                                          @if(!empty($second_object))
                                          {{$second_object}}
                                          @endif
                                          </a></td>
                                    </tr>
                                   <tr>
                                      <th>Second Insurer Name:</th>
                                      <td></td>
                                      @if(count($driver_details)>0)
                                        @if (@$driver_details[0]['driver_second_name']==null)
                                        <td>{{  $driver_details[0]['driver_name'] }}</td>
                                        @else
                                        <td>{{$driver_details[0]['driver_second_name']}}</td>
                                        @endif
                                      @else
                                      <td>Not Available</td>
                                      @endif
                                    </tr>
                                    <tr>
                                      <th>offers:</th>
                                      <td></td>
                                      <td>
                                      @if(!empty($offer_details['offer_name']))
                                          {{ $offer_details['offer_name'] }}
                                          @else
                                          --
                                          @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Claiming:</th>
                                      <td></td>
                                      @if ($policy_data['claiming_paid'])
                                        <td>Yes</td>
                                        @else
                                        <td>No</td>
                                        @endif


                                      {{--  <td>{{ $policy_data['claiming_paid'] }}</td>  --}}
                                    </tr>
                                    <tr>
                                      <th>Start Date:</th>
                                      <td></td>
                                      <td>{{ date('d-m-Y', strtotime($policy_data['created_at'] ))}}</td>
                                    </tr>
                                    <tr>
                                      <th>End Date:</th>
                                      <td></td>
                                      <td>{{ date('d-m-Y', strtotime($policy_data['expiry_date'] ))}}</td>
                                    </tr>
                                    <tr>
                                      <th>Validity Period:</th>
                                      <td></td>
                                      <td>{{ $policy_data['validity_period'] }}</td>
                                    </tr>
                                    {{-- <tr>
                                      <th>Additional:</th>
                                      <td></td>
                                      <td></td>
                                    </tr> --}}
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
                            <th>Delivery Info</th>
                            <th></th>
                            <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal"
                                data-target="#delivery-editModal"><i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_12" colspan="10">
                              <div class="history-infoTablDiv table-responsive">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Address:</th>
                                      <td></td>
                                      <td>{{ $policy_data['delivery_address'] }}</td>
                                    </tr>
                                    <tr>
                                      <th>City:</th>
                                      <td></td>
                                      <td>{{ $policy_data['delivery_city'] }}</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Zip:</th>
                                        <td></td>
                                        <td>{{ $get_customer['zip'] }}</td>
                                      </tr> -->
                                    <tr>
                                      <th>Time:</th>
                                      <td></td>
                                      <td>{{ date('H:i:s',strtotime($policy_data['delivery_time'])) }}</td>
                                    </tr>
                                    <tr>
                                      <th>Date:</th>
                                      <td></td>
                                      @if (!empty($policy_data['delivery_date']))
                                      <td>{{  date('d/m/Y',strtotime($policy_data['delivery_date'])) }}</td>
                                      @else
                                      <td>-</td>
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
                    <div class="document_div">
                      <div class="dis-flex heading_bod">
                        <div class="doc_table_title">
                          <h5>Tasks</h5>
                        </div>
                        <div>
                          <button type="button" class="popup_btn" data-toggle="modal"
                            data-target=".bd-example-modal-lg"><i class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="add_policy_documenttable3">
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
                    @if($get_cod_detalis!=null)
                      <div class="table-responsive">
                        <table class="fold-table table table-bordered">
                          <thead>
                            <tr>
                              <th>COD Details</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="">
                              <td class="no-padding pb_12" colspan="10">
                                <div class="history-infoTablDiv table-responsive">
                                  <table class="table_style table_style_info">
                                    <tbody>
                                      <tr>
                                        <th>Amount:</th>
                                        <td></td>
                                        <td></td>
                                        
                                      <td>{{ isset($get_cod_detalis['amount'])?$get_cod_detalis['amount']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Notes:</th>
                                        <td></td>
                                        <td></td>
                                        <td>{{ isset($get_cod_detalis['notes'])?$get_cod_detalis['notes']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Date:</th>
                                        <td></td>
                                        <td></td>
                                        @if(isset($get_cod_detalis['date']))
                                        <td>{{  @date('d/m/Y',strtotime($get_cod_detalis['date'])) }}</td>
                                        @else
                                        <td>Not Available</td>
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
                    @endif
                    @if($getBKTPaymentStatus!=null)
                      <div class="table-responsive">
                        <table class="fold-table table table-bordered">
                          <thead>
                            <tr>
                              <th>BKT VPOS Payment Details</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="">
                              <td class="no-padding pb_12" colspan="10">
                                <div class="history-infoTablDiv table-responsive">
                                  <table class="table_style table_style_info">
                                    <tbody>
                                      <tr>
                                        <th>Amount:</th>
                                        <td></td>
                                        <td></td>
                                        
                                      <td>{{ isset($getBKTPaymentStatus['PurchAmount'])?$getBKTPaymentStatus['PurchAmount']:"" }}</td>
                                      </tr>
                                      <tr>
                                        <th>Currency:</th>
                                        <td></td>
                                        <td></td>
                                        @if(isset($getBKTPaymentStatus['Currency']) && $getBKTPaymentStatus['Currency']=='008')
                                        <td>ALL</td>
                                        @else              
                                        <td>LEK</td>
                                        @endif
                                      </tr>
                                      <tr>
                                        <th>Date:</th>
                                        <td></td>
                                        <td></td>
                                        @if(isset($getBKTPaymentStatus['created_at']))
                                        <td>{{  @date('d/m/Y',strtotime($getBKTPaymentStatus['created_at'])) }}</td>
                                        @else
                                        <td>Not Available</td>
                                        @endif
                                      </tr>
                                      <tr>
                                        <th>Payment Status:</th>
                                        <td></td>
                                        <td></td>
                                        <td style="color: {{ $getBKTPaymentStatus['payment_status'] === 'Failed' ? 'red' :'green'}}">{{ isset($getBKTPaymentStatus['payment_status'])?$getBKTPaymentStatus['payment_status']:"" }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    @elseif($getBKTPaymentStatus==null && ($getPaymentMethod['payment_method']=='Paguaj me kartë' || $getPaymentMethod['payment_method']=='BKT VPOS') )
                    <div class="table-responsive">
                        <table class="fold-table table table-bordered">
                          <thead>
                            <tr>
                              <th>BKT VPOS Payment Details</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="">
                              <td class="no-padding pb_12" colspan="10">
                                <div class="history-infoTablDiv table-responsive">
                                  <table class="table_style table_style_info">
                                    <tbody>
                                      <tr>
                                        <th>Payment Status:</th>
                                        <td></td>
                                        <td></td>
                                        
                                        <td>Payment not done yet</td>
                                      </tr>
                                   
                                    </tbody>
                                  </table>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    @endif
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
                            {{Form::open(array('url' => route('create_task_policy'), 'method' => 'post','name' => 'add_task','files' => true))}}
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
                                {{ Form::hidden('policy_id',$policy_data['policy_id'], array('id' => "policy_id")) }}
                                {{ Form::hidden('customer_id',$get_customer['customer_id'], array('id' => "customer_id")) }}


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
                              {{Form::open(array('url' => route('update_task_policy'), 'method' => 'post','name' => 'upadte_task','files' => true))}}
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
                                {{ Form::hidden('policy_id',$policy_data['policy_id'], array('id' => "policy_id")) }}
                                {{ Form::hidden('customer_id',$get_customer['customer_id'], array('id' => "customer_id")) }}
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
                <div class="modal fade" id="details-editModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Details</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <form action="" method="post">
                              <div class="form-group">
                                <label for=""> Insurer Name</label>
                                <input type="text" class="form-control"  name="ins_name">
                              </div>
                              <div class="form-group">
                                <label for="">Second Insurer Name</label>
                                <input type="text" class="form-control"  name="sec_ins_name">
                              </div>
                              <div class="form-group mt_5">
                                <label for="">Offers</label>
                                <select class="form-control"  name="addon">
                                  <option>offer I</option>
                                  <option>offer II</option>
                                  <option>offer III</option>
                                  <option>offer IV</option>
                                  <option>offer V</option>
                                </select>
                              </div>

                              <div class="form-group mt_5">
                                <label for="">Claiming</label>
                                <select class="form-control"  name="claim">
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                              </div>
                              <div class="form-group wrapper date_div">
                                <label for="datepicker">Start Date
                                  <input class="form-control" type="text" id="datepicker2" autocomplete="off"
                                    name="start_date">
                                </label>
                              </div>
                              <div class="form-group wrapper date_div">
                                <label for="datepicker">End Date
                                  <input class="form-control" type="text" id="datepicker4" autocomplete="off"
                                    name="end_date">
                                </label>
                              </div>
                              <div class="form-group">
                                <label for="">Validity Period</label>
                                <input type="text" class="form-control" name="validity">
                              </div>
                              <div class="form-group">
                                <label for="">Additional</label>
                                <input type="text" class="form-control" name="add">
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="delivery-editModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delivery Info</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            {{Form::open(array('url' => route('update_delivery_info'), 'method' => 'post','name' => 'update_delivery_info','files' => true))}}
                            {{Form::model($policy_data)}}
                              <div class="form-group">
                                <label for="">Address</label>
                                {{Form::text('delivery_address',null,['class'=>'form-control'])}}

                                <!-- <input type="text" class="form-control"  name="address" value="{{ $get_customer['address'] ? $get_customer['address'] : ' ' }}
                                "> -->
                              </div>
                              <div class="form-group">
                                <label for="" for="inputPassword"
                                  class="select_lebel col-sm-2 col-form-label">City</label>
                                  {{Form::text('delivery_city',null,['class'=>'form-control'])}}
                                  <!-- <input type="text" class="form-control"  name="city" value="{{ $get_customer['city'] ? $get_customer['city'] : ' ' }}"> -->
                              </div>
                              <!-- <div class="form-group">
                                <label for="" for="inputPassword"
                                  class="select_lebel col-sm-2 col-form-label">Zip</label>
                                  <input type="text" class="form-control"  name="zip" value="{{ $get_customer['zip'] ? $get_customer['zip'] : ' ' }}">
                              </div> -->
                              {{ Form::hidden('policy_id',$policy_data['policy_id']) }}

                              <div class="form-group">
                                <label for=""> Time</label>
                                {{Form::text('delivery_time',null,['class'=>'form-control clockpicker','id'=>'time_pick'])}}
                            </div>
                            <div class="form-group">
                                <label for=""> Date</label>
                                {{Form::text('delivery_date',null,['class'=>'form-control','id'=>'date_picker'])}}
                            </div>
                               
                              <button type="submit" class="btn btn-primary">Submit</button>
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

        <div class="modal fade in cod-payment" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
        

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">COD Payment</h4>
        

            </div>
            <div class="modal-body">
              <div class="contact-form mar-top">
                        <div class="row">
                          <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                {{Form::label('Paid Amount')}}
                                {{Form::text('amount',null,['class'=>'form-control','id'=>'amount'])}}
                                <div class="text-danger"><strong id="amount_error_home"></strong></div>
                              </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="Date range:">Date Range:</label>
                                  <div class="input-group">
                                    <div class="input-group-addon"> <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-right" id="cod_datepicker" readonly value="" autocomplete="off" name="date_range" type="text">
                                    <div class="text-danger"><strong id="date_range_error_home"></strong></div>
                                  </div>
                            </div>
                          </div>

                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes" id="notes"></textarea>
                            <div class="text-danger"><strong id="notes_error_home"></strong></div>
                            </div>
                          </div>

                          <div class="col-sm-12 col-md-12">
                            <div class="btn-group">
                            <input type="button" id="add"  onclick="saveCodDetails()"   class="go" value="{{__('Add')}}">
                            <input type="hidden" id="policyId"    class="go" value="{{$policy_data['policy_id']}}">
                            </div>
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
    $(document).ready(function () {

      //hides dropdown content
      $(".size_chart").hide();

      //unhides first option content
      $("#option1").show();

      //listen to dropdown for change
      $("#size_select").change(function () {
        //rehide content on change
        $('.size_chart').hide();
        //unhides current item
        $('#' + $(this).val()).show();
      });

    });
  </script>
  <script>
    $('#file-upload').change(function () {
      var filepath = this.value;
      var m = filepath.match(/([^\/\\]+)$/);
      var filename = m[1];
      $('#filename').html(filename);

    });
    
    $('#customer-file-upload').change(function () {
      var filepath = this.value;
      var m = filepath.match(/([^\/\\]+)$/);
      var filename = m[1];
      $('#customer-filename').html(filename);

    });
    $('#edit-file-upload').change(function () {
      var filepath = this.value;
      var m = filepath.match(/([^\/\\]+)$/);
      var filename = m[1];
      $('#edit-filename').html(filename);

    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#datepicker2").datepicker({
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
      $("#datepicker-task").datepicker({
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

 $.datetimepicker.setLocale('pt-BR');
      $('#date_picker').datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });


      $("#cod_datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });

    });
    $('#time_pick').timepicker();
  </script>
  <script>
    $('select#dis_city option:first').attr('disabled', true);
    $('select#size_select option:first').attr('disabled', true);
    $('select#dis_engine option:first').attr('disabled', true);

  </script>
  <script>
    $('#file-upload').click(function (){
      $(this).attr('type', 'file');
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $(function() {

        $("form[name='create_policy_document']").validate({
          rules: {
            browse: {
                required: true
              },
            message: "required"
          },
          messages: {
            message: "Please Enter your Comments",
            document_file: "Please Select Your File"

          },
          submitHandler: function(form) {
            form.submit();
          }
        });
        $("form[name='edit_policy_document']").validate({
            rules: {
              browse: {
                  required: true
                },
              message: "required"
            },
            messages: {
              message: "Please Enter your Comments",
              document_file: "Please Select Your File"

            },
            submitHandler: function(form) {
              form.submit();
            }
        });

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
        $("form[name='edit_document_customer']").validate({
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

        $("form[name='update_delivery_info']").validate({
            rules: {
              delivery_address: "required",
              delivery_city: "required",
              delivery_time: "required",
              delivery_date: "required"
            },
            messages: {
              delivery_address: "Please Select Address",
              delivery_city: "Please Select your City",
              delivery_time: "Please Enter your  Time",
              delivery_date: "Please Enter your Date "

            },
            submitHandler: function(form) {
              form.submit();
            }
        });

      });

    function edit_documents(id){
        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('edit_policy_document') }}",
            data:{data:getid},
            success:function(data){
                console.log(data);
               $('#edit-policy-doc-Modal').modal('show');


               $("#edit-policy-doc-Modal input[name='documents_id']").val('');
               $("#edit-policy-doc-Modal input[name='documents_id']").val(data.id);
               $("#edit-policy-doc-Modal textarea[name='message']").val(data.comments);


            }
         });
    }
    function edit_customer_documents(id){
        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('edit_customer_document') }}",
            data:{data:getid},
            success:function(data){

               $('#edit-customer-doc-Modal').modal('show');
               $("#edit-customer-doc-Modal input[name='documents_id']").val('');
               $("#edit-customer-doc-Modal input[name='documents_id']").val(data.id);
               $('#edit-customer-doc-Modal  select[name="status"] option[value="'+data.status+'"]').attr('selected','selected');
               $("#edit-customer-doc-Modal textarea[name='message']").val(data.comments);

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

function saveCodDetails()
{
    var amount = $("#amount").val();
    var datepicker = $("#cod_datepicker").val();
    var notes = $("#notes").val();
    var policyId = $("#policyId").val();

    $.ajax({
      headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
        type:'POST',
        url:"{{ route('cod-create') }}",
        data:{amount:amount,date_range:datepicker,notes:notes,policyId:policyId},
        success: function (response) {   // success callback function

          if(response.success === true)
          {
          $(".cod_submit_button").prop('disabled', false);
          toastr.success('Cod added Sucessfully','Success');
          $('#myModal').modal('hide');
          location.reload(true);
          }

          },error: function (jqXHR) {
          $(".cod_submit_button").prop('disabled', false);
            var errormsg = jQuery.parseJSON(jqXHR.responseText);
            $.each(errormsg.errors,function(key,value) {
                $(".text-danger").show();
                $('#'+key+'_error_home').html(value);
            });
          }
    });

}
$('#amount').keyup(function(){
      $('#amount_error_home').html('');
    });

  $("#cod_datepicker").click(function(){
    $('#date_range_error_home').html('');
   });

    $("#notes").keyup(function(){
      $("#notes_error_home").html('');
    });
  </script>
@endsection
