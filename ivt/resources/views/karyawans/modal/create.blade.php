<!-- Modal -->
<div class="modal fade" id="karyawan_create_modal" data-backdrop="static" data-keyboard="false"
	tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Tambah Data Karyawan</h5>
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
				<form action="{{ route('karyawan.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="first_name">Nama<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="first_name" class="form-control @error('first_name', 'store') is-invalid @enderror"
									id="first_name" value="{{ old('first_name') }}" placeholder="Isikan nama">
								@error('first_name', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="email">Email<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="email" class="form-control @error('email', 'store') is-invalid @enderror"
									id="email" value="{{ old('email') }}" placeholder="Isikan email">
								@error('email', 'store')
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