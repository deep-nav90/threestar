@extends('admin.layout.layout')
@section('title','Data Management')
@section('content')
<style>
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
   .video_err_1 {
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
   span.video_err_1 {
   color: #ff0000!important;
   font-size: 100%!important;
   }
   span.video_err_1:hover {
   color: #ff0000!important;
   }
   .dashboard_panel .add_imgae_box .user_img video.video_upload {
   border: 2px solid #daa905;
   }
   table#basic-datatables {
   margin-top: 10px!important;
   display: inline-block;
   }
   p#selectTriggerFilter {
   position: absolute;
   top: 45px;
   z-index: 9999;
   left: 50%;
   transform: translate(-50%, -50%);
   }
   p#selectTriggerFilter label {
   display: flex;
   width: 197px;
   line-height: 35px;
   }
   select.filter.form-control {
   background-color: #fff;
   color: #000;
   cursor: pointer;
   padding:0px !important;
   }
   p#selectTriggerFilter {
   display: flex;
   width: 264px;
   height: 36px;
   }
   .dashboard_panel .same_wd_btn{
   width: 81px;
   }
   .form-control {
   font-size: 13px;
   }
   .tab {
   overflow: hidden;
   border: 1px solid #ccc;
   background-color: #f1f1f1;
   width: 610px;
   display:flex;
   }
   /* Style the buttons inside the tab */
   .tab button {
   background-color: inherit;
   float: left;
   border: none;
   outline: none;
   cursor: pointer;
   padding: 14px 16px;
   transition: 0.3s;
   font-size: 17px;
   }
   /* Change background color of buttons on hover */
   .tab button:hover {
   background-color: #ddd;
   }
   /* Create an active/current tablink class */
   .tab button.active {
   background-color: #daa905;
   }
   .tabcontent h3 {
   font-size: 20px;
   color: #fff;
   text-align: center;
   margin: 18px 0;
   }
   /* Style the tab content */
   .tabcontent {
   display: none;
   padding: 6px 12px;
   border: 1px solid #ccc;
   /* border-top: none; */
   }
   .form-group.pb-3 {
   position: relative;
   /* display: flex; */
   }

   label#description-error {
    position: absolute;
    top: 315px;
   }

label#description_1-error { 
   position: relative;
    top: 333px;
}


label#description_2-error { 
   position: relative;
    top: 333px;
}
.tab {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
div#dsd,div#tvd {
    border-radius: 5px;
    border: 1px solid #fff;
}
button#submit_btn {
    margin: 14px 0 21px;
}

.data_enter {
    margin: 5px 0 21px !important;
}

label.pb-1 {
    margin-left: 9px !important;
}


textarea#title {
    background-color: #fff;
    height: 80px!important;
}

textarea#title1 {
    background-color: #fff;
    height: 80px!important;
}

textarea#heading {
    background-color: #fff;
    height: 80px!important;
}

