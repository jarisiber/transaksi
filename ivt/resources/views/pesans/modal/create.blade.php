<!-- Modal -->
<div class="modal fade" id="kirim_pesan_modal" data-backdrop="static" data-keyboard="false"
	tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Kirim Pesan ke Pengguna</h5>
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
				<form action="{{ route('pesan.store') }}" method="POST" id="pesanForm">
					@csrf
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
							    <label for="to_user_id">Ke<span class="font-weight-bold text-danger">*</span></label>
							    <select name="to_user_id" class="form-control select2-toUserId @error('to_user_id', 'store') is-invalid @enderror" id="to_user_id">
							        <option value="">-- Pilih Pengguna --</option>
							        @foreach($users as $id => $pengguna)
							            <option value="{{ $id }}" {{ old('to_user_id') == $id ? 'selected' : '' }}>
							                {{ $pengguna }}
							            </option>
							        @endforeach
							    </select>
							    @error('to_user_id', 'store')
							    <div class="d-block invalid-feedback">
							        {{ $message }}
							    </div>
							    @enderror
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label for="subject">Judul/Subject<span class="font-weight-bold text-danger">*</span></label>
								<input type="text" name="subject" class="form-control @error('subject', 'store') is-invalid @enderror"
									id="subject" value="{{ old('subject') }}" placeholder="Masukan Judul/Subject..">
								@error('subject', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label for="message_text">Isi Pesan <span class="font-italic">(opsional)</span></label>
								<textarea name="message_text" class="form-control @error('message_text', 'store') is-invalid @enderror"
									name="message_text" id="message_text" style="height: 100px;"
									placeholder="Masukan isi Pesan (opsional)..">{{ old('message_text') }}</textarea>
								@error('message_text', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="submit-pesan-btn" title="Kirim Pesan">
							<i class="fas fa-paper-plane"></i>
							Kirim Pesan
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
        $('.select2-toUserId').select2({
            dropdownParent: $('#kirim_pesan_modal'),
            placeholder: "Cari nama...",
            allowClear: true,
            width: '100%',
            theme: 'bootstrap5'
        });

		// Animation for the submit button
		 // 1. Listen for the form submission
        $('#pesanForm').on('submit', function() {
            let $btn = $('#submit-pesan-btn');
            
            // 2. Prevent double submission and show loading state
            $btn.attr('disabled', true); // Disable the button
            
            // 3. Change the button content to a spinner/loader
            $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim pesan...');

            // The form will now submit normally via the browser
            // When Laravel redirects (success or failure), the page will reload/navigate,
            // and the button state will reset.
        });

        // Add custom border styling
        $('.select2-toUserId').on('select2:open', function(e) {
            $('.select2-dropdown').css({
                'border': '1px solid #E5E4E2',
                'border-radius': '4px'
            });
        });

        // Add border to the main select element
        $('.select2-toUserId').parent().find('.select2-selection').css({
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