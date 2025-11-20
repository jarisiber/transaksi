<!-- Modal -->
<div class="modal fade" id="tikets_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Tambah Tiket Laporan</h5>
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
				<form action="{{ route('tiket.store') }}" method="POST" id="ticketForm">
					@csrf
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
							    <label for="branch">Nama Branch<span class="font-weight-bold text-danger">*</span></label>
							    <select name="branch" class="form-control select2-branch @error('branch', 'store') is-invalid @enderror" id="branch">
							        <option value="">-- Pilih Branch --</option>
							        @foreach($branches as $id => $name)
							            <option value="{{ $name }}" {{ old('branch') == $name ? 'selected' : '' }}>
							                {{ $name }}
							            </option>
							        @endforeach
							    </select>
							    @error('branch', 'store')
							    <div class="d-block invalid-feedback">
							        {{ $message }}
							    </div>
							    @enderror
							</div>
						</div>
						<div class="col-lg-12">
						    <div class="form-group">
						        <label for="emailNotification">Nama Karyawan<span class="font-weight-bold text-danger">*</span></label>
						        <select name="email_notification" class="form-control select2-emailNotification @error('email_notification', 'store') is-invalid @enderror" id="emailNotification">
						            <option value="">-- Pilih Karyawan --</option>
						            @foreach($karyawans as $email => $first_name)
						                <option value="{{ $email }}" {{ old('email_notification') == $email ? 'selected' : '' }}>
						                    {{ $first_name }} - {{ $email }}
						                </option>
						            @endforeach
						        </select>
						        @error('email_notification', 'store')
						        <div class="d-block invalid-feedback">
						            {{ $message }}
						        </div>
						        @enderror
						    </div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="departemen">Departemen<span class="font-weight-bold text-danger">*</span></label>
								<select name="departemen" class="form-control @error('departemen', 'store') is-invalid @enderror" id="departemen">
							        <option value="">-- Pilih Departemen --</option>
									<option value="Accounting" {{ old('departemen') == 'Accounting' ? 'selected' : '' }}>Accounting</option>
							        <option value="Admin" {{ old('departemen') == 'Admin' ? 'selected' : '' }}>Admin</option>
							        <option value="Aftersales" {{ old('departemen') == 'Aftersales' ? 'selected' : '' }}>Aftersales</option>
									<option value="CCO" {{ old('departemen') == 'CCO' ? 'selected' : '' }}>CCO</option>
									<option value="Finance" {{ old('departemen') == 'Finance' ? 'selected' : '' }}>Finance</option>
									<option value="GA" {{ old('departemen') == 'GA' ? 'selected' : '' }}>GA</option>
									<option value="HRD" {{ old('departemen') == 'HRD' ? 'selected' : '' }}>HRD</option>
									<option value="Importasi" {{ old('departemen') == 'Importasi' ? 'selected' : '' }}>Importasi</option>
									<option value="IT" {{ old('departemen') == 'IT' ? 'selected' : '' }}>IT</option>
									<option value="Pajak" {{ old('departemen') == 'Pajak' ? 'selected' : '' }}>Pajak</option>
									<option value="Recruitment" {{ old('departemen') == 'Recruitment' ? 'selected' : '' }}>Recruitment</option>
							        <option value="Sales" {{ old('departemen') == 'Sales' ? 'selected' : '' }}>Sales</option>
							    </select>
							    @error('departemen', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="priority">Prioritas<span class="font-weight-bold text-danger">*</span></label>
								<select name="priority" class="form-control @error('priority', 'store') is-invalid @enderror" id="priority">
							        <option value="">-- Pilih Prioritas --</option>
							        <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>Tinggi</option>
							        <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>Normal</option>
							        <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>Rendah</option>
							    </select>
								@error('priority', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="jenis_dukungan">Jenis Dukungan<span class="font-weight-bold text-danger">*</span></label>
								<select name="jenis_dukungan" class="form-control @error('jenis_dukungan', 'store') is-invalid @enderror" id="jenis_dukungan">
							        <option value="">-- Jenis Dukungan --</option>
							        <option value="Troubleshooting" {{ old('jenis_dukungan') == 'Troubleshooting' ? 'selected' : '' }}>Troubleshooting</option>
							        <option value="Pemeliharaan" {{ old('jenis_dukungan') == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
							        <option value="Perbaikan" {{ old('jenis_dukungan') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
							        <option value="Pembelian" {{ old('jenis_dukungan') == 'Pembelian' ? 'selected' : '' }}>Pembelian</option>
							    </select>
								@error('jenis_dukungan', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="judul">Judul<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="judul" id="judul"
									class="form-control @error('judul', 'store') is-invalid @enderror" value="{{ old('judul') }}"
									placeholder="Nama User: Judul / Subject..">
								@error('judul', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="description">Keterangan <span class="font-weight-bold text-danger">*</span></label>
								<textarea name="description" class="form-control @error('description', 'store') is-invalid @enderror"
									id="description" placeholder="Deskripsikan masalah atau kebutuhan Anda dengan jelas dan rinci."
									style="height: 100px;">{{ old('description') }}</textarea>
								@error('description', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="submit-ticket-btn" title="Tambah Tiket">
							<i class="fa-solid fa-floppy-disk"></i>
								Simpan
						</button>
						<!-- <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button> -->
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
            dropdownParent: $('#tikets_create_modal'),
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

		// Existing Select2 initialization for emailNotification
		$('.select2-emailNotification').select2({
			dropdownParent: $('#tikets_create_modal'),
			placeholder: "Cari karyawan...",
			allowClear: true,
			width: '100%',
			theme: 'bootstrap5'
		});

		// Add custom border styling for emailNotification
		$('.select2-emailNotification').on('select2:open', function(e) {
			$('.select2-dropdown').css({
				'border': '1px solid #E5E4E2',
				'border-radius': '4px'
			});
		});

		// Add border to the main select element for emailNotification
		$('.select2-emailNotification').parent().find('.select2-selection').css({
			'border': '1px solid #E5E4E2',
			'border-radius': '4px',
			'padding': '1px'
		});

		// Animation for the submit button
		 // 1. Listen for the form submission
        $('#ticketForm').on('submit', function() {
            let $btn = $('#submit-ticket-btn');
            
            // 2. Prevent double submission and show loading state
            $btn.attr('disabled', true); // Disable the button
            
            // 3. Change the button content to a spinner/loader
            $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan tiket...');

            // The form will now submit normally via the browser
            // When Laravel redirects (success or failure), the page will reload/navigate,
            // and the button state will reset.
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