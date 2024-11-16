@extends('admin.layout.layout')
@section('title','Add User')
@section('content')

<style type="text/css">
	span#profile_picture_error {
    position: absolute;
    right: 0;
    left: 0;
    margin-top: 15px;
    color: #ff0000!important;
    font-size: 100%!important;
    width: 300px;
    margin-left: -78px;
}


.add_content .row {
    display: flex;
    gap: 16px; /* Optional spacing between fields */
}

.add_content .row > div {
    flex: 1; /* Each field takes up equal space */
}

.yellow-radio {
    appearance: none; /* Remove default styling */
    -webkit-appearance: none; /* For Safari */
    width: 18px;
    height: 18px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    outline: none;
    cursor: pointer;
    background-color: white;
    position: relative;
}

.yellow-radio:checked {
    background-color: #57b4ca!important;
}


label#swd_name-error {
    color: #ff0000 !important;
    font-size: 100% !important;
    margin-top: -15px !important;
    display: flex;
    position: relative;
    margin-left: 24%;
}

</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.userManagement')}}">User Management</a></li>
								<li class="breadcrumb-item remove_hover">Add User</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>

						@include('admin.layout.notification')
						
					</div>
					<h1>Add User</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<form method="POST" enctype="multipart/form-data" id="validate_form">
								{{@csrf_field()}}


								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="sponser_id" class="pb-1">Sponser ID</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<!-- <input type="text" class="form-control" placeholder="Enter Sponser ID" name="sponser_id" /> -->

												<select class="form-control form-group" style="padding: .6rem 1rem; position: relative;" name="sponser_id" placeholder="Select Sponser ID">
												<option value="">Select Sponser ID</option>
													@foreach($allUserIds as $customUserID)
													<option value="{{$customUserID}}">{{$customUserID}}</option>
													@endforeach()
												</select>
												@if($errors->first('sponser_id'))
													<span class="text-danger error">{{$errors->first('sponser_id')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="upline_id" class="pb-1">Upline ID</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
											<select class="form-control form-group" style="padding: .6rem 1rem; position: relative;" name="upline_id" placeholder="Select Upline ID">
												<option value="">Select Sponser ID</option>
													@foreach($allUserIds as $customUserID)
													<option value="{{$customUserID}}">{{$customUserID}}</option>
													@endforeach()
												</select>
												@if($errors->first('upline_id'))
													<span class="text-danger error">{{$errors->first('upline_id')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>

								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="name" class="pb-1">Name</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Name" name="name" />
												@if($errors->first('name'))
													<span class="text-danger error">{{$errors->first('name')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="" class="pb-1">
												DOB
											</label>
											<span class="artisan-star">*</span>

											<?php 
												$carbon_max_calander_date = Carbon\Carbon::now()->subYear(12)->format('Y-m-d');
											?>

											<div class="form-group pb-3" style="position: relative;">
												<input type="date" class="form-control" name="dob" min="1920-01-01" max="{{$carbon_max_calander_date}}" placeholder="Enter Date of Birth" onkeydown="return false"/>

												<!-- <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth"/> -->

												@if($errors->first('dob'))
												<span class="text-danger error">{{$errors->first('dob')}}</span>
												@endif()

											</div>
										</div>
								
									</div>
								</div>

								<div class="add_content">
									<div class="row">
										<!-- Field with Checkboxes -->
										<div class="col-md-12">
											<label for="swd_name" class="pb-1">Relation Name</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3" style="display: flex; align-items: center;">
												<!-- Checkboxes -->
												<div class="relation-checkboxes" style="display: flex; gap: 15px; margin-right: 15px;">
													<label>
														<input type="radio" checked name="s_w_d" value="Sun Off" class="yellow-radio"> S/O
													</label>
													<label>
														<input type="radio" name="s_w_d" value="Daughter Off" class="yellow-radio"> D/O
													</label>
													<label>
														<input type="radio" name="s_w_d" value="Wife Off" class="yellow-radio"> W/O
													</label>
												</div>

												<!-- Input Field -->
												<input type="text" class="form-control" id="swd_name" name="swd_name" placeholder="Enter Name" />
											</div>
											<!-- Validation Error -->
											@if($errors->first('swd_name'))
												<span class="text-danger error">{{$errors->first('swd_name')}}</span>
											@endif

											<label id="swd_name-error" style="display:none" class="error" for="swd_name">Please enter name.</label>
										</div>

										

									</div>
								</div>


								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="nomination_name" class="pb-1">Nomination Name</label>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Nomination Name" name="nomination_name" />
												@if($errors->first('nomination_name'))
													<span class="text-danger error">{{$errors->first('nomination_name')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="" class="pb-1">
												Nomination DOB
											</label>

											<?php 
												$carbon_max_calander_date = Carbon\Carbon::now()->subYear(12)->format('Y-m-d');
											?>

											<div class="form-group pb-3" style="position: relative;">
												<input type="date" class="form-control" name="nomination_dob" min="1920-01-01" max="{{$carbon_max_calander_date}}" placeholder="Enter Nomination DOB" onkeydown="return false"/>

												<!-- <input type="date" class="form-control" name="dob" placeholder="Enter Nomination DOB"/> -->

												@if($errors->first('nomination_dob'))
												<span class="text-danger error">{{$errors->first('nomination_dob')}}</span>
												@endif()

											</div>
										</div>
								
									</div>
								</div>


								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="mobile_number" class="pb-1">Mobile Number</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
											<input type="tel" autocomplete="off" class="form-control" name="mobile_number" id="phone_number" placeholder="Enter Mobile Number"/>
												@if($errors->first('mobile_number'))
													<span class="text-danger error">{{$errors->first('mobile_number')}}</span>
												@endif

												<label id="phone_number-error" style="display:none" class="error" for="phone_number" style="">Please enter mobile number.</label>
											</div>
										</div>

										<div class="col-md-6">
											<label for="email" class="pb-1">Email</label>
											<div class="form-group pb-3">
												<input type="email" class="form-control" placeholder="Enter Email" name="email" />
												@if($errors->first('email'))
													<span class="text-danger error">{{$errors->first('email')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>
							
								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="adhar_number" class="pb-1">Aadhar Number</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Aadhar Number" name="adhar_number" />
												@if($errors->first('adhar_number'))
													<span class="text-danger error">{{$errors->first('adhar_number')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="pan_number" class="pb-1">PAN Number</label>
											<!-- <span class="artisan-star">*</span> -->
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter PAN Number" name="pan_number" />
												@if($errors->first('pan_number'))
													<span class="text-danger error">{{$errors->first('pan_number')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>

								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="bank_account_number" class="pb-1">Bank Account Number</label>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Bank Account Number" name="bank_account_number" />
												@if($errors->first('bank_account_number'))
													<span class="text-danger error">{{$errors->first('bank_account_number')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="bank_name" class="pb-1">Bank Name</label>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Bank Name" name="bank_name" />
												@if($errors->first('bank_name'))
													<span class="text-danger error">{{$errors->first('bank_name')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>

								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="bank_ifsc_code" class="pb-1">Bank IFSC Code</label>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Bank IFSC Code" name="bank_ifsc_code" />
												@if($errors->first('bank_ifsc_code'))
													<span class="text-danger error">{{$errors->first('bank_ifsc_code')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="bank_branch_name" class="pb-1">Bank Branch Name</label>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Bank Branch Name" name="bank_branch_name" />
												@if($errors->first('bank_branch_name'))
													<span class="text-danger error">{{$errors->first('bank_branch_name')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>


								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="address" class="pb-1">Address</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Address" name="address" />
												@if($errors->first('address'))
													<span class="text-danger error">{{$errors->first('address')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="country" class="pb-1">country</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter country" name="country" />
												@if($errors->first('country'))
													<span class="text-danger error">{{$errors->first('country')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>


								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="city" class="pb-1">city</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter city" name="city" />
												@if($errors->first('city'))
													<span class="text-danger error">{{$errors->first('city')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="state" class="pb-1">State</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter State" name="state" />
												@if($errors->first('state'))
													<span class="text-danger error">{{$errors->first('state')}}</span>
												@endif
											</div>
										</div>
								
									</div>
								</div>

								<div class="add_content">
									<div class="row">
										<!-- Name Field -->
										<div class="col-md-6">
											<label for="zip_code" class="pb-1">Zip Code</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="text" class="form-control" placeholder="Enter Zip Code" name="zip_code" />
												@if($errors->first('zip_code'))
													<span class="text-danger error">{{$errors->first('zip_code')}}</span>
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<label for="" class="pb-1">
												Password
											</label>
											<span class="artisan-star">*</span>
											<div class="form-group pb-3">
												<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />

												@if($errors->first('password'))
												<span class="text-danger error">{{$errors->first('password')}}</span>
												@endif()

											</div>
										</div>
								
									</div>
								</div>
							
							<div class="text-center">
									<button type="submit" id="submit_btn" class="btn btn-warning same_wd_btn">Add</button>
								
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
@endsection()


@section('js')

<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$(".click_upload").click(function(){
      		$("#profile_picture").click();
  		});


		$("#profile_picture").change(function(event){
        
              var file = event.target.files[0];

            /*  console.log(file);*/
              if (file) {

                var size = event.target.files[0].size;

                if(size > 2097152){
                    $("#profile_picture_error").text("File should not be greater than 2 MB.").show();

                    $("#profile_picture").val("");
                    $('#upload_image_view').attr('src',"{{url('public/admin/assets/img/dum.png')}}");
                    //attr remove
                    document.getElementById("profile_picture").removeAttribute("img");
                    $(".add_img").show();
                    return false;
                }

               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){

                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#profile_picture').attr('src', e.target.result);
                  $('#upload_image_view').attr('src', e.target.result);
                  //attr set
                  document.getElementById("profile_picture").setAttribute("img", "true");
                }
        
               reader.readAsDataURL(file);
               $("#profile_picture_error").text("").hide();
               $(".add_img").hide();
              }else {
                $("#profile_picture_error").text("Please select jpg, jpeg or png image format only.").show();
                $("#profile_picture").val("");
                $('#upload_image_view').attr('src',"{{url('public/admin/assets/img/dum.png')}}");
                
                document.getElementById("profile_picture").removeAttribute("img");

                $(".add_img").show();
             }
            }
            })

	})
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>

 <script type="text/javascript">
    $(document).ready(function(){


		var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
			separateDialCode: true,
			preferredCountries:["in"],
			hiddenInput: "country_code",
			utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
		});

    	$("#email_address-error").hide();




    	$("#email_address").on("focusout",function(){
                let val = $(this).val();

                var data = {
	              '_token': "{{csrf_token()}}",
	              'email': val,
              	};

              $.ajax({
                  url:"{{url('admin/check-exist-email-user')}}",
                  type:'POST',
                  data:data,
                  success: function(res){
                    if(res == 1){
                      $("#email_address-error").text("Email address is already exists. Please try another one.").show();
                    }else{
                     // $("#email_address-error").text("").hide();
                    }
                  },
                  error: function(data, textStatus, xhr) {
                    if(data.status == 422){
                      var result = data.responseJSON;
                      alert('Something went worng.');
                      window.location.href = "";
                      return false;
                    } 
                  }
                });

        });


    	jQuery.validator.addMethod("valid_email", function(value, element) {
                console.log(value.indexOf("."))
                  if(value.indexOf(".") >= 0 ){
                    return true;
                  }else {
                    return false;
                  }
              }, "Please enter valid email address.");


        $("#validate_form").validate({
            rules : {
				
				sponser_id : {
                    required : true,
                },
				upline_id : {
                    required : true,
                },
            	name : {
                    required : true,
                    maxlength:30,
                    minlength:2,
                },
				dob : {
                    required : true,
                },
				swd_name : {
                    required : true,
                    maxlength:30,
                    minlength:2,
                },
				mobile_number : {
                    required : true,
					digits: true,
					maxlength:10
                },
                email : {
                    email : true,
                    required : true,
                    valid_email: true
                },
				adhar_number : {
                    required : true,
					maxlength: 12
                },
				pan_number : {
                    //required : true,
					maxlength: 12
                },
				address : {
                    required : true,
					maxlength: 500
                },
				country : {
                    required : true,
					maxlength: 30
                },
				city : {
                    required : true,
					maxlength: 30
                },
				state : {
                    required : true,
					maxlength: 30
                },
				zip_code : {
                    required : true,
					maxlength: 10
                },
                password : {
	                required: true,
	                minlength: 6
              	}
            },
            messages : {

				sponser_id : {
                    required : "Please select Sponser ID.",
                },
				upline_id : {
                    required : "Please enter Upline ID.",
                },
				name : {
                    required : "Please enter name.",
                    maxlength: "Name should be less than 30 characters.",
                    minlength: "Name must be at least 2 characters long."
                },
				dob : {
                    required : "Please select DOB."
                },
				swd_name : {
                    required : "Please enter name.",
                },
				mobile_number : {
                    required : "Please enter mobile number.",
                    digits: "Mobile number should be digits only.",
					maxlength: "Mobile number should be less than 10 digits."
                },
				adhar_number : {
                    required : "Please enter Aadhar number.",
                    maxlength: "Aadhar number should be less than 12 digits.",
                    digits: "Aadhar number should be digits only."
                },
				pan_number : {
                    required : "Please enter PAN number.",
                    maxlength: "PAN number should be less than 12 characters."
                },
				address : {
                    required : "Please enter Address.",
                    maxlength: "Address should be less than 500 characters.",
                },
				country : {
                    required : "Please enter Country.",
                    maxlength: "Country should be less than 30 characters."
                },
				city : {
                    required : "Please enter City.",
                    maxlength: "City should be less than 30 characters."
                },
				state : {
                    required : "Please enter state.",
                    maxlength: "State should be less than 30 characters."
                },

            	zip_code : {
                    required : "Please enter Zip Code.",
                    maxlength: "Zip Code should be less than 10 characters or digits."
                },
                password : {
                	required : "Please enter password.",
                	minlength : "Password must be at 6 characters long."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);
                
				var countryCode = phone_number.getSelectedCountryData()['dialCode'];
				$("input[name='country_code'").val("+"+countryCode);


				let mobileNumber = $("input[name='mobile_number'").val();

              	var data = {
                  '_token': "{{csrf_token()}}",
                  'mobile_number': mobileNumber,
				  'country_code': "+"+countryCode
              	};

              	$.ajax({
                  	url:"{{url('admin/check-exist-mobile-number-user')}}",
                  	type:'POST',
                  	data:data,
                  	success: function(res){
                  		console.log(res);
						
                    	if(res == 1){
                      		$("#phone_number-error").text("Mobile number is already exists. Please try another one.").show();
                      		$("#submit_btn").attr("disabled",false);
                        }else{
                          	$("#phone_number-error").text("").hide();
                          	form.submit();
                        }
                      },
                      error: function(data, textStatus, xhr) {
                        if(data.status == 422){
                          $("#submit_btn").attr("disabled",false);
                          var result = data.responseJSON;
                        } 
                      }
                });
            }
        });

        });
 </script>

@endsection()