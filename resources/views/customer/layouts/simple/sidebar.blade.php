<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href=""><img class="img-fluid for-light" height="50" width="50" src="{{asset('assets/images/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo.png')}}" height="80" width="80" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href=""><img class="img-fluid" src="{{asset('assets/images/logo.png')}}" height="50" width="50"  alt=""></a></div>
		<nav class="sidebar-main" >
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu" >
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href=""><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-1">Dashboard</h6>
						</div>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Request::is( 'customer')  ? 'active' : ''}}" href="{{route('admin.dashboard')}}"><i data-feather="home"> </i><span>Dashboard</span></a></li>

					</li>
				</ul>
					
					
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>