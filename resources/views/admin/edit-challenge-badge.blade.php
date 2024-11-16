@extends('admin.layout.layout')
@section('title','Edit Challenge/Badge')
@section('content')


<style type="text/css">
	span#image_error {
    position: absolute;
    right: 0;
    left: 0;
    margin-top: 8px;
    color: #ff0000!important;
    font-size: 100%!important;
    width: 300px;
    margin-left: -78px;
}

#challenge_name-error {

   color: #ff0000!important;
    font-size: 100%!important;
    
}

.dashboard_panel .add_content {
    margin-top: 40px;
}


</style>


		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.challengeBadgeManagement')}}">Challenge/Badge Management</a></li>
								<li class="breadcrumb-item remove_hover">Edit Challenge/Badge</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Edit Challenge/Badge</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<form method="POST" id="validate_form" enctype="multipart/form-data">
								{{@csrf_field()}}


								<?php 

									if(!empty($challenge_find->image)){
										$img = $challenge_find->image;
									}else{
										$img = url('public/admin/assets/img/dum_l.jpg');
									}
								?>

							<div class="user_img" title="Change Image" style="width: 12%;
							margin: auto; position: relative;">
								<img id="upload_image_view" class="click_upload" src="{{$img}}" alt="woman">
								<div class="add_img">
									<img class="click_upload" src="{{url('public/admin/assets/img/plus.png')}}" alt="plus">
								</div>
								<input type='file' style="display:none" id="image" name="image" accept="image/*">


								<span class="text-danger error" id="image_error"></span>
							</div>

							<div class="add_content">
								
									<!-- <label for="" class="pb-1">
										Challenge Name
									</label> -->
									<label for="exampleFormControlSelect1" class="pb-1">Challenge Name</label>
									<div class="mb-3">
										<input type="text" class="form-control" name="challenge_name" value="{{$challenge_find->challenge_name}}" placeholder="Enter Challenge Name">

										<label id="challenge_name-error" class="error" for="challenge_name"></label>
										<!-- <select class="form-control form-group" style="padding: .6rem 1rem; position: relative;" id="exampleFormControlSelect1">
											<option>New Challenge</option>
											<option>New Challenge2</option>
											<option>New Challenge3</option>
											<option>New Challenge4</option>
											<option>New Challenge5</option>
										</select> -->
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

		$(".click_upload").click(function(){
      		$("#image").click();
  		});


		$("#image").change(function(event){
        
              var file = event.target.files[0];

            /*  console.log(file);*/
              if (file) {

                

               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){


                var size = event.target.files[0].size;

                if(size > 52428800){
                    $("#image_error").text("File should not be greater than 5 MB.").show();

                    $("#image").val("");
                    $('#upload_image_view').attr('src',"{{url('public/admin/assets/img/dum_l.jpg')}}");
                    //attr remove
                    document.getElementById("image").removeAttribute("img");
                    $(".add_img").show();
                    return false;
                }


                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#image').attr('src', e.target.result);
                  $('#upload_image_view').attr('src', e.target.result);
                  //attr set
                  document.getElementById("image").setAttribute("img", "true");
                }
        
               reader.readAsDataURL(file);
               $("#image_error").text("").hide();
               $(".add_img").hide();
              }else {
                $("#image_error").text("Please select jpg, jpeg or png image format only.").show();
                $("#image").val("");
                $('#upload_image_view').attr('src',"{{url('public/admin/assets/img/dum_l.jpg')}}");
                
                document.getElementById("image").removeAttribute("img");

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


    	let check_img = "{{$challenge_find->image}}";

    	if(check_img.length > 0){
    		$("#image").attr("img","true");
    		$(".add_img").hide();
    	}

    	$("#submit_btn").on("click",function(){

    		let check_img  = $("#image").attr("img");

            if(check_img == "true"){

            	
            }else{
            
            	$("#image_error").text("Please upload image.").show();
            }

    	});

        $("#validate_form").validate({
            rules : {

            	 challenge_name : {
                    required : true,
                    maxlength:50,
                    minlength:2,
                }
               
            },
            messages : {

            	challenge_name : {
                    required : "Please enter challenge name.",
                    maxlength: "Challenge name should be less than 50 characters.",
                    minlength: "Challenge name must be at least 2 characters long."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);

                let check_img  = $("#image").attr("img");
                if(check_img == "true"){

                	form.submit();
                }else{
                	$("#submit_btn").attr('disabled', false);
                	$("#image_error").text("Please upload image.").show();
                }

            }
        });

        });
 </script>

@endsection()