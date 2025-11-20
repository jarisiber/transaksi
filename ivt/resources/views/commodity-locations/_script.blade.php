<script>
	$(document).ready(function () {
		$(".show-modal").click(function () {
			const id = $(this).data("id");
			let url = "{{ route('api.ruangan.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			$.ajax({
				url: url,
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#show_commodity_location #name").text(res.data.name);
					$("#show_commodity_location #nama_pt").text(res.data.nama_pt);
					$("#show_commodity_location #alamat").text(res.data.alamat);
					$("#show_commodity_location #npwp").text(res.data.npwp ? res.data.npwp : '-');
					$("#show_commodity_location #email_digunakan").text(res.data.email_digunakan);
					$("#show_commodity_location #vendor_isp").text(res.data.vendor_isp ? res.data.vendor_isp : '-');
					$("#show_commodity_location #no_inet").text(res.data.no_inet ? res.data.no_inet : '-');
					$("#show_commodity_location #vendor_isp_1").text(res.data.vendor_isp_1 ? res.data.vendor_isp_1 : '-');
					$("#show_commodity_location #no_inet_1").text(res.data.no_inet_1 ? res.data.no_inet_1 : '-');
					$("#show_commodity_location #description").text(res.data.description);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$(".edit-modal").on("click", function () {
			const id = $(this).data("id");
			let url = "{{ route('api.ruangan.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			let updateURL = "{{ route('ruangan.update', ':paramID') }}".replace(
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
					$("#commodity_location_edit_modal form #name").val(res.data.name);
					$("#commodity_location_edit_modal form #description").val(res.data.description);
					$("#commodity_location_edit_modal form").attr("action", updateURL);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});
	});
</script>
