@extends('admin.layout.layout')
@section('title','Challenge/Badge Management')
@section('content')


<style type="text/css">
	.dashboard_panel .same_wd_btn {
  
    width: 94px;
    
}

</style>


		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item remove_hover">Challenge/Badge Management</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>
					<h1>Challenge/Badge Management</h1>
					<div class="card">
						<div class="card-body">
							<div class="add_btn">
								<a href="{{route('admin.addChallengeBadge')}}">
									<button type="button" class="btn btn-warning same_wd_btn">Add</button>
								</a>
							</div>
							<div class="serch_icon">
								<i class="fas fa-search"></i>
							</div>
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th class="text-left" width="320">Badge Image</th>
											<th width="400">Challenge Name</th>
											<th class="text-center" width="200">Action</th>
										</tr>
									</thead>
									<tbody>

										<?php $i = 1; ?>
										@foreach($challenge_badges as $challenge_badge)

										<?php 

											if(!empty($challenge_badge->image)){
												$img = $challenge_badge->image;
											}else{
												$img = url('public/admin/assets/img/arashmil.jpg');
											}


											$challenge_name = strlen($challenge_badge->challenge_name) > 50 ? substr($challenge_badge->challenge_name,0,50)."..." : $challenge_badge->challenge_name;

										?>
										<tr>
											<td>{{$i++}}</td>
											<td class="user_img">
												<img src="{{$img}}" alt="arashmil">
											</td>
											<td>{{$challenge_name}}</td>
											<td class="text-center" style="padding-right: 11px !important;">
												<a href="{{route('admin.viewChallengeBadge',base64_encode($challenge_badge->id))}}">
													<button type="button" class="btn btn-warning same_wd_btn mr-2">View</button>
												</a>
												<a href="{{route('admin.editChallengeBadge',base64_encode($challenge_badge->id))}}">
													<button type="button" class="btn btn-warning same_wd_btn border_btn mr-2">Edit</button>
												</a>
												
													<button type="button" ui="{{base64_encode($challenge_badge->id)}}" class="btn btn-warning same_wd_btn delete">Delete</button>
												
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
        <p style="font-size: 18px;">Are you sure you want to delete this challenge/badge?</p>
    </div>
      </div>
      <form method="POST" action="{{route('admin.deleteChallenge')}}" id="deleteForm">
      	{{@csrf_field()}}
      	<input type="hidden" name="challenge_id" id="challenge_id">
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
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});
	</script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>



	<script type="text/javascript">
		$(document).ready(function(){

			$(document).on("click",".delete",function(){

				let challenge_id = $(this).attr("ui");
				$("#myModal").modal("show");
				$("#challenge_id").val(challenge_id);
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