<html>

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{URL::asset('frontend/css/style.css')}}" rel="stylesheet">
  <link href="{{URL::asset('frontend/css/media.css')}}" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
  <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{ url('country_code/build/css/intlTelInput.min.css') }}">
  @yield('styles')

</head>
<!-- C:\xampp\htdocs\mysig\public\frontend\css -->
<body>

@yield('content')


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
  <script src=" {{URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}} "></script>
  <script src=" {{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script>
  <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{ url('country_code/build/js/intlTelInput.min.js') }}"></script>
 

<script type="text/javascript">

  window.onload = () => {
    let dropBtn = document.querySelector('#headerDropDown');
    let dropDown = document.querySelector('#myDropdown');
    
    dropBtn.addEventListener('click', function(ev) {
      dropDown.classList.toggle("show");
    })
  
    document.addEventListener('click', function(ev) {
      const target = ev.target;
      
      if (target.closest('#headerDropDown') || target.closest('#myDropdown')) {
        return;
      }

      dropDown.classList.remove("show");
    });
  }

  $(function(){
    // $(".menu-toggle-btn").click(function () {
    //             $(this).toggleClass("fa-times");
    //             $(".navigation-menu").toggleClass("active");
    //         });
    //         $(document).on('click', function(e){
    //             if(!$(e.target).hasClass('menu-toggle-btn')){
    //                 $(".navigation-menu").removeClass("active");
    //             }
    //         });

    

    var current = location.pathname;
    $('.auth-btn').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
          $this.addClass('active');
        }
    })

    var header = document.getElementById("myDIV");
    var btns = header.getElementsByClassName("car-list");
      for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        if (current.length > 0) { 
          current[0].className = current[0].className.replace(" active", "");
        }
        this.className += " active";
        });
      }
  });
</script>

<script>
    /*Dropdown Menu*/
    $(function () {
       $('.dropdown').click(function () {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.dropdown-menu').slideToggle(300);
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
  // Add active class to the current button (highlight it)
  
</script>

<script>
  /* When the user clicks on the button, 
  toggle between hiding and showing the dropdown content */
  // function myFunction() {
  //   document.getElementById("myDropdown1").classList.toggle("show");
  // }

  // Close the dropdown if the user clicks outside of it
  // window.onclick = function (e) {
  //   if (!e.target.matches('.dropbtns1')) {
  //     var myDropdown1 = document.getElementById("myDropdown1");
  //     if (myDropdown1.classList.contains('none')) {
  //       myDropdown1.classList.remove('none');
  //     }
  //   }
  // }

  $(document).ready(function(){
        // Show hide popover
        $(".dropdowns").click(function(){
            $(this).find("#myDropdown1").slideToggle("medium");
        });
    });
    $(document).on("click", function(event){
        var $trigger = $(".dropdowns");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $("#myDropdown1").slideUp("medium");
        }            
    });

// window.addEventListener ('mouseup', function(event){
//   var myDropdow = document.getElementById('myDropdown1');
//   if (event.target != myDropdow) {
//     myDropdow.style.display = 'none';
//   }
// });
//*** Creating active button either for Login or Register */


</script>

<script>
  /* When the user clicks on the button, 
  toggle between hiding and showing the dropdown content */
  // function myDrop() {
  //   document.getElementById("aboutUs").classList.toggle("show");
  // }

  // Close the dropdown if the user clicks outside of it
  // window.onclick = function (e) {
  //   if (!e.target.matches('.dropbtns')) {
  //     var aboutUs = document.getElementById("aboutUs");
  //     if (aboutUs.classList.contains('remove')) {
  //       aboutUs.classList.remove('remove');
  //     }
  //   }
  // }

  $(document).ready(function(){
        // Show hide popover
        $(".dropdowns2").click(function(){
            $(this).find("#aboutUs").slideToggle("medium");
        });
    });
    $(document).on("click", function(event){
        var $trigger = $(".dropdowns2");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $("#aboutUs").slideUp("medium");
        }            
    });

</script>
@yield('add-js')
{!! Toastr::message() !!}

</body>

</html>