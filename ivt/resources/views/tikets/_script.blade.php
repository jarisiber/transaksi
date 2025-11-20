<script>
	$(document).ready(function () {
		// Listen for the modal to be hidden (closed)
		$('#show_detail_tiket').on('hidden.bs.modal', function () {
		    // Reset the form to clear all input fields
		    $('#tutupTiketForm')[0].reset();
		
		    // Manually hide the comment and rating fields again
		    $("#rating-field").hide();
			$("#histori-komentar").hide(); // Show the histori komentar field
		
		    // This is optional, but ensures the radio buttons are visually reset
		    $('input[name="rating"]').prop('checked', false);
			$("#add-comment-field").hide(); // Hide the new comment field as well
		});

		$(".show-modal").click(function () {
		    const id = $(this).data("id");

			// Clear the comments section every time the modal is opened
    		$("#comment-history").empty();
				
		    let url = "{{ route('api.tiket.show', ':paramID') }}".replace(":paramID", id);
		    let updateURL = "{{ route('tiket.tutupTiket', ':paramID') }}".replace(":paramID", id);
			let addCommentURL = "{{ route('tiket.addComment', ':paramID') }}".replace(":paramID", id); // New URL for adding comments

		    // Set the form action dynamically based on the ticket ID
		    $("#tutupTiketForm").attr("action", updateURL);

			// Set up the Comment Submission Handler
			$("#addCommentForm").attr("action", addCommentURL);
    
    		$("#addCommentForm").off('submit').on('submit', function(event) {
    		    event.preventDefault();
			
    		    const form = $(this);
    		    const url = form.attr('action');
    		    const data = form.serialize();
			
    		    $.ajax({
    		        url: url,
    		        method: "POST",
    		        data: data,
    		        success: (res) => {
    		            // Clear the textarea and REFRESH THE TICKET DATA
    		            form.find('textarea[name="comment_text"]').val('');
						// Close the modal after adding the comment
    		            $('#show_detail_tiket').modal('hide'); 
    		        },
    		        error: (err) => {
    		            alert("Gagal menambahkan komentar.");
    		            console.log(err);
    		        }
    		    });
    		});

		    // Unbind any previous submit handlers
		    $("#tutupTiketForm").off('submit');
				
		    // Handle the form submission with a confirmation dialog
		    $("#tutupTiketForm").on('submit', function(event) {
		        // Prevent the default form submission
		        event.preventDefault();
			
		        const userConfirmed = confirm("Apakah Anda yakin ingin menutup tiket ini?");
			
		        // If the user confirms, submit the form
		        if (userConfirmed) {
		            this.submit();
		        }
		    });
		
		    $.ajax({
		        url: url,
		        method: "GET",
		        header: {
		            "Content-Type": "application/json",
		        },
		        success: (res) => {
		            $("#show_detail_tiket #no_tiket").text(res.data.no_tiket);
				
		            const isPembuatTiket = res.data.dibuat_oleh;
		            const currentUser = {{ auth()->user()->id }}; 
		            let buttonDisplay = 'none';
				
		            // Change status text and classes based on status code
		            switch (res.data.status) {
		                case 1:
		                    $("#show_detail_tiket #status").removeClass('badge-danger').addClass('badge-success').text('Open');
		                    break;
		                // case 2:
		                //     $("#show_detail_tiket #status").removeClass('badge-success').addClass('badge-warning').text('In Progress');
		                //     break;
		                default:
		                    $("#show_detail_tiket #status").removeClass('badge-warning').addClass('badge-danger').text('Close');
		                    break;
		            }
					
					// Get the ticket rating
					const ticketRating = res.data.rating; // Assuming rating is a number (1-5) or null
    				// Get the display elements
    				const staticRatingDisplay = $("#static-rating-display");
    				const currentTicketRating = $("#current-ticket-rating");
					// Clear previous rating display
    				currentTicketRating.empty();
    				staticRatingDisplay.hide();
					const toFile = $("#to_file");		

		            // Check the condition for button visibility separately
		            // if ((res.data.status === 1 || res.data.status === 2) && isPembuatTiket === currentUser) {
		            if (res.data.status === 1 && isPembuatTiket === currentUser) {
		                buttonDisplay = 'inline-block';
		                // Show the comment input field if the button is visible
						$("#rating-field").show(); // Show the rating field if needed
						$("#add-comment-field").show(); // Show the add comment form
						staticRatingDisplay.hide();
						// toFile.hide(); // Hide the toFile button when ticket is open
		            } else {
						toFile.show(); // Show the toFile button when ticket is closed
		                // Hide the comment input field if the button is not visible
						$("#rating-field").hide(); // Hide the rating field if needed
						$("#histori-komentar").show(); // Show the histori komentar field
						// Check if a rating exists (it should for status 0)
        				if (ticketRating >= 1 && ticketRating <= 5) {
        				    staticRatingDisplay.show(); // Show the static display field
        				    let starsHtml = '';
						
        				    // Generate the star icons
        				    for (let i = 5; i >= 1; i--) {
        				        const isFilled = (i <= ticketRating);
        				        starsHtml += `<span class="fa fa-star ${isFilled ? 'filled' : ''}" title="${i} stars">★</span>`;
        				    }
        				    // Reverse the stars to display 5 on the left (if that's your convention)
        				    currentTicketRating.html(starsHtml.split('★').reverse());
						
        				} else {
        				    // Ticket closed but no rating data available
        				    currentTicketRating.html('<p>Tidak ada rating tersedia.</p>');
        				    staticRatingDisplay.show();
        				}
		            }
				
		            // Apply the form's display style
		            $("#tutupTiketForm").css("display", buttonDisplay);
				
		            // ... (rest of your code to populate the modal) ...
		            $("#show_detail_tiket #branch").text(res.data.branch);
		            $("#show_detail_tiket #judul").text(res.data.judul);
		            $("#show_detail_tiket #dibuat_oleh").text(res.data.user.name);
		            $("#show_detail_tiket #departemen").text(res.data.departemen);
		            $("#show_detail_tiket #description").text(res.data.description);
					
		            
				
		            const dateString1 = res.data.created_at;
		            const dateObject1 = new Date(dateString1);
		            const options1 = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
		            const formattedDate1 = dateObject1.toLocaleString('en-US', options1);
		            $("#show_detail_tiket #created_at").text(formattedDate1);

					// Handle closed_at date formatting
		            const closedAtValue = res.data.closed_at;
					if (closedAtValue) {
					    // If closed_at has a value (is not null/empty), format it
					    const dateObject2 = new Date(closedAtValue);
					    const options2 = { 
					        year: 'numeric', 
					        month: 'long', 
					        day: 'numeric', 
					        hour: '2-digit', 
					        minute: '2-digit' 
					    };
					    const formattedDate2 = dateObject2.toLocaleString('en-US', options2);
					
					    // Display the formatted date
					    $("#show_detail_tiket #closed_at").text(formattedDate2);
					} else {
					    // If closed_at is null or empty, display a hyphen
					    $("#show_detail_tiket #closed_at").text('-');
					}

					// Loop through the comments and display them
            		if (res.data.comments && res.data.comments.length > 0) {
            		    $.each(res.data.comments, function(index, comment) {
            		        const commentDate = new Date(comment.created_at);
            		        const dateOptions = { year: 'numeric', month: 'short', day: 'numeric' };
            		        const formattedCommentDate = commentDate.toLocaleDateString('en-US', dateOptions);

            		        const commentHtml = `
            		            <li>
            		                <a target="_blank" href="#">${res.data.user.name}</a>
            		                <a class="float-right">${formattedCommentDate}</a>
            		                <p>${comment.comment}</p>
            		            </li>
            		        `;
            		        $("#comment-history").append(commentHtml);
            		    });
            		} else {
            		    $("#comment-history").append('<li>Tidak ada komentar.</li>');
            		}

		        },
		        error: (err) => {
		            alert("error occured, check console");
		            console.log(err);
		        },
		    });
		});

		$(".edit-modal").on("click", function () {
			const id = $(this).data("id");
			let url = "{{ route('api.tiket.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			let updateURL = "{{ route('tiket.update', ':paramID') }}".replace(
				":paramID",
				id
			);

			$.ajax({
				url: url,
				method: "GET",
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#edit_commodity form #item_code").val(res.data.item_code);
					$("#edit_commodity form #name").val(res.data.name);
					$("#edit_commodity form #commodity_location_id").val(res.data.commodity_location.id);
					$("#edit_commodity form #material").val(res.data.material);
					$("#edit_commodity form #brand").val(res.data.brand);
					$("#edit_commodity form #year_of_purchase").val(res.data.year_of_purchase);
					$("#edit_commodity form #condition").val(res.data.condition);
					$("#edit_commodity form #commodity_acquisition_id").val(res.data.commodity_acquisition.id);
					$("#edit_commodity form #note").val(res.data.note);
					$("#edit_commodity form #quantity").val(res.data.quantity);
					$("#edit_commodity form #price").val(res.data.price);
					$("#edit_commodity form #price_per_item").val(res.data.price_per_item);
					$("#edit_commodity form").attr("action", updateURL);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

    $(".qr-modal-button").on("click", function () {
      const id = $(this).data("id");
      const name = $(this).data("name");

      $("#qr_code_container").html('<span class="text-muted">Memuat QR Code...</span>');
      $("#qr_code_modal .modal-title").text('QR Code untuk ' + name);
      $("#download_qr_link").addClass('disabled').attr('href', '#');

      let url = "{{ route('api.barang.generate-qrcode', ':paramID') }}".replace(":paramID", id);

      $.ajax({
        url: url,
        method: "GET",
        header: {
          "Content-Type": "application/json",
        },
        success: (res) => {
          if (res.success) {
            const dataUri = res.svg;

            $("#download_qr_link")
              .removeClass('disabled')
              .attr('href', dataUri)
              .attr('download', res.filename);

            $("#qr_code_container").html('<img src="' + dataUri + '" alt="QR Code" class="d-inline-block">');
          }
        },
        error: (err) => {
          $("#qr_code_container").html('<span class="text-danger">Gagal memuat QR Code.</span>');
          console.log(err);
        },
      });
    });
	});

	
</script>

<script>
function exportModalToPDF() {
    const { jsPDF } = window.jspdf;
    // Target the element you want to export. The main modal content is a good choice.
    const element = document.getElementById('show_detail_tiket').querySelector('.modal-content');
	// Get the Ticket Number from the modal
    const ticketNumberElement = document.getElementById('no_tiket');
    let ticketNumber = ticketNumberElement ? ticketNumberElement.textContent.trim() : 'Detail_Tiket'; 

	// Sanitize the filename to remove potential illegal characters, 
    // although generally unnecessary for simple text.
    const filename = ticketNumber + '.pdf'; 

    // Temporarily hide elements you don't want in the PDF (like the close button, footer forms)
    const closeButton = element.querySelector('.close');
    const modalFooter = element.querySelector('.modal-footer');
    // const addCommentField = document.getElementById('add-comment-field');
    const toFile = document.getElementById('to_file');
	const commentHistorySection = document.getElementById('comment-history-section');

    if (closeButton) closeButton.style.display = 'none';
    if (modalFooter) modalFooter.style.display = 'none';
    // if (addCommentField) addCommentField.style.display = 'none';
	if (toFile) toFile.style.display = 'none';
	if (commentHistorySection) commentHistorySection.style.display = 'none';

    html2canvas(element, { 
        scale: 2, // Increase scale for better resolution
        logging: true, 
        allowTaint: true, 
        useCORS: true 
    }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a5'); // 'p' for portrait, 'mm' for units, 'a4' for size

        const imgWidth = 148; // A4 width in mm
        const pageHeight = 210; // A4 height in mm
        const imgHeight = canvas.height * imgWidth / canvas.width;
        let heightLeft = imgHeight;

        let position = 0;

        // Add the image to the PDF
        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        // Handle pagination for content longer than one page
        while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            pdf.addPage();
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        pdf.save(filename);

        // Restore hidden elements after generating the PDF
        if (closeButton) closeButton.style.display = 'block'; 
        if (modalFooter) modalFooter.style.display = 'flex';
        // if (addCommentField) addCommentField.style.display = 'block';
		if (toFile) toFile.style.display = 'inline-block';
		if (commentHistorySection) commentHistorySection.style.display = 'inline-block';
    });
}
</script>