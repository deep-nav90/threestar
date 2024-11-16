
@extends('admin.layout.layout')
@section('title','Dashboard')
@section('content')

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
									<div class="icon_text">
										<i class="fas fa-user"></i>
										<h2>
											User Management
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