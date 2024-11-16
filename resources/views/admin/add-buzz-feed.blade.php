@extends('admin.layout.layout')
@section('title','Add Buzz Feed')
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
	    border: 2px solid #daa905;
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
    border: 2px solid #daa905;
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
  border-top: 16px solid #daa905;
  border-bottom: 16px solid #daa905;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
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
								<li class="breadcrumb-item active"><a href="{{route('admin.buzzFeedManagement')}}">Buzz Feed Management</a></li>
								<li class="breadcrumb-item remove_hover">Add Buzz Feed</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Add Buzz Feed</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<form method="POST" enctype="multipart/form-data" id="validate_form">
								{{@csrf_field()}}
							<div>

								<input type="hidden" name="click_on_file_count" id="click_on_file_count">
								<input type="hidden" name="video_count" value="0" id="video_count">
								<input type="hidden" name="audio_count" value="0" id="audio_count">
								<input type="hidden" name="image_count" value="0" id="image_count">
								<input type="hidden" name="click_on_cross_count" id="click_on_cross_count">
								<input type="hidden" name="upload_file_count" id="upload_file_count">

								<input type="hidden" name="acceptable[]" id="acceptable">
								<input type="hidden" name="non_acceptable[]" id="non_acceptable">

								<div class="files_container">

										<!-- <input type='file' style="display:none" class ="files" name="files[0][]"> -->
									
								</div>

								

							<div class="upload_align">

								
							
								<div class="user_img mr-2" title="Upload Image/Video/Audio" style="
									position: relative; margin-bottom: 16px;">
									<img class="click_upload img_upload file_upload_click" src="{{url('public/admin/assets/img/dum5_l.jpg')}}" alt="woman">

									
									<!--  <div class="add_img cross_icon">
										<img class="click_upload plus_icon" src="{{url('public/admin/assets/img/cross.png')}}" alt="cross">
									</div> -->

									
								</div>
								<!-- <div class="user_img mr-2" id="file2" title="Upload Image/Video/Audio" style="
									position: relative; margin-bottom: 12px;">
									<div style="margin-bottom: 18px;">
										<video width="320" height="240" controls class="video_setup video_upload file_upload_click" ui="video">
								 			<source src="" type="video/mp4">
								  			<source src="" type="video/ogg">
								  			Your browser does not support the video tag.
										</video>
										<div class="add_img" id="file2_add">
											<img class="video_upload file_upload_click_plus" ui="video" src="{{url('public/admin/assets/img/plus.png')}}" alt="plus" style="top: 129px; margin-left: 65px;">
										</div>
										 <div class="add_img cross_icon" id="file2_cross">
										<img class="click_upload plus_icon" src="{{url('public/admin/assets/img/cross.png')}}" alt="cross">
										</div>
									</div>


									


								</div> -->


								<!-- <div class="user_img mr-2" id="file3" title="Upload Image/Video/Audio" style="
									position: relative; margin-bottom: 12px;">
									<div style="margin-bottom: 18px; border: 2px solid #daa905; border-radius: 7px; width: 180px;">
										<div class="audio_img">
											<img class="file_upload_click" ui="audio" src="{{url('public/admin/assets/img/mp3.png')}}" alt="mp3">
										</div>
										<audio controls class="audio_width">
  											<source src="" type="audio/ogg">
  											<source src="" type="audio/mpeg">
											Your browser does not support the audio element.
										</audio>
										<div class="add_img" id="file3_add">
											<img class="video_upload file_upload_click_plus" ui="audio" src="{{url('public/admin/assets/img/plus.png')}}" alt="plus" style="top: 129px; margin-left: 74px;">
										</div>
										 <div class="add_img cross_icon" id="file3_cross">
										<img class="click_upload plus_icon" src="{{url('public/admin/assets/img/cross.png')}}" alt="cross" style="margin-left: 73px;">
										</div>
									</div>


						


								</div> -->


								
								

							</div>


								
							</div>

							<div class="add_content">
								
									<label for="" class="pb-1">
										Title
									</label>
									<div class="form-group pb-3">
										<input type="text" class="form-control" name="title" placeholder="Enter Title"/>
									</div>
								
							</div>
							<div class="add_content">
								
									<label for="" class="pb-1">
										Description
									</label>
									<div class="form-group pb-3">
										<!-- <input type="email" class="form-control" placeholder="Email Address" value="" required /> -->
										<textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
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
      <div class="modal-header" style="background-color: #daa905">
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

            	 title : {
                    required : true,
                    maxlength:50,
                    minlength:2,
                },
                description : {
                    required : true,
                    maxlength : 5000,
                    minlength: 3
                }
               
            },
            messages : {

            	title : {
                    required : "Please enter title.",
                    maxlength: "Title should be less than 50 characters.",
                    minlength: "Title must be at least 2 characters long."
                },
                description : {
                    required : "Please enter description.",
                    maxlength : "Description should be less than 5000 characters.",
                    minlength: "Description must be atleast 3 characters long."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);

                let validate = false;

                let image_count = $("#image_count").val();
                let video_count = $("#video_count").val();
                let audio_count = $("#audio_count").val();

                if( (image_count == "" || image_count == 0) && (video_count == "" || video_count == 0) && (audio_count == "" || audio_count == 0) ){
                	validate = true;
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
 						let video_count = 0;
 						let audio_count = 0;

 					$.each(files, function (i) {
					    
 						let file = event.target.files[i];


 						let size = event.target.files[i].size;



		                if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){

	 						if(size > 5242880){
				            
				            	$("#alertModel").modal("show");
			                	$("#alert_message").text("Image should not be greater than 5 MB.");
			                	$("#alertModel").unbind("click");

				                $("#files_"+__count).remove();  
				                error = "true";
				                return false;
			                }

			                image_count++;
			               
			            }else if(file.type == "video/mp4" || file.type == "application/mp4" || file.type == "video/quicktime"){

			            	if(size > 52428800){
				            
				            	$("#alertModel").modal("show");
			                	$("#alert_message").text("Video should not be greater than 50 MB.");
			                	$("#alertModel").unbind("click");

				                $("#files_"+__count).remove();  
				                error = "true";
				                return false;
			                }

			                video_count++;


			            }else if(file.type == "audio/mpeg3" || file.type == "audio/x-mpeg-3" || file.type == "audio/mpeg" || file.type == "audio/x-mpeg"){


			            	if(size > 5242880){
				            
				            	$("#alertModel").modal("show");
			                	$("#alert_message").text("Audio should not be greater than 5 MB.");
			                	$("#alertModel").unbind("click");

				                $("#files_"+__count).remove();  
				                error = "true";
				                return false;
			                }

			                audio_count++;


			            }else{
			                

			                $("#alertModel").modal("show");
		                	$("#alert_message").text("Please select image type of Jpg, Jpeg or Png format and video type of Mp4, mov format and audio type of Mp3 format.");
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

	 					let already_upload_video_count = $("#video_count").val();

	 					let total_video_count = parseInt(already_upload_video_count) + video_count;

	 					let already_upload_audio_count  = $("#audio_count").val();

	 					let total_audio_count = parseInt(already_upload_audio_count) + audio_count;


	 					let total_file_count = total_img_count + total_video_count + total_audio_count;

	 					if(total_file_count > 20){
	 						
	 						$("#alertModel").modal("show");
		                	$("#alert_message").text("Maximum 20 images/video(1)/audio(1) is allowed.");
		                	$("#alertModel").unbind("click");


			                $("#files_"+__count).remove();  
			                error =  "true";
			                return false;
	 					}
	 					


	 					if(total_img_count > 20){

	 						$("#alertModel").modal("show");
		                	$("#alert_message").text("Maximum 20 images/video(1)/audio(1) is allowed.");
		                	$("#alertModel").unbind("click");


			                $("#files_"+__count).remove();  
			                error =  "true";
			                return false;
	 					}


	 					if(total_video_count > 1){

	 						$("#alertModel").modal("show");
		                	$("#alert_message").text("Maximum 20 images/video(1)/audio(1) is allowed.");
		                	$("#alertModel").unbind("click");


			                $("#files_"+__count).remove();  
			                error =  "true";
			                return false;
	 					}

	 					if(total_audio_count > 1){

	 						$("#alertModel").modal("show");
		                	$("#alert_message").text("Maximum 20 images/video(1)/audio(1) is allowed.");
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

			               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){

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



				                $(".upload_align").append(`<div class="user_img mr-2" ui="image" title="Upload Image/Video/Audio" style="position: relative; margin-bottom: 16px;">
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
			               
			              }else if(file.type == "video/mp4" || file.type == "application/mp4" || file.type == "video/quicktime"){

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


				                let video_count_val = $("#video_count").val();

				                let __count_video = video_count_val == "" ? 1 : parseInt(video_count_val) + 1;

				                $("#video_count").val(__count_video);


				                $(".upload_align").append(`<div class="user_img mr-2" ui="image" title="Upload Image/Video/Audio" style="position: relative; margin-bottom: 16px;">
									
									<div style="margin-bottom: 18px;">
										<video width="320" height="240" controls class="video_setup video_upload" id="accept_`+acceptable_file_arr+`" src="`+e.target.result+`">
								 			<source src="" type="video/mp4">
								  			<source src="" type="video/ogg">
								  			Your browser does not support the video tag.
										</video>
										
										<div class="add_img cross_icon">
										<img class="click_upload plus_icon cross_icon" ui="video" id="cross_`+acceptable_file_arr+`" src="{{url('public/admin/assets/img/cross.png')}}" alt="cross">
										</div>
									</div>

									
								</div>`);




				                //cross function

				                $("#cross_"+acceptable_file_arr).on("click",function(){




						 			let check_type = $(this).attr("ui");

						 			if(check_type == "video"){
						 				
				                		let parent_div = $(this).parent().parent().parent();

				                		
						 				let video_count_val = $("#video_count").val();

						 				let sub_video_count_val = video_count_val - 1;

						 				$("#video_count").val(sub_video_count_val);


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

			              }else if(file.type == "audio/mpeg3" || file.type == "audio/x-mpeg-3" || file.type == "audio/mpeg" || file.type == "audio/x-mpeg"){


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


				                let audio_count_val = $("#audio_count").val();

				                let __count_audio = audio_count_val == "" ? 1 : parseInt(audio_count_val) + 1;

				                $("#audio_count").val(__count_audio);


				                $(".upload_align").append(`<div class="user_img mr-2" title="Upload Image/Video/Audio" style="position: relative; margin-bottom: 16px;">
									
									<div style="margin-bottom: 18px; border: 2px solid #daa905; border-radius: 7px; width: 180px;">
										<div class="audio_img">
											<img src="{{url('public/admin/assets/img/mp3.png')}}" alt="mp3">
										</div>
										<audio controls class="audio_width" id="accept_`+acceptable_file_arr+`" src="`+e.target.result+`">
  											<source src="" type="audio/ogg">
  											<source src="" type="audio/mpeg">
											Your browser does not support the audio element.
										</audio>
										
										 <div class="add_img cross_icon">
										<img class="click_upload plus_icon cross_icon" ui="audio" id="cross_`+acceptable_file_arr+`" src="{{url('public/admin/assets/img/cross.png')}}" alt="cross">
										</div>

									</div>

									
								</div>`);




				                //cross function

				                $("#cross_"+acceptable_file_arr).on("click",function(){




						 			let check_type = $(this).attr("ui");

						 			if(check_type == "audio"){
						 				
				                		let parent_div = $(this).parent().parent().parent();

				                		
						 				let audio_count_val = $("#audio_count").val();

						 				let sub_audio_count_val = audio_count_val - 1;

						 				$("#audio_count").val(sub_audio_count_val);


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