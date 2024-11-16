@extends('admin.layout.layout')
@section('title','View Question Answer Details')
@section('content')
<style>
    /* The checkout */
.checkout {
    display: block;
    position: absolute;
    right: 18px;
    top: 42px;
    padding-left: 35px;
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
  top: -23px;
  left: 43px;
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

td.think_about {
    word-break: break-all;
    white-space: normal;
}
.checkout .checkmark {

    right: 0px !important;
    left:unset !important;
}

.answer_20 {
    word-break: break-all;
    white-space: normal;
    padding-right: 63px;
}
.answer{
    position:relative;
}


.video_setup {
    width: 200px;
    height: 150px;
    border: 2px solid #daa905;
    border-radius: 7px;
    cursor: pointer;
    margin-top: 25px;
  }

  .video_err {
      text-align: center;
      width: 100%;
      display: block;
  }

  
.upload_align .user_img .img_upload {
    border-radius: 7px;
    height: 150px;
    width: 176px;
    object-fit: contain;
    border: 2px solid #daa905;
    margin-top: 16px;
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
                                <li class="breadcrumb-item remove_hover">View Question Answer Details</li>
                        </ol>
            </nav>
          </div>
          <h1>View Question Answer Details</h1>
          <div class="card">
            <div class="card-body">
              <div class="table-responsive simple_table">
                <table id="basic-datatables" class="display table table-striped table-hover dataTable" >
                  <!-- <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th class="text-left">Profile Image</th>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <tr>
                      <th>
                        Situation Animation
                      </th>
                      <td>
                        <div class="user_img" title="Upload Video" style="
                          margin: auto; position: relative; margin-bottom: 12px;">
                          <div style="margin-bottom: 18px;">
                            <video width="320" height="240" controls class="video_setup video_upload" id="video_src" src="{{$question_answer->video_url}}">
                              <source src="movie.mp4" type="video/mp4">
                              <source src="movie.ogg" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                            <!-- <div class="add_img">
                              <img class="video_upload" src="http://localhost/projects/brain/public/admin/assets/img/plus.png" alt="plus" style="bottom: -14px; margin-left: 80px;">
                            </div> -->
                            
                          </div>
                          </div>
                      </td>
                    </tr>

                    <tr>
                  <th>Defensive Situation </th>
                      <td>
                        {{$question_answer->defensiveSituation->situation_name}}
                      </td>
                    </tr>
                    <tr>
                      <th>Question</th>
                      <td>
                        {{$question_answer->question}}
                      </td>
                    </tr>
                    <tr>
                      <th>You Are</th>
                      <td>
                                            {{$question_answer->you_are}}
                      </td>
                    </tr>
                    <tr>
                      <th> Runners On</th>
                      <td>
                                            {{$question_answer->runners_on}}
                      </td>
                    </tr>
                    <tr>
                      <th>Outs</th>
                      <td>
                                            {{$question_answer->out}}
                      </td>
                                        </tr>
                                        <tr>
                      <th> Also Think About It</th>
                      <td class="think_about">
                                            {{$question_answer->also_think_about_it}}
                      </td>
                                        </tr>
                                        <?php
                                                $answerss=$question_answer->answers; 
                                                $answer_text=array('Answer One','Answer Two','Answer Three','Answer Four');
                                                $i=0;
                                        ?>
                                        @foreach($answerss as $key=>$value)
                                            <tr>
                      <th>{{$answer_text[$i++]}}</th>
                      <td class="answer">
                        <div class="answer_20">
                                            {{$value->answer}}
</div>
                                            <!-- {{$value->is_correct}} -->
                                            <!-- <input type="checkbox"@if($value->is_correct == 1) checked @endif disabled> -->
                                            <label class="checkout">
                                            <input type="checkbox" class="checkmarks" @if($value->is_correct == 1) checked @endif disabled>
                                                
                                                <span class="checkmark"></span>
                                            </label>
                      </td>
                                        </tr>
                                        @endforeach


                      <tr>
                      <th>Situation Image</th>
                      <td>

                        <div class="upload_align">
                          <div class="user_img mr-2" style="
                          position: relative; margin-bottom: 16px;">

                          <?php 
                            if($question_answer->situation_img){
                              $img = $question_answer->situation_img;
                            }else{
                              $img = url('public/admin/assets/img/dum5_l.jpg');
                            }
                          ?>
                          <img class="click_upload img_upload" src="{{$img}}" alt="woman">
                          </div>
                        </div>

                      </td>
                    </tr>

                    <tr>
                      <th>Situation Description</th>
                      <td>
                                            {{$question_answer->runners_on}}
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection()