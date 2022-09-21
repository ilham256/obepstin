<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Profil Mata Kuliah</h4>
			<div class="form-group">

				<br>
			</div>
			<div class="row mb-3">
					<label for="semester" class="col-sm-3 col-form-label">Silahkan Pilih Semester</label>
					<div class="col-sm-3">

						<form role="form" id="contactform" action="<?php echo site_url('input_asesmen_guest/profil_matakuliah')?>" method="post">
						<div class="input-group">
						<select class="form-control select" name="semester">
							<option value="1">- Pilih Semester - </option>
							<?php $i = 1; foreach($data_semester as $d) { ?>
							<option value="<?php echo $d->id_semester; ?>"><?php echo $d->id_semester; ?></option>
							<?php $i++; } ?>
						</select>
						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button>
						</div>
						</form>
						
					</div>
				</div>
 		</div>


					<?php $i = 1; foreach($datas as $r) { ?>

					<div class="box-content bordered primary">

							<div class="card-body">
									<table id="example-edit" class="display" style="width: 100%">
										<thead>
											<tr>
												<th style="width: 150px;"></th>
												<th style="width: 600px;"></th>
											</tr>
										</thead>
										<tbody>												
											<tr> 
												<td><b>Kode TM-2018 & 2019</b></td>
												<td><?php echo $r->kode_mk;?></td>
											</tr>

										</tbody> 
									</table>
				                <hr>
				                <table id="example-edit" class="display" style="width: 100%">
										<thead>
											<tr>
												<th style="width: 150px;"></th>
												<th style="width: 600px;"></th>
											</tr>
										</thead>
										<tbody>												
											<tr> 
												<td><b>Kode K-2020</b></td>
												<td><?php echo $r->nama_kode_2;?></td>
											</tr>

										</tbody> 
									</table>
				                <hr>
				                <table id="example-edit" class="display" style="width: 100%">
										<thead>
											<tr>
												<th style="width: 150px;"></th>
												<th style="width: 600px;"></th>
											</tr>
										</thead>
										<tbody>												
											<tr> 
												<td><b>Mata Kuliah</b></td>
												<td><?php echo $r->nama_mata_kuliah;?></td>
											</tr>

										</tbody> 
									</table>
				                <hr>
				                <table id="example-edit" class="display" style="width: 100%">
										<thead>
											<tr>
												<th style="width: 150px;"></th>
												<th style="width: 600px;"></th>
											</tr>
										</thead>
										<tbody>												
											<tr> 
												<td><b>Semester</b></td>
												<td><?php echo $r->id_semester;?></td>
											</tr>

										</tbody> 
									</table>
				                <hr>
				                <table id="example-edit" class="display" style="width: 100%">
										<thead>
											<tr>
												<th style="width: 150px;"></th>
												<th style="width: 600px;"></th>
											</tr>
										</thead>
										<tbody>												
											<tr> 
												<td style="vertical-align: top;"><b>CPMK</b></td>
												<td>
													<?php $i = 1; foreach($rumus as $p) { ?>
													<?php if ($r->kode_mk == $p->kode_mk) { ?>

															<b><?php echo $p->nama; ?></b>
															<p><?php echo $p->deskripsi_matakuliah_has_cpmk; ?></p>

													<?php } ?>
													<?php $i++; } ?>
												</td>
											</tr>

										</tbody> 
									</table>
				                <hr>


				              </div>


					</div>
					<?php $i++; } ?>
		
	</div>

</div>
<?php //echo '<pre>';  var_dump($rumus); echo '</pre>';  ?>