<x-layout>
	<x-slot name="title">Hal. Daftar Tiket & Panduan</x-slot>
	<x-slot name="page_heading">Daftar Tiket dan Panduan
		<i class="fa-solid fa-circle-info" style="color: #000" id="infoTiket"></i>
		<span id="infoButton" style="font-size: 12px; color: #000; font-style: italic;">
		</span>
	</x-slot>

	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-primary">
					<i class="fas fa-ticket"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Tiket</h4>
					</div>
					<div class="card-body">
						{{ $tiket_counts['tiket_in_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-success">
					<i class="fas fa-ticket"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Tiket Open</h4>
					</div>
					<div class="card-body">
						{{ $tiket_counts['tiket_open_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-danger">
					<i class="fas fa-ticket"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Tiket Close</h4>
					</div>
					<div class="card-body">
						{{ $tiket_counts['tiket_close_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-warning">
					<i class="fa-solid fa-cart-shopping fa-lg" style="color: #fff"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Tiket Pembelian</h4>
					</div>
					<div class="card-body">
						{{ $tiket_counts['tiket_pembelian_total'] }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			@include('utilities.alert')
			<div class="d-flex justify-content-end mb-3">
				<div class="btn-group">
					@can('import barang')
					<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#excel_menu">
						<i class="fas fa-fw fa-upload"></i>
						Import Excel
					</button>
					@endcan

					@can('export barang')
					<button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#export_menu">
						<i class="fas fa-fw fa-download"></i>
						Export
					</button>
					@endcan

					@can('tambah tiket')
					<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#tikets_create_modal">
						<i class="fas fa-fw fa-plus"></i>
						Tambah Tiket
					</button>
					@endcan

					@can('print barang')
					<form action="{{ route('barang.print') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-success">
							<i class="fas fa-fw fa-print"></i>
							Print
						</button>
					</form>
					@endcan
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<x-datatable>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">No Tiket</th>
								<th scope="col">Jenis Dukungan</th>
								<th scope="col">Judul</th>
								<th scope="col">Prioritas</th>
								<th scope="col">Status</th>
								<th scope="col">Dibuat Oleh</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tiket as $tiket)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<td>{{$tiket->no_tiket}}</td>
								<td>{{ $tiket->jenis_dukungan }}</td>
								<td>{{ Str::limit($tiket->judul, 25, '...') }}</td>
								<td class="text-center align-middle">
									@if ($tiket->priority == 1)
										<i class="fa-solid fa-arrow-up" style="color: #f60404"></i>
									@elseif ($tiket->priority == 2)
										<i class="fa-solid fa-arrow-right" style="color: #3904d7"></i>	
									@else
										<i class="fa-solid fa-arrow-down" ></i>
									@endif
								</td>
								
								<td class="text-center align-middle">
									@if ($tiket->status == 0)
										<i class="fa-solid fa-ticket" style="color: #f60404" title="Close"></i>
									@elseif ($tiket->status == 1)
										<i class="fa-solid fa-ticket" style="color: #07cf5e" title="Open"></i>
									@else ($tiket->status == 2)
										<i class="fa-solid fa-ticket" style="color: #ffd43b" title="In Progress"></i>
									@endif
								</td>
								<td class="text-center align-middle">
								    {{ $tiket->user->name ?? 'N/A' }}
								</td>
								<td class="text-center">
									<div class="btn-group" role="group" aria-label="Basic example">

										@can('detail tiket')
										<a data-id="{{ $tiket->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_detail_tiket" title="Lihat Detail">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan

										@can('ubah tiket')
										<a data-id="{{ $tiket->id }}" class="btn btn-sm btn-success text-white edit-modal mr-2"
											data-toggle="modal" data-target="#show_tiket" title="Ubah data">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan

										@can('print satu tiket')
										<form action="{{ route('tiket.print-satu', $tiket->id) }}" method="POST">
											@csrf
											<button type="submit" class="btn btn-sm btn-danger mr-2">
												<i class="fa-regular fa-file-pdf"></i>
											</button>
										</form>
										@endcan

										@can('hapus tiket')
										<form action="{{ route('tiket.destroy', $tiket) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-sm btn-danger delete-button"><i
													class="fas fa-fw fa-trash-alt"></i></button>
										</form>
										@endcan
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</x-datatable>
				</div>
			</div>
		</div>
	</div>

	@push('modal')
	@include('tikets.modal.show')
	@include('tikets.modal.create')
	@include('tikets.modal.edit')
	@include('tikets.modal.import')
	@include('tikets.modal.export')
	@endpush

	@push('js')
	@include('tikets._script')
	@endpush

	@push('js')
	<script>
		var x = document.getElementById("infoTiket");
		x.addEventListener("mouseover", myFunction);
		x.addEventListener("mouseout", outFunction);
		
		function myFunction() {
			document.getElementById("infoButton").innerHTML = "Tiket ini digunakan untuk merekam panduan dan masalah yg membutuhkan eskalasi atau konsentrasi khusus";
		}
		function outFunction() {
			document.getElementById("infoButton").innerHTML = "";
		}
	</script>
	@endpush
</x-layout>
