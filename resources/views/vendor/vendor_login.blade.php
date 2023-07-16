<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('adminbackend/assets/images/favicon-32x32.png') }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('adminbackend/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('adminbackend/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('adminbackend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/icons.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
	<title>MVE - Vendor Login Page</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" width="180" alt="" />
						    <h4 class="logo-text">MVE - Vendor</h4>
						</div>
						
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded " style="background-color:#F0F8FF">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										<p>Don't have an account yet? <a href="{{route('become.vendor')}}">Sign up here</a>
										</p>
									</div>
<!--

									<div class="d-grid">
										<a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                          <img class="me-2" src="{{ asset('adminbackend/assets/images/icons/search.svg') }}" width="16" alt="Image Description">
                          <span>Sign in with Google</span>
											</span>
										</a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
										<hr/>
									</div>
-->
									<div class="form-body">
										
                                        <form class="row g-3" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <!--
											<x-input-error :messages="$errors->get('email')" class="mt-2" style="color:red;"/>
											<x-input-error :messages="$errors->get('password')" class="mt-2" style="color:red;" />
                                            -->

											@error('email')
										       <div class=" alert alert-danger" role="alert">	
												<span class="text-danger"> {{ $message }} </span>
											   </div>
											@enderror

											<div class="col-12">
												<label for="email" class="form-label">Email Address</label>
												<input class="form-control @error('email') is-invalid @enderror"  placeholder="Email Address" id="email"  type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
												
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input  class="form-control border-end-0 " id="password"  type="password" name="password" value="" placeholder="Enter Password" required autocomplete="current-password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                
												</div>
											</div>
											<div class="form-group">
												<input type="hidden" id="role"   name="role" value="vendor" />
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="remember_me" name="remember" checked>

													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="{{ route('password.request') }}">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
												<br>
												<div class="d-grid text-center">
													<a href="{{ route('welcome') }}">Home</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('adminbackend/assets/js/app.js') }}"></script>
    <!--Toaster JS-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>
</body>

</html>