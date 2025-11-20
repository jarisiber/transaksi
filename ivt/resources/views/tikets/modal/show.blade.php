<div class="modal fade" id="show_detail_tiket" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Detail Tiket Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<label for="judul">Subjek :
					<strong>
						<label id="judul" name="judul"></label>
					</strong>
					<span class="badge badge-success" id="status" name="status"></span>
					<button type="button" class="badge badge-light" onclick="exportModalToPDF()" id="to_file">as pdf</button>
				</label>
				@php
					echo $renderer->render($barcode);
				@endphp
				<hr>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="no_tiket">No Tiket :
								<strong>
									<label id="no_tiket" name="no_tiket" data-id="no_tiket"></label>
								</strong>
							</label>
							<label for="branch">Branch :
								<strong>
									<br><label id="branch" name="branch"></label>-
									<label id="departemen" name="departemen"></label>
								</strong>
							</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="dibuat_oleh">Dibuat oleh :
								<label id="dibuat_oleh" name="dibuat_oleh"></label>
							</label>
							<label for="created_at">Tgl dibuat :
								<br><label id="created_at" name="created_at"></label>
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="description">Keterangan :
								<label id="description" name="description"></label>
							</label>
						</div>
					</div>
				</div>
				<!-- Form to add a comment -->
				<div id="add-comment-field" style="display: none;">
					<hr>
				    <h4>Tambah Komentar</h4>
				    <form id="addCommentForm">
				        @csrf
				        <div class="form-group">
				            <textarea name="comment_text" class="form-control" rows="3" placeholder="Tambahkan komentar..." required></textarea>
				        </div>
				        <button type="submit" class="btn btn-primary btn-sm">Kirim Komentar</button>
				    </form>
				</div>
				<hr>

				<div class="col-md-9 offset-md-3" id="comment-history-section">
				    <h4>Komentar-komentar</h4>
				    <ul class="timeline" id="comment-history"></ul>
				</div>
				<div class="form-group" id="static-rating-display" style="display: none;">
				    <label>Rating Kepuasan:</label>
				    <div class="star-display" id="current-ticket-rating"></div>
				    <label>Tgl tiket ditutup:</label>
					<label id="closed_at" name="closed_at"></label>
				</div>
				<div class="text-muted mt-5 mb-5 text-center small">by : <a class="text-muted" target="_blank" href="http://#">adoer-zc21s v1.0.0</a></div>
				<!-- Form to close the ticket -->
				<div class="modal-footer">
				    <form id="tutupTiketForm" method="POST">
				        @method('PUT')
				        @csrf
				        <input type="hidden" name="status" value="0">
				        <div class="form-group" id="rating-field" style="display: none;">
				            <label>Rating:</label>
				            <div class="star-rating">
				                <input type="radio" id="star5" name="rating" value="5" required>
				                <label for="star5" title="5 stars"></label>
				                <input type="radio" id="star4" name="rating" value="4">
				                <label for="star4" title="4 stars"></label>
				                <input type="radio" id="star3" name="rating" value="3">
				                <label for="star3" title="3 stars"></label>
				                <input type="radio" id="star2" name="rating" value="2">
				                <label for="star2" title="2 stars"></label>
				                <input type="radio" id="star1" name="rating" value="1">
				                <label for="star1" title="1 star"></label>
				            </div>
				        </div>
				        <button type="submit" class="btn btn-primary" id="buttonTutupTiket">Tutup Tiket</button>
						<button type="button" class="btn btn-info fa-solid fa-xmark" data-dismiss="modal" title="tutup"></button>
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>
 <!-- Rating CSS -->
<style>
.star-rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: flex-end;
}

.star-rating input[type="radio"] {
  display: none;
}

.star-rating label {
  font-size: 2rem;
  color: #ccc;
  cursor: pointer;
}

.star-rating label:before {
  content: '★';
}

.star-rating input[type="radio"]:checked ~ label {
  color: #ffc107; /* Bootstrap yellow color */
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color: #ffc107;
}

/* Add CSS for the static rating display */
.star-display {
    color: #ccc; /* Default color for unrated stars */
    font-size: 2rem;
}

.star-display .filled {
    color: #ffc107; /* Color for rated stars (Bootstrap yellow) */
}

/* Ensure stars are inline */
.star-display span {
    display: inline-block;
}
</style>

<!-- Timeline -->
<style>
	ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
</style>

@push('js')
<script>
	$(document).ready(function() {
	    // Use event delegation for the form submission on the document
	    // This is more reliable for elements inside modals.
		$(document).on('submit', '#tutupTiketForm', function(e) {
			let $form = $(this);
			let $btn = $('#buttonTutupTiket');
			// Check if a rating has been selected (since we use 'required')
			if ($form.find('input[name="rating"]:checked').length === 0 && $('#rating-field').is(':visible')) {
			    // Let native HTML validation handle it if required.
				return true;
			}
			
		    // Show loading state *before* the synchronous form submission
			$btn.attr('disabled', true);
			$btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menutup tiket...');
		    // The form will submit normally now.
		    // Note: Since this is a synchronous submission (causes a page redirect), 
		    // the visual update might still be very brief, but the functionality is correct.
		});
	});
</script>
@endpush