textarea#heading1 {
    background-color: #fff;
    height: 80px!important;
}
</style>
<div class="main-panel dashboard_panel">
   <div class="content">
      <div class="page-inner" style="padding-right: 12px;">
         <div class="navbar_bar">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item remove_hover">Data Management</li>
                  <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
               </ol>
            </nav>
            @include('admin.layout.notification')
         </div>
         <h1> Data Management </h1>
         <div class="card">
            <div class="card-body">
               <div class="tab">
                  <button class="tablinks active" onclick="openCity(event, 'dsd')">Defensive Situation Data Management</button>
                  <button class="tablinks" onclick="openCity(event, 'tvd')">Training Videos Data Management</button>
               </div>
               <div id="dsd" class="tabcontent mt-3" style="display: block;">
                  <h3> Defensive Situation Data Management</h3>
                  <form method="POST" action="{{url('admin/edit-defensive-video-data-management')}}" enctype="multipart/form-data" id="validate_form">
                     {{@csrf_field()}}
                     <?php 
                        $video_file = $defensive_situation_management->file_name;
                        ?>
                     <input type="file" name="file_name" id="video_url" tooltip="Change Video" style="display: none;" accept="video/*">
                     <div class="card-body add_imgae_box">
                        <div class="user_img" title="Change Video" style="
                           margin: auto; position: relative; margin-bottom: 12px;">
                           <div style="margin-bottom: 18px;">
                              <video width="320" height="240" controls class="video_setup video_upload" src="{{$video_file}}" id="video_src">
                                 <source src="" type="video/mp4">
                                 Your browser does not support the video tag.
                              </video>
                           </div>
                        </div>
                        <div>
                           <span class="text-danger error video_err">{{$errors->first('video_url')}}</span> 
                        </div>
                     </div>
                     

                     <div class="add_content" class="mt-3">
                        <label for="" class="p-2">
                        Title 
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="form-control" id="title" name="title" style="width: 100%;">{{$defensive_situation_management->title}}</textarea>
                        <label id="title-error" class="error" for="title"></label>
                        </div>


                     </div>

                     <div class="add_content" class="mt-3">
                        <label for="" class="p-2">
                        Heading 
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="form-control" id="heading" name="heading" style="width: 100%;">{{$defensive_situation_management->heading}}</textarea>
                           <label id="heading-error" class="error" for="heading" style=""></label>
                        </div>


                     </div>


                     <div class="add_content" class="mt-3">
                        <label for="" class="p-2">
                        Description 
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="ckeditor form-control" id="description" name="description" style="width: 100%;">{{$defensive_situation_management->description}}</textarea>
                        </div>
                     </div>
                     <input type="hidden" value="{{$defensive_situation_management->id}}" name="id" />
                     <div class="text-center">
                        <button type="submit" id="submit_btn" class="btn btn-warning same_wd_btn">Update</button>
                     </div>
                  </form>
               </div>
               <div id="tvd" class="tabcontent mt-3">
                  <form method="POST" id="validate_form1" enctype="multipart/form-data" action="{{url('admin/edit-training-video-data-management')}}">
                     {{@csrf_field()}}
                     <h3>Training Videos Data Management</h3>
                     <?php 
                        $video_file_1 = $traning_video_management->file_name;
                        ?>
                     <input type="file" name="file_name_1" tooltip="Change Video" id="video_url_1" style="display: none;" accept="video/*">
                     <div class="card-body add_imgae_box">
                        <div class="user_img" title="Change Video" style="
                           margin: auto; position: relative; margin-bottom: 12px;">
                           <div style="margin-bottom: 18px;">
                              <video width="320" height="240" controls class="video_setup video_upload_1" src="{{$video_file_1}}" id="video_src">
                                 <source src="" type="video/mp4">
                                 Your browser does not support the video tag.
                              </video>
                           </div>
                        </div>
                        <div>
                           <span class="text-danger error video_err_1">{{$errors->first('video_url')}}</span> 
                        </div>
                     </div>


                     <div class="add_content mt-3 mb-2">
                        <label for="" class="pb-1">
                        Title
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="form-control" name="title1" id="title1">{{$traning_video_management->title}}</textarea>
                           <label id="title1-error" class="error" for="title1"></label>
                           @if($errors->first('title1'))
                           <span class="text-danger error">{{$errors->first('title1')}}</span>
                           @endif()
                        </div>
                     </div>



                     <div class="add_content mt-3 mb-2">
                        <label for="" class="pb-1">
                        Heading
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="form-control" name="heading1" id="heading1">{{$traning_video_management->heading}}</textarea>
                           <label id="heading1-error" class="error" for="heading1"></label>
                           @if($errors->first('heading1'))
                           <span class="text-danger error">{{$errors->first('heading1')}}</span>
                           @endif()
                        </div>
                     </div>


                     <div class="add_content mt-3 mb-2">
                        <label for="" class="pb-1">
                        Description (Speed/Balance & Agility)
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="ckeditor form-control" name="description_1">{{$traning_video_management->description_1}}</textarea>
                           @if($errors->first('description_1'))
                           <span class="text-danger error">{{$errors->first('description_1')}}</span>
                           @endif()
                        </div>
                     </div>
                     <div class="add_content mt-3 mb-2 ">
                        <label for="" class="pb-1">
                        Description (Strength/ Endurance & Corrections)
                        </label>
                        <div class="form-group pb-3">
                           <textarea class="ckeditor form-control" name="description_2">{{$traning_video_management->description_2}}</textarea>
                          
                           @if($errors->first('description_2'))
                           <span class="text-danger error">{{$errors->first('description_2')}}</span>
                           @endif()
                        </div>
                     </div>
                     <input type="hidden" name="id" value="{{$traning_video_management->id}}"/>
                     <div class="text-center">
                        <button type="submit" id="submit_btn1" class="btn data_enter btn-warning same_wd_btn">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection()
@section('js')



<script type="text/javascript">
   $(document).ready(function(){
   
        let old_video = "{{$video_file}}";
   
        if(old_video.length > 0){
           document.getElementById("video_url").setAttribute("is_video", "true");
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
                   
                   if(duration > 10){
                      $(".video_err").text("Video duration should be less than 10 Seconds.").show();
                      $("#video_url").val("");
                      //attr remove
                      return false;
                   }else{
   
                      if(size > 52428800){
                      $(".video_err").text("Video should not be greater than 50 MB.").show();
   
                      $("#video_url").val("");
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
                  $("#video_url").val("");
                  $(".video_err").text("Video should be type of mp4, mov only.").show();
                  document.getElementById("video_url").setAttribute("is_video", "false");
               }
              }
              })
   
   })
