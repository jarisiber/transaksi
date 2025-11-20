<script>
	$(document).ready(function () {
		$(".show-modal").click(function () {
			const id = $(this).data("id");
			let url = "{{ route('api.pc.show', ':paramID') }}".replace(
				":paramID",
				id
			);
			$.ajax({
				url: url,
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#show_pc_detail #branch_name").val(res.data.branch_name);
					$("#show_pc_detail #user_responsible").val(res.data.user_responsible);
					$("#show_pc_detail #jenis").val(res.data.jenis);

					$("#show_pc_detail #hostname").val(res.data.hostname);
					$("#show_pc_detail #processor").val(res.data.processor);
					$("#show_pc_detail #ram").val(res.data.ram);

				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$(".edit-modal").on("click", function () {
			const id = $(this).data("id");
			let url = "{{ route('api.perolehan.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			let updateURL = "{{ route('perolehan.update', ':paramID') }}".replace(
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
					$("#commodity_acquisition_edit_modal form #name").val(res.data.name);
					$("#commodity_acquisition_edit_modal form #description").val(
						res.data.description
					);
					$("#commodity_acquisition_edit_modal form").attr("action", updateURL);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});
	});
</script>
