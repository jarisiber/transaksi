<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
	<title>{{ $title }} &mdash; {{ config('app.name') }}</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.css') }}" />

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap4.css" />

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
	<link rel="stylesheet" href="{{ url('assets/css/components.css') }}" />

	<link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.bootstrap4.min.css" />
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!-- export pdf for detail ticket -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li>
							<a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
						</li>
					</ul>
				</form>
				<ul class="navbar-nav navbar-right">
					<li>
						<a href="{{ route('pesan.index') }}" class="nav-link nav-link-lg" title="Pesan Masuk">
							<i class="fa-solid fa-envelope">
								@php
								    $pesan_counts = \App\Messages::where('to_user_id', Auth::id())
								        ->where('is_read', 0)
								        ->count();
								@endphp
								@if($pesan_counts > 0)
									<span class="badge badge-success top-0 rounded-pill" id="unred-message-count">
										{{ $pesan_counts }}
									</span>
								@else
									<span class="badge badge-success top-0 rounded-pill" id="unred-message-count">0</span>
								@endif
							</i>
						</a>
					</li>
					<li>
						<a href="{{ route('tiket.index') }}" class="nav-link nav-link-lg" title="Opened Ticket">
							<i class="fa-solid fa-ticket">
								@php
            					    $openTicketCount = \App\Ticket::where('status', '>=', 1)->count();
            					@endphp
            					@if($openTicketCount > 0)
									<span class="badge badge-success top-0 rounded-pill" id="open-ticket-count">
										{{ $openTicketCount}}
									</span>
								@else
									<span class="badge badge-success top-0 rounded-pill" id="open-ticket-count">0</span>
            					@endif
							</i>
						</a>
					</li>
					@push('js')
					<script>
					    $(document).ready(function() { // Ensure the DOM is ready
					        setInterval(function() {
					            $.ajax({
					                url: "{{ route('tiket.open-count') }}",
					                type: "GET",
					                success: function(data) {
					                    $('#open-ticket-count').text(data.count);
					                },
					                error: function(xhr, status, error) {
					                    console.error("Terjadi kesalahan saat mengambil jumlah tiket:", error); // Add error handling
					                }
					            });
								$.ajax({
					                url: "{{ route('pesan.unread-count') }}",
					                type: "GET",
					                success: function(data) {
					                    $('#unred-message-count').text(data.count);
					                },
					                error: function(xhr, status, error) {
					                    console.error("Terjadi kesalahan saat mengambil jumlah pesan yg belum dibaca:", error); // Add error handling
					                }
					            });
					        }, 10000); // refresh every 10 seconds
					    });
					</script>
					@endpush
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1" />
							<div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->name }}</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Akun sejak: {{ auth()->user()->diffForHumanDate(auth()->user()->created_at) }}
							</div>
							@can('mengatur profile')
							<a href="{{ route('profile.index') }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
								Pengaturan Profil </a>
							@endcan
							<div class="dropdown-divider"></div>
							{{--
							<a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}">
								<i class="fas fa-sign-out-alt"></i>
								{{ __('Logout') }}
							</a>
							--}}
							<form id="logout-form" action="{{ route('logout') }}" method="POST">
								@csrf

								<button type="submit" class="dropdown-item has-icon btn-link text-danger logout">
									Logout
								</button>
							</form>
						</div>
					</li>
				</ul>
			</nav>

			<div class="main-sidebar">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<a href="{{ route('home') }}">{{ config('app.name') }}</a>
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="{{ route('home') }}">{{ substr(config('app.name'), 0, 2) }}</a>
					</div>
					<ul class="sidebar-menu">
						<li class="menu-header">Dashboard</li>
						<li class="nav-item dropdown{{ request()->routeIs('home') ? ' active' : '' }}">
							<a href="{{ route('home') }}" class="nav-link"><i class="fas fa-house"></i>
								<span>Dashboard</span></a>
						</li>
						<li class="menu-header">Manajemen</li>
						@can('lihat barang')
						<li class="nav-item dropdown{{ request()->routeIs('barang.index') ? ' active' : '' }}">
							<a href="{{ route('barang.index') }}" class="nav-link"><i class="fas fa-boxes-stacked"></i>
								<span>Data Barang</span></a>
						</li>
						@endcan
						@can('lihat email')
						<li class="menu-header">Internet & Email</li>
						<li class="nav-item dropdown{{ request()->routeIs('email.index') ? ' active' : '' }}">
							<a href="{{ route('email.index') }}" class="nav-link"><i class="fa-solid fa-envelope"></i>
								<span>Data Email</span></a>
						</li>
						@endcan 
						@can('lihat branch')
						<li class="nav-item dropdown{{ request()->routeIs('branch.index') ? ' active' : '' }}">
							<a href="{{ route('branch.index') }}" class="nav-link"><i class="fa-solid fa-code-branch"></i>
								<span>Inet Branch</span></a>
						</li>
						@endcan 
						@can('lihat kredensial')
						<li class="menu-header">Kredensial</li>
						<li class="nav-item dropdown{{ request()->routeIs('kredensial.index') ? ' active' : '' }}">
							<a href="{{ route('kredensial.index') }}" class="nav-link"><i class="fas fa-user-shield"></i>
								<span>Data Kredensial</span></a>
						</li>
						@endcan
						@can('lihat pc')
						<li class="menu-header">Computer & Peripheral</li>
						<li class="nav-item dropdown{{ request()->routeIs('pc.index') ? ' active' : '' }}">
							<a href="{{ route('pc.index') }}" class="nav-link"><i class="fa-solid fa-computer"></i>
								<span>Data Desktop & Laptop</span></a>
						</li>
						@endcan
						@can('lihat wifi')
						<li class="menu-header">Network</li>
						<li class="nav-item dropdown{{ request()->routeIs('wifi.index') ? ' active' : '' }}">
							<a href="{{ route('wifi.index') }}" class="nav-link"><i class="fa-solid fa-wifi"></i>
								<span>Data Wifi</span></a>
						</li>
						@endcan
						@can('lihat tiket')
						<li class="menu-header">Maintenance</li>
						<li class="nav-item dropdown{{ request()->routeIs('tiket.index') ? ' active' : '' }}">
							<a href="{{ route('tiket.index') }}" class="nav-link"><i class="fa-solid fa-ticket"></i>
								<span>Tiket & Panduan</span>
							</a>
						</li>
						@endcan
						@can('lihat pesan')
						<li class="menu-header">Percakapan</li>
						<li class="nav-item dropdown{{ request()->routeIs('pesan.index') ? ' active' : '' }}">
							<a href="{{ route('pesan.index') }}" class="nav-link"><i class="fa-solid fa-envelope"></i>
								<span>Pesan-pesan</span>
							</a>
						</li>
						@endcan
						@can('lihat karyawan')
						<li class="menu-header">Data Master</li>
						<li class="nav-item dropdown{{ request()->routeIs('karyawan.index') ? ' active' : '' }}">
							<a href="{{ route('karyawan.index') }}" class="nav-link"><i class="fa-solid fa-address-card"></i>
								<span>Data Pelanggan</span>
							</a>
						</li>
						@endcan 
						@can('lihat ruangan')
						<li class="nav-item dropdown{{ request()->routeIs('ruangan.index') ? ' active' : '' }}">
							<a href="{{ route('ruangan.index') }}" class="nav-link"><i class="fa-solid fa-font-awesome"></i>
								<span>Data Branch</span>
							</a>
						</li>
						@endcan 
						@can('lihat perolehan')
						<li class="nav-item dropdown{{ request()->routeIs('perolehan.index') ? ' active' : '' }}">
							<a href="{{ route('perolehan.index') }}" class="nav-link"><i class="fa-solid fa-right-left"></i>
								<span>Data Perolehan</span></a>
						</li>
						@endcan 
						@can('mengatur profile')
						<li class="menu-header">Pengaturan</li>
						<li class="nav-item dropdown{{ request()->routeIs('profile.index') ? ' active' : '' }}">
							<a href="{{ route('profile.index') }}" class="nav-link"><i class="fas fa-cog"></i>
								<span>Pengaturan Profil</span></a>
						</li>
						@endcan @can('lihat pengguna')
						<li class="nav-item dropdown{{ request()->routeIs('pengguna.index') ? ' active' : '' }}">
							<a href="{{ route('pengguna.index') }}" class="nav-link"><i class="fas fa-users"></i> 
								<span>Data Pengguna</span></a>
						</li>
						@endcan	@can('lihat peran dan hak akses')
						<li class="nav-item dropdown{{ request()->routeIs('peran-dan-hak-akses.index') ? ' active' : '' }}">
							<a href="{{ route('peran-dan-hak-akses.index') }}" class="nav-link"><i class="fas fa-user-shield"></i>
								<span>Peran & Hak Akses</span></a>
						</li>
						@endcan
					</ul>

					<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
						<form id="logout-form" action="{{ route('logout') }}" method="POST">
							<button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split logout">
								<i class="fas fa-fw fa-sign-out-alt"></i>
								Logout
							</button>
							@csrf
						</form>
					</div>
				</aside>
			</div>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>{{ $page_heading }}</h1>
					</div>

					{{ $slot }}
				</section>
			</div>
		</div>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ url('assets/js/popper.min.js') }}"></script>
	<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ url('assets/js/moment.min.js') }}"></script>
	<script src="{{ url('assets/js/stisla.js') }}"></script>

	<!-- JS Libraies -->
	<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap4.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<!-- Template JS File -->
	<script src="{{ url('assets/js/scripts.js') }}"></script>
	<script src="{{ url('assets/js/custom.js') }}"></script>

	<!-- Page Specific JS File -->
	<script src="{{ url('assets/js/page/index-0.js') }}"></script>

	<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js"></script>

	<script src="{{ asset('js/scripts.js') }}"></script>

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<script>
		$(document).ready(function () {
        $(".delete-button").click(function (e) {
          e.preventDefault();
          Swal.fire({
            title: "Hapus?",
            text: "Data tidak akan bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            reverseButtons: true,
          }).then((result) => {
            if (result.value) {
              $(this).parent().submit();
            }
          });
        });

        $(".logout").click(function (e) {
          e.preventDefault();
          Swal.fire({
            title: "Keluar?",
            text: "Anda akan keluar dari aplikasi!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            reverseButtons: true,
          }).then((result) => {
            if (result.value) {
              $(this).parent().submit();
            }
          });
        });
      });
	</script>
	@stack('modal')
	@stack('js')
</body>

</html>