</script>
<script type="text/javascript">
   $(document).ready(function(){
   
        let old_video_1 = "{{$video_file_1}}";
   
        if(old_video_1.length > 0){
           document.getElementById("video_url").setAttribute("is_video_1", "true");
        }
    $(".video_upload_1").click(function(){
            $("#video_url_1").click();
        });
   
    $("#video_url_1").change(function(event){
                var file = event.target.files[0];
   
                var size = event.target.files[0].size;
                
                if (file) {
   
                 if(file.type == "video/mp4" || file.type == "application/mp4" || file.type == "video/quicktime"){
   
   
                    var video = document.createElement('video');
                    video.preload = 'metadata';
   
                    video.onloadedmetadata = function() {
                    window.URL.revokeObjectURL(video.src);
                    var duration = Math.round(video.duration,0);
                   
                   if(duration > 10){
                      $(".video_err_1").text("Video duration should be less than 10 Seconds.").show();
                      $("#video_url_1").val("");
                      //attr remove
   
                      return false;
                   }else{
   
                      if(size > 52428800){
                      $(".video_err_1").text("Video should not be greater than 50 MB.").show();
   
                      $("#video_url_1").val("");
                      return false;
                    }
   
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                      $('#video_url_1').attr('src', e.target.result);
                      $('#video_src_1').attr('src', e.target.result);
                      //attr set
                      document.getElementById("video_url_1").setAttribute("is_video", "true");
                    }
            
                   reader.readAsDataURL(file);
                   $(".video_err_1").text("").hide();
                   $(".add_img_1").hide();
   
                   }
                 }
   
                 video.src = URL.createObjectURL(file);
                 
                }else {
                  $("#video_url_1").val("");
                  $(".video_err_1").text("Video should be type of mp4, mov only.").show();
                  document.getElementById("video_url_1").setAttribute("is_video", "false");
               }
              }
              })
   
   })
</script>
<script>
   function openCity(evt, cityName) {
     var i, tabcontent, tablinks;
     tabcontent = document.getElementsByClassName("tabcontent");
     for (i = 0; i < tabcontent.length; i++) {
       tabcontent[i].style.display = "none";
     }
     tablinks = document.getElementsByClassName("tablinks");
     for (i = 0; i < tablinks.length; i++) {
       tablinks[i].className = tablinks[i].className.replace(" active", "");
     }
     document.getElementById(cityName).style.display = "block";
     evt.currentTarget.className += " active";
   }
</script>
<script>
   function readURL(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
       
       reader.onload = function(e) {
         $('#blah').attr('src', e.target.result);
       }
       
       reader.readAsDataURL(input.files[0]); // convert to base64 string
     }
   }
   
   $("#imgInp").change(function() {
     readURL(this);
   });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>

<script type="text/javascript">

$("#validate_form").validate({
            ignore : [],
            rules : {

               description : {
                    required : true,
                    maxlength: 2000
                },
                title:{
                  required: true,
                  maxlength:50
                },
                heading:{
                  required: true,
                  maxlength:100
                }
               
            },
            messages : {

              description : {
                    required : "Please enter description.",
                    maxlength: "Description should be less than 2000 characters."
                },
                title:{
                  required: "Please enter title.",
                  maxlength: "Title should be less than 50 characters."
                },
                heading:{
                  required: "Please enter heading.",
                  maxlength: "Heading should be less than 100 characters."
                }
            },
            submitHandler:function(form){
              $("#submit_btn").attr("disabled", true);
              $("#submit_btn1").attr("disabled", true);

              form.submit();
            }

        });


$("#validate_form1").validate({
            ignore : [],
            rules : {

               description_1 : {
                    required : true,
                    maxlength: 2000
                },
                description_2 : {
                    required : true,
                    maxlength: 2000
                },
                heading1:{
                  required: true,
                  maxlength: 100
                },
                title1:{
                  required: true,
                  maxlength:50
                }
               
            },
            messages : {

              description_1 : {
                    required : "Please enter description.",
                    maxlength: "Description should be less than 2000 characters."
                },
                description_2 : {
                    required : "Please enter description.",
                    maxlength: "Description should be less than 2000 characters."
                },
                heading1:{
                  required: "Please enter heading.",
                  maxlength: "Heading should be less than 100 characters."
                },
                title1:{
                  required: "Please enter title.",
                  maxlength: "Title should be less than 50 characters."
                }

            },
            submitHandler:function(form){
              $("#submit_btn1").attr("disabled", true);
              $("#submit_btn").attr("disabled", true);
              form.submit();
            }

        });
      </script>




<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.on('instanceReady', function () {
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].on('change', function () {
                this.updateElement();
            });
        }
    });
</script>
@endsection()