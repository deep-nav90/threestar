@extends('admin.layout.layout')
@section('title','Add Reward')
@section('content')


<style type="text/css">
	.video_setup {
		width: 200px;
    height: 150px;
    border: 2px solid #fff;
    border-radius: 7px;
    cursor: pointer;
	}

	.video_err {
	    text-align: center;
	    width: 100%;
	    display: block;
	}


	span.video_err {
  
    color: #ff0000!important;
    font-size: 100%!important;
    
	}
	span.video_err:hover {
		color: #ff0000!important;
	}
	.dashboard_panel .add_imgae_box .user_img img.img_upload {
		border-radius: 7px;
		height: 150px;
	    width: 176px;
	    object-fit: contain;
	    border: 2px solid #57b4ca;
	    margin-bottom: 22px;
	}
	.dashboard_panel .add_imgae_box .add_img img.plus_icon {
		top: 129px;
    	margin-left: 65px;
	}
	.dashboard_panel .add_imgae_box .cross_icon img.plus_icon {
		top: -17px;

	}
	.video_setup {
		width: 176px;
    height: 150px;
    border: 2px solid #57b4ca;
    border-radius: 7px;
    cursor: pointer;
	}
	.upload_align {
		display: flex;
		flex-wrap: wrap;
		    justify-content: center;
	}
	.mr-2 {
		margin-right: 25px !important;
	}
	.audio_img img {
		border-radius: 7px !important;
		height: 80px !important;
	    width: 200px !important;
	    object-fit: contain !important;
	    /*border: 2px solid #fff;*/
	    margin-bottom: 10px;
	    margin-top: 10px;
	}
	.audio_width {
		width: 170px !important;
		height: 42px !important;
	}


	#lodaerModal .modal-body {
    text-align: center;
    margin: 0 auto;
    padding: 4rem;

}

#lodaerModal .modal-dialog {
    max-width: 400px;
    margin: 10.75rem auto;
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #57b4ca;
  border-bottom: 16px solid #57b4ca;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

