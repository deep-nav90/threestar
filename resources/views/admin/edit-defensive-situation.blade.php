@extends('admin.layout.layout')
@section('title','Edit Situation')
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
   #also_think_about_it
   {
   border-radius: 2px !important;
   padding: .6rem 1rem;
   width: 100%;
   }


.checkout {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.checkout input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkout .checkmark {
  position: absolute;
  top: -5px;
  left: 22px;
  height: 25px;
  width: 25px;
  background-color: #fff;
  border-radius: 5px;
}

/* When the checkbox is checked, add a blue background */
.checkout input:checked ~ .checkmark {
    background-color: #daa905;
    border-radius: 5px;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkout input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkout .checkmark:after {
    left: 9px;
    top: 4px;
    width: 7px;
height: 13px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

.main-panel.dashboard_panel .number::-webkit-outer-spin-button,
.main-panel.dashboard_panel .number::-webkit-inner-spin-button{
   appearance: none;
    -moz-appearance: none;
-webkit-appearance: none;
}

.checkout .checkmark {

right: 0px !important;
left:unset !important;
}

#also_think_about_it::placeholder{
   color:#575962;
   opacity: 0.8;
   
}

.dashboard_panel .add_imgae_box .user_img img.img_upload {
    border-radius: 7px;
    height: 150px;
    width: 176px;
    object-fit: contain;
    border: 2px solid #daa905;
    margin-bottom: 22px;
}

.dashboard_panel .add_imgae_box .user_img video.video_upload {
    border: 2px solid #daa905;
}

.video_setup {
    width: 200px;
    height: 150px;
    border-radius: 7px;
    cursor: pointer;
}


span.video_err {
    color: #ff0000!important;
    font-size: 100%!important;
}

.video_err {
    text-align: center;
    width: 100%;
    display: block;
}


span.img_error {
    display: block;
    width: 100%;
    color: #ff0000!important;
    font-size: 100%!important;
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


</style>

<div class="main-panel dashboard_panel">
   <div class="content">
      <div class="page-inner" style="padding-right: 12px;">
         <div class="navbar_bar">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active"><a href="{{route('admin.situationManagement')}}">Situation Management</a></li>
                  <li class="breadcrumb-item remove_hover">Edit Situation</li>
                  <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
               </ol>
            </nav>
         </div>
         <h1>Edit Situation</h1>
         <div class="card">
            <div class="card-body add_imgae_box">
               <form method="POST" id="validate_form" enctype="multipart/form-data">
                  {{@csrf_field()}}

                  <?php 

                    $image = $defense_situations->image ? $defense_situations->image : url('public/admin/assets/img/dum5_l.jpg');

                    $video = $defense_situations->video ? $defense_situations->video : "";

                  ?>

                <input type="file" id="img_url" name="image" img="false" style="display: none;">
                <input type="file" id="video_url" name="video" vid="false" style="display: none;">

                <!-- <div class="upload_align">
                  <div class="user_img mr-2" title="Change Image" style="
                  position: relative; margin-bottom: 16px;">
                  <img class="click_upload img_upload" id="image_up" src="{{$image}}" alt="woman">

                  <span class="img_error"></span>

                  </div>
                </div> -->


                <div class="user_img" title="Change Video" style="
              margin: auto; position: relative; margin-bottom: 12px;">
                  <div style="margin-bottom: 18px;">
                    <video width="320" height="240" controls="" class="video_setup video_upload" id="video_src" src="{{$video}}">
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
                <span class="video_err"></span> 
                  
                </div>
                
                 
                  <!-- <div class="add_content">
                     <div action="">
                        <label for="" class="pb-1">
                        Description
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="form-control" rows="5" cols="87" name="description" id="description" placholder="Enter description">{{$defense_situations->description}}</textarea>
                           @if($errors->first('descrption'))
                           <span class="text-danger error">{{$errors->first('descrption')}}</span>
                           @endif()
                        </div>
                     </div>
                  </div> -->

                  <div class="text-center">
                     <button type="submit" id="submit_btn" class="btn btn-warning same_wd_btn">Update</button>
                  </div>
               </form>
            </div>
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

<script>
   $('.checkmarks').on('change', function() {
      //alert("test");
      $('.checkmarks').not(this).prop('checked', false);  
   });
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>




<script type="text/javascript">
  $(document).ready(function(){


    let check_vid = "{{$defense_situations->video}}";
    let check_img = "{{$defense_situations->image}}";

    if(check_vid.length > 0){
      $("#video_url").attr("vid","true");
      $(".add_img").hide();
    }

    if(check_img.length > 0){
      $("#img_url").attr("img","true");
    }

    $(".video_upload").click(function(){
          $("#video_url").click();
      });


    $("#video_url").change(function(event){
        
              var file = event.target.files[0];

              var size = event.target.files[0].size;

              if (file) {

               if(file.type == "video/mp4" || file.type == "application/mp4" || file.type == "video/quicktime"){

                var video = document.createElement('video');
                video.preload = 'metadata';

                video.onloadedmetadata = function() {
                 window.URL.revokeObjectURL(video.src);
                 var duration = Math.round(video.duration,0);
                 
                 
                 if(duration < 0){ //currently not show error always use else part 
                    $(".video_err").text("Video duration should be less than 2 Minutes.").show();

                    $("#video_url").val("");
                    $('#video_src').attr('src',"");
                    document.getElementById("video_url").removeAttribute("vid");
                    $(".add_img").show();
                    return false;
                 }else{

                    if(size > 52428800){
                    $(".video_err").text("Video should not be greater than 50 MB.").show();

                    $("#video_url").val("");
                    $('#video_src').attr('src',"");
                    //attr remove
                    $("#video_url").attr("vid","false");
                    
                    $(".add_img").show();
                    return false;
                }


                  var reader = new FileReader();
                  
                  reader.onload = function(e) {
                    $('#video_url').attr('src', e.target.result);
                    $('#video_src').attr('src', e.target.result);
                    //attr set
                    document.getElementById("video_url").setAttribute("vid", "true");
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
                $('#video_src').attr('src',"");
                
                $("#video_url").attr("vid","false");
                $(".add_img").show();
             }
            }
            });




    $("#image_up").click(function(){
          $("#img_url").click();
      });


    $("#img_url").change(function(event){
        
      var file = event.target.files[0];

        if (file) {

                var size = event.target.files[0].size;


               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){

                  if(size > 20971520){
                      $(".img_error").text("Image should not be greater than 20 MB.").show();

                      $("#img_url").val("");
                      $('#image_up').attr('src',"{{url('public/admin/assets/img/dum5_l.jpg')}}");
                      //attr remove
                      $("#img_url").attr("img","false");
                      return false;
                  }
                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#img_url').attr('src', e.target.result);
                  $('#image_up').attr('src', e.target.result);
                  //attr set
                  document.getElementById("img_url").setAttribute("img", "true");
                }
        
               reader.readAsDataURL(file);
               $(".img_error").text("").hide();
              }else {
                $(".img_error").text("Please select jpg, jpeg or png image format only.").show();
                $("#img_url").val("");
                $('#image_up').attr('src',"{{url('public/admin/assets/img/dum5_l.jpg')}}");
                
                $("#img_url").attr("img","false");
             }
            }
            })


  })
</script>


<script type="text/javascript">
   $(document).ready(function(){


    $("#submit_btn").on("click",function(){
      /*let img_attr = $("#img_url").attr("img");

      if(img_attr == "false"){
        $(".img_error").text("Please upload image.").show();
      }else{
        $(".img_error").text("").hide(); 
      }*/

      let video_attr = $("#video_url").attr("vid");

      if(video_attr == "false"){
        $(".video_err").text("Please upload video.").show();
      }else{
        $(".video_err").text("").hide();
      }
    });

   $("#validate_form").validate({

           rules : {
   
            /*description : {
                   required : true,
                   maxlength: 500
               }*/
           },
           messages : {
   
          /*description : {
                   required : "Please enter description.",
                   maxlength:"Description should be less than or equal to 500 characters."
               },*/
              

           },
           submitHandler:function(form){

              let validate = "false";
              let check_is_video = $("#video_url").attr("vid");
              let check_is_image = $("#img_url").attr("img");

              if(check_is_video == "false"){
                $(".video_err").text("Please upload video.").show();
                validate = "true";
              }

              /*if(check_is_image == "false"){
                $(".img_error").text("Please upload image.").show();
                validate = "true";
              }*/

              if(validate == "true"){
                return false;
              }else{
                $("#lodaerModal").modal("show");
                $("#lodaerModal").unbind("click");
                form.submit();
              }
           }
       });
   
       });
</script>

  
@endsection()