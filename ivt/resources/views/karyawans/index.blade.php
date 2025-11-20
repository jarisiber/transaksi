<x-layout>
	<x-slot name="title">Hal. Daftar Karyawan</x-slot>
	<x-slot name="page_heading">Daftar Karyawan
		<i class="fa-solid fa-circle-info" style="color: #000" id="infoTiket"></i>
		<span id="infoButton" style="font-size: 12px; color: #000; font-style: italic;">
		</span>
	</x-slot>

	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-primary">
					<i class="fa-solid fa-address-card fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Karyawan</h4>
					</div>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-success">
					<i class="fa-solid fa-address-card fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Aktif</h4>
					</div>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-warning">
					<i class="fa-solid fa-address-card fa-lg"  style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total NA</h4>
					</div>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-danger">
					<i class="fa-solid fa-address-card fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>NA<h4>
					</div>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			@include('utilities.alert')
			<div class="d-flex justify-content-end mb-3">
				@can('tambah karyawan')
				<button type="button" class="btn btn-primary" data-toggle="modal"
					data-target="#karyawan_create_modal">
					<i class="fas fa-fw fa-plus"></i>
					Tambah Data
				</button>
				@endcan
			</div>

			<div class="row">
				<div class="col-lg-12">
					<x-datatable>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama Karyawan</th>
								<th scope="col">Jabatan</th>
								<th scope="col">Email</th>
								<th scope="col">Is Active?</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($karyawan as $pegawai)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<!-- RECORD DATA -->
								<td>{{ $pegawai->first_name }} {{ $pegawai->last_name }}</td>
								<td>{{ $pegawai->position }}</td>
								<td>{{ $pegawai->email }}</td>
								<td style="text-align: center">
									@if ($pegawai->employment_status == 'Aktif')
										<i class="fa-solid fa-user" style="color: #63E6BE;"></i>
									@else
										<i class="fa-solid fa-user" style="color: #fa004b;"></i>
									@endif
								</td>
								</td>
								<td class="text-center">
									<div class="btn-group">
										@can('detail perolehan')
										<a data-id="{{ $pegawai->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_pc_detail">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan
										@can('ubah perolehan')
										<a data-id="{{ $pegawai->id }}"
											class="btn btn-sm btn-success text-white edit-modal mr-2" data-toggle="modal"
											data-target="#commodity_acquisition_edit_modal">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan
										@can('hapus perolehan')
										<form action="{{ route('perolehan.destroy', $pegawai->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-sm btn-danger delete-button">
												<i class="fas fa-fw fa-trash-alt"></i>
											</button>
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
	@include('karyawans.modal.create')
	@include('karyawans.modal.show')
	@include('karyawans.modal.edit')
	@endpush

	@push('js')
	@include('karyawans._script')
	@endpush

	@push('js')
	<script>
		var x = document.getElementById("infoTiket");
		x.addEventListener("mouseover", myFunction);
		x.addEventListener("mouseout", outFunction);
		
		function myFunction() {
			document.getElementById("infoButton").innerHTML = "Daftar karyawan hanya bersifat partial, untuk data lengkap silahkan hubungi bagian HRD.";
		}
		function outFunction() {
			document.getElementById("infoButton").innerHTML = "";
		}
	</script>
	@endpush
</x-layout>
