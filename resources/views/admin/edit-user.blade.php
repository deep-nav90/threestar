@extends('admin.layout.layout')
@section('title','Edit User')
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

</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.userManagement')}}">User Management</a></li>
								<li class="breadcrumb-item remove_hover">Edit User</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Edit User</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<form method="POST" enctype="multipart/form-data" id="validate_form">
								{{@csrf_field()}}

                <input type="hidden" value="0" name="is_error_upload_img" id="is_error_upload_img">
							<div class="user_img" title="Click to change image" style="width: 12%;
							margin: auto; position: relative;">
								<img id="upload_image_view" class="click_upload" src="{{url('public/admin/assets/img/dum.png')}}" alt="woman">
								<div class="add_img">
									<img class="click_upload" src="{{url('public/admin/assets/img/plus.png')}}" alt="plus">
								</div>
								<input type='file' style="display:none" id="profile_picture" name="profile_picture" accept="image/*">


								<span class="text-danger error" id="profile_picture_error"></span>
							</div>

							<div class="add_content">
								<div action="" class=" pt-5">
									<label for="" class="pb-1">
										Name
									</label>
									<div class="form-group pb-3">
										<input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$user_find->name}}" />
										@if($errors->first('name'))
										<span class="text-danger error">{{$errors->first('name')}}</span>
										@endif()
									</div>
								</div>
							</div>
							<div class="add_content">
								
									<label for="" class="pb-1">
										Email Address
									</label>
									<div class="form-group pb-3">
										<input type="email" class="form-control" id="email_address" name="email" value="{{$user_find->email}}" placeholder="Enter Email Address" />

										<label id="email_address-error" class="error" for="email_address" style=""></label>

										@if($errors->first('email'))
										<span class="text-danger error">{{$errors->first('email')}}</span>
										@endif()

									</div>
								
							</div>

							<div class="add_content">
								
									<label for="" class="pb-1">
										Date of Birth
									</label>
                  <?php 
                    $carbon_max_calander_date = Carbon\Carbon::now()->subYear(12)->format('Y-m-d');
                    
                  ?>
									<div class="form-group pb-3" style="position: relative;">
										<input type="date" class="form-control" name="dob" value="{{$user_find->dob}}" min="1920-01-01" max="{{$carbon_max_calander_date}}" placeholder="Enter Date of Birth" onkeydown="return false"/>


                   <!--  <input type="date" class="form-control" name="dob" value="{{$user_find->dob}}" placeholder="Enter Date of Birth"/> -->

										@if($errors->first('dob'))
										<span class="text-danger error">{{$errors->first('dob')}}</span>
										@endif()

									</div>
								
							</div>
							<div class="add_content">
								
									<!-- <label for="" class="pb-1">
										User Type
									</label>
									<div class="form-group pb-3">
										<input type="password" class="form-control" placeholder="Password" value="" required />
									</div> -->
									<label for="exampleFormControlSelect1" class="pb-1">User Type</label>
									<div class="selectdiv mb-3">
										<select class="form-control form-group" style="padding: .6rem 1rem; position: relative;" id="exampleFormControlSelect1" name="user_type">
											<option value="">Select User Type</option>
											<option value="Players" @if($user_find->user_type == "Players") selected = "selected" @endif()>Players</option>
											<option value="Coaches" @if($user_find->user_type == "Coaches") selected = "selected" @endif()>Coaches</option>
											<option value="Trainers" @if($user_find->user_type == "Trainers") selected = "selected" @endif()>Trainers</option>
											<option value="Scouts" @if($user_find->user_type == "Scouts") selected = "selected" @endif()>Scouts</option>
											<option value="Managers" @if($user_find->user_type == "Managers") selected = "selected" @endif()>Managers</option>
											<option value="Parents" @if($user_find->user_type == "Parents") selected = "selected" @endif()>Parents</option>
										</select>

										@if($errors->first('user_type'))
										<span class="text-danger error">{{$errors->first('user_type')}}</span>
										@endif()

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
<script type="text/javascript">
	$(document).ready(function(){


		let user_profile_pic = "{{$user_find->profile_picture}}";

		if(user_profile_pic != "" || user_profile_pic.length > 0){

			$('#upload_image_view').attr('src', user_profile_pic);
			document.getElementById("profile_picture").setAttribute("img", "true");
			$(".add_img").hide();

		}

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
                    $("#is_error_upload_img").val(1);
                    return false;
                }

               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){

                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#profile_picture').attr('src', e.target.result);
                  $('#upload_image_view').attr('src', e.target.result);
                  $("#is_error_upload_img").val(0);
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
                $("#is_error_upload_img").val(1);
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

    	$("#email_address-error").hide();




    	$("#email_address").on("focusout",function(){
                let val = $(this).val();

                let id = "{{$user_find->id}}";

                var data = {
	              '_token': "{{csrf_token()}}",
	              'email': val,
              	};

              $.ajax({
                  url:"{{url('admin/check-exist-email-user')}}"+'/'+id,
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

            	 name : {
                    required : true,
                    maxlength:30,
                    minlength:2
                },
                email : {
                    email : true,
                    required : true,
                    //maxlength:40,
                    valid_email: true
                },
	            dob:{
	            	required: true
	            },
	            user_type : {
	            	required: true
	            }
               
            },
            messages : {

            	name : {
                    required : "Please enter name.",
                    maxlength: "Name should be less than 30 characters.",
                    minlength:"Name must be at least 2 characters long."
                },
                email : {
                    email : "Please enter valid email address.",
                    required : "Please enter email address.",
                    //maxlength: "Email address should be less than 40 characters."
                },
                dob:{
                	required : "Please select date of birth."
                },
                user_type :{
                	required : "Please select user type."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);
                

                let email_val = $("#email_address").val();

                let id = "{{$user_find->id}}";

              	var data = {
                  '_token': "{{csrf_token()}}",
                  'email': email_val,
              	};

              	$.ajax({
                  	url:"{{url('admin/check-exist-email-user')}}"+'/'+id,
                  	type:'POST',
                  	data:data,
                  	success: function(res){
                  		console.log(res);
                    	if(res == 1){
                      		$("#email_address-error").text("Email address is already exists. Please try another one.").show();
                      		$("#submit_btn").attr("disabled",false);
                        }else{
                          	$("#email_address-error").text("").hide();
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