@extends('admin.layout.layout')
@section('title','Change Password')
@section('content')

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<!-- <li class="breadcrumb-item active"><a href="user_management.html">User Management</a></li> -->
								<li class="breadcrumb-item remove_hover">Change Password</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>
					<h1>Change Password</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<form method="POST" id="validate_form">
								{{@csrf_field()}}
							<div class="add_content">
								
									<label for="" class="pb-1">
										Old Password
									</label>
									<div class="form-group pb-3">
										<input type="password" name="old_password" class="form-control" placeholder="Enter Old Password" />
									</div>
							
							</div>
							<div class="add_content">
								
									<label for="" class="pb-1">
										New Password
									</label>
									<div class="form-group pb-3">
										<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password" />
									</div>
								
							</div>
							<div class="add_content">
								
									<label for="" class="pb-1">
										Confirm Password
									</label>
									<div class="form-group pb-3">
										<input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password" />
									</div>
								
							</div>
							<div class="text-center">
								
									<button type="submit" id="submit_btn" class="btn btn-warning same_wd_btn">Update</button>
								
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		@endsection()

		@section('js')

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


	 <script type="text/javascript">
    $(document).ready(function(){
        $("#validate_form").validate({
            rules : {
           	  old_password : {
                required: true
              },
              new_password : {
                required: true,
                minlength: 6,
                //maxlength:20
              },
              confirm_password : {
                required: true,
                equalTo:"#new_password"
              }
            },
            messages : {
            	old_password : {
            		required: "Please enter old password."
            	},
                new_password:{
                    required: "Please enter new password.",
                    minlength: "New password must be at least 6 characters long.",
                    //maxlength : "New password must be less than 20 characters."
                },
                confirm_password : {
                 required:"Please enter confirm password.",
                
                equalTo:"New password and confirm password must be same."
              }
            },
            submitHandler:function(form){
                $("#submit_btn").attr('disabled', true);
                form.submit();
            }
        });

        });
 </script>

		@endsection()