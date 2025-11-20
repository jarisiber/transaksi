<x-layout>
	<x-slot name="title">Halaman Daftar Desktop & Laptop</x-slot>
	<x-slot name="page_heading">Daftar Desktop & Laptop</x-slot>

	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-primary">
					<i class="fa-solid fa-display fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Desktop & Laptop</h4>
					</div>
					<div class="card-body">
						{{ $pc_counts['pc_in_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-success">
					<i class="fa-solid fa-computer fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Desktop</h4>
					</div>
					<div class="card-body">
						{{ $pc_counts['pc_desktop_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-warning">
					<i class="fa-solid fa-laptop fa-lg"  style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Laptop</h4>
					</div>
					<div class="card-body">
						{{ $pc_counts['pc_laptop_total'] }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-danger">
					<i class="fa-solid fa-robot fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Server<h4>
					</div>
					<div class="card-body">
						{{ $pc_counts['pc_server_total'] }}
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
					data-target="#pc_create_modal">
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
								<th scope="col">User Resp.</th>
								<th scope="col">Jenis</th>
								<th scope="col">Hostname</th>
								<th scope="col">Processor</th>
								<th scope="col">Is Active?</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pc as $pc)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<!-- RECORD DATA -->
								<td>{{ $pc->branch_name }}</td>
								<td>{{ $pc->user_responsible }}</td>
								<td>{{ $pc->jenis }}</td>
								<td style="text-align: center">{{ $pc->hostname }}</td>
								<td>{{ Str::limit($pc->processor, 10, '...') }}</td>
								<td style="text-align: center">
									@if ($pc->is_active == 1)
										<i class="fa-solid fa-arrow-up" style="color: #63E6BE;"></i>
									@else
										<i class="fa-solid fa-arrow-down" style="color: #fa004b;"></i>
									@endif
								</td>
								</td>
								<td class="text-center">
									<div class="btn-group">
										@can('detail perolehan')
										<a data-id="{{ $pc->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_pc_detail">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan
										@can('ubah perolehan')
										<a data-id="{{ $pc->id }}"
											class="btn btn-sm btn-success text-white edit-modal mr-2" data-toggle="modal"
											data-target="#commodity_acquisition_edit_modal">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan
										@can('hapus perolehan')
										<form action="{{ route('perolehan.destroy', $pc->id) }}" method="POST">
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
	@include('pcs.modal.create')
	@include('pcs.modal.show')
	@include('pcs.modal.edit')
	@endpush

	@push('js')
	@include('pcs._script')
	@endpush
</x-layout>
