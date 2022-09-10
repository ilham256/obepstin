<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h5 class="box-title">Input EPBM</h5>
			
				<div class="row mb-3">
					<div class="col-md-9 col-sm-12">
						<div> 
							<hr>
							 Data Evaluasi Proses Belajar Mengajar (EPBM)  
							<hr>
						</div>

					</div> 
					<div class="col-md-3 col-sm-12">
						<form role="form" id="contactform" action="<?php echo site_url('epbm/import')?>" method="post" enctype="multipart/form-data">
						<input type="file" id="input-file-to-destroy" name="file" class="dropify" />
						<p class="help margin-top-10">Format file Excel (.xls atau .xlsx), Maksimum ukuran file 5 MB</p>
						<div class="float-start">
							<input class="btn btn waves-effect waves-light" type="submit" value="Upload File Excel">
						</div>
						</form>
					</div>

				</div>

			
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>