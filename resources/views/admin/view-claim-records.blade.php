@extends('admin.layout.layout')
@section('title','Claim Reward Details')
@section('content')

<style type="text/css">
	<style type="text/css">
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
	.dashboard_panel .add_imgae_box .user_img img.img_upload {
		border-radius: 7px;
		height: 150px;
	    width: 176px;
	    object-fit: contain;
	    border: 2px solid #57b4ca;
	    margin-bottom: 22px;
	}
	.dashboard_panel .add_imgae_box .add_img img.plus_icon {
		top: 129px;
    	margin-left: 65px;
	}
	.dashboard_panel .add_imgae_box .cross_icon img.plus_icon {
		top: -17px;

	}
	.video_setup {
		width: 176px;
    height: 150px;
    border: 2px solid #57b4ca;
    border-radius: 7px;
    cursor: pointer;
	}
	.upload_align {
		display: flex;
		flex-wrap: wrap;
		    justify-content: center;
	}
	.mr-2 {
		margin-right: 25px !important;
	}
	.audio_img img {
		border-radius: 7px !important;
		height: 80px !important;
	    width: 200px !important;
	    object-fit: contain !important;
	    /*border: 2px solid #fff;*/
	    margin-bottom: 10px;
	    margin-top: 10px;
	}
	.audio_width {
		width: 170px !important;
		height: 42px !important;
	}


	.dashboard_panel #basic-datatables {
    white-space: inherit;
}

</style>
</style>
		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.claimRewardManagement')}}">Claim Reward Management</a></li>
								<li class="breadcrumb-item remove_hover">Claim Reward Details</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Claim Reward Details</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<div>
								<div class="upload_align">

									@foreach($findClaim->reward->rewardImages as $rewardImage)

									@if(!empty($rewardImage['image']))
									<div class="user_img mr-2" style="
									position: relative; margin-bottom: 16px;">

                                    <img class="click_upload img_upload file_upload_click" ui="image" src="{{$rewardImage['image']}}" alt="woman">
									

									
									</div>
									@endif()
									@endforeach()
								</div>
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
											<th>Reward Name</th>
											<td>
												{{$findClaim->reward->reward_name}}
											</td>
										</tr>
										<tr>
											<th style="vertical-align: top !important; padding: 8px 15px !important;">Reward Level</th>
											<td style="vertical-align: top !important; padding: 8px 15px !important; word-break: break-all;">
												{{$findClaim->reward->reward_level}}
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