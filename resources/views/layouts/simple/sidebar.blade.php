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
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}"><i data-feather="home"> </i><span>Dashboard</span></a></li>

					</li>
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-1">Data Master </h6>
                     		<p class="lan-2"></p>
						</div>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'admin.medicine.index' ? 'active' : ''}}" href="{{route('admin.medicine.index')}}"><i data-feather="package"> </i><span>Data Obat</span></a></li>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'admin.supplier.index' ? 'active' : ''}}" href="{{route('admin.supplier.index')}}"><i data-feather="users"> </i><span>Data Supplier</span></a></li>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'admin.customer.index' ? 'active' : ''}}" href="{{route('admin.customer.index')}}"><i data-feather="users"> </i><span>Data Pelanggan</span></a></li>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'admin.administrator_user.index' ? 'active' : ''}}" href="{{route('admin.administrator_user.index')}}"><i data-feather="user"> </i><span>Data Administrator</span></a></li>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Request::is('admin/sale')  ? 'active' : ''}}" href="{{route('admin.sale.index')}}"><i data-feather="dollar-sign"> </i><span>Data Penjualan</span></a></li>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Request::is('admin/purchase')  ? 'active' : ''}}" href="{{route('admin.purchase.index')}}"><i data-feather="shopping-bag"> </i><span>Data Pembelian</span></a></li>
					</li>
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-1">Data Satuan </h6>
                     		<p class="lan-2"></p>
						</div>
						<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'admin.medicine_form_type.index' ? 'active' : ''}}" href="{{route('admin.medicine_form_type.index')}}"><i data-feather="hash"> </i><span>Tipe Obat</span></a></li>
					</li>
					{{-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'administrasi.data.meja' ? 'active' : ''}}" href="{{route('administrasi.data.meja')}}"><i data-feather="coffee"> </i><span>Daftar Meja</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'administrasi.data.order' ? 'active' : ''}}" href="{{route('administrasi.data.order')}}"><i data-feather="at-sign"> </i><span>Daftar Pesanan</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'administrasi.data.menu' ? 'active' : ''}}" href="{{route('administrasi.data.menu')}}"><i data-feather="tag"> </i><span>Daftar Menu</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'administrasi.data.kategori' ? 'active' : ''}}" href="{{route('administrasi.data.kategori')}}"><i data-feather="tag"> </i><span>Daftar Kategori</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'administrasi.data.rekap' ? 'active' : ''}}" href="{{route('administrasi.data.rekap')}}"><i data-feather="dollar-sign"> </i><span>Rekap Pesanan</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'administrasi.data.cashback' ? 'active' : ''}}" href="{{route('administrasi.data.cashback')}}"><i data-feather="percent"> </i><span>Diskon</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{route('auth.logout')}}"><span>Logout</span></a></li> --}}
				</ul>
					
					
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>