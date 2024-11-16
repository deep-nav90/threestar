@extends('admin.layout.layout')
@section('title','Question Answer Management')
@section('content')
<style>

table#basic-datatables {
    margin-top: 10px!important;
    display: inline-block;
}
p#selectTriggerFilter {
    position: absolute;
    top: 45px;
    z-index: 99;
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
	padding: 2px 0px !important;
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


.dashboard_panel .card .card-body .serch_icon i {
    right: 195px !important;
}





/* table tr th::after {
	right: .5em;
    content: "\2193";
    font-size: 15px;
	position: absolute;
    bottom: .9em;
    display: block;
    opacity: .5;
} */

</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item remove_hover">Question Answer Management</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>
					<h1>Question Answer Management</h1>
					<div class="card">
						<div class="card-body">
							<div class="add_btn">
								<a href="{{route('admin.addQuestionAnswerManagement')}}">
									<button type="button" class="btn btn-warning same_wd_btn">Add</button>
								</a>
							</div>
							<div class="serch_icon">
								<i class="fas fa-search"></i>
							</div>

							<p id="selectTriggerFilter"><label><b>Situation Name:</b></label><br></p>
							<div class="table-responsive">
								<table id="management-datatable" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th width="320" >Question</th>
											<th width="180" >Situation Name</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										@foreach($question_answers as $question_answer)
										<tr>
                                            <?php 
                                                $question = strlen($question_answer->question) > 40 ? substr($question_answer->question,0,40)."..." : $question_answer->question;
                                            ?>
											<td>{{$i++}}</td>
											<td>{{$question}}</td>
											<td class="">{{$question_answer->defensiveSituation->situation_name}}</td>
											<td class="text-center" style="padding-right: 15px !important;">
												<a href="{{route('admin.viewQuestionAnswerManagement',base64_encode($question_answer->id))}}">
													<button type="button" class="btn btn-warning same_wd_btn mr-2">View</button>
												</a>
												<a href="{{route('admin.editQuestionAnswer',base64_encode($question_answer->id))}}">
													<button type="button" class="btn btn-warning same_wd_btn border_btn mr-2">Edit</button>
												</a>

													<button type="button" qi="{{base64_encode($question_answer->id)}}" class="btn btn-warning same_wd_btn delete">Delete</button>
												
											</td>
										</tr>
										
										@endforeach()
										
										
									</tbody>
								</table>
							</div>
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
        <p style="font-size: 18px;">Are you sure you want to delete this question?</p>
    </div>
      </div>
      <form method="POST" action="{{route('admin.deleteQuestionAnswer')}}" id="deleteForm">
      	{{@csrf_field()}}
      	<input type="hidden" name="question_id" id="question_id">
	      <div class="modal-footer">
	      	<button type="button" id="ok" class="btn btn-default" data-dismiss="modal">Ok</button>
	        <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
	      </div>
  	</form>
    </div>

  </div>
</div>


@endsection()

@section('js')

<script>
$(document).ready(function() {

$("#management-datatable").DataTable({
		  
    initComplete: function() {
      var column = this.api().column(2);

      var select = $('<select class="filter form-control"><option value="">All</option></select>')
        .appendTo('#selectTriggerFilter')
        .on('change', function() {
          var val = $(this).val();
          column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
        });

		select.append('<option value="Catcher">Catcher</option>');
		select.append('<option value="Pitcher">Pitcher</option>');
		select.append('<option value="First Base">First Base</option>')
		select.append('<option value="Second Base">Second Base</option>');
		select.append('<option value="Third Base">Third Base</option>');
		select.append('<option value="Short Step">Short Step</option>');
		select.append('<option value="Left Field">Left Field</option>')
		select.append('<option value="Center Field">Center Field</option>');
		select.append('<option value="Right Field">Right Field</option>');
    }
});

});
		
</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$(document).on("click",".delete",function(){

				let question_id = $(this).attr("qi");
				$("#myModal").modal("show");
				$("#question_id").val(question_id);
				$("#myModal").unbind("click");
			});


			$("#cancel").on("click",function(){
				$("#myModal").modal("hide");
			});

			$("#ok").on("click",function(){
				$("#deleteForm").submit();
			});
		});
	</script>
@endsection()


