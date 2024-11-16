@extends('admin.layout.layout')
@section('title','Edit Question Answer')
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

   <style>
/* The checkout */
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

.dashboard_panel .add_imgae_box .user_img video.video_upload {
      border: 2px solid #daa905;
  }

  .dashboard_panel .add_imgae_box .user_img img.img_upload {
    border-radius: 7px;
    height: 150px;
    width: 176px;
    object-fit: contain;
    border: 2px solid #daa905;
    margin-bottom: 22px;
}


textarea {
    resize: none;
}

.add_content.situation h3 {
    color: #fff;
    margin-top: 25px;
    margin-bottom: 40px;
    font-size: 33px;
}


.img_err {
      text-align: center;
      width: 100%;
      display: block;
  }


  span.img_err {
  
    color: #ff0000!important;
    font-size: 100%!important;
    
  }
  span.img_err:hover {
    color: #ff0000!important;
  }


</style>

<div class="main-panel dashboard_panel">
   <div class="content">
      <div class="page-inner" style="padding-right: 12px;">
         <div class="navbar_bar">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active"><a href="{{route('admin.questionAnswerManagement')}}">Question Answer Management</a></li>
                  <li class="breadcrumb-item remove_hover">Edit Question Answer</li>
                  <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
               </ol>
            </nav>
         </div>
         <h1>Edit Question Answer</h1>
         <div class="card">
            <div class="card-body add_imgae_box">
               <form method="POST" id="validate_form" enctype="multipart/form-data">
                  {{@csrf_field()}}


                  <input type="file" name="video_url" id="video_url" style="display: none;" accept="video/*">
                  <input type="file" name="situation_img" id="situation_img" style="display: none;" accept="image/*">


                  <div class="user_img" title="Change Video" style="
              margin: auto; position: relative; margin-bottom: 12px;">
              <div style="margin-bottom: 18px;">
                <video width="320" height="240" controls class="video_setup video_upload" id="video_src" src="{{$question_answer->video_url}}">
                  <source src="" type="video/mp4">
                  <source src="" type="video/ogg">
                  Your browser does not support the video tag.
                </video>
                <!-- <div class="add_img">
                  <img class="video_upload" src="{{url('public/admin/assets/img/plus.png')}}" alt="plus" style="bottom: -14px; margin-left: 80px;">
                </div> -->
                
              </div>
              </div>

                <div>
                <span class="text-danger error video_err">{{$errors->first('video_url')}}</span>  
                  
                </div>

                  <div class="add_content">
                     <div action ="" class="pt-5">
                        <label for="" class="pb-1">
                           Defensive Situation
                        </label>
                        <div class="form-group selectdiv pb-3">
                           <select class="form-control" name="defensive_situation_id" id="defensive_situation_id" class="form-control">
                              @foreach($defense_situations as $defense_situation )
                                 <option value="{{$defense_situation->id}}"@if($defense_situation->situation_name == $question_answer->defensiveSituation->situation_name) selected @endif >{{$defense_situation->situation_name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="add_content">
                     <div action="">
                        <label for="" class="pb-1">
                        Question
                        </label>
                        <div class="form-group pb-3">
                           <input type="text" class="form-control" value="{{$question_answer->question}}" placeholder="Enter Question" name="question" />
                           @if($errors->first('question'))
                           <span class="text-danger error">{{$errors->first('question')}}</span>
                           @endif()
                        </div>
                     </div>
                  </div>
                  <div class="add_content">
                     <label for="" class="pb-1">
                     You Are
                     </label>
                     <div class="form-group pb-3">
                        <input type="text" class="form-control" value="{{$question_answer->you_are}}" id="you_are" name="you_are" placeholder="Enter You Are" />
                        @if($errors->first('you_are'))
                        <span class="text-danger error">{{$errors->first('you_are')}}</span>
                        @endif()
                     </div>
                  </div>
                  <div class="add_content">
                     <label for="" class="pb-1">
                     Runners On
                     </label>
                     <div class="form-group pb-3">
                        <input type="text" class="form-control" value="{{$question_answer->runners_on}}" id="runners_on" name="runners_on" placeholder="Enter Runners On" />
                        @if($errors->first('runners_on'))
                        <span class="text-danger error">{{$errors->first('runners_on')}}</span>
                        @endif()
                     </div>
                  </div>
                  <div class="add_content">
                     <label for="" class="pb-1">
                     Outs
                     </label>
                     <div class="form-group pb-3">
                        <input type="text" class="form-control" value="{{$question_answer->out}}" id="out" name="out" placeholder="Enter Outs" />
                        @if($errors->first('out'))
                        <span class="text-danger error">{{$errors->first('out')}}</span>
                        @endif()
                     </div>
                  </div>
                  <div class="add_content">
                     <label for="" class="pb-1">
                     Also Think About It
                     </label>
                     <div class="form-group pb-3">
                        <textarea rows="5" cols="87" id="also_think_about_it" name="also_think_about_it" placeholder="Enter Also Think About It">{{$question_answer->also_think_about_it}}</textarea>
                        @if($errors->first('also_think_about_it'))
                        <span class="text-danger error">{{$errors->first('also_think_about_it')}}</span>
                        @endif()
                     </div>
                  </div>

                  <?php
                        $answerss=$question_answer->answers; 
                        $answer_text=array('Answer One','Answer Two','Answer Three','Answer Four');
                        $i=0;
                        $k=0;
                        $answer = 0;
                  ?>
                @foreach($answerss as $key=>$value)

                  <div class="add_content">
                     <label for="" class="pb-1">
                     {{$answer_text[$i++]}}
                     </label>
                     <div class="form-group pb-3">
                        <div class="row">
                            <div class="col-md-11">
                                    <input type="text" class="form-control answer_req" value="{{$value->answer}}" name="answer[{{$answer}}]" placeholder="Enter Answer" />
                                    @if($errors->first('answer_one'))
                                    <span class="text-danger error">{{$errors->first('answer_one')}}</span>
                                    @endif()
                            </div>
                            <div class="col-md-1 mt-3">
                                <!-- <input type="radio" class="form-control" name="answer" value="1"/> -->
                                <label class="checkout">
                                    <input type="checkbox" class="checkmarks" @if($value->is_correct == 1) checked @endif name="is_correct" value="{{$k++}}">
                                       <span class="checkmark"></span>
                                 </label>
                            </div>        
                        </div>    
                     </div>
                  </div>
                  <?php $answer++; ?>
                @endforeach

                  <div class="add_content situation">
                  <h3>Situation Management</h3>
                  </div>

                  <?php 
                    if(!empty($question_answer->situation_img)){
                      $img = $question_answer->situation_img;
                    }else{
                      $img = url('public/admin/assets/img/dum5_l.jpg');
                    }

                  ?>
                  <div class="upload_align">
                    <div class="user_img mr-2" title="Change Image" style="
                      position: relative;">
                      <img class="click_upload img_upload" id="image_up" src="{{$img}}" alt="woman">
                    </div>
                  </div>

                  <div>
                    <span class="text-danger error img_err"></span>  
                  
                  </div>


                  <div class="add_content">
                     <label for="" class="pb-1">
                     Description
                     </label>
                     <div class="form-group pb-3">
                        <textarea rows="5" cols="87" id="situation_description" name="situation_description">{{$question_answer->situation_description}}</textarea>
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

<div id="myModal" class="modal fade" role="dialog">
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
        <p style="font-size:18px;margin-top: 15px;">Please select atleast one answer.</p>
    </div>
      </div>
      <div class="modal-footer">
          
          <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

    $(".video_upload").click(function(){
          $("#video_url").click();
      });


    let check_is_vid = "{{$question_answer->video_url}}";
    let is_img_situation = "{{$question_answer->situation_img}}";

    if(check_is_vid.length > 0){
      $("#video_url").attr("is_video","true");
    }

    if(is_img_situation.length > 0){
      $("#situation_img").attr("situation_img","true");
    }


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
                 
                 if(duration < 0){ //currently not show error always use else part 
                    $(".video_err").text("Video duration should be less than 2 Minutes.").show();

                    $("#video_url").val("");
                    $('#video_src').attr('src',"");
                    //attr remove
                    document.getElementById("video_url").removeAttribute("is_video");
                    $(".add_img").show();
                    return false;
                 }else{



                      if(size > 52428800){
                    $(".video_err").text("Video should not be greater than 50 MB.").show();

                    $("#video_url").val("");
                    $('#video_src').attr('src',"");
                    //attr remove
                    document.getElementById("video_url").removeAttribute("is_video");
                    $(".add_img").show();
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
                $('#video_src').attr('src',"");
                
                document.getElementById("video_url").removeAttribute("is_video");

                $(".add_img").show();
             }
            }
            });


    $(".img_upload").click(function(){
          $("#situation_img").click();
      });


    $("#situation_img").change(function(event){
        
      var file = event.target.files[0];

        if (file) {

                var size = event.target.files[0].size;


               if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png"){

                  if(size > 20971520){
                      $(".img_err").text("Image should not be greater than 20 MB.").show();

                      $("#situation_img").val("");
                      $('#image_up').attr('src',"{{url('public/admin/assets/img/dum5_l.jpg')}}");
                      //attr remove
                      $("#situation_img").attr("situation_img","false");
                      return false;
                  }
                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#situation_img').attr('src', e.target.result);
                  $('#image_up').attr('src', e.target.result);
                  //attr set
                  document.getElementById("situation_img").setAttribute("situation_img", "true");
                }
        
               reader.readAsDataURL(file);
               $(".img_err").text("").hide();
              }else {
                $(".img_err").text("Please select jpg, jpeg or png image format only.").show();
                $("#situation_img").val("");
                $('#image_up').attr('src',"{{url('public/admin/assets/img/dum5_l.jpg')}}");
                
                $("#situation_img").attr("situation_img","false");
             }
            }
            });

  });
