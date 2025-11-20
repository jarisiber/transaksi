<x-layout>
	<x-slot name="title">Halaman Daftar Wifi</x-slot>
	<x-slot name="page_heading">Daftar Wifi</x-slot>

	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-primary">
					<i class="fa-solid fa-house-signal fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Wifi</h4>
					</div>
					<div class="card-body">
						{{ $wifi_counts['wifi_in_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-success">
					<i class="fa-solid fa-wifi fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Wifi Active</h4>
					</div>
					<div class="card-body">
						{{ $wifi_counts['wifi_active'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-warning">
					<i class="fas fa-fw fa-exclamation-circle fa-lg"  style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Wifi In-Active</h4>
					</div>
					<div class="card-body">
						{{ $wifi_counts['wifi_in_active'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-danger">
					<i class="fa-solid fa-bug fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>?????<h4>
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
				@can('tambah perolehan')
				<button type="button" class="btn btn-primary" data-toggle="modal"
					data-target="#kredensial_penggunas_create_modal">
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
								<th scope="col">Nama Branch</th>
								<th scope="col">Nama Wifi</th>
								<th scope="col">Pwd</th>
								<th scope="col">IP Portal</th>
								<th scope="col">Pwd Portal</th>
								<th scope="col">Is Active?</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($wifi as $wifi)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<!-- RECORD DATA -->
								<td>{{ $wifi->branch_name }}</td>
								<td>{{ $wifi->wifi_name }}</td>
								<td>{{ $wifi->password }}</td>
								<td style="text-align: center">{{ $wifi->ip_portal }}</td>
								<td>{{ Str::limit($wifi->password_portal, 5, '...') }}</td>
								<td style="text-align: center">
									@if ($wifi->is_active == 1)
										<i class="fa-solid fa-arrow-up" style="color: #63E6BE;"></i>
									@else
										<i class="fa-solid fa-arrow-down" style="color: #fa004b;"></i>
									@endif
								</td>
								</td>
								<td class="text-center">
									<div class="btn-group">
										@can('detail perolehan')
										<a data-id="{{ $wifi->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_commodity_acquisition">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan
										@can('ubah perolehan')
										<a data-id="{{ $wifi->id }}"
											class="btn btn-sm btn-success text-white edit-modal mr-2" data-toggle="modal"
											data-target="#commodity_acquisition_edit_modal">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan
										@can('hapus perolehan')
										<form action="{{ route('perolehan.destroy', $wifi->id) }}" method="POST">
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
	@include('kredensial-penggunas.modal.create')
	@include('kredensial-penggunas.modal.show')
	@include('kredensial-penggunas.modal.edit')
	@endpush

	@push('js')
	@include('kredensial-penggunas._script')
	@endpush
</x-layout>
