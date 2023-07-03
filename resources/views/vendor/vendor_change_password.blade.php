@extends('vendor.vendor_dashboard')

@section('vendor')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Change Password</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Change Password</li>
                </ol>
            </nav>
        </div>
     
    </div>

    <!-- wrapper -->
	
					<div class="card">
						<div class="row g-0">
							<div class="col-lg-5 border-end">
								<div class="card-body">
									<div class="p-5">
										<div class="sidebar-header">
                                            <div>
                                                <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
                                            </div>
                                            <div>
                                                <h4 class="logo-text">MVE - Vendor</h4>
                                            </div>
                                            
                                        </div>
										<h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
										
										<form method="post" action="{{ route('vendor.update.password') }}"  >
											@csrf
								
												@if (session('status'))
													<div class="alert alert-success" role="alert">
															{{session('status')}}
													</div>
												@elseif(session('error'))
													<div class="alert alert-danger" role="alert">
														{{session('error')}}
													</div>
												@endif

												<div class="mb-3">
													<label class="form-label">Old Password</label>
													<input type="password" name="old_password"   id="current_password"  class="form-control @error('old_password') is-invalid @enderror" placeholder="Enter old password" />
												    
													@error('old_password')
													  <span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="mb-3">
													<label class="form-label">New Password</label>
													<input type="password" name="new_password"  id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Enter new password" />
												    
													@error('new_password')
													  <span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="mb-3">
													<label class="form-label">Confirm Password</label>
													<input type="password" name="new_password_confirmation"  id="new_password_confirmation" class="form-control" placeholder="Confirm password" />
												</div>
												<div class="d-grid gap-2">
													<button type="submit" class="btn btn-primary">Change Password</button> <a href="{{route('vendor.logout')}}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
												</div>
										</form>			
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<img src="{{ asset('adminbackend/assets/images/login-images/forgot-password-frent-img.jpg')}}" class="card-img login-img h-100" alt="...">
							</div>
						</div>
					</div>
				
	<!-- end wrapper -->


</div>    

@endsection