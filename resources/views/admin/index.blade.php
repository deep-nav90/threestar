
@extends('admin.layout.layout')
@section('title','Dashboard')
@section('content')

<style>
	span.total_count {
    color: #ffff;
    font-size: 20px;
    font-weight: bold;
    display: flex;
    justify-content: right;
}
</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<!-- <li class="breadcrumb-item"><a href="#">Library</a></li>
								<li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>
					<div class="row mt-5">
						<div class="col-md-6 mb_bottom ">
							<a href="{{route('admin.userManagement')}}" class="hover_box">
								<div class="box">
									<span class="total_count">{{$totalUsers}}</span>
									<div class="icon_text">
										<i class="fas fa-user"></i>
										<h2>
											Total No. Of Users
										</h2>
									</div>
								</div>
							</a>
						</div>

						
						<div class="col-md-6 mb_bottom ">
							<a href="{{route('admin.userManagement')}}" class="hover_box">
								<div class="box">
									<span class="total_count">{{$myWalletCreditFormat}}</span>
									<div class="icon_text">
									<i class="fas fa-wallet"></i>
										<h2>
											My Wallet Balance
										</h2>
									</div>
								</div>
							</a>
						</div>
						

						
						
					</div>
					@if(Auth::guard('admin')->user()->is_super_admin == 1)
					<div class="row mt-5">
						<div class="col-md-6 mb_bottom ">
							<a href="{{route('admin.userManagement')}}" class="hover_box">
								<div class="box">
									<span class="total_count">{{$adminWalletAmount}}</span>
									<div class="icon_text">
										<i class="fas fa-wallet"></i>
										<h2>
											Total Credit Amount
										</h2>
									</div>
								</div>
							</a>
						</div>


						<div class="col-md-6 mb_bottom ">
							<a href="{{route('admin.userManagement')}}" class="hover_box">
								<div class="box">
									<span class="total_count">{{$totalCreditAmtFormat}}</span>
									<div class="icon_text">
										<i class="fas fa-wallet"></i>
										<h2>
											Users Wallet Credit
										</h2>
									</div>
								</div>
							</a>
						</div>
					</div>
					@endif()
					<div class="row mt-5">
						<!-- @if(Auth::guard('admin')->user()->is_super_admin == 1)
							<div class="col-md-6 mb_bottom ">
								<a href="{{route('admin.userManagement')}}" class="hover_box">
									<div class="box">
										<span class="total_count">{{$totalAmount}}</span>
										<div class="icon_text">
											<i class="fas fa-rupee-sign"></i>
											<h2>
												Total Amount
											</h2>
										</div>
									</div>
								</a>
							</div>

						
						@endif() -->

						<div class="col-md-6 mb_bottom ">
							<a href="{{route('admin.userManagement')}}" class="hover_box">
								<div class="box">
									<span class="total_count">0</span>
									<div class="icon_text">
									<i class="fas fa-gift"></i>
										<h2>
											My Reward
										</h2>
									</div>
								</div>
							</a>
						</div>


						<div class="col-md-6 mb_bottom ">
							<a href="{{route('admin.userManagement')}}" class="hover_box">
								<div class="box">
									<span class="total_count">Level {{Auth::guard('admin')->user()->user_level}}</span>
									<div class="icon_text">
									<i class="fas fa-level-up-alt"></i>
										<h2>
											My Level
										</h2>
									</div>
								</div>
							</a>
						</div>

					</div>
					

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

@endsection()