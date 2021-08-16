
@extends('layouts.master')
@section('title','MySIg by Fidentia | Customer')
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Customer Info
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Custome Info</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->

              <div class="box-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered">
                        <thead>
                          <tr>
                            <th>Customer Info</th>
                            <th></th>
                            <th class="text-right">
                              <button type="button" class="popup_btn" data-toggle="modal" data-target="#editModal"><i
                                  class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv table-responsive">
                                <table class="table_style table_style_info">
                                  <tbody>



                                        <tr>
                                            <th>customer Type:</th>
                                            <td></td>
                                            <td>{{ $data->user_type}}</td>
                                          </tr>




                                    <tr>
                                      <th>Name:</th>
                                      <td></td>
                                      <td>{{ $data->name}}</td>
                                    </tr>
                                    <tr>
                                      <th>ID Number/Nuis:</th>


                                        <td >{{ ($data->nuis_id) }}</td>

                                        <td ></td>

                                      <td>

                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Can Purchase:</th>
                                      <td ></td>
                                      <td>yes</td>
                                    </tr>

                                  </tbody>
                                </table>
                              </div>
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info table-striped">
                                  <thead class="back_fff">
                                    <tr>
                                      <th>Contact Info</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                        <tr>
                                        <th>Email Address:</th>
                                        <td  style="width: 25%"></td>
                                        <td>{{ $data->email}}</td>
                                        </tr>
                                        <tr>
                                        <th></th>
                                        <td  style="width: 25%"></td>
                                        <td></td>
                                        </tr>
                                        <tr>
                                        <th>Phone:</th>
                                        <td  style="width: 25%"></td>
                                        <td>{{ $data->phone}}</td>
                                        </tr>
                                        <tr>
                                        <th>Address:</th>
                                        <td  style="width: 25%"></td>
                                        <td>{{ $data->address}}</td>
                                        </tr>
                                        <tr>
                                        <th >Preferred Communication Channel:</th>
                                        <td  style="width: 25%"></td>
                                        <td >Email</td>
                                        </tr>

                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    @php
                      $country_code=[
                      '+93'=>'+93','+358'=>'+358','+355'=>'+355','+213'=>'+213','+1264'=>'+1264','+672'=>'+672','+1268'=>'+1268','+54'=>'+54','+374'=>'+374',
                      '+297'=>'+297','+61'=>'+61','+43'=>'+43','+994'=>'+994','+1242'=>'+1242','+973'=>'+973','+880'=>'+880','+1246'=>'+1246','+375'=>'+375',
                      '+32'=>'+32','+501'=>'+501','+229'=>'+229','+1441'=>'+1441','+975'=>'+975','+591'=>'+591','+387'=>'+387','+267'=>'+267','+55'=>'+55','+246'=>'+246',
                      '+673'=>'+673','+359'=>'+359','+226'=>'+226','+257'=>'+257','+855'=>'+855','+237'=>'+237','+1'=>'+1','+238'=>'+238','+345'=>'+345',
                      '+236'=>'+236','+235'=>'+235','+56'=>'+56','+86'=>'+86','+61'=>'61',"+57"=>"+57","+269"=>"+269","+242"=>"+242","+243"=>"+243",
                      "+682"=>"+682","+506"=>"+506", "+225"=> "+225", "+385"=> "+385", "+53"=> "+53", "+357"=> "+357","+420"=>"+420", "+253"=> "+253",
                      "+1767"=> "+1767", "+1849"=> "+1849", "+593"=> "+593","+20"=>"+20", "+503"=> "+503", "+240"=> "+240", "+291"=> "+291", "+372"=> "+372",
                      "+251"=> "+251", "+500"=> "+500", "+298"=> "+298", "+679"=>"+679","+358"=>"+358","+33"=>"+33", "+594"=> "+594","+689"=>"+689","+241"=>"+241",
                      "+220"=>"+220", "+995"=>"+995", "+49"=>"+49", "+233"=>"+233", "+350"=>"+350", "+30"=>"+30", "+299"=>"+299", "+1473"=>"+1473", "+590"=>"+590",
                      "+1671"=>"+1671", "+502"=>"+502", "+224"=>"+224", "+245"=>"+245", "+595"=>"+595", "+509"=>"+509", "+379"=>"+379","+504"=>"+504","+852"=>"+852",
                      "+36"=>"+36", "+354"=>"+354","+91"=>"+91", "+62"=>"+62","+98"=>"+98","+964"=>"+964", "+353"=>"+353","+972"=>"+972", "+39"=>"+39", "+1876"=>"+1876",
                      "+81"=>"+81","+962"=>"+962","+77"=>"+77","+254"=>"+254", "+686"=>"+686", "+850"=>"+850", "+82"=>"+82", "+965"=>"+965","+996"=>"+996", "+856"=>"+856",
                      "+371"=>"+371", "+961"=>"+961", "+266"=>"+266", "+231"=>"+231", "+218"=>"+218", "+423"=>"+423", "+370"=>"+370", "+352"=>"+352","+853"=>"+853", "+389"=>"+389",
                      "+261"=>"+261","+265"=>"+265","+60"=>"+60", "+960"=>"+960", "+223"=>"+223", "+356"=>"+356", "+692"=>"+692", "+596"=>"+596", "+222"=>"+222", "+230"=>"+230",
                      "+262"=>"+262", "+52"=>"+52", "+691"=> "+691", "+373"=> "+373", "+377"=> "+377", "+976"=> "+976", "+382"=> "+382", "+1664"=> "+1664","+212"=>"+212",
                      "+258"=> "+258", "+95"=> "+95", "+264"=> "+264","+674"=>"+674", "+977"=> "+977", "+31"=> "+31", "+599"=> "+599", "+687"=> "+687", "+64"=> "+64", "+505"=> "+505",
                      "+227"=> "+227", "+234"=> "+234", "+683"=> "+683","+672"=>"+672", "+1670"=> "+1670", "+47"=> "+47", "+968"=> "+968", "+92"=> "+92", "+680"=> "+680", "+970"=> "+970",
                      "+507"=> "+507", "+675"=> "+675", "+595"=> "+595", "+51"=> "+51", "+63"=> "+63", "+872"=> "+872", "+48"=> "+48","+351"=>"+351", "+1939"=> "+1939", "+974"=> "+974",
                      "+40"=>"+40", "+7"=> "+7","+250"=>"+250", "+262"=> "+262", "+590"=> "+590", "+290"=> "+290", "+1869"=> "+1869", "+1758"=> "+1758", "+590"=> "+590","+508"=>"+508", "+1784"=> "+1784",
                      "+685"=>"+685","+378"=>"+378","+239"=>"+239", "+966"=> "+966","+221"=>"+221","+381"=>"+381", "+248"=> "+248","+232"=>"+232", "+65"=> "+65", "+421"=> "+421","+386"=>"+386",
                      "+677"=> "+677", "+252"=> "+252", "+27"=> "+27","+211"=>"+211", "+500"=> "+500", "+34"=> "+34", "+94"=> "+94", "+249"=> "+249", "+597"=> "+597", "+47"=> "+47",
                      "+268"=> "+268", "+46"=> "+46", "+41"=> "+41", "+963"=> "+963", "+886"=> "+886", "+992"=> "+992","+255"=>"+255", "+66"=> "+66", "+670"=> "+670","+228"=>"+228",
                      "+690"=> "+690", "+676"=> "+676", "+1868"=> "+1868", "+216"=> "+216","+90"=>"+90", "+993"=> "+993", "+1649"=> "+1649", "+688"=> "+688","+256"=>"+256","+380"=>"+380",
                      "+971"=> "+971", "+44"=> "+44", "+1"=> "+1", "+598"=> "+598", "+998"=> "+998", "+678"=> "+678","+58"=>"+58", "+84"=> "+84", "+1284"=> "+1284", "+1340"=> "+1340",
                      "+681"=> "+681", "+967"=> "+967", "+260"=> "+260", "+263"=> "+263"];
                    @endphp
                    <div class="modal fade" id="editModal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Customer Info</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(['route'=>'edit_customer_details','id'=>'customer_view_details_edit'])}}
                                @if(!empty($data))
                                {{Form::model($data)}}
                                {{Form::hidden('user_id',$data->user_id)}}
                                @endif
                                  <div class="form-group">
                                  {{Form::label('Customer Type Channel',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}
                                  {{Form::select('user_type',array('Individual'=>'Individual',
                                                                'Business'=>'business'),null,['class'=>'form-control','id'=>'custom_user_type'])}}
                                  <div class="text-danger"><strong id="user_type_customer_edit_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Name')}}
                                    {{Form::text('name',null,['class'=>'form-control','id'=>'custom_name'])}}
                                    <div class="text-danger"><strong id="name_customer_edit_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('ID Number/Nuis')}}
                                    {{Form::text('nuis_id',null,['class'=>'form-control'])}}
                                    <div class="text-danger"><strong id="nuis_id_customer_edit_error"></strong></div>
                                  </div>
                                 <div class="form-group">
                                  {{Form::label('Can Purchase Channel',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}
                                  {{Form::select('can_purchase_channel',array('Yes'=>'Yes',
                                                              'No'=>'No'),null,['class'=>'form-control'])}}
                                  <div class="text-danger"><strong id="can_purchase_channel_customer_edit_error"></strong></div>
                                  </div>
                                  <div class="mt-5">
                                    <h4>Contact Info:</h4>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Email address')}}
                                    {{Form::email('email',null,['class'=>'form-control','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp','placeholder'=>'Enter email','id'=>'custom_email'])}}
                                    <div class="text-danger"><strong id="email_customer_edit_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Phone')}}
                                    <div class="row">
                                      <div class="col-sm-3 col-xs-3 col-lg-3">{{Form::select('country_code',$country_code,null,['class'=>'form-control select2','id'=>'custom_country_type'])}}
                                        <div class="col-sm-3 col-xs-3 col-lg-3 text-danger"><strong id="country_code_customer_edit_error"></strong></div>
                                      </div>
                                      <div class="col-sm-9 col-xs-9 col-lg-9">{{Form::text('phone',null,['class'=>'form-control custom_phone','id'=>'number_only'])}}</div>
                                        <div class="col-sm-9 col-xs-9 col-lg-9 text-danger pull-right"><strong id="phone_customer_edit_error"></strong></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Address')}}
                                    {{Form::text('address',null,['class'=>'form-control'])}}
                                    <div class="text-danger"><strong id="address_customer_edit_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Preferred Communication Channel',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}
                                    {{Form::select('commnication_channel',array('email'=>'Email',
                                                                'phone'=>'phone'),null,['class'=>'form-control','id'=>'exampleFormControlSelect1'])}}
                                    <div class="text-danger"><strong id="commnication_channel_customer_edit_error"></strong></div>
                                  </div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="editdocumentsModal" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Customer Info</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  {{Form::open(array('url' => route('customer_documnets_update'), 'method' => 'post','name' => 'edit_document_form','files' => true))}}
                                  <div class="file-upload-div"> <span id="editfilename" class="filename">Select your file</span>
                                    <label for="editfile-upload">Browse

                                      {{--  {{Form::file('document-file',null,['id'=>'editfile-upload','required'])}}  --}}
                                      {{ Form::file('document-file', $attributes = array('id'=>'editfile-upload','class'=>'file-upload'))}}


                                    </label>
                                  </div>
                                    <div class="form-group">
                                      {{Form::label('Comments')}}
                                      {{Form::textarea('message',null,['class'=>'form-control'.( $errors->has('message') ? ' is-invalid' : '' ),'class'=>'form-control','required','rows'=>'3'])}}
                                      @error('message')
                                          <span class="color_red" role="alert">
                                          <h5 class="message_text">*{{ $message }}</h5>
                                          </span>
                                      @enderror
                                      {{ Form::hidden('customer_id', $data->cus_id, array('id' => "documnets_id")) }}

                                    </div>
                                      {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                                  {{ Form::close() }}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edittaskModal" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Customer Info</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                    {{Form::open(array('url' => route('update_task_customer'), 'method' => 'post','name' => 'upadte_task','files' => true))}}
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

                                    <div class="form-group row">
                                    {{ Form::label('staticEmail','Customer <span class="form-control-plaintext">'.$data->name.'</span>',['class'=>'col-sm-12 col-form-label'],false) }}

                                    {{ Form::hidden('task_id', $data->id, array('id' => "task_id")) }}
                                </div>
                                    <div class="wrapper date_div form-group">
                                      {{Form::label('Date')}}
                                      {{Form::text('edit_datepicker',null,['class'=>'form-control date_range datepicker','id'=>'datepicker','autocomplete'=>'off'])}}
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
                                      {{ Form::submit('Update Task',['class'=>'btn btn-primary']) }}
                                      <button type="button" class="btn btn-light"  data-dismiss="modal">Cancel</button>

                                    </div>
                                  {{Form::close()}}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div>
                      <div class="dis-flex heading_bod">
                        <div class="doc_table_title">
                          <h5>Document</h5>
                        </div>
                        <div>
                          <button type="button" class="popup_btn" data-toggle="modal" data-target="#addModal"><i
                              class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive document_div">
                        <table class="table table-bordered table-striped" id="customer_view_table1">
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

                                        <button type="button" class="popup_btn" data-href="{{ route('customer_documnets_delete',$item->document_id  ) }}" data-toggle="modal" data-target="#confirm-delete">
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
                    <div class="modal fade" id="addModal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Customer Info</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {{Form::open(array('url' => route('customer_documnets_add'), 'method' => 'post','name' => 'douments_add','files' => true))}}

                                  <div class="file-upload-div"> <span id="add-filename" class="filename">Select your file</span>
                                    <label for="add-file-upload">Browse
                                      {{ Form::file('document_file', $attributes = array('id'=>'add-file-upload','class'=>'file-upload'))}}


                                    </label>

                                  </div>
                                  @error('message')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                  <div class="form-group">
                                    {{Form::label('Comments')}}
                                    {{Form::textarea('message',null,['class'=>'form-control'.( $errors->has('message') ? ' is-invalid' : '' ),'class'=>'form-control','rows'=>'3'])}}
                                    @error('message')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                    {{ Form::hidden('customer_id', $data->customer_id ) }}

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
                  <div class="col-md-7">
                    <div class="table-responsive document_div">
                      <table class="table table-bordered table-striped" id="customer_view_table2">
                        <thead>
                          <tr>
                            <th >Object</th>
                            <th >Type</th>
                            <th >Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($car_details_show as $details)
                          <tr>
                            <td>{{$details['car_registration_number']}}</td>
                            <td >{{$details['car_type']}}/{{$details['car_sub_type']}}</td>
                            <td >{{$details['status']}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="table-responsive mt_5 document_div">
                      <table class="table table-bordered table-striped" id="customer_view_table3">
                        <thead>
                          <tr>
                            <th >Policy No</th>
                            <th >Insurer</th>
                            <th >Type</th>
                            <th >Object</th>
                            <th >Premium</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if (!empty($data->policy_details))
                            @foreach ($data->policy_details as $item)
                           
                                <tr>
                                    <td>{{ $item['policy_number']}}</td>
                                    <td>{{ $item['insurer_name']}}</td>
                                    <td>
                                      {{$item['policy_type']}}
                                    </td>
                                    <td>{{ $item['object']}}</td>
                                    <td>{{ $item['premium']}}</td>

                                    @if (!empty( $item['status_tracking']))
                                        @if( $item['status_tracking'] == '1' )

                                        <td>Requested</td>

                                        @elseif( $item['status_tracking'] == '2' )

                                        <td>Not Issued</td>
                                        @elseif( $item['status_tracking'] == '3' )

                                        <td>Issued</td>
                                        @elseif( $item['status_tracking'] == '4' )

                                        <td>Sent</td>
                                        @elseif( $item['status_tracking'] == '5' )

                                        <td>Delivered</td>
                                        @endif
                                    @else
                                    <td>-</td>
                                    @endif



                                </tr>
                            @endforeach


                        @endif




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
                      <div class="table-responsive mt_5">
                        <table class="table table-bordered" id="customer_view_table4">
                          <thead>
                            <tr>
                              <th >Date</th>
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
                      <div class="table-responsive mt_5">
                        <table class="table table-bordered" id="customer_view_table5">
                          <thead>
                            <tr>
                              <th >Claim ID</th>
                              <th >Policy</th>
                              <th >Insurer</th>
                              <th >Status</th>
                              <th >Product</th>
                              <th >Object</th>
                              <th >Loss Date</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($claim_data as $details)
                            <tr>
                              <td>CI000{{$details['claim_id']}}</td>
                              <td>{{$details['policy_type']}}</td>
                              <td>{{$details['insurer']}}</td>
                                @if(!empty($details['status']))
                                  @if( $details['status'] == '1' )
                                      <td>Requested</td>
                                  @elseif($details['status'] == '2' )

                                      <td>Not Issued</td>
                                  @elseif($details['status'] == '3' )

                                      <td>Issued</td>
                                  @elseif($details['status'] == '4' )

                                      <td>Sent</td>
                                  @elseif($details['status'] == '5' )

                                      <td>Delivered</td>
                                  @else
                                      <td>-</td>
                                  @endif
                                  @else
                                  <td>-</td>
                                @endif
                              <td>{{$details['product']}}</td>
                              <td>{{$details['object']}}</td>
                              <td>{{$details['loss_date']}}</td>
                            </tr>
                          @endforeach
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
                                {{Form::open(array('url' => route('create_task_customer'), 'method' => 'post','name' => 'add_task','files' => true))}}
                                <div class="form-group">
                                  {{Form::label('Responsible',null,['class'=>'select_lebel col-sm-2 col-form-label'])}}

                                    <select class="form-control" name="responsible">
                                        <option value="">--add to myself--</option>
                                        @foreach ($get_all_user as $key =>$item)

                                        <option value="{{ $item->id }}">{{ $item->name }}</option>

                                        @endforeach
                                    </select>

                                    @error('responsible')
                                            <span class="color_red" role="alert">
                                            <h5 class="message_text">*{{ $message }}</h5>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                {{ Form::label('staticEmail','Customer <span class="form-control-plaintext">'.$data->name.'</span>',['class'=>'col-sm-12 col-form-label'],false) }}
                                {{ Form::hidden('customer_id', $data->customer_id) }}
                            </div>
                                <div class="wrapper date_div form-group">
                                  {{Form::label('Date')}}
                                  {{Form::text('datepicker',null,['class'=>'form-control date_range datepicker','id'=>'datepicker','autocomplete'=>'off'])}}
                                    @error('datepicker')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  {{Form::label('Subject')}}
                                  {{Form::text('subject',null,['class'=>'form-control'])}}
                                    @error('subject')
                                        <span class="color_red" role="alert">
                                        <h5 class="message_text">*{{ $message }}</h5>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  {{Form::label('Description')}}
                                  {{Form::textarea('task_message',null,['class'=>'form-control','id'=>'exampleFormControlTextarea1','rows'=>'3'])}}
                                    @error('task_message')
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



$(function() {

    $("form[name='douments_add']").validate({
      rules: {
        document_file: {
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

    $("form[name='edit_document_form']").validate({
        rules: {
          message: "required"
        },
        messages: {
          message: "Please Enter your Comments"
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
            task_message: "required"


        },
        messages: {
            responsible: "Please Select Responsible",
            datepicker: "Please Select your Date",
            subject: "Please Enter your Subject",
            task_message: "Please Enter your Description"
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



  });






    $('#file-upload').change(function () {
      var filepath = this.value;
      var m = filepath.match(/([^\/\\]+)$/);
      var filename = m[1];
    });
  </script>
  <script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $(".datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>

  <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
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
                $("#edittaskModal #datepicker").val(dateformat(data.date));




              console.log(data);


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
    function edit_documents(id){
        var getid=id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'get',
            url:"{{ route('customer_documnets_edit') }}",
            data:{data:getid},
            success:function(data){
               $('#editdocumentsModal').modal('show');
               $('#documnets_id').val(" ");
               $('#documnets_id').val(data.id);
               $("#editdocumentsModal textarea[name='message']").val(data.comments);

            }
         });
    }
    $('#number_only').keypress(function(event){
        if (event.keyCode == 46 || event.keyCode == 8)
        {
        //do nothing
        }
        else
        {
          if (event.keyCode < 48 || event.keyCode > 57 )
          {
            event.preventDefault();
          }
        }
        });
  </script>
  <script>
    $('#file-upload').click(function (){
      $(this).attr('type', 'file');
    });
    $(document).ready(function() {
    $('.select2').select2();
  });
  </script>
  <script>
   $("#customer_view_details_edit").submit(function(){

    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache:false,
        data: formData,
        success: function (response) {   // success callback function

          if(response.success === true)
          {

            toastr.success('Customer updated','Success');
            $('#editModal').modal('hide');

            location.reload(true);
          }

        },error: function (jqXHR) {
            var errormsg = jQuery.parseJSON(jqXHR.responseText);
            if(errormsg.status == 'error')
            {
              toastr.error(errormsg.errors,'Error');
            }
            else{
              $.each(errormsg.errors,function(key,value) {
                $(".text-danger").show();
                $('#'+key+'_customer_edit_error').html(value);
            });
            }
           
        }
    });
    });
    $('#custom_name').click(function(){
      $('#name_customer_edit_error').html('');
      $('#email_customer_edit_error').html('');
      $('#user_type_customer_edit_error').html('');
      $("#country_code_customer_edit_error").html('');
      $("#phone_customer_edit_error").html('');
    });
    $("#custom_email").click(function(){
      $('#name_customer_edit_error').html('');
      $('#email_customer_edit_error').html('');
      $('#user_type_customer_edit_error').html('');
      $("#country_code_customer_edit_error").html('');
      $("#phone_customer_edit_error").html('');
    });
    $(".custom_phone").click(function(){
      // alert("arka");
      $('#name_customer_edit_error').html('');
      $('#email_customer_edit_error').html('');
      $('#user_type_customer_edit_error').html('');
      $("#country_code_customer_edit_error").html('');
      $("#phone_customer_edit_error").html('');
    });
    $('#custom_country_type').click(function(){
      $('#name_customer_edit_error').html('');
      $('#email_customer_edit_error').html('');
      $('#user_type_customer_edit_error').html('');
      $("#country_code_customer_edit_error").html('');
      $("#phone_customer_edit_error").html('');
    });
  </script>
@endsection
