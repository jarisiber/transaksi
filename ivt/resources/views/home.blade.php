<x-layout>
	<x-slot name="title">Dashboard</x-slot>
	<x-slot name="page_heading">Dashboard
		<i class="fa-solid fa-circle-info" style="color: #000" id="infoTiket"></i>
		<span id="infoButton" style="font-size: 12px; color: #000; font-style: italic;">
		</span>
    </x-slot>
	<h6 class="mb-2" style="color:#C1B3C7">Status Router Branchs</h6>
	<div class="row">
		<!-- iForte Scomadi MTH -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus2)
					<i id="merceMthIcon" class="fa-solid fa-globe fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="merceMthIcon" class="fa-solid fa-globe fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>iForte Scomadi MTH: <span id="merceMthValue">{{ $merceMth }}</span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
							<span id="merceMthStatus" style="color:{{ $connectionStatus2 ? 'green' : 'red' }};">
								{{ $connectionStatus2 ? 'Up' : 'Down' }}
							</span>
						</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- iForte RE Antasari -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus3)
					<i id="reAtsIcon" class="fa-solid fa-globe fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="reAtsIcon" class="fa-solid fa-globe fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>iForte RE ATS: <span id="reAtsValue">{{ $reAts }}</span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
					    @if($connectionStatus3)
					        <span style="color:green;">Up</span>
					    @else
					        <span style="color:red;">Down</span>
					    @endif
					</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- iForte Honda MTH -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus)
					<i id="hondaMthIcon" class="fa-solid fa-globe fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="hondaMthIcon" class="fa-solid fa-globe fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>iForte Honda MTH: <span id="hondaMthValue">{{ $hondaMth }}</span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
					    @if($connectionStatus)
					        <span style="color:green;">Up</span>
					    @else
					        <span style="color:red;">Down</span>
					    @endif
					</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- iForte Honda BKS -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus1)
					<i id="hondaBksIcon" class="fa-solid fa-globe fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="hondaBksIcon" class="fa-solid fa-globe fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>iForte Honda BKS: <span id="hondaBksValue">{{ $hondaBks }}</span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
					    @if($connectionStatus1)
					        <span style="color:green;">Up</span>
					    @else
					        <span style="color:red;">Down</span>
					    @endif
					</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<h6 class="mb-2" style="color:#C1B3C7">Status Server Aplikasi</h6>
	<!-- OtoBitz SMD -->
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus7)
					<i id="otobitzSmdIcon" class="fa-solid fa-power-off fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="otobitzSmdIcon" class="fa-solid fa-power-off fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Nama Server : <span id="otobitzSmdValue"></span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
							<span id="otobitzSmdStatus" style="color:{{ $connectionStatus7 ? 'green' : 'red' }};">
								{{ $connectionStatus7 ? 'Up' : 'Down' }}
							</span>
						</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- OtoBitz BKS -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus5)
					<i id="otobitzBksIcon" class="fa-solid fa-power-off fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="otobitzBksIcon" class="fa-solid fa-power-off fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Nama Server : <span id="otobitzBksValue"></span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
							<span id="otobitzBksStatus" style="color:{{ $connectionStatus5 ? 'green' : 'red' }};">
								{{ $connectionStatus5 ? 'Up' : 'Down' }}
							</span>
						</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- OtoBitz MTH -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus4)
					<i id="otobitzMthIcon" class="fa-solid fa-power-off fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="otobitzMthIcon" class="fa-solid fa-power-off fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Nama Server : <span id="otobitzMthValue"></span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
							<span id="otobitzMthStatus" style="color:{{ $connectionStatus4 ? 'green' : 'red' }};">
								{{ $connectionStatus4 ? 'Up' : 'Down' }}
							</span>
						</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- Odoo MTH -->
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-color1">
					@if($connectionStatus6)
					<i id="odooMthIcon" class="fa-solid fa-power-off fa-fade fa-xl" style="color: #fff;"></i>
					@else
					<i id="odooMthIcon" class="fa-solid fa-power-off fa-bounce fa-xl" style="color: #ff0000;"></i>
					@endif
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Nama Server : <span id="odooMthValue"></span></h4>
					</div>
					<div class="card-body">
						<h6>Status: 
							<span id="odooMthStatus" style="color:{{ $connectionStatus6 ? 'green' : 'red' }};">
								{{ $connectionStatus6 ? 'Up' : 'Down' }}
							</span>
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<h6 class="mb-2" style="color:#C1B3C7">Data Barang</h6>
	<div class="row">
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Barang</p>
                    <h5 class="font-weight-bolder">
                      {{ $commodity_counts['commodity_in_total'] }}
                    </h5>
                    <p class="mb-0">
                    	<span class="text-success text-sm font-weight-bolder">
							{{ $commodity_counts['commodity_in_total'] }}
						</span>
                    		sampai saat ini
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fas fa-columns text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Kondisi Baik</p>
                    <h5 class="font-weight-bolder">
						{{ $commodity_counts['commodity_in_good_condition'] }}
                    </h5>
                    <p class="mb-0">
						Dari
                    	<span class="text-success text-sm font-weight-bolder">
							{{ $commodity_counts['commodity_in_total'] }}
						</span>
						barang
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                    <i class="fas fa-fw fa-check-circle text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Kondisi Error</p>
                    <h5 class="font-weight-bolder">
						{{ $commodity_counts['commodity_in_not_good_condition'] }}
                    </h5>
                    <p class="mb-0">
						Dari 
                    	<span class="text-success text-sm font-weight-bolder">
							{{ $commodity_counts['commodity_in_total'] }}
						</span>
						barang
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                    <i class="fas fa-fw fa-exclamation-circle text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Kondisi Rusak</p>
                    <h5 class="font-weight-bolder">
						{{ $commodity_counts['commodity_in_heavily_damage_condition'] }}
                    </h5>
                    <p class="mb-0">
						Dari 
                    	<span class="text-success text-sm font-weight-bolder">
							{{ $commodity_counts['commodity_in_total'] }}
						</span>
						barang
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                    <i class="fas fa-fw fa-times-circle text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
	</div>
	<h6 class="mb-2" style="color:#C1B3C7">Grafik Data Barang</h6>
	<div class="row">
		<div class="col-md-6 col-lg-8">
			<div class="card">
				<x-bar-chart chartTitle="Grafik Barang Berdasarkan Kondisi" chartID="chartCommodityCondition"
					:series="$charts['commodity_condition_count']['series']"
					:categories="$charts['commodity_condition_count']['categories']" :colors="['#47C363', '#FFA426', '#FC544B']">
				</x-bar-chart>
			</div>
		</div>

		<div class="col-md-6 col-lg-4">
			<div class="card">
				<div class="card-header">
					<h4>5 Barang Termahal</h4>
				</div>
				<div class="card-body">
					@foreach($commodity_order_by_price as $key => $order_by_price)
					<ul class="list-unstyled list-unstyled-border">
						<li class="media">
							<!-- <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-1.png" alt="avatar"> -->
							<div class="media-body">
								@can('detail barang')
								<button data-id="{{ $order_by_price->id }}" class="float-right btn btn-info btn-sm show-modal"
									data-toggle="modal" data-target="#show_commodity">Detail</button>
								@endcan
								<div class="media-title">{{ $order_by_price->name }}</div>
								<span class="text-small text-muted">Harga: Rp{{
									$order_by_price->indonesian_currency($order_by_price->price) }}</span>
							</div>
						</li>
					</ul>
					@endforeach
					@can('lihat barang')
					<div class="text-center pt-1 pb-1">
						<a href="{{ route('barang.index') }}" class="btn btn-primary btn-lg btn-round">
							Lihat Semua Barang
						</a>
					</div>
					@endcan
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-7">
			<x-bar-chart chartTitle="Grafik Jumlah Barang Berdasarkan Tahun Pembelian" chartID="chartCommodityCountEachYear"
				:series="$charts['commodity_each_year_of_purchase_count']['series']"
				:categories="$charts['commodity_each_year_of_purchase_count']['categories']">
			</x-bar-chart>
		</div>
		<div class="col-lg-5">
			<x-pie-chart chartTitle="Grafik Jumlah Barang Berdasarkan Perolehan"
				chartID="chartCommodityByCommodityAcquisitionCount"
				:series="$charts['commodity_by_commodity_acquisition_count']['series']"
				:categories="$charts['commodity_by_commodity_acquisition_count']['categories']"></x-pie-chart>
		</div>
	</div>

	<div class="row">
		
		<div class="col-lg-6">
			<x-pie-chart chartTitle="Grafik Jumlah Barang Berdasarkan Merk" chartID="chartCommodityByBrand"
				:series="$charts['commodity_by_brand_count']['series']"
				:categories="$charts['commodity_by_brand_count']['categories']"></x-pie-chart>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<x-bar-chart chartTitle="Grafik Jumlah Barang Berdasarkan Branch Location" chartID="chartCommodityCountEachLocation"
				:series="$charts['commodity_each_location_count']['series']"
				:categories="$charts['commodity_each_location_count']['categories']">
			</x-bar-chart>
		</div>
	</div>

	<footer class="footer  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0">
              <div class="copyright text-left text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> 
                <a href="https://www.adour-zc21s.com" class="font-weight-bold" target="_blank">adour-zc21s</a>
                v1.0
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.adour-zc21s.com" class="nav-link text-muted" target="_blank">adour Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.adour-zc21s.com" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.adour-zc21s.com" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.adour-zc21s.com" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </footer>

	@push('modal')
	@include('commodities.modal.show')
	@endpush

	@push('js')
	@include('_script');
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshMerceMth() {
    $.ajax({
        url: '{{ route("dashboard.merceMth") }}',
        type: 'GET',
        success: function(data) {
            $('#merceMthValue').text(data.merceMth);
            $('#merceMthStatus')
                .text(data.connectionStatus2 ? 'Up' : 'Down')
                .css('color', data.connectionStatus2 ? 'green' : 'red');
            $('#merceMthIcon').css('color', data.connectionStatus2 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshMerceMth, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshReAts() {
    $.ajax({
        url: '{{ route("dashboard.reAts") }}',
        type: 'GET',
        success: function(data) {
            $('#reAtsValue').text(data.reAts);
            $('#reAtsStatus')
                .text(data.connectionStatus3 ? 'Up' : 'Down')
                .css('color', data.connectionStatus3 ? 'green' : 'red');
            $('#reAtsIcon').css('color', data.connectionStatus3 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshReAts, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshHondaMth() {
    $.ajax({
        url: '{{ route("dashboard.hondaMth") }}',
        type: 'GET',
        success: function(data) {
            $('#hondaMthValue').text(data.hondaMth);
            $('#hondaMthStatus')
                .text(data.connectionStatus ? 'Up' : 'Down')
                .css('color', data.connectionStatus ? 'green' : 'red');
            $('#hondaMthIcon').css('color', data.connectionStatus ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshHondaMth, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshHondaBks() {
    $.ajax({
        url: '{{ route("dashboard.hondaBks") }}',
        type: 'GET',
        success: function(data) {
            $('#hondaBksValue').text(data.hondaBks);
            $('#hondaBksStatus')
                .text(data.connectionStatus1 ? 'Up' : 'Down')
                .css('color', data.connectionStatus1 ? 'green' : 'red');
            $('#hondaBksIcon').css('color', data.connectionStatus1 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshHondaBks, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshOtobitzMth() {
    $.ajax({
        url: '{{ route("dashboard.otobitzMth") }}',
        type: 'GET',
        success: function(data) {
            $('#otobitzMthValue').text(data.connectionString4);
            $('#otobitzMthStatus')
                .text(data.connectionStatus4 ? 'Up' : 'Down')
                .css('color', data.connectionStatus4 ? 'green' : 'red');
            $('#otobitzMthIcon').css('color', data.connectionStatus4 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshOtobitzMth, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshOtobitzBks() {
    $.ajax({
        url: '{{ route("dashboard.otobitzBks") }}',
        type: 'GET',
        success: function(data) {
            $('#otobitzBksValue').text(data.connectionString5);
            $('#otobitzBksStatus')
                .text(data.connectionStatus5 ? 'Up' : 'Down')
                .css('color', data.connectionStatus5 ? 'green' : 'red');
            $('#otobitzBksIcon').css('color', data.connectionStatus5 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshOtobitzBks, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshOdooMth() {
    $.ajax({
        url: '{{ route("dashboard.odooMth") }}',
        type: 'GET',
        success: function(data) {
            $('#odooMthValue').text(data.connectionString6);
            $('#odooMthStatus')
                .text(data.connectionStatus6 ? 'Up' : 'Down')
                .css('color', data.connectionStatus6 ? 'green' : 'red');
            $('#odooMthIcon').css('color', data.connectionStatus6 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshOdooMth, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	@include('_script');
	<script>
	function refreshOtobitzSmd() {
    $.ajax({
        url: '{{ route("dashboard.otobitzSmd") }}',
        type: 'GET',
        success: function(data) {
            $('#otobitzSmdValue').text(data.connectionString7);
            $('#otobitzSmdStatus')
                .text(data.connectionStatus7 ? 'Up' : 'Down')
                .css('color', data.connectionStatus7 ? 'green' : 'red');
            $('#otobitzSmdIcon').css('color', data.connectionStatus7 ? '#fff' : '#ff0000');
        }
    });
	}
	setInterval(refreshOtobitzSmd, 10000); // every 10 seconds
	</script>
	@endpush

	@push('js')
	<script>
    	document.addEventListener('DOMContentLoaded', function() {
    	    const numStars = 300; // Number of stars
    	    const body = document.body;

    	    for (let i = 0; i < numStars; i++) {
    	        const star = document.createElement('div');
    	        star.classList.add('star');
    	        star.style.width = `${Math.random() * 3}px`; // Random size
    	        star.style.height = star.style.width;
    	        star.style.top = `${Math.random() * 99}vh`; // Random position
    	        star.style.left = `${Math.random() * 99}vw`;
    	        star.style.animationDelay = `${Math.random() * 5}s`; // Random delay
    	        body.appendChild(star);
    	    }
    	});

		// Info icon script
		var x = document.getElementById("infoTiket");
		x.addEventListener("mouseover", myFunction);
		x.addEventListener("mouseout", outFunction);
		
		function myFunction() {
			document.getElementById("infoButton").innerHTML = "Selamat datang di dashboard inventaris barang dan tiket panduan. Di sini Anda dapat memantau status router branch, server aplikasi, serta melihat statistik dan grafik terkait data barang yang ada dalam sistem inventaris kami. Gunakan informasi ini untuk mengelola aset Anda dengan lebih efektif dan efisien. Sistem ini juga melakukan pengiriman email pengajuan tiket secara otomatis (setiap hari senin jam 11.30) kepada pihak terkait untuk memastikan setiap permintaan pembelian ditangani dengan cepat dan tepat.";
		}
		function outFunction() {
			document.getElementById("infoButton").innerHTML = "";
		}
	</script>
	@endpush


	<style>
	/* Add to your CSS file or inside a <style> tag */
	body {
	  background: linear-gradient(to top, #3e2049, #383838);
	  /* Example gradient */
	  /* overflow: hidden; */
	  /* Hide scrollbars */
	}
	
	.star {
	  position: absolute;
	  background-color: white;
	  border-radius: 50%;
	  animation: twinkle 5s linear infinite;
	}
	
	@keyframes twinkle {
	  0% {
	    opacity: 0.2;
	  }
  
	  50% {
	    opacity: 1;
	  }
  
	  100% {
	    opacity: 0.2;
	  }
	}
	</style>

</x-layout>
