@extends('admin.layout.layout')
@section('title','Challenge/Badge Details')
@section('content')


<style type="text/css">
	.dashboard_panel #basic-datatables {
    white-space: inherit;
}
</style>
		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.challengeBadgeManagement')}}">Challenge/Badge Details Management</a></li>
								<li class="breadcrumb-item remove_hover">Challenge/Badge Details</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Challenge/Badge Details</h1>


					<?php 

						if(!empty($challenge_find->image)){
							$img = $challenge_find->image;
						}else{
							$img = url('public/admin/assets/img/dum_l.jpg');
						}
					?>

					<div class="card">
						<div class="card-body add_imgae_box">
							<div class="user_img" style="    width: 12%;
							margin: auto; position: relative;">
								<img src="{{$img}}" alt="woman">
								<!-- <div class="add_img">
									<img src="../assets/img/plus.png" alt="plus">
								</div> -->
							</div>
							<div class="table-responsive simple_table">
								<table id="basic-datatables" class="display table table-striped table-hover" >
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
											<th>Challenge Name</th>
											<td>
												{{$challenge_find->challenge_name}}
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