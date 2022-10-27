<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>


   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->

         @include('home.header')   

         @include('home.flash_message')


         <!-- end header section -->
            @yield('site')
         <!-- footer start -->

         @include('home.footer')

        <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© All Rights Reserved By
             <a href="https://www.facebook.com/m7.alalamy/">Mohamed Alalamey</a><br>
         </p>
      </div>
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>

      <script>
            function reply(caller){
               document.getElementById('commentId').value 
                  = $(caller).attr('data-commentid');
               $('.replyDiv').insertAfter($(caller));
               $('.replyDiv').show();
            }

            function reply_close(caller){
               $('.replyDiv').hide();
            }
      </script>

      <script>
            document.addEventListener("DOMContentLoaded", function(event) { 
                  var scrollpos = localStorage.getItem('scrollpos');
                  if (scrollpos) window.scrollTo(0, scrollpos);
            });

            window.onbeforeunload = function(e) {
                  localStorage.setItem('scrollpos', window.scrollY);
            };
      </script>
  
   </body>
</html>