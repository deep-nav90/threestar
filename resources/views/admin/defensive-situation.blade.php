@extends('admin.layout.layout')
@section('title','Situation Management')
@section('content')
<style>
td.defensive_situation {
    word-break: break-all;
    white-space: break-spaces;
}
</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item remove_hover">Situation Management</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>
					<h1>Situation Management</h1>
					<div class="card">
						<div class="card-body">
							<div class="serch_icon">
								<i class="fas fa-search"></i>
							</div>
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Category Name</th>
											<!-- <th>Description</th> -->
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										@foreach($defensivesituations as $defensivesituation)
										<tr>
											<td>{{$i++}}</td>
											<td>{{$defensivesituation->situation_name}}</td>
											<!-- <td class="defensive_situation">{{$defensivesituation->description}}</td> -->
											<td class="text-center" style="padding-right: 15px !important;">
												<a href="{{route('admin.editSituationManagement',base64_encode($defensivesituation->id))}}">
													<button type="button" class="btn btn-warning same_wd_btn border_btn mr-2">Edit</button>
												</a>
												
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








@endsection()

@section('js')
		
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
		});
	</script>

@endsection()