.jq-validator {
	display:none;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


textarea.form-control {
    /* height: auto; */
    height: 105px!important;
}

</style>


		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.rewardManagement')}}">Reward Management</a></li>
								<li class="breadcrumb-item remove_hover">Add Reward</li>
								
							</ol>
						</nav>

						@include('admin.layout.notification')

					</div>
					<h1>Add Reward</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<form method="POST" enctype="multipart/form-data" id="validate_form">
								{{@csrf_field()}}
							<div>

								<input type="hidden" name="click_on_file_count" id="click_on_file_count">
								
								<input type="hidden" name="image_count" value="0" id="image_count">
								<input type="hidden" name="click_on_cross_count" id="click_on_cross_count">
								<input type="hidden" name="upload_file_count" id="upload_file_count">

								<input type="hidden" name="acceptable[]" id="acceptable">
								<input type="hidden" name="non_acceptable[]" id="non_acceptable">

								<div class="files_container">

										
									
								</div>

								

							<div class="upload_align">

								
							
								<div class="user_img mr-2" title="Upload Image" style="
									position: relative; margin-bottom: 16px;">
									<img class="click_upload img_upload file_upload_click" src="{{url('public/admin/assets/img/plus-icon-c.svg')}}" alt="woman">

									
									
									
								</div>
								

								
								

							</div>


								
							</div>

							<div class="add_content">
								
                            <div class="row">
										<!-- Name Field -->

                                <div class="col-md-6">
                                    <label for="reward_name" class="pb-1">Reward Name</label>
                                    <span class="artisan-star">*</span>
                                    <div class="form-group pb-3">
                                        <input type="text" class="form-control" placeholder="Enter Reward Name" name="reward_name" />
                                        @if($errors->first('reward_name'))
                                            <span class="text-danger error">{{$errors->first('reward_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="reward_level" class="pb-1">Reward Level</label>
                                    <span class="artisan-star">*</span>
                                    <div class="form-group pb-3">
                                        <!-- <input type="text" class="form-control" placeholder="Enter Sponser ID" name="reward_level" /> -->

                                        <select id="reward_level" class="form-control form-group select2" style="padding: .6rem 1rem; position: relative;" name="reward_level" placeholder="Select Reward Level">
                                        <option value="">Select Reward Level</option>
                                            
                                        @foreach($levels as $level)
                                        
										@if(in_array($level->level, $disabledLevels))
                                        <option disabled value="{{$level->level}}">{{$level->level}}</option>
                                        @else
										<option value="{{$level->level}}">{{$level->level}}</option>
										@endif()
                                        
                                        @endforeach()
                                            
                                        </select>
                                        @if($errors->first('reward_level'))
                                            <span class="text-danger error">{{$errors->first('reward_level')}}</span>
                                        @endif

                                        <label id="reward_level-error" class="error jq-validator" for="reward_level">Please select Reward Level.</label>

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






		<div id="alertModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #57b4ca">
<!--         <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->
 <div class="text-center" style="width: 100%;">       
  <h4 class="modal-title" style="font-size: 18px; color: #fff;">Alert</h4>
</div>
      </div>
      <div class="modal-body">
      	<div class="text-center">
        <p style="font-size: 18px;" id="alert_message"></p>
    </div>
      </div>
	      <div class="modal-footer">
	      	<button type="button" id="ok" class="btn btn-default" data-dismiss="modal">Ok</button>
	      </div>
  	
    </div>

  </div>
</div>




<div id="lodaerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-body">
        <div class="loader"></div>
        <p style="font-size: 20px;">Please wait!</p>
      </div>
     
    </div>

  </div>
</div>

		
		@endsection()


		@section('js')



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>






 <script type="text/javascript">
    $(document).ready(function(){


        $("#validate_form").validate({
            rules : {

                reward_name : {
                    required : true,
                    maxlength:50,
                    minlength:2,
                },
                reward_level : {
                    required : true,
                }
               
            },
            messages : {

            	reward_name : {
                    required : "Please enter reward name.",
                    maxlength: "Reward Name should be less than 50 characters.",
                    minlength: "Reward Name must be at least 2 characters long."
                },
                reward_level : {
                    required : "Please enter reward level."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);

                let validate = false;

                let image_count = $("#image_count").val();
                

                if( (image_count == "" || image_count == 0)){
                	//validate = true;
                }

                if(validate == true){
                	$("#submit_btn").attr('disabled', false);
                	$("#alertModel").modal("show");
                	$("#alert_message").text("Please upload atleast one file.");
                	$("#alertModel").unbind("click");
                	return false;
                }


                $("#lodaerModal").modal("show");
          		$("#lodaerModal").unbind("click");
              		
                form.submit();
             

            }
        });

        });
 </script>


 <script type="text/javascript">
 	$(document).ready(function(){

 		enableClickClasses();

 		function enableClickClasses(){

 			$(".file_upload_click").click(function(){

 				let __count_click = $("#click_on_file_count").val();



 				__count = __count_click == "" ? 0 : parseInt(__count_click) + 1;

 				$("#click_on_file_count").val(__count);

 				
 				/*Make Html Input FIles*/

 				$(".files_container").append(`<input type='file' style="display:none" id="files_`+__count+`" class ="files" name="files[`+__count+`][]" multiple>`);


 				$("#files_"+__count).click();



 				$("#files_"+__count).on("change",function(event){

 					var files = event.target.files;

 					let error = "false";

 						let image_count = 0;
 						

 					$.each(files, function (i) {
					    
 						let file = event.target.files[i];


 						let size = event.target.files[i].size;



		                if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png" || file.type == "image/heif" || file.type == "image/heic"){

	 						if(size > 5242880){
				            
				            	$("#alertModel").modal("show");
			                	$("#alert_message").text("Image should not be greater than 5 MB.");
			                	$("#alertModel").unbind("click");

				                $("#files_"+__count).remove();  
				                error = "true";
				                return false;
			                }

			                image_count++;
			               
			            }else{
			                

			                $("#alertModel").modal("show");
		                	$("#alert_message").text("Please select image type of Jpg, Jpeg, Heif, Heic or Png format.");
		                	$("#alertModel").unbind("click");


			                $("#files_"+__count).remove();  
			                error =  "true";
			                return false;

			             }





					});

			       // console.log(image_count);

			        if(error == "false"){

	 					let already_upload_img_count = $("#image_count").val();

	 					let total_img_count = parseInt(already_upload_img_count) + image_count;

	 					let total_file_count = total_img_count;
	 				
	 					if(total_img_count > 5){

	 						$("#alertModel").modal("show");
		                	$("#alert_message").text("Maximum 5 images is allowed.");
		                	$("#alertModel").unbind("click");


			                $("#files_"+__count).remove();  
			                error =  "true";
			                return false;
	 					}
			        }


 					if(error == "false"){

					$.each(files, function (i) {
					    
 						let file = event.target.files[i];


 						if(file){

			               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png" || file.type == "image/heif" || file.type == "image/heic"){

			                var reader = new FileReader();
			                
			                reader.onload = function(e) {
			                  //$('#profile_picture').attr('src', e.target.result);
			                  
				                let upload_file_count_val = $("#upload_file_count").val();

				                let __upload_file_count = upload_file_count_val == "" ? 1 : parseInt(upload_file_count_val) + 1;

				                $("#upload_file_count").val(__upload_file_count);


				                let acceptable_file_arr = __count+'_'+i;

				                
				                let acceptable_val = $("#acceptable").val();

				                let push_val_acceptable = acceptable_val == "" ? acceptable_file_arr : acceptable_val+','+acceptable_file_arr;

				       

				                $("#acceptable").val(push_val_acceptable);


				                let image_count_val = $("#image_count").val();

				                let __count_image = image_count_val == "" ? 1 : parseInt(image_count_val) + 1;

				                $("#image_count").val(__count_image);



				                $(".upload_align").append(`<div class="user_img mr-2" ui="image" title="Upload Image" style="position: relative; margin-bottom: 16px;">
									<img class="click_upload img_upload" id="accept_`+acceptable_file_arr+`" src="`+e.target.result+`" alt="woman">
									
									<div class="add_img cross_icon">
										<img class="click_upload plus_icon cross_icon" ui="image" id="cross_`+acceptable_file_arr+`" src="{{url('public/admin/assets/img/cross.png')}}" alt="cross">
									</div>

									
								</div>`);




				                //cross function

				                $("#cross_"+acceptable_file_arr).on("click",function(){




						 			let check_type = $(this).attr("ui");

						 			if(check_type == "image"){
						 				
				                		let parent_div = $(this).parent().parent();

				                		
						 				let image_count_val = $("#image_count").val();

						 				let sub_image_count_val = image_count_val - 1;

						 				$("#image_count").val(sub_image_count_val);


						 				let non_acceptable = $("#non_acceptable").val();

						 				let acceptable = $(this).attr('id');

						 				acceptable = acceptable.replace("cross_", "");

						                let push_val_non_acceptable = non_acceptable == "" ? acceptable : non_acceptable+','+acceptable;

						       

						                $("#non_acceptable").val(push_val_non_acceptable);


						                let cross_count_val = $("#click_on_cross_count").val();


						                let cross_count = cross_count_val == "" ? 1 : parseInt(cross_count_val) + 1;

						                $("#click_on_cross_count").val(cross_count);

						                parent_div.remove();



						 			}

	 	
				                });

				                //end cross function




			                }
			        
			               reader.readAsDataURL(file);
			               
			              }

			            }



					});
 					}


					

 				});

 			});

 		}

 	})
 </script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#ok").on("click",function(){
			$("#alertModel").modal("hide");
		});
	});
</script>


@endsection()