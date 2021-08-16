@extends('layouts.master')
@section('title','MySIg by Fidentia | View Insurer')

@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          View Insurer
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">View Insurer</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="insurer_head">
                @if(isset($insurer_details))
                  <h3 class="box-title">{{$insurer_details['name']}}</h3>
                @endif
                  <div class="">
                    <label class="checkbox-four">
                      @if($insurer_details['status'] == 1)
                        <input type="checkbox" class="insurer_status" data-id="{{ $insurer_details['insurer_id'] }}" checked/> <span class="track thumb"></span>
                      @else
                      <input type="checkbox" class="insurer_status" data-id="{{ $insurer_details['insurer_id'] }}" /> <span class="track thumb"></span>
                      @endif
                    </label>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="document_div">
                      <div class="dis-flex heading_bod">
                        <div class="doc_table_title">
                          <h5> Policy</h5>
                        </div>
                        <div>
                          <button type="button" class="popup_btn" data-toggle="modal" data-target="#policy-doc-Modal"><i
                              class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="insurer_pofile_table1">
                          <thead>
                            <tr>
                              <th>Policy Name</th>
                              <th>Type</th>
                              <th>Sub Type</th>
                              <th>Commissions %</th>
                              <th>Status</th>
                              <th>Views</th>
                            </tr>
                          </thead>
                          <tbody id="policy_table">
                            @foreach($insurer_policy as $key => $policy)
                            <tr class="insurer_profile_tr">
                              <td>{{$policy['policy_name']}}</td>
                              <td>{{$policy['policy_type']['name']}}</td>
                              <td>{{$policy['policy_sub_type']['name']}}</td>
                              <td>{{$policy['commission']}}%</td>
                              <td>
                                <label class="checkbox-four">
                                 @if($policy['status'] == 1)
                                  <input type="checkbox" class="insurer_policy_status" data-id="{{ $policy['insurer_policy_id'] }}" checked /> <span class="thumb track"></span>
                                 @else
                                  <input type="checkbox" class="insurer_policy_status" data-id="{{ $policy['insurer_policy_id'] }}" /> <span class="thumb track"></span>
                                 @endif
                                </label>
                              </td>
                              <td>
                              @if($policy['policy_sub_type']['policy_sub_type_id'] == 'c1bc21cfdda9')
                                <a class="delete_police" data-id="27273" href="{{route('policy_tpl',$policy['insurer_policy_id'])}}" target="_blank" >View</a>
                              @elseif($policy['policy_sub_type']['policy_sub_type_id'] == 'dfd3e39b733a')
                                <a class="delete_police" data-id="27273" href="{{route('policy_green_card',$policy['insurer_policy_id'])}}" target="_blank" >View</a>
                              @elseif($policy['policy_sub_type']['policy_sub_type_id'] == 'c7824ee08a59')
                                <a class="delete_police" data-id="27273" href="{{route('policy_full_casco',$policy['insurer_policy_id'])}}" target="_blank" >View</a>
                              @elseif($policy['policy_sub_type']['policy_sub_type_id'] == '74273e1bc257')
                                <a class="delete_police" data-id="27273" href="{{route('policy_home',$policy['insurer_policy_id'])}}" target="_blank" >View</a>
                              @elseif($policy['policy_sub_type']['policy_sub_type_id'] == '0ac2b7cfc696')
                              <a class="delete_police" data-id="27273" href="{{route('policy_travel',$policy['insurer_policy_id'])}}" target="_blank" >View</a>
                              @else
                                <a class="delete_police" data-id="27273" href="{{route('policy_travel_student',$policy['insurer_policy_id'])}}" target="_blank" >View</a>
                              @endif
                              </td>
                            </tr>
                            @endforeach
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
                            <h4 class="modal-title">Policy</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <h5>Policy Type</h5>
                                <div class="tabs insurer_tab">
                                  <div class="tabs__navigation">
                                    <button type="button" data-target="first" class="active">Home</button>
                                    <button type="button" data-target="second">Car</button>
                                    <button type="button" data-target="third">Travel</button>
                                  </div>
                                  <div id="tabs__content">
                                    <div class="single__tab active first">
                                    {!! Form::open(['route'=>'add_home_policy','role'=>'form','files'=>true,'id'=>'add-home-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                        @if(isset($insurer_details) && !empty($insurer_details))
                                            {!! Form::hidden('insurer_id',$insurer_details->insurer_id,['id'=>'insurer_id']) !!}
                                        @endif
                                        <div class="form-group">
                                          {{Form::label('Policy Name')}}
                                          {{Form::text('policy_name',null,['class'=>'form-control','id'=>'policy_name'])}}
                                          <div class="text-danger"><strong id="policy_name_error_home"></strong></div>
                                        </div>
                                        <div class="form-group">
                                          {{Form::label('Commissions %')}}
                                          {{Form::text('commission',null,['class'=>'form-control per-val-modal commission_persent','id'=>'commission'])}}
                                          <div class="text-danger"><strong id="commission_error_home"></strong></div>
                                          <div class="text-success"><strong></strong></div>

                                        </div>
                                        <div>
                                          {{Form::submit('Submit',['class'=>'btn btn-primary','id'=>'home_btn','name'=>'submit_button'])}}
                                        </div>
                                      {{ Form::close() }}
                                    </div>
                                    <div class="single__tab second">
                                    {!! Form::open(['route'=>'add_car_policy','role'=>'form','files'=>true,'id'=>'add-car-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                        @if(isset($insurer_details) && !empty($insurer_details))
                                            {!! Form::hidden('insurer_id',$insurer_details->insurer_id,['id'=>'insurer_id']) !!}
                                            {!! Form::hidden('name',$insurer_details->name,['id'=>'name']) !!}
                                        @endif
                                        <div class="form-group  mt_5">
                                          {{Form::label('Policy Name ')}}
                                          {{Form::text('policy_name',null,['class'=>'form-control','id'=>'policy_name_car'])}}
                                          <div class="text-danger"><strong id="policy_name_error_car"></strong></div>
                                        </div>
                                        <div class="form-group">
                                          {{Form::label('Sub Category')}}
                                          {{Form::select('policy_sub_type',array('c1bc21cfdda9'=>'TPL',
                                                                              'dfd3e39b733a'=>'Green Card',
                                                                              'c7824ee08a59'=>'Full Casco'),null,['class'=>'form-control','id'=>'policy_sub_type_car'])}}
                                        </div>
                                        <div class="form-group">
                                          {{Form::label('Commissions %')}}
                                          {{Form::text('commission',null,['class'=>'form-control per-val-modal commission_persent','id'=>'commission_car'])}}
                                          <div class="text-danger"><strong id="commission_error_car"></strong></div>
                                          <div class="text-success"><strong></strong></div>

                                        </div>
                                        <div>
                                          {{Form::submit('Submit',['class'=>'btn btn-primary','id'=>'car_btn','name'=>'submit_button'])}}
                                        </div>
                                      {{ Form::close() }}
                                    </div>
                                    <div class="single__tab third">
                                    {!! Form::open(['route'=>'add_travel_policy','role'=>'form','files'=>true,'id'=>'add-travel-policy','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                        @if(isset($insurer_details) && !empty($insurer_details))
                                            {!! Form::hidden('insurer_id',$insurer_details->insurer_id,['id'=>'insurer_id']) !!}
                                        @endif
                                        <div class="form-group  mt_5">
                                          {{Form::label('Policy Name ')}}
                                          {{Form::text('policy_name',null,['class'=>'form-control','id'=>'policy_name_travel'])}}
                                          <div class="text-danger"><strong id="policy_name_error_travel"></strong></div>
                                        </div>
                                        <div class="form-group">
                                          {{Form::label('Choose Country')}}
                                          {{Form::select('country',array('0'=>'Select One',
                                                                        '69e21f9783bd'=>'Student outside country',
                                                                        '0ac2b7cfc696'=>'travel outside country'),null,['class'=>'form-control','id'=>'country'])}}
                                          <div class="text-danger"><strong id="country_error_travel"></strong></div>
                                        </div>
                                        <div class="form-group">
                                          {{Form::label('Commissions %')}}
                                          {{Form::text('commission',null,['class'=>'form-control per-val-modal commission_persent','id'=>'commission_tarvel'])}}
                                          <div class="text-danger"><strong id="commission_error_travel"></strong></div>
                                          <div class="text-success"><strong></strong></div>

                                        </div>
                                        <div>
                                          {{Form::submit('Submit',['class'=>'btn btn-primary','id'=>'travel_btn','name'=>'submit_button'])}}
                                        </div>
                                      {{ Form::close() }}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="mt_5">
                      <div class="document_div">
                        <div class="dis-flex heading_bod">
                          <div class="doc_table_title">
                            <h5>Comparison</h5>
                          </div>
                          <div>
                            <button type="button" class="popup_btn" data-toggle="modal"
                              data-target="#comparison-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" id="insurer_pofile_table2">
                            <thead>
                              <tr>
                                <th>Policy Name</th>
                                <th>Comparison Value</th>
                                <th>Delete Comparison</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($insuer_policy_item as $deatils)
                                @if(!empty($deatils->comparision_values))
                                  <tr>
                                    <td>{{ $deatils->policy_name}}</td>
                                    <td>{{$deatils->comparision_values}}</td>
                                    <td>
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="{{route('delete_comparision_values',$deatils->insurer_policy_id)}}" class="logo_del"><i class="fa fa-trash-o" id="comparision_delete" aria-hidden="true"></i></a>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="comparison-modal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">comparison</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                {!! Form::open(['route'=>'save_insurer_comparision','role'=>'form','id'=>'comparision_value','autocomplete' => 'off']) !!}
                                  <div class="form-group">
                                    {{Form::label('Associated With')}}
                                    {{Form::select('policy_name',$insurer_policy_name,null,['class'=>'form-control','id'=>'policy_name_of_comparision'])}}
                                  </div>
                                  <div class="form-group">
                                    <label>Comparison Value</label>
                                    <div class="multi-field-wrapper">
                                      <div class="multi-fields compare_vlaue_field">

                                        <div class="multi-field">
                                          {{Form::text('comparision_values[]',null,['class'=>'form-control comparision_number_only'])}}
                                          <button type="button" class="remove-field btn btn-danger" id="comparision_remove">Remove</button>
                                        </div>
                                      </div>
                                      <div class="text-danger"><strong id="_comparision_error"></strong></div>
                                      <div class="text-right">
                                        <button type="button" class="add-field btn btn-success">Add New</button>
                                      </div>
                                    </div>
                                  </div>
                                  {{Form::submit('Submit',['class'=>'btn btn-primary','id'=>'comparision_submit_button'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="mt_5">
                      <div class="document_div">
                        <div class="dis-flex heading_bod">
                          <div class="doc_table_title">
                            <h5>Terms & Condition </h5>
                          </div>
                          <div>
                            <button type="button" class="popup_btn" data-toggle="modal"
                              data-target="#tnc-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" id="insurer_pofile_table3">
                            <thead>
                              <tr>
                                <th>Policy Name</th>
                                <th>Pdf files</th>
                                <th>Delete Pdf files</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($insuer_terms_condition as $terms_condition_details)
                              <tr>
                                <td>{{$terms_condition_details->policy_name}}</td>
                                <td><i class="fa fa-file-pdf-o" aria-hidden="true"></i><a href="{{ asset('/storage/uploads/terms_condition/' . $terms_condition_details->policy_file) }}" target="_black"> view Pdf </a></td>
                                <td>
                                  <a onclick="return confirm('Are you sure you want to delete?')" href="{{route('delete_insurer_terms_condition',['insurer_policy_id'=>$terms_condition_details->insurer_policy_id])}}" class="logo_del"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="tnc-modal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Terms & Condition</h4>
                          </div>
                          <div class="modal-body" id="terms_condition_modal_body">
                            <div class="row">
                              <div class="col-md-12">
                                {!! Form::open(['route'=>'insurer_terms_condition_save','role'=>'form','id'=>'terms_condition','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                                {!! Form::hidden('csrf', csrf_token(),['id'=>'csrf','required','class'=>'form-control',]) !!}

                                  <div class="form-group">
                                    {{Form::label('Associated With')}}
                                    {{Form::select('policy_name',$insurer_policy_name,null,['class'=>'form-control','id'=>'policy_name_of_terms_condition'])}}
                                    <div class="text-danger"><strong id="policy_name_error"></strong></div>
                                  </div>
                                  @if(isset($insurer_details) && !empty($insurer_details))
                                    {!! Form::hidden('insurer_id',$insurer_details->insurer_id) !!}
                                  @endif
                                  <div class="form-group">
                                    <label for=""> upload pdf file</label>
                                    <div class="file-upload-div mb_36"> <span id="filename2">Select your file</span>
                                      <label for="file-upload2" class="text-right">Browse
                                        <input type="file" id="file-upload2" name="browse">
                                      </label>
                                    <div class="text-danger"><strong id="browse_error"></strong></div>

                                    </div>
                                    <!-- <div class="text-danger"><strong id="browse_error"></strong></div> -->
                                  </div>
                                  {{Form::submit('Submit',['class'=>'btn btn-primary terms_and_condition_button'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mt_5">
                      <div class="document_div">
                        <div class="dis-flex heading_bod">
                          <div class="doc_table_title">
                            <h5>Offers</h5>
                          </div>
                          <div>
                            <button type="button" class="popup_btn" data-toggle="modal"
                              data-target="#customer-doc-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" id="insurer_pofile_table4">
                            <thead>
                              <tr>
                                <th >Offer Name</th>
                                <th >% or ammount off</th>
                                <th >Extra Ammount</th>
                                <th>Associated With</th>
                                <th>Delete offer</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($insuer_offer_get as $deatils)
                              @php
                                $percentage_amount = !empty($deatils->amount_of)?$deatils->amount_of:$deatils->percentage_of."%";
                              @endphp
                              <tr>
                                <td>{{$deatils->offer_name}}</td>
                                <td>{{$percentage_amount}}</td>
                                <td>{{$deatils->extra_amount}}</td>
                                <td>{{$deatils->policy_name}}</td>
                                <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('delete_save_offers',['offers_id'=>$deatils->offers_id])}}" class="logo_del"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="mt_5">
                      <div class="document_div">
                        <div class="dis-flex heading_bod">
                          <div class="doc_table_title">
                            <h5>Logo</h5>
                          </div>
                          <div>
                            <button type="button" class="popup_btn" data-toggle="modal"
                              data-target="#addLogo-modal"><i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" id="insurer_pofile_table5">
                            <thead>
                              <tr>
                                <th>Logo</th>
                                <th>Delete Logo</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(isset($insurer_details['logo']))
                              <tr>
                                <td>
                                  <img src="{{URL::asset('storage/uploads/insurer_logo/'.$insurer_details['logo'])}}" id="logo-upload" style="width:100px; height:43px;">
                                </td>
                                <td>
                                  <a  class="delete_logo" id="{{$insurer_details['insurer_id']}}"><i class="fa fa-trash-o " aria-hidden="true" ></i></a>
                                </td>
                              </tr>
                              @else
                              <tr>
                                <td>
                                  <img src="https://via.placeholder.com/60" id="logo-upload" style="width:100px; height:43px;">
                                </td>
                                <td>
                                  <a  class="delete_logo"><i class="fa fa-trash-o " aria-hidden="true" id=""></i></a>
                                </td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="addLogo-modal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Logo</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                              {!! Form::open(['route'=>'add_insurer_logo','role'=>'form','files'=>true,'id'=>'add-logo','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                              {!! Form::hidden('csrf', csrf_token(),['id'=>'csrf','required','class'=>'form-control',]) !!}
                                @if(isset($insurer_details) && !empty($insurer_details))
                                    {!! Form::hidden('insurer_id',$insurer_details->insurer_id) !!}
                                @endif
                                  <div class="file-upload-div mb_36"> <span id="filename">Select your file</span>
                                    <label for="file-upload">Browse
                                      <input type="file" id="file-upload" name="browse">
                                    </label>
                                  </div>
                                  <div class="text-danger"><strong id="browse_error_logo"></strong></div>
                                {{Form::submit('Add Logo',['class'=>'btn btn-primary','id'=>'logo_bttn'])}}
                                {{ Form::close() }}
                              </div>
                            </div>
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
                            <h4 class="modal-title">Add Offer</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                              {!! Form::open(['route'=>'post_save_offers','role'=>'form','id'=>'add_offer','autocomplete' => 'off']) !!}
                                {!! Form::hidden('csrf', csrf_token(),['id'=>'csrf','required','class'=>'form-control',]) !!}
                                  @if(isset($insurer_details) && !empty($insurer_details))
                                      {!! Form::hidden('insurer_id',$insurer_details->insurer_id) !!}
                                  @endif
                                  <div class="form-group">
                                    {{Form::label('Offer Name')}}
                                    {{Form::text('offer_name',null,['class'=>'form-control','id'=>'offer_name'])}}
                                    <div class="text-danger"><strong id="offer_name_offer_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('% off')}}
                                    {{Form::text('percentage_of',0,['class'=>'form-control number_only per-val','id'=>'percentage_of'])}}
                                    <div class="text-danger"><strong id="percentage_of_offer_error"></strong></div>
                                  </div>
                                
                                  <div class="text-danger"><strong id="meassage_offer_error"></strong></div>
                                  <div class="text-success"><strong></strong></div>

                                  <div class="form-group">
                                    {{Form::label('Amount off')}}
                                    {{Form::text('amount_of',0,['class'=>'form-control number_only','id'=>'amount_of'])}}
                                    <div class="text-danger"><strong id="amount_of_offer_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Extra Amount (Optional)')}}
                                    {{Form::text('extra_amount',0,['class'=>'form-control number_only','id'=>'extra_amount_id'])}}
                                    <div class="text-danger"><strong id="extra_amount_offer_error"></strong></div>
                                  </div>
                                  <div class="form-group">
                                    {{Form::label('Associated With')}}
                                    {{Form::select('policy_name',$insurer_policy_name,null,['class'=>'form-control','id'=>'policy_offers_id'])}}
                                    <div class="text-danger"><strong id="policy_name_offer_error"></strong></div>

                                  </div>
                                  <div>
                                    {{Form::submit('Submit',['class'=>'btn btn-primary offers_submit_button'])}}
                                {{ Form::close() }}
                              </div>
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
<script src="{{URL::asset('js/modals/insurer/insurer-policy.js')}}"></script>
<script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1

    $(function () {
      $("#datepicker2").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
      $('#file-upload').change(function () {
        var filepath = this.value;
        var m = filepath.match(/([^\/\\]+)$/);
        var filename = m[1];
        $('#filename').html(filename);

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
    //inspired by instagram : webdev.tips

    const tab = document.querySelectorAll("button");
    const panel = document.querySelectorAll(".single__tab");

    function tabClick(event) {
      // deactivate existing active tabs and panel
      for (let i = 0; i < tab.length; i++) {
        tab[i].classList.remove("active");
      }
      for (let i = 0; i < panel.length; i++) {
        panel[i].classList.remove("active");
      }
      // activate new tabs and panel
      event.target.classList.add('active');
      let classString = event.target.getAttribute('data-target');
      document.getElementById('tabs__content').getElementsByClassName(classString)[0].classList.add("active");
    }
    for (let i = 0; i < tab.length; i++) {
      tab[i].addEventListener('click', tabClick, false);
    }
  </script>
  <script>
    //hide all tabs first
    $('.tab-content').hide();
    //show the first tab content
    $('#tab-1').show();

    $('#select-box').change(function () {
      dropdown = $('#select-box').val();
      //first hide all tabs again when a new option is selected
      $('.tab-content').hide();
      //then show the tab content of whatever option value was selected
      $('#' + "tab-" + dropdown).show();
    });
  </script>
  <script>
   $(document).ready(function(){
    $("#comparision_remove").hide();
   });
    $('.multi-field-wrapper').each(function () {
      var $wrapper = $('.multi-fields', this);
      $(".add-field", $(this)).click(function (e) {
        $("#comparision_remove").show();
        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        // $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('div').val('');
      });
      $('.multi-field .remove-field', $wrapper).click(function () {
        if ($('.multi-field', $wrapper).length > 1)
          $(this).parent('.multi-field').remove();
      });
    });
  </script>

  <!-- Page script -->
  <script>






    $(function () {



        $(".per-val").on("keydown keyup change", function(){
            var value = $(this).val().trim();

            if(parseFloat(value)<=100 && value !='' && value>0){

                $(this).closest('.form-group').find('.text-success').children().text("Valid Percentage");
                // $( ".offers_submit_button").prop('disabled', false);

            }else{
                $(this).closest('.form-group').find('.text-danger').children().text("Please enter your valid Percentage");
                $(this).closest('.form-group').find('.text-success').children().text(" ");
                // $( ".offers_submit_button").prop('disabled', true);
            }

        });
        $(".per-val-modal").on("keydown keyup change", function(){
            var value = $(this).val().trim();

            if(parseFloat(value)<=100 && value !='' && value>0){

                $(this).closest('.form-group').find('.text-success').children().text("Valid Percentage");
                $(this).closest('.form-group').next().children().prop('disabled', false);


            }else{
                $(this).closest('.form-group').find('.text-danger').children().text("Please enter your valid Percentage");
                $(this).closest('.form-group').find('.text-success').children().text(" ");
                $(this).closest('.form-group').next().children().prop('disabled', true);

            }

        });

      //Initialize Select2 Elements
      $('.select2').select2()

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservation').daterangepicker()
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

      //Colorpicker
    //   $('.my-colorpicker1').colorpicker()
    //   //color picker with addon
    //   $('.my-colorpicker2').colorpicker()

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    });
  </script>
  <script>
    $(document).ready(function(){
        $('#add-logo').submit(function(event){
            event.preventDefault();
            var btnid = $('#logo_bttn').attr('id');
            buttonDisabled(btnid);
            var formdata = new FormData($(this)[0]);
            var flagsUrl = '{{ URL::asset('storage/uploads/insurer_logo/') }}';
            $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              dataType: 'json',
              processData: false,
              contentType: false,
              cache:false,
              data: formdata,
              success: function (response) {   // success callback functiondelete_logo
                if(response.success){
                  buttonEnabled(btnid);
                  $("#logo-upload").attr("src",flagsUrl+'/'+response.insure.logo);
                  $(".delete_logo").attr("id",response.insure.insurer_id);
                  toastr.success('Logo Uploaded','Success');
                  $('#addLogo-modal').modal('hide');
                }
              },error: function (jqXHR) {
                buttonEnabled(btnid);
                  var errormsg = jQuery.parseJSON(jqXHR.responseText);
                  $.each(errormsg.errors,function(key,value) {
                      $('#'+key+'_error_logo').html(value);
                  });
              }
            });
        });
    });
    $(document).on('change','.insurer_status',function(){
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
            url: "{{ route('change_insurer_status') }}",
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
    $(document).on('change','.insurer_policy_status',function(){
        var ischecked = $(this).is(':checked');
        // alert(ischecked);
        var id = $(this).attr('data-id');
        // alert(id);
        var active ;
        if(ischecked) {
            active = 1;
        } else {
            active = 0;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('change_insurer_policy_status') }}",
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
            },
            error: function (jqXHR) {
              // var errormsg = jQuery.parseJSON(jqXHR.responseText);
              
              // toastr.error('Error','Error');
              // location.reload(true);
            }
        })
    });

    $('#comparision_value').submit(function(e){
      e.preventDefault();
      var policy_name = $("#policy_name_of_comparision").children("option:selected").val();

      var comparision_values = $("input[name='comparision_values[]']").map(function(){return $(this).val();}).get();
      var insurer_id = '<?php echo $insurer_details->insurer_id ?>';
      $("#comparision_submit_button").prop('disabled', true);
        $.ajax({
          url: $(this).attr('action'),
          method: 'post',
          data: { '_token': '{{ csrf_token() }}','policy_name':policy_name,'comparision_values':comparision_values,'insurer_id':insurer_id},
          dataType: 'json',
          success: function (response)
          {

            console.log(response);
              if(response.success == true)
              {

                  toastr.success('Comparision Added Successfully','Success');
                  $("#comparision_submit_button").prop('disabled', false);
                  $('#comparison-modal').modal('hide');
                  location.reload(true);
              }
          },
          error: function (jqXHR) {
            console.log(jqXHR.responseText);
            // var errormsg = jQuery.parseJSON(jqXHR.responseText);
            // // alert(errormsg);
            // $.each(errormsg.errors,function(key,value) {
            //     $('#_comparision_error').html(value);
            // });
            toastr.error('Please Fill all Fields','Error');
           $("#comparision_submit_button").prop('disabled', false);

        }
        });
    });
  $("#terms_condition").submit(function(){
    event.preventDefault();
    var flagsUrl = '{{ URL::asset('/storage/uploads/terms_condition/') }}';
    // alert(flagsUrl);
    var formData = new FormData($(this)[0]);
    $(".terms_and_condition_button").prop('disabled', true);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache:false,
        data: formData,
        success: function (response) {   // success callback function
            if(response.success === true){

              toastr.success('Terms and Condition Added Successfully','Success');
              $(".terms_and_condition_button").prop('disabled', false);
                $('#tnc-modal').modal('hide');
                location.reload(true);
            }
            // else{
            //   console.log("arka");
            //   toastr.error('Terms and Condition Added Successfully','Error');
            // }
        },error: function (jqXHR) {
          var errormsg = jQuery.parseJSON(jqXHR.responseText);
          $(".terms_and_condition_button").prop('disabled', false);
          if(errormsg.status == 'error')
          {
            toastr.error(errormsg.errors,'Error');
            // console.log(errormsg);
          }
          else{
            // var errormsg = jQuery.parseJSON(jqXHR.responseText);
            $.each(errormsg.errors,function(key,value) {
                $('#'+key+'_error').html(value);
            });
          }
            // $('#travel-btn').attr('disabled',false);
           
        }
    });
  });


  $("#add_offer").submit(function(){

    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $(".offers_submit_button").prop('disabled', true);
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
          $(".offers_submit_button").prop('disabled', false);

            toastr.success('Offers added Sucessfully','Success');
            $('#customer-doc-modal').modal('hide');

            location.reload(true);
          }

        },error: function (jqXHR) {
          $(".offers_submit_button").prop('disabled', false);

            // $('#travel-btn').attr('disabled',false);
            var errormsg = jQuery.parseJSON(jqXHR.responseText);
            $.each(errormsg.errors,function(key,value) {
                $(".text-danger").show();
                $('#'+key+'_offer_error').html(value);
            });
        }
    });
  });

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

    $(".delete_logo").click(function()
    {
      var insuer_id = $(this).attr("id");
      // alert(insuer_id);
      if(insuer_id === undefined)
      {
        toastr.warning('This is a demo Picture','warning');
      }
      else{
        var result = confirm("Are you sure you want to delete?");
          if (result == true)
          {
            var flagsUrl = 'https://via.placeholder.com/60';
            $.ajax({
              type: 'POST',
              url: "{{ route('delete_insurer_logo') }}",
              data: {'insurer_id':insuer_id,"_token": " {{ csrf_token() }}"},
              dataType: 'json',
              success: function (response){
                if(response.success == true)
                {
                  toastr.success( 'Delete Sucessfully');
                  $("#logo-upload").attr("src",flagsUrl);
                  $(".delete_logo").attr("id",null);
                  $('#addLogo-modal').modal('hide');
                }
              }
            });
          }
      }


    });
    $('#amount_of').keyup(function(){
      $('#amount_of_offer_error').html('');
      $('#percentage_of_offer_error').html('');
      $('#meassage_offer_error').html('');
      $("#policy_name_offer_error").html('');
    });
    $("#offer_name").keyup(function(){
      $("#policy_name_offer_error").html('');
      $("#offer_name_offer_error").html('');
    });
    $("#extra_amount_id").keyup(function(){
      $("#policy_name_offer_error").html('');
      $("#extra_amount_offer_error").html('');
      $('#amount_of_offer_error').html('');
      $('#percentage_of_offer_error').html('');
      $('#meassage_offer_error').html('');
    });
    $('#percentage_of').keyup(function(){
      $('#amount_of_offer_error').html('');
      $('#percentage_of_offer_error').html('');
      $('#meassage_offer_error').html('');
      $("#policy_name_offer_error").html('');
    });
    $(".extra_number_only").keypress(function (e){
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
      }
    });
  </script>

@endsection
