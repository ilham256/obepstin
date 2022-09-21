<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Input Kategori Kinerja CPMK dan CPL</h4>
			<form role="form" method="post" action="<?php echo site_url('katkin/simpan_data') ?>" enctype="multipart/form-data" >
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="box-content card">
							<h5 class="box-title">KINERJA CPL</h5>
							<div class="card-content">
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Batas Bawah Kategori Cukup</label>
									<label for="angkatan" class="col-sm-6 col-form-label">Target Persentase Mahasiswa</label>
									<div class="col-sm-12 col-md-6">
										<input type="text" class="form-control" id="inp-type-1" value="<?= $data->batas_bawah_kategori_cukup_cpl ?>" name="batas_bawah_kategori_cukup_cpl" disabled>
									</div>
									<div class="col-sm-12 col-md-6">
										<input type="text" class="form-control" id="inp-type-1" value="<?= $data->target_jumlah_mahasiswa_cukup_cpl ?>" name="target_jumlah_mahasiswa_cukup_cpl" disabled>
									</div>
								</div>
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Batas Bawah Kategori Baik</label>
									<label for="angkatan" class="col-sm-6 col-form-label">Target Persentase Mahasiswa</label>
									<div class="col-sm-12 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->batas_bawah_kategori_baik_cpl ?>" name="batas_bawah_kategori_baik_cpl">
									</div>
									<div class="col-sm-12 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->target_jumlah_mahasiswa_baik_cpl ?>" name="target_jumlah_mahasiswa_baik_cpl">
									</div>
								</div> 
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Batas Bawah Kategori Sgt Baik</label>
									<label for="angkatan" class="col-sm-6 col-form-label">Target Persentase Mahasiswa</label>
									<div class="col-sm-12 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->batas_bawah_kategori_sangat_baik_cpl ?>" name="batas_bawah_kategori_sangat_baik_cpl">
									</div>
									<div class="col-sm-12 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->target_jumlah_mahasiswa_sangat_baik_cpl ?>" name="target_jumlah_mahasiswa_sangat_baik_cpl">
									</div>
								</div>
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Nilai Target Pencapaian CPL</label>
									<div class="col-sm-12 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->nilai_target_pencapaian_cpl ?>" name="nilai_target_pencapaian_cpl">
									</div>
								</div>
							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content card white -->
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="box-content card">
							<h5 class="box-title">KINERJA CPMK</h5>
							<!-- /.box-title -->
							<div class="card-content">
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Batas Bawah Kategori Cukup</label>
									<div class="col-sm-6 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->batas_bawah_kategori_cukup_cpmk ?>" name="batas_bawah_kategori_cukup_cpmk">
									</div>
								</div>
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Batas Bawah Kategori Baik</label>
									<div class="col-sm-6 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->batas_bawah_kategori_baik_cpmk ?>" name="batas_bawah_kategori_baik_cpmk">
									</div>
								</div>
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Batas Bawah Kategori Sangat Baik</label>
									<div class="col-sm-6 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->batas_bawah_kategori_sangat_baik_cpmk ?>" name="batas_bawah_kategori_sangat_baik_cpmk">
									</div>
								</div>
								<div class="row mb-3">
									<label for="angkatan" class="col-sm-6 col-form-label">Nilai Target Pencapaian CPMK</label>
									<div class="col-sm-6 col-md-6">
										<input type="text" disabled class="form-control" id="inp-type-1" value="<?= $data->nilai_target_pencapaian_cpmk ?>" name="nilai_target_pencapaian_cpmk">
									</div>
								</div>
								<input type="hidden" name="id"value="<?= $data->id ?>">

							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content card white -->
					</div>
				</div>

			</form> 
		</div>
		<!-- /.box-content --> 
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
