<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

  <!-- Data Table -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <!-- END -->
  <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/responsive.css')}}">
  <link rel="stylesheet" href="{{URL::asset('bower_components/Ionicons/css/ionicons.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
  <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
    <link rel="stylesheet" href="{{URL::asset('plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
      .date_range {
        background: url("{{URL::asset('img/calendar.png')}}") center right 10px no-repeat
          transparent;
        cursor: pointer;
        margin-bottom: 30px;
      }
      #dataTableCustomer_filter .input-sm {
        background: url("{{URL::asset('img/search.png')}}") center right 10px no-repeat
          transparent;
      }
      .dataTables_filter .input-sm {
        background: url("{{URL::asset('img/search.png')}}") center right 10px no-repeat
          transparent;
      }

    </style>

  @yield('css')
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
  @php
    $user_name = Auth::user()->name;
    $user_image = Auth::user()->profile_image;
    if(isset($user_image))
    {
        $image = 'storage/uploads/'.$user_image;
    }
    else{
      $image = 'img/user.png';
    }
    $user_created_at = Auth::user()->created_at;

    $user_date_informat = date('F-Y',strtotime($user_created_at));

  @endphp
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels --> <span class="logo-mini"><b>S</b>ig</span>
        <!-- logo for regular state and mobile devices --> <span class="logo-lg"><b>My</b>Sig</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle
            navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu message">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu message_list">
                <li class="header message_listItem">You have 4 messages</li>
                <li class="message_listItem">
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu message_dropList">
                    <li class="message_dropListItem">
                      <!-- start message -->
                      <a href="#" class="message_dropListLink">
                        <div class="pull-left">
                          <img src="{{URL::asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                    <li class="message_dropListItem">
                      <a href="#" class="message_dropListLink">
                        <div class="pull-left">
                          <img src="{{URL::asset('img/user3-128x128.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          AdminLTE Design Team
                          <small><i class="fa fa-clock-o"></i> 2 hours</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <li class="message_dropListItem">
                      <a href="#" class="message_dropListLink">
                        <div class="pull-left">
                          <img src="{{URL::asset('img/user4-128x128.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Developers
                          <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <li class="message_dropListItem">
                      <a href="#" class="message_dropListLink">
                        <div class="pull-left">
                          <img src="{{URL::asset('img/user3-128x128.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Sales Department
                          <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <li class="message_dropListItem">
                      <a href="#" class="message_dropListLink">
                        <div class="pull-left">
                          <img src="{{URL::asset('img/user4-128x128.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Reviewers
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer message_listItem"><a href="#" class="message_listLink">See All Messages</a>
                </li>
              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu notification">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu notification_list">
                <li class="header notification_listItem">You have 10 notifications</li>
                <li class="notification_listItem">
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu notification_dropList">
                    <li class="notification_dropListItem">
                      <a href="#" class="notification_dropListLink"> <i class="fa fa-users text-aqua"></i> 5 new members
                        joined today</a>
                    </li>
                    <li class="notification_dropListItem">
                      <a href="#" class="notification_dropListLink"> <i class="fa fa-warning text-yellow"></i> Very long
                        description here that may not fit into the page and may cause design problems</a>
                    </li>
                    <li class="notification_dropListItem">
                      <a href="#" class="notification_dropListLink"> <i class="fa fa-users text-red"></i> 5 new members
                        joined</a>
                    </li>
                    <li class="notification_dropListItem">
                      <a href="#" class="notification_dropListLink"> <i class="fa fa-shopping-cart text-green"></i> 25
                        sales made</a>
                    </li>
                    <li class="notification_dropListItem">
                      <a href="#" class="notification_dropListLink"> <i class="fa fa-user text-red"></i> You changed
                        your username</a>
                    </li>
                  </ul>
                </li>
                <li class="footer notification_listItem"><a href="#" class="notification_listLink">View all</a>
                </li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{URL::asset($image)}}" class="user-image" alt="User Image"> <span class="hidden-xs">{{$user_name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{URL::asset($image)}}" class="img-circle" alt="User Image">
                  <p>{{ $user_name}} <small>Member since {{$user_date_informat}}</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left"> <a href="{{route('user_profile')}}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right"> <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{URL::asset($image)}}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ $user_name}}</p>
            @if(isset(Auth::user()->status))
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            @else
              <a href="#"><i class="fa fa-exclamation-circle"></i> Offline</a>
            @endif
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu sidebar_list" data-widget="tree">
          <li class="header sidebar_listItem">MAIN NAVIGATION</li>
          <li class="sidebar_listItem">
            <a href="{{route('home')}}" class="sidebar_listLink"> <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="active treeview sidebar_listItem menu-open">
            <a href="#" class="sidebar_listLink"> <i class="fa fa-dashboard"></i> <span>Policies</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu sidebar_dropList">
              <li class="sidebar_dropListItem">
                <a href="{{route('user_upcoming_policy')}}" class="sidebar_dropListLink"> <i class="fa fa-circle-o"></i>
                  Upcoming Policy</a>
              </li>
              <li class="sidebar_dropListItem">
                <a href="{{route('user_converted_policy')}}" class="sidebar_dropListLink"> <i class="fa fa-circle-o"></i>
                  Converted Policy</a>
              </li>

              <li class="sidebar_dropListItem">
                <a href="{{route('failed-payment-policy')}}" class="sidebar_dropListLink"> <i class="fa fa-circle-o"></i>
                   Failed Payment</a>
              </li>

            </ul>
          </li>
          <li class="sidebar_listItem">
            <a href="{{route('user_customer_policy')}}" class="sidebar_listLink"> <i class="fa fa-users" aria-hidden="true"></i>
              <span>Customers</span>
            </a>
          </li>         
          <li class="sidebar_listItem">
            <a href="{{route('user_claimed')}}" class="sidebar_listLink"> <i class="fa fa-files-o"></i></i> <span>Claims</span>
            </a>
          </li>
          <li class="sidebar_listItem">
            <a href="{{route('user_reporting')}}" class="sidebar_listLink"> <i class="fa fa-edit"></i></i> <span>Reporting</span>
            </a>
          </li>
          <li class="sidebar_listItem">
            <a href="{{route('user_insurer')}}" class="sidebar_listLink"> <i class="fa fa-american-sign-language-interpreting"
                aria-hidden="true"></i>
              <span>Insurer</span>
            </a>
          </li>
          <li class="sidebar_listItem">
            <a href="{{route('contact_view')}}" class="sidebar_listLink"> <i class="fa fa-phone-square" aria-hidden="true"></i>
              <span>Contact</span>
            </a>
          </li>
          <!-- <li class="sidebar_listItem">
            <a href="#" class="sidebar_listLink" data-toggle="modal" data-target="#myModal"> <i class="fa fa-money" aria-hidden="true"></i>
              <span>COD Payment</span>
            </a>
          </li> -->
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    @yield('content')

    <!-- /.content-wrapper -->
    <footer class="main-footer">
    <?php $year = date('Y');?>
      <div class="pull-right hidden-xs"> <b>Version</b> 1.0</div> <strong>Copyright &copy; <?php echo date('Y');?> <a href="{{route('home')}}"
          class="sig">MySig</a>.</strong> All rights reserved.
    </footer>
  </div>

 

  <!-- ./wrapper -->
  <script src="{{ asset('js/app.js') }}"></script>
  
  <!-- jQuery 3 -->
  <script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" href="{{URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
  <script src="{{URL::asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <script src="{{URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>


  <!-- Data Table -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <!-- END -->
  <script src="{{URL::asset('js/pages/dashboard2.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
  <script src="{{URL::asset('js/adminlte.min.js')}}"></script>
  <script src="{{URL::asset('js/demo.js')}}"></script>
  <script src="{{URL::asset('js/main.js')}} "></script>
  <script src="{{URL::asset('js/modals/global-post.js')}} "></script>
  <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{URL::asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
  <script src="{{URL::asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
  <script src="{{URL::asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
  <script src="{{URL::asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
  <script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{URL::asset('bower_components/fastclick/lib/fastclick.js')}}"></script>

	<script src="{{URL::asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
	<script src="{{URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
	<script src="http://cdn.craig.is/js/rainbow-custom.min.js"></script>
  <script src=" {{URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}} "></script>
  <script src=" {{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script>
  <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js'></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script>
      var insurerUrl = '{{URL::asset('insurer/insurer-profile/')}}';
      var insurerPolicyUrl = '{{URL::asset('insurer/policy/')}}';
  </script>

<script>
    // INCLUDE JQUERY & JQUERY UI 1.12.1
    $(function () {
      $("#cod_datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
      });
    });
  </script>
  
  {!! Toastr::message() !!}
  @yield('add-js')
  
  <!-- <script src=" {{URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}} "></script>
  <script src=" {{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script> -->
</body>
</html>

