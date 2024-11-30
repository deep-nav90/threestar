@extends('admin.layout.layout')
@section('title','User Details')
@section('content')

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.userManagement')}}">User Management</a></li>
								<li class="breadcrumb-item remove_hover">User Details</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>User Details</h1>

					<div class="my-tree">
								<a href="{{route('admin.treeView',base64_encode($userDetails->id))}}">
									<button type="button" class="btn btn-warning same_wd_btn">My Tree</button>
								</a>
							</div>

					<div class="card">
						<div class="card-body add_imgae_box">
							
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
											<th>Sponser ID & Name</th>
											<td>
												{{$userDetails->sponserDetails->sponserUser->custom_user_id}} ({{$userDetails->sponserDetails->sponserUser->name}})
											</td>
										</tr>

										<tr>
											<th>Upline ID & Name</th>
											<td>
												{{$userDetails->uplineDetails->uplineUser->custom_user_id}} ({{$userDetails->uplineDetails->uplineUser->name}})
											</td>
										</tr>
										<tr>
											<th>Username</th>
											<td>
												{{$userDetails->name}}
											</td>
										</tr>
										<tr>
											<th>Date of Birth</th>
											<td>
												<?php 
													$dob = Carbon\Carbon::parse($userDetails->dob)->format("d-M-Y");
												?>
												{{$dob}}
											</td>
										</tr>
										<tr>
											<th>Relaton Type</th>
											<td>
												{{$userDetails->s_w_d}}
											</td>
										</tr>

										<tr>
											<th>Relaton Name</th>
											<td>
												{{$userDetails->swd_name}}
											</td>
										</tr>

										<tr>
											<th>Nomination Name</th>
											<td>
												{{$userDetails->nomination_name ?? "N/A"}}
											</td>
										</tr>


										<tr>
											<th>Nomination DOB</th>
											<td>
												{{$userDetails->nomination_dob ?? "N/A"}}
											</td>
										</tr>


										<tr>
											<th>Mobile Number</th>
											<td>
												{{$userDetails->country_code}} {{$userDetails->mobile_number}}
											</td>
										</tr>


										<tr>
											<th>Email</th>
											<td>
												{{$userDetails->email ?? "N/A"}}
											</td>
										</tr>


										<tr>
											<th>Adhar number</th>
											<td>
												{{$userDetails->adhar_number ?? "N/A"}}
											</td>
										</tr>


										<tr>
											<th>Pan Number</th>
											<td>
												{{$userDetails->pan_number ?? "N/A"}}
											</td>
										</tr>


										<tr>
											<th>Account Number</th>
											<td>
												{{$userDetails->bank_account_number ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>Bank Name</th>
											<td>
												{{$userDetails->bank_name ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>IFSC Code</th>
											<td>
												{{$userDetails->bank_ifsc_code ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>Branch Name</th>
											<td>
												{{$userDetails->bank_branch_name ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>Address</th>
											<td>
												{{$userDetails->address ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>Country</th>
											<td>
												{{$userDetails->country ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>City</th>
											<td>
												{{$userDetails->city ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>State</th>
											<td>
												{{$userDetails->state ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>Zip Code</th>
											<td>
												{{$userDetails->zip_code ?? "N/A"}}
											</td>
										</tr>

										<tr>
											<th>Amount Added</th>
											<td>
												{{($userDetails->sponserDetails->amount / 100) . ' (INR)' ?? "N/A"}}
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