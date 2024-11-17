		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2 custom_sidebar" data-background-color="dark2">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="dark2">
				
				<a href="javascript:void(0);" class="logo">
					<img src="{{url('public/admin/assets/img/logo.png')}}" alt="navbar brand" class="navbar-brand">
          			<!-- <h2 class="heading">Admin</h2> -->
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto hide_hum" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="navbar-toggler sidenav-toggler ml-auto hide_bar" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-times"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
				<!-- <div class="border-bottom"></div>	 -->
			<!-- End Logo Header -->
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item <?php if(Request::is("admin/dashboard")) {echo 'active';} else {echo '';}?>">
							<a  href="{{route('admin.dashboard')}}" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<!-- <span class="caret"></span> -->
							</a>
							<!-- <div class="collapse" id="dashboard">
								<ul class="nav nav-collapse">
									<li>
										<a href="../demo1/index.html">
											<span class="sub-item">Dashboard 1</span>
										</a>
									</li>
									<li>
										<a href="../demo2/index.html">
											<span class="sub-item">Dashboard 2</span>
										</a>
									</li>
								</ul>
							</div> -->
						</li>
						<li class= "nav-item <?php if(Request::is("admin/user-management") || Request::is("admin/tree-view/*") || Request::is("admin/view/*") || Request::is("admin/add-user") || Request::is("admin/view-user/*")) {echo 'nav-item active';} else {echo '';}?>">
							<a href="{{route('admin.userManagement')}}">
								<i class="fas fa-user"></i>
								<p>User Management</p>
								<!-- <span class="caret"></span> -->
							</a>
							<!-- <div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="components/avatars.html">
											<span class="sub-item">Avatars</span>
										</a>
									</li>
									<li>
										<a href="components/buttons.html">
											<span class="sub-item">Buttons</span>
										</a>
									</li>
									<li>
										<a href="components/gridsystem.html">
											<span class="sub-item">Grid System</span>
										</a>
									</li>
									<li>
										<a href="components/panels.html">
											<span class="sub-item">Panels</span>
										</a>
									</li>
									<li>
										<a href="components/notifications.html">
											<span class="sub-item">Notifications</span>
										</a>
									</li>
									<li>
										<a href="components/sweetalert.html">
											<span class="sub-item">Sweet Alert</span>
										</a>
									</li>
									<li>
										<a href="components/font-awesome-icons.html">
											<span class="sub-item">Font Awesome Icons</span>
										</a>
									</li>
									<li>
										<a href="components/simple-line-icons.html">
											<span class="sub-item">Simple Line Icons</span>
										</a>
									</li>
									<li>
										<a href="components/flaticons.html">
											<span class="sub-item">Flaticons</span>
										</a>
									</li>
									<li>
										<a href="components/typography.html">
											<span class="sub-item">Typography</span>
										</a>
									</li>
								</ul>
							</div> -->
						</li>


						<li class="nav-item <?php if(Request::is("admin/change-password")) {echo 'nav-item active';} else {echo '';}?>">
							<a href="{{route('admin.changePassword')}}">
								<i class="fas fa-lock"></i>
								<p>Change Password</p>
								<!-- <span class="caret"></span> -->
							</a>
							<!-- <div class="collapse" id="maps">
								<ul class="nav nav-collapse">
									<li>
										<a href="maps/jqvmap.html">
											<span class="sub-item">JQVMap</span>
										</a>
									</li>
								</ul>
							</div> -->
						</li>
						<li class="nav-item <?php if(Request::is("admin/logout")) {echo 'nav-item active';} else {echo '';}?>">
							<a href="{{route('admin.logout')}}">
								<i class="fas fa-sign-out-alt"></i>
								<p>Logout</p>
								<!-- <span class="caret"></span> -->
							</a>
							<!-- <div class="collapse" id="charts">
								<ul class="nav nav-collapse">
									<li>
										<a href="charts/charts.html">
											<span class="sub-item">Chart Js</span>
										</a>
									</li>
									<li>
										<a href="charts/sparkline.html">
											<span class="sub-item">Sparkline</span>
										</a>
									</li>
								</ul>
							</div> -->
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->