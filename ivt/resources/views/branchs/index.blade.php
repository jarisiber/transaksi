<x-layout>
	<x-slot name="title">Hal. Daftar Branch</x-slot>
	<x-slot name="page_heading">Daftar Branch</x-slot>

	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-primary">
					<i class="fa-brands fa-font-awesome fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Branch</h4>
					</div>
					<div class="card-body">
						{{ $branch_counts['branch_in_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-success">
					<i class="fa-solid fa-door-open fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Branch Active</h4>
					</div>
					<div class="card-body">
						{{ $branch_counts['branch_in_active'] }}
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
						<h4>Multibranch</h4>
					</div>
					<div class="card-body">
						{{ $branch_counts['branch_in_multibrand'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-danger">
					<i class="fa-solid fa-door-closed fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Branch Close<h4>
					</div>
					<div class="card-body">
						{{ $branch_counts['branch_in_close'] }}
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
								<th scope="col">Nama PT</th>
								<th scope="col">ISP</th>
								<th scope="col">No Inet</th>
								<th scope="col">Email Digunakan</th>
								<th scope="col">Is Active?</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($branch as $branch)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<!-- RECORD DATA -->
								<td>{{ $branch->nama_branch }}</td>
								<td>{{ $branch->nama_pt }}</td>
								<td>{{ $branch->ISP }}</td>
								<td>{{ $branch->no_inet }}</td>
								<td>{{ Str::limit($branch->email_digunakan, 5, '...') }}</td>
								<td style="text-align: center">
									@if ($branch->is_active == 1)
										<i class="fa-solid fa-arrow-up" style="color: #63E6BE;"></i>
									@else
										<i class="fa-solid fa-arrow-down" style="color: #fa004b;"></i>
									@endif
								</td>
								</td>
								<td class="text-center">
									<div class="btn-group">
										@can('detail perolehan')
										<a data-id="{{ $branch->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_commodity_acquisition">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan
										@can('ubah perolehan')
										<a data-id="{{ $branch->id }}"
											class="btn btn-sm btn-success text-white edit-modal mr-2" data-toggle="modal"
											data-target="#commodity_acquisition_edit_modal">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan
										@can('hapus perolehan')
										<form action="{{ route('perolehan.destroy', $branch->id) }}" method="POST">
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
