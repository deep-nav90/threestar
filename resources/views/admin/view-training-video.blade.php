@extends('admin.layout.layout')
@section('title','Training Video Details')
@section('content')

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


	.dashboard_panel #basic-datatables {
    white-space: inherit;
}

.dashboard_panel .add_imgae_box .user_img video.video_upload {
      border: 2px solid #daa905;
  }

</style>


		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.trainingVideoManagement')}}">Training Video Management</a></li>
								<li class="breadcrumb-item remove_hover">Training Video Details</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
					</div>
					<h1>Training Video Details</h1>
					<div class="card">
						<div class="card-body add_imgae_box">
							<div class="user_img" title="Upload Video" style="
							margin: auto; position: relative; margin-bottom: 12px;">
							<div style="margin-bottom: 18px;">
								<video width="320" height="240" controls class="video_setup video_upload" id="video_src" src="{{$training_video_find->video_url}}">
								  <source src="movie.mp4" type="video/mp4">
								  <source src="movie.ogg" type="video/ogg">
								  Your browser does not support the video tag.
								</video>
								<!-- <div class="add_img">
									<img class="video_upload" src="http://localhost/projects/brain/public/admin/assets/img/plus.png" alt="plus" style="bottom: -14px; margin-left: 80px;">
								</div> -->
								
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
											<th>Category</th>
											<td>
												{{$training_video_find->category->category_name}}
											</td>
										</tr>

										<tr>
											<th>Title</th>
											<td>
												{{$training_video_find->title}}
											</td>
										</tr>
										<tr>
											<th style="vertical-align: top !important; padding: 8px 15px !important;">Description</th>
											<td style="vertical-align: top !important; padding: 8px 15px !important; word-break: break-all;">
												{{$training_video_find->description}}
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