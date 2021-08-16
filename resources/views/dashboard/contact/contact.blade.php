@extends('layouts.master')
@section('title','MySIg by Fidentia | Contact')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Contact Info
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb_listItem"><a href="#" class="breadcrumb_listLink"><i class="fa fa-dashboard"></i>
                    Home</a>
            </li>
            <li class="active breadcrumb_listItem">Contact Info</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form  action="{{ route('contact_create') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="Name">Address</label>
                                        <textarea id="" class="form-control" name="address" rows="3" required>@if(@$address_details!=null){{$address_details['address']}}@endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">Primary Phone no.</label>
                                        @if(@$address_details!=null)
                                        <input type="number" class="form-control" name="primary_number" value="{{$address_details['primary_number']}}" type="text" required>
                                        @else
                                        <input type="number" class="form-control" name="primary_number" value="" type="text" required>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">Alternative Phone no.</label>
                                        @if(@$address_details!=null)
                                        <input type="number" class="form-control" name="alternate_number"  value="{{$address_details['alternate_number']}}" type="text">
                                        @else
                                        <input type="number" class="form-control" name="alternate_number"  value="" type="text" required>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">Email</label>
                                        @if(@$address_details!=null)
                                        <input class="form-control" name="email" value="{{$address_details['email']}}" type="email" required>
                                        @else
                                        <input class="form-control" name="email" value="" type="email" required>
                                        @endif
                                    </div>
                                </div>
                            </div>
                      <button type="submit" class="btn btn-block text-white" style="background-color: #9592c1; font-size: 12px; font-weight: 600; padding: 0.575rem .75rem;">SUBMIT</button>

                    </div>
                    </form>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
