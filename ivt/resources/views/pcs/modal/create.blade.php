<!-- Modal -->
<div class="modal fade" id="pc_create_modal" data-backdrop="static" data-keyboard="false"
	tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Tambah Data PC</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="d-flex align-items-center">
					<i class="text-warning fa-solid fa-circle-info mr-2"></i>
					<p class="font-italic mb-0">
						Kolom yang memiliki tanda merah <span class="font-weight-bold">wajib diisi.</span>
					</p>
				</div>
				<hr>
				<form action="{{ route('pc.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
							    <label for="jenis">Desktop/Laptop<span class="font-weight-bold text-danger">*</span></label>
							    <select name="jenis" class="form-control @error('jenis', 'store') is-invalid @enderror" id="jenis">
							        <option value="">-- Pilih Jenis --</option>
							        <option value="Desktop" {{ old('jenis') == 'Desktop' ? 'selected' : '' }}>Desktop</option>
							        <option value="Laptop" {{ old('jenis') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
							        <option value="Server" {{ old('jenis') == 'Server' ? 'selected' : '' }}>Server</option>
							    </select>
							    @error('jenis', 'store')
							    <div class="d-block invalid-feedback">
							        {{ $message }}
							    </div>
							    @enderror
							</div>
						</div>
						<div class="col-lg-3">
						    <div class="form-group">
							    <label for="branch_name">Nama Branch<span class="font-weight-bold text-danger">*</span></label>
							    <select name="branch_name" class="form-control select2-branch @error('branch_name', 'store') is-invalid @enderror" id="branch_name">
							        <option value="">-- Pilih Branch --</option>
							        @foreach($branches as $id => $name)
							            <option value="{{ $name }}" {{ old('branch_name') == $name ? 'selected' : '' }}>
							                {{ $name }}
							            </option>
							        @endforeach
							    </select>
							    @error('branch_name', 'store')
							    <div class="d-block invalid-feedback">
							        {{ $message }}
							    </div>
							    @enderror
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="user_responsible">User Responsible<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="user_responsible" class="form-control @error('user_responsible', 'store') is-invalid @enderror"
									id="user_responsible" value="{{ old('user_responsible') }}" placeholder="Divisi - Nama User..">
								@error('user_responsible', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="hostname">Hostname<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="hostname" class="form-control @error('hostname', 'store') is-invalid @enderror"
									id="hostname" value="{{ old('hostname') }}" placeholder="DESKTOP-AD21S..">
								@error('hostname', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="merk">Merek<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="merk" class="form-control @error('merk', 'store') is-invalid @enderror"
									id="merk" value="{{ old('merk') }}" placeholder="Lenovo..">
								@error('merk', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="processor">Processor<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="processor" class="form-control @error('processor', 'store') is-invalid @enderror"
									id="processor" value="{{ old('processor') }}" placeholder="Intel i3-2120..">
								@error('processor', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="ram">RAM<span class="font-weight-bold text-danger">*</span></label>
								<input type="number" name="ram" class="form-control @error('ram', 'store') is-invalid @enderror"
									id="ram" value="{{ old('ram') }}" placeholder="4/8..">
								@error('ram', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="keterangan">Keterangan<span class="font-italic">(opsional)</span></label>
								<textarea name="keterangan" class="form-control @error('keterangan', 'store') is-invalid @enderror"
									id="keterangan" placeholder="Masukan deskripsi (opsional).."
									style="height: 100px;">{{ old('keterangan') }}</textarea>
								@error('keterangan', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Tambah</button>
						<button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Existing Select2 initialization
        $('.select2-branch').select2({
            dropdownParent: $('#pc_create_modal'),
            placeholder: "Cari branch...",
            allowClear: true,
            width: '100%',
            theme: 'bootstrap5'
        });

        // Add custom border styling
        $('.select2-branch').on('select2:open', function(e) {
            $('.select2-dropdown').css({
                'border': '1px solid #E5E4E2',
                'border-radius': '4px'
            });
        });

        // Add border to the main select element
        $('.select2-branch').parent().find('.select2-selection').css({
            'border': '1px solid #E5E4E2',
            'border-radius': '4px',
            'padding': '1px'
        });
    });
</script>

<style>
    .select2-container--bootstrap5 .select2-selection {
        border: 1px solid #E5E4E2 !important;
    }
    
    .select2-dropdown {
        border: 1px solid #E5E4E2 !important;
    }
	.select2-results__options {
    max-height: 200px; /* Adjust as needed */
    overflow-y: auto;
	}
</style>
@endpush