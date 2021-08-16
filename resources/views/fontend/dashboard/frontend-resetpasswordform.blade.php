@extends('fontend.layouts.frontend-master')
@section('title','MySIg by Fidentia | Buy')
@section('content')

/*************** Reset Password Form ******************/

<h1>Reset Password Form</h1>

<form role="form">
    <div class="container">
        <div class="card-body">
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Old Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="New Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirm New Password">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Change</button>
        </div>
    </div>
</form>

    
    

@endsection
