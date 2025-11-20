<x-layout>
	<x-slot name="title">Hal. Daftar Pesan</x-slot>
	<x-slot name="page_heading">Kotak Pesan Masuk
		<i class="fa-solid fa-circle-info" style="color: #000" id="infoTiket"></i>
		<span id="infoButton" style="font-size: 12px; color: #000; font-style: italic;">
		</span>
	</x-slot>

	<!-- <div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-primary">
					<i class="fa-regular fa-message fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>NA</h4>
					</div>
					<div class="card-body">

					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-success">
					<i class="fa-regular fa-message fa-lg" style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>NA</h4>
					</div>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-warning">
					<i class="fa-regular fa-message fa-lg"  style="color: #fafafa;"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>NA</h4>
					</div>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-gradient-danger">
					<i class="fa-regular fa-message fa-lg" style="color: #fafafa;"></i>
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
	</div> -->

	<div class="card">
		<div class="card-body">
			@include('utilities.alert')
			<div class="d-flex justify-content-end mb-3">
				@can('kirim pesan')
				<button type="button" class="btn btn-primary" data-toggle="modal"
					data-target="#kirim_pesan_modal">
					<i class="fas fa-fw fa-plus"></i>
					Kirim Pesan
				</button>
				@endcan
			</div>

			<div class="row">
                <div class="col-md-5">
					<x-datatable>
						<thead>
    					    <tr>
    					        <th>Pesan Masuk</th>
    					        <th>Tanggal</th>
    					    </tr>
    					</thead>
                        <tbody>
                            @foreach($pesan2 as $pesan)
                            {{-- Changed $pesan2 to $pesan to avoid loop variable conflict --}}
                            <tr class="message-row @unless($pesan->is_read) font-weight-bold unread-message @endunless" data-message-id="{{ $pesan->id }}">
                                <td>
                                    <label style="font-size: 15px;">
										{{ $pesan->user->name ?? 'Unknown User' }}
									</label> : 
                                    <br><label style="font-size: 15px; color: #555">
                                        {{ Str::limit($pesan->subject, 37, '...') }}
                                    </label>
                                    <br><label style="font-size: 12px;">
                                        {{ Str::limit($pesan->message_text, 37, '...') }}
                                    </label>
                                </td>
                                <td>{{ $pesan->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-datatable>
                </div>
                <div class="col-md-7">
                    <div class="card" id="message-detail-card">
                        <div class="card-header">
                            <h6 id="detail-subject">Pilih Pesan</h6>
                        </div>
                        <div class="card-body" id="detail-message-text">
                            Klik salah satu pesan di Kotak Masuk untuk melihat detailnya.
                        </div>
                        <div class="card-footer" id="detail-date"></div>
                    </div>
                </div>
            </div>
		</div>
	</div>

	@push('modal')
	@include('pesans.modal.create')
	@include('pesans.modal.show')
	@include('pesans.modal.edit')
	@include('pesans.modal.reply')
	@endpush

	@push('js')
	@include('pesans._script')
	@endpush


	@push('js')
	<script>
		$(document).ready(function() {
			// Define a global or scoped variable to temporarily hold the message body
    		let originalMessageBody = '';
			// 1. Select all rows with the class 'message-row'
			$('.message-row').on('click', function() {
				// Store the reference to the clicked row
            	let $clickedRow = $(this); 
            	let messageId = $clickedRow.data('message-id');
	
				// Optional: Highlight the selected row
            	$('.message-row').removeClass('table-primary');
            	$clickedRow.addClass('table-primary');
	
				// 2. Make an AJAX call to the new route
				$.ajax({
					url: '{{ route("pesans.show_detail", "") }}/' + messageId,
					type: 'GET',
					beforeSend: function() {
						// Show a loading state
						$('#detail-subject').html('<i class="fas fa-spinner fa-spin"></i> Memuat...');
						$('#detail-message-text').html('');
						$('#detail-date').html('');
					},
					success: function(data) {
						// Store the original message body globally before updating the detail view
                    	originalMessageBody = data.body;
						// 3. Update the content in the right column
						// Use a two-column layout for sender, recipient, and date
						$('#detail-subject').html(
							'<span style="font-size: 1.3rem; font-weight: normal;">' + data.subject + '</span>' +
						    '<div class="row">' +
						        // Left column
						        '<div class="col-6 mb-2">' +
						            '<span style="font-size: 0.85rem; font-weight: normal;">' + data.sender + '</span>' +
						        '</div>' +
												
								// Right column: Reply Button
        						'<div class="col-6 mb-2 text-right">' + // Use text-right for better alignment
        						    // Use the sender's ID as data attribute for the reply function
        						    '<button class="btn btn-sm btn-outline-primary" ' +
        						    'data-toggle="modal" data-target="#balas_pesan_modal" ' +
        						    'data-recipient-id="' + data.sender_id + '" ' + // Pass the sender's ID
        						    'data-recipient-name="' + data.sender + '" ' + // Pass the sender's name (optional, for UX)
        						    'data-subject="' + data.subject + '">' +
        						        '<i class="fa-solid fa-reply"></i> Balas' +
        						    '</button>' +
        						'</div>' +

						        // Left column
						        '<div class="col-6 mb-2">' +
						            '<span style="font-size: 0.85rem; font-weight: normal;"> Ke ' + data.to + '</span>' +
						        '</div>' +

								// Date (Right column, next row)
								'<div style="font-size: 0.85rem; font-weight: normal; text-align: right" class="col-6 mb-2">' +
									data.date +
								'</div>' +
												
						    '</div>' +		
						    '<hr class="mt-0">' // Horizontal line separator
						);
						
						// Display the full message body
						$('#detail-message-text').html(data.body);

						// 4. *** KEY MODIFICATION: Change the list row style to 'read' ***
                    	// Remove the bold font and unread background color classes
                    	$clickedRow.removeClass('font-weight-bold unread-message');
	
						// Display the date
						// $('#detail-date').html('Dikirim: ' + data.date);
					},
					error: function(xhr) {
						$('#detail-subject').text('Error');
						$('#detail-message-text').text('Gagal memuat pesan. Pastikan Anda memiliki akses.');
						$('#detail-date').html('');
						console.error('AJAX Error:', xhr.responseText);
					}
				});
			});

			// --- New Reply Modal Logic ---
		    $('#balas_pesan_modal').on('show.bs.modal', function (event) {
		        let button = $(event.relatedTarget);
    			let recipientId = button.data('recipient-id');
    			let recipientName = button.data('recipient-name'); // Need this from the button!
    			let subject = button.data('subject');
    			let modal = $(this);
				// Use the globally stored originalMessageBody (which contains <br> tags)
        		let originalBodyHtml = originalMessageBody; 
				// 1. Display the original message in the dedicated QUOTE AREA
        		modal.find('#quoted_original_message').html(originalBodyHtml); 
				// 2. Clear the main reply textarea for the new response
        		modal.find('#reply_message_text').val(''); 
		        // Pre-fill the 'to_user_id' field (select element)
		        // --- UPDATED RECIPIENT LOGIC ---
    			// Set the hidden ID for submission
    			modal.find('#reply_to_user_id_hidden').val(recipientId); 
						
    			// Set the visible, read-only name for the user
    			modal.find('#reply_recipient_name').val(recipientName); 
    			// -------------------------------
			
		        if (!subject.startsWith('Re:')) {
            	modal.find('#reply_subject').val('Re: ' + subject);
        		} else {
        		    modal.find('#reply_subject').val(subject);
        		}
		    });
		});
	</script>
	@endpush

	@push('css')
	<style>
		.unread-message {
			color: #1C09BD; /* Black text for unread messages */
			background-color: #f0f8ff; /* Light blue background for unread messages */
			cursor: pointer; /* Change cursor to pointer on hover */
		}
		.unread-message:hover {
			background-color: #e0f0ff; /* Slightly darker blue on hover */
		}
		#message-detail-card {
			min-height: 200px; /* Ensure a minimum height for the detail card */
		}
	</style>
	@endpush

	@push('js')
	<script>
		var x = document.getElementById("infoTiket");
		x.addEventListener("mouseover", myFunction);
		x.addEventListener("mouseout", outFunction);
		
		function myFunction() {
			document.getElementById("infoButton").innerHTML = "Menu ini digunakan untuk mengirim dan menerima pesan antar karyawan dalam sistem inventaris";
		}
		function outFunction() {
			document.getElementById("infoButton").innerHTML = "";
		}
	</script>
	@endpush
</x-layout>

