@extends('layouts.master')
@section('title','MySIg by Fidentia | Insurer')
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <h1>
          Insurer
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">Insurer</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="insurer_head">
                  <h3 class="box-title">Insurer</h3>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add
                    Insurer</button>
                </div>
              </div>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                          aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['route'=>'add_insurer','role'=>'form','files'=>true,'id'=>'form-add-insurer','autocomplete' => 'off','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                          {{Form::label('Insurer Name')}}
                          {{Form::text('name',null,['class'=>'form-control','id'=>'insurer_name'])}}
                          <div class="text-danger"><strong id="name_error_name"></strong></div>
                        </div>
                        <div class="form-group">
                          {{Form::label('Status')}}
                          {{Form::select('status',array('1'=>'Active',
                                                        '2'=>'Inactive'),null,['class'=>'form-control'])}}
                        </div>
                        {{Form::submit('Add',['class'=>'btn btn-primary','id'=>'insurer_btn','name'=>'submit_button'])}}
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class=" table table-bordered table-striped" id="insurer_table">
                        <thead>
                          <tr role="row">
                            <th>Insurer</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody id="insurers_table">
                        @foreach($all_insure as $key => $insurer)
                        <tr role="row" class="odd insurer_tr "  onclick="window.open('{{route('user_insurer_profile',$insurer['insurer_id'])}}','_self')">
                            <td class="sorting_1">{{$insurer['name']}}</td>
                            <td>
                              @if($insurer['status'] == 1)
                                <a class="active-btn" href="{{route('user_insurer_profile',$insurer['insurer_id'])}}">Active</a>
                              @else
                                <a class="delivered in" href="{{route('user_insurer_profile',$insurer['insurer_id'])}}">Inactive</a>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </section>
    </div>
@endsection
@section('add-js')
  <script src="{{URL::asset('js/modals/insurer/insurer.js')}}"></script>
@endsection

