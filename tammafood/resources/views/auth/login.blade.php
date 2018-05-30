@extends('layouts.app')

@section('content')
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{asset('assets/login-v18/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/login-v18/css/main.css')}}">
<!--===============================================================================================-->

<body style="background-color: #666666;">
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form id="login-form" class="login100-form validate-form" method="get" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <span class="login100-form-title p-b-43">
                        Nabila Bakery
                    </span>
                    
                    
                    <div class="wrap-input100 validate-input" data-validate = "Username / E-mail is required">
                        <input class="input100" type="text" name="username" id="username" autofocus>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>
                    
                    
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" name="password" id="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <!-- <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div> -->
                    </div>
            

                    <div class="container-login100-form-btn">
                        <button type="button" onclick="login()" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    
                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                           {{date('Y')}} &copy; Created By
                        </span>
                    </div>

                    <div class="login100-form-social flex-c-m">
                        <a href="http://www.alamraya.co.id/" target="_blank" class="txt2 btn-link">Alamraya Sebar Barokah</a>
                        <!-- <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a> -->
                    </div>
                </form>

                <div class="login100-more" style="background-image: url('assets/img/bakery-bg1.jpg');">
                </div>
            </div>
        </div>
    </div>
    
    

    
    
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('assets/login-v18/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('assets/login-v18/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('assets/login-v18/js/main.js')}}"></script>

    <script type="text/javascript">

    function login(){
          
            if(validateForm()){
                 
                $.ajax({
                    url         : baseUrl+'/login',
                    type        : 'get',
                    timeout     : 10000,
                    data        : $('#login-form').serialize(),
                    dataType    : 'JSON',
                    success     : function(response){
                        
                        //alert(response.content);
                        //console.log(response);
                          if(response.status == 'sukses'){


                            window.location = baseUrl+'/home';

                        }
                        else if(response.status == 'gagal'){
                            $('.error-load').removeClass('hidden');
                            $('.error-load small').text(response.data);
                            
                            
                        }
                    },
                    error       : function(xhr, status){
                        if(status == 'timeout'){
                            $('.error-load').removeClass('hidden');
                            $('.error-load small').text('Ups. Terjadi Kesalahan, Coba Lagi Nanti');
                        }
                        else if(xhr.status == 0){
                            $('.error-load').removeClass('hidden');
                            $('.error-load small').text('Ups. Koneksi Internet Bemasalah, Coba Lagi Nanti');
                        }
                        else if(xhr.status == 500){
                           $('.error-load').removeClass('hidden');
                            $('.error-load small').text('Ups. Server Bemasalah, Coba Lagi Nanti');
                        }

                       
                    }
                });

            }
    }

    
        var baseUrl = '{{ url('/') }}';
        
     

        function validateForm(){
            
            var username = document.getElementById('username');
            var password = document.getElementById('password');

            //alert(username.value);

            if(username.validity.valueMissing){
                $('#username-error').removeClass('hidden');
                return false;
            }
            else if(password.validity.valueMissing){
                $('#password-error').removeClass('hidden');
                return false;
            }

            return true;
        }


  

    </script>

</body>      

@endsection

@section('extra_scripts')

@endsection
