@extends('admin.layout.layout')
@section('title','Edit Training Video')
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

.dashboard_panel .add_imgae_box .user_img video.video_upload {
      border: 2px solid #daa905;
  }

</style>
		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.trainingVideoManagement')}}">Training Video Management</a></li>
								<li class="breadcrumb-item remove_hover">Edit Training Video</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Edit Training Video</h1>
					<div class="card">
					<form method="POST" id="validate_form" enctype="multipart/form-data">
							{{@csrf_field()}}
							<input type="file" name="video_url" id="video_url" style="display: none;" accept="video/*">
						<div class="card-body add_imgae_box">
							<div class="user_img" title="Change Video" style="
							margin: auto; position: relative; margin-bottom: 12px;">
							<div style="margin-bottom: 18px;">
								<video width="320" height="240" controls class="video_setup video_upload" id="video_src">
								  <source src="" type="video/mp4">
								  <source src="" type="video/ogg">
								  Your browser does not support the video tag.
								</video>
								<div class="add_img">
									<img class="video_upload" src="{{url('public/admin/assets/img/plus.png')}}" alt="plus" style="bottom: -14px; margin-left: 80px;">
								</div>
								
							</div>
							</div>
								<div>
								<span class="text-danger error video_err">{{$errors->first('video_url')}}</span>	
									
								</div>



								<div class="add_content">
								
									<label for="" class="pb-1">
										Category
									</label>
									<div class="form-group pb-3 selectdiv">
										<select class="form-control" name="category_id">
											<option value="">Select Category</option>
											@foreach($categories as $category)
											<option value="{{$category->id}}" @if($training_video_find->category_id == $category->id) selected = "selected" @endif()>{{$category->category_name}}</option>
											@endforeach()
										</select>

										@if($errors->first('category_id'))
										<span class="text-danger error">{{$errors->first('category_id')}}</span>
										@endif()
									</div>
						
							</div>



							<div class="add_content">
								
									<label for="" class="pb-1">
										Title
									</label>
									<div class="form-group pb-3">
										<input type="text" class="form-control" name="title" value="{{$training_video_find->title}}" placeholder="Enter Title"/>

										@if($errors->first('title'))
										<span class="text-danger error">{{$errors->first('title')}}</span>
										@endif()
									</div>
						
							</div>
							<div class="add_content">
								
									<label for="" class="pb-1">
										Description
									</label>
									<div class="form-group pb-3">
										<!-- <input type="email" class="form-control" placeholder="Email Address" value="" required /> -->
										<textarea class="form-control" name="description" placeholder="Enter Description">{{$training_video_find->description}}</textarea>
										@if($errors->first('description'))
										<span class="text-danger error">{{$errors->first('description')}}</span>
										@endif()
									</div>
					
							</div>
							<div class="text-center">
								
									<button type="submit" id="submit_btn" class="btn btn-warning same_wd_btn">Update</button>
							
							</div>
						</div>
					</form>
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

	<script type="text/javascript">
	$(document).ready(function(){

		$(".video_upload").click(function(){
      		$("#video_url").click();
  		});


		$("#video_url").change(function(event){
        
              var file = event.target.files[0];

              var size = event.target.files[0].size;

              


              console.log(file);
              if (file) {

                

               if(file.type == "video/mp4" || file.type == "application/mp4" || file.type == "video/quicktime"){




                var video = document.createElement('video');
               video.preload = 'metadata';

               video.onloadedmetadata = function() {
                 window.URL.revokeObjectURL(video.src);
                 var duration = Math.round(video.duration,0);
                 
                 if(duration > 120){
                    $(".video_err").text("Video duration should be less than 2 Minutes.").show();
                    $("#video_url").val("");
                    //attr remove
                    return false;
                 }else{

                    if(size > 52428800){
                    $(".video_err").text("Video should not be greater than 50 MB.").show();

                    $("#video_url").val("");
                   // $('#video_src').attr('src',"");
                    //attr remove
                   // document.getElementById("video_url").removeAttribute("is_video");
                   // $(".add_img").show();
                    return false;
                  }


                  var reader = new FileReader();
                  
                  reader.onload = function(e) {
                    $('#video_url').attr('src', e.target.result);
                    $('#video_src').attr('src', e.target.result);
                    //attr set
                    document.getElementById("video_url").setAttribute("is_video", "true");
                  }
          
                 reader.readAsDataURL(file);
                 $(".video_err").text("").hide();
                 $(".add_img").hide();




                 }
               }

               video.src = URL.createObjectURL(file);
               



                

                
              }else {
                $(".video_err").text("Video should be type of mp4, mov only.").show();
                $("#video_url").val("");
               // $('#video_src').attr('src',"");
                
              //  document.getElementById("video_url").removeAttribute("is_video");

                //$(".add_img").show();
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

    	let check_video_uploaded = "{{$training_video_find->video_url}}";

    	if(check_video_uploaded.length > 0){
    		$("#video_url").attr('is_video', true);
    		$("#video_src").attr("src", check_video_uploaded);
    		$(".add_img").hide();
    	}

    	$("#submit_btn").on("click",function(){


    		let file_check = $("#video_url").attr('is_video');

          	if(file_check == "true"){
          		$(".video_err").text("").hide();
          	}else{
          		 $(".video_err").text("Please upload video.").show();
          	}



		});

        $("#validate_form").validate({
            rules : {

            	 title : {
                    required : true,
                    maxlength:50,
                    minlength:2
                },
                description : {
                  required : true,
                 	maxlength:5000,
                  minlength:3
                },
                category_id : {
                	required : true
                }
               
            },
            messages : {

            	title : {
                    required : "Please enter title.",
                    maxlength: "Title should be less than 50 characters.",
                    minlength:"Title must be at least 2 characters long."
                },
                description : {
                    required : "Please enter description.",
                    maxlength: "Description should be less than 5000 characters.",
                    minlength:"Description must be atleast 3 characters long."
                },
                category_id : {
                	required : "Please select category."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);
                

                let file_check = $("#video_url").attr('is_video');

              	if(file_check == "true"){
              		$(".video_err").text("").hide();
              		$("#lodaerModal").modal("show");
              		$("#lodaerModal").unbind("click");
              		form.submit();
              	}else{
              		 $(".video_err").text("Please upload video.").show();
                   $("#submit_btn").attr('disabled', false);
              		 return false;
              	}

            }
        });

        });
 </script>

@endsection()