<div class="modal fade" id="show_commodity_location" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Detail Data Branch</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<label for="name">Nama Branch :
					<label id="name" name="name"></label>
					<span class="badge badge-success" id="is_active" name="is_active"></span>
				</label>
				@php
					echo $renderer->render($barcode);
				@endphp
				<hr>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="nama_pt">Nama PT :
								<br><label id="nama_pt" name="nama_pt"></label>
							</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="npwp">NPWP :
								<br><label id="npwp" name="npwp"></label>
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="alamat">Alamat :
								<br><label id="alamat" name="alamat"></label>
							</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="email_digunakan">Email digunakan :
								<br><label id="email_digunakan" name="email_digunakan"></label>
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="vendor_isp">Vendor ISP 1 :
								<br><label id="vendor_isp" name="vendor_isp"></label>
								<label id="no_inet" name="no_inet"></label>
							</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="vendor_isp_1">Vendor ISP 2 :
								<br><label id="vendor_isp_1" name="vendor_isp_1"></label>
								<label id="no_inet_1" name="no_inet_1"></label>
							</label>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="description">Keterangan :
								<label id="description" name="description"></label>
							</label>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
			</div> -->
		</div>
	</div>
</div>