</script>

<script type="text/javascript">
   $(document).ready(function(){



    $("#submit_btn").on("click",function(){


        let file_check = $("#video_url").attr('is_video');
        let img_check = $("#situation_img").attr('situation_img');

            if(file_check == "true"){
              $(".video_err").text("").hide();
            }else{
               $(".video_err").text("Please upload video.").show();
            }

            if(img_check == "true"){
              $(".img_err").text("").hide();
            }else{
              $(".img_err").text("Please upload image");
            }

    });

      
     $("#validate_form").on("submit",function(){

        $('.answer_req').each(function() {
           $(this).rules("add", {
               required: true,
               maxlength:200,
               messages: {
                   required: "Please enter answer.",
                   maxlength: "Answer should be less than 200 characters."
                }
           });
         });
     }); 

   
       $("#validate_form").validate({

           rules : {
   
            question : {
                   required : true,
                   maxlength: 500
               },
               you_are : {
                  required : true,
                  maxlength:50

               },
               runners_on : {
                  required : true,
                  maxlength:50
              },
            out:{
               required : true,
               maxlength:50
            },
            also_think_about_it:{
               required : true,
               maxlength:2000
            },
            situation_description : {
              required : true,
              maxlength: 500
            }             
           },
           messages : {
   
            question : {
                   required : "Please enter question.",
                   maxlength:"Question should be less than or equal to 500 characters."
               },
               you_are : {
                required : "Please enter you are.",
                  maxlength:"You are should be less than 50 characters."
               },
               runners_on:{
                required : "Please enter runners on.",
                  maxlength:"Runner on should be less than 50 characters."
               },
               out :{
                required : "Please enter outs.",
                  maxlength:"Outs should be less than 50 characters."
               },
               also_think_about_it:{
                  required : "Please enter also think about it.",
                  maxlength:"Also think about it should be less than or equal to 500 characters."
               },
               situation_description : {
                required : "Please enter description.",
                maxlength: "Description should be less than 500 characters."
               }

           },
           submitHandler:function(form){
            $("#submit_btn").prop('disabled', true);

            let validate = "false";

            var checkbox_check = $('input[type="checkbox"]:checked').length;

            let file_check = $("#video_url").attr('is_video');
            let img_check = $("#situation_img").attr('situation_img');

            if(file_check == "true"){

            }else{
              $(".video_err").text("Please upload video.").show();
              validate = "true";
            }


            if(img_check == "true"){

            }else{
              $(".img_err").text("Please upload image.").show();
              validate = "true";
            }

            if(validate == "true"){
              $("#submit_btn").attr('disabled', false);
              return false;
            }

            if(checkbox_check>0){
                $("#lodaerModal").modal("show");
                $("#lodaerModal").unbind("click");
               form.submit();
            }
            else{
               $("#submit_btn").prop('disabled', false);
               $("#myModal").modal("show");
               return false;
            }
   
   
           }
       });
   
       });
</script>

  
@endsection()