@extends('admin.layout.layout')
@section('title','Wallet Details')
@section('content')

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.walletManagement')}}">Wallet Management</a></li>
								<li class="breadcrumb-item remove_hover">Wallet Details</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>User Details</h1>

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
											<th>Upline User</th>
											<td>
												{{$walletDetails->upline_user_id_with_name}}
											</td>
										</tr>

										<tr>
											<th>Under User</th>
											<td>
                                            {{$walletDetails->under_user_id_with_name}}
											</td>
										</tr>
										<tr>
											<th>Percentage/Flat</th>
											<td>
                                            {{$walletDetails->percentag_or_flat_amount}}
											</td>
										</tr>
										<tr>
											<th>Total Amount</th>
											<td>
										
                                            {{$walletDetails->total_amount_in_rupees}}
											</td>
										</tr>
										<tr>
											<th>Credit Amoount</th>
											<td>
                                            {{$walletDetails->credit_user_amount_in_rupees}}
											</td>
										</tr>

										<tr>
											<th>Created At</th>
											<td>
												{{$walletDetails->date_show}}
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