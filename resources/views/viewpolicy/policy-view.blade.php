@extends('layouts.master')
@section('title','MySIg by Fidentia | View  Policy')

@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          View Policy
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
              Home</a>
          </li>
          <li class="active breadcrumb_listItem">View Policy</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-7">
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered ">
                        <thead>
                          <tr>
                            <th>Incomplete Policies</th>
                            <th class="text-right">
                              <span class="label label-secondary">0</span> &nbsp;
                              <a href="#" class="update_link"><i class="fa fa-cog"
                                aria-hidden="true"></i></a> &nbsp;
                                <a href="#" class="update_link"><i class="fa fa-file-o"
                                  aria-hidden="true"></i></a> &nbsp;
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
                                      <th>No incomplete policies</th>
                                      <td></td>
                                      <td></td>
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
                      <table class="fold-table table table-bordered ">
                        <thead>
                          <tr>
                            <th >Upcoming Policies/ Renewals</th>
                            <th class="text-right">
                              <span class="label label-secondary">0</span> &nbsp;
                              <a href="#" class="update_link"><i class="fa fa-cog"
                                aria-hidden="true"></i></a> &nbsp;
                              <a href="#" class="update_link"><i class="fa fa-file-o"
                                  aria-hidden="true"></i></a>  &nbsp;
                            </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr >
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv table-responsive">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th>Please set the "day in advance" setting to view ending
                                        policies</th>
                                      <td ></td>
                                      <td></td>
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
                      <table class="fold-table table table-bordered ">
                        <thead>
                          <tr>
                            <th>Loss Information</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="">
                            <td class="no-padding pb_36" colspan="10">
                              <div class="history-infoTablDiv">
                                <table class="table_style table_style_info">
                                  <tbody>
                                    <tr>
                                      <th >Location of loss or incident & Description</th>
                                      <td ></td>
                                      <td ></td>
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
                        <div class="doc_table_title ">
                          <h5> Document From Customer</h5>
                        </div>
                        <div>
                          <ul class="document_icon_list">
                            <li class="document_icon_listLink">
                              <div><span class="label label-secondary">1</span>
                              </div>
                            </li>
                            <li class="document_icon_listLink"> <a href="#" class="doc_link update_link"><i
                                  class="fa fa-cog" aria-hidden="true"></i></a>
                            </li>
                            <li class="document_icon_listLink"> <a href="#" class="doc_link update_link"><i
                                  class="fa fa-filter" aria-hidden="true"></i></a>
                            </li>
                            <li class="document_icon_listLink"> <a href="#" class="doc_link update_link"><i
                                  class="fa fa-file-o" aria-hidden="true"></i></a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="home_policyview_table">
                          <thead>
                            <tr>
                              <th >Invoice No.</th>
                              <th >Product</th>
                              <th >Due Date</th>
                              <th >Sum</th>
                              <th >CNT</th>
                              <th ></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>2
                                <br>
                                <h6>aaa bbb</h6>
                              </td>
                              <td>Home</td>
                              <td>29.03-2020
                                <h6>(1day over due)</h6>
                              </td>
                              <td>250.00EUR</td>
                              <td>--</td>
                              <td><a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                            <tr>
                              <td>2
                                <br>
                                <h6>ccc bbb</h6>
                              </td>
                              <td>Home</td>
                              <td>29.03-2020
                                <h6>(1day over due)</h6>
                              </td>
                              <td>250.00EUR</td>
                              <td>--</td>
                              <td><a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="table-responsive">
                      <table class="fold-table table table-bordered ">
                        <thead>
                          <tr>
                            <th>Reminders</th>
                            <th><a href="#" class="update_link"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </th>
                            <th><a href="#" class="update_link"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </th>
                            <th><a href="#" class="update_link"><i class="fa fa-file-o" aria-hidden="true"></i></a>
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
                                      <th>No Reminders</th>
                                      <td ></td>
                                      <td ></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
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