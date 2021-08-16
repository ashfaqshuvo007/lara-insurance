<html>

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{URL::asset('frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('frontend/css/media.css')}}" rel="stylesheet">
</head>

<body>

    <div id="app">
        <?php
        // dd($data);
            $token = null;
            $strings = null;
            if(!empty(Auth::user())){
                $user = Auth::user();
                $token = auth('api')->tokenById($user->id);

                $lang = config('app.locale');
                $files = glob(resource_path('lang/' . $lang . '/layout-body.php'));
                foreach ($files as $file) {
                    $strings = require $file;
                }
            }
            
        
        ?>
        <header class="header-policy {{ (isset($data) && @$data['i_frame']) ? 'd-none' : ''}}">
            <div class="container">
                <div class="row">
                    <div class="col-7 d-flex justify-content-end">
                        <a href="{{route('frontend_index')}}"><img src="{{url('frontend/images/Logo.png')}}"
                                class="logo-icon"></a>
                    
                    </div>
                    <div class="col-5 d-flex justify-content-end">
                        <div class="navbar-policy inner-width-policy">
                            <i class="policy-menu-toggle-btn fa fa-bars"></i>
                            <nav class="navigation-menu-policy home-nav">
                                <a href="{{route('frontend_policies')}}" class="text-white"><img
                                        src="{{URL::asset('frontend/images/Policy.png')}}" class="menu-icon mr-2">
                                        {{trans('layout-body.my_policies')}}</a>
                                <a href="{{route('frontend_claim')}}" class="text-white"><img
                                        src="{{URL::asset('frontend/images/Claim.png')}}"
                                        class="menu-icon mr-2">{{trans('layout-body.claims')}}</a>
                                <a href="#" class="text-white"><img src="{{URL::asset('frontend/images/Account.png')}}"
                                        class="menu-icon mr-2">{{trans('layout-body.account')}}</a>
                                <a href="{{route('frontend_logout')}}" class="text-white"><img
                                        src="{{URL::asset('frontend/images/Logout.png')}}"
                                        class="menu-icon mr-2">{{trans('layout-body.logout')}}</a>
                            </nav>
                        </div>

                        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('frontend_policies')}}">
                                    <img
                                        src="{{URL::asset('frontend/images/Policy.png')}}" class="menu-icon mr-2">
                                        {{trans('layout-body.my_policies')}}
                                    <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.html">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="gallery.html">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link quote btn-text" href="#" data-toggle="modal" data-target="#myModal">GET A QUOTE</a>
                                </li>
                                </ul>
                            </div>
                        </nav> -->

                        <select-language :base_url="'{{ url('/') }}'" :Auth="{{json_encode($token)}}" :locale="{{json_encode($strings)}}">
                        </select-language>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
    </div>
    @if(@!$data['i_frame'])
    @include('fontend.layouts.head-footer')
    @endif

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    
    
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
    </script> -->

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".policy-menu-toggle-btn").click(function () {
                $(this).toggleClass("fa-times");
                $(".navigation-menu-policy").toggleClass("active");
            });
            $(document).on('click', function(e){
                if(!$(e.target).hasClass('policy-menu-toggle-btn')){
                    $(".navigation-menu-policy").removeClass("active");
                }
            });
            // $('.policy-menu-toggle-btn').click(function () {
            //     $(this).attr('tabindex', 1).focus();
            //     $(this).toggleClass('fa-times');
            //     $(this).find('.navigation-menu-policy').slideToggle(300);
            // });
            // $('.policy-menu-toggle-btn').focusout(function () {
            //     $(this).removeClass('fa-times');
            //     $(this).find('.navigation-menu-policy').slideUp(800);
            // });


            // Contact file input
            $(document).on('change', '.file__input', function (evt) {
                File(evt);
            });

            function File(evt) {
                let target = evt.currentTarget;
                let fakeFile = $(evt.currentTarget).next('.file__input-fake');
                let fileName = target.files[0].name
                fakeFile.val(fileName);

                // console.log(target, fileName);
                // if (target.value == fileName) {
                //   file.val('');
                // }
            }
        });

    </script>

    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
   </script>


    <script>
    /*Dropdown Menu*/
    $(function () {
       $('.dropdown').click(function () {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.dropdown-menu').slideToggle(200);
        });
        $('.dropdown').focusout(function () {
            $(this).removeClass('active');
            // $(this).find('.dropdown-menu').slideUp(800);
        });
        $('.dropdown .dropdown-menu a').click(function () {
            $(this).parents('.dropdown').find('span').text($(this).text());
            $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
        });
    })
    </script>
    <script>
        function setCountry(code) {
            if (code || code == '') {
                var text = jQuery('a[cunt_code="' + code + '"]').html();
                $(".dropdown dt a span").html(text);
            }
        }
        $(document).ready(function () {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function () {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function () {
                //console.log($(this).html())
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("country-select"));
            });

            function getSelectedValue(id) {
                //console.log(id,$("#" + id).find("dt a span.value").html())
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function (e) {
                var $clicked = $(e.target);
                if (!$clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function () {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });

    </script>
    <script src="{{ asset('js/app.js') }}"></script>


    @yield('add-js')
</body>

</html>
