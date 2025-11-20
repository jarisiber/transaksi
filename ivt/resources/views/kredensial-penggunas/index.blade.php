<x-layout>
	<x-slot name="title">Hal. Daftar Kredensial Pengguna</x-slot>
	<x-slot name="page_heading">Daftar Kredensial Pengguna</x-slot>

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
								<th scope="col">Nama/ID Pengguna</th>
								<th scope="col">Branch</th>
								<th scope="col">Email</th>
								<th scope="col">Keterangan</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($kredensialPengguna as $kredensialPengguna)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<!-- RECORD DATA -->
								<td>{{ $kredensialPengguna->nama_pengguna }}</td>
								<td>{{ $kredensialPengguna->branch }}</td>
								<td>{{ $kredensialPengguna->email }}</td>
								<td>{{ Str::limit($kredensialPengguna->keterangan, 55, '...') }}</td>
								</td>
								<td class="text-center">
									<div class="btn-group">
										@can('detail perolehan')
										<a data-id="{{ $kredensialPengguna->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_commodity_acquisition">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan
										@can('ubah perolehan')
										<a data-id="{{ $kredensialPengguna->id }}"
											class="btn btn-sm btn-success text-white edit-modal mr-2" data-toggle="modal"
											data-target="#commodity_acquisition_edit_modal">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan
										@can('hapus perolehan')
										<form action="{{ route('perolehan.destroy', $kredensialPengguna->id) }}" method="POST">
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
