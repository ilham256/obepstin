<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">Input Nilai CPL Pengukuran Tak Langsung</h4>
			<form role="form" id="contactform" action="<?php echo site_url('input_asesmen_guest/cpltlang')?>" method="post">
				<div class="row mb-3">
					<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan pilih Tahun Akademik</label>
					<div class="col-sm-3 ">
						<div class="input-group">
						<select id="angkatan" class="form-select" name="tahun_masuk">
							<option value="<?php echo $simpanan_tahun	; ?>" style="background: lightblue;"><?php echo $simpanan_tahun.$t_simpanan_tahun; ?></option>
							<?php $i = 1; foreach($tahun_masuk as $d) { ?>
							<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk.'/'.($d->tahun_masuk+1); ?></option>
							<?php $i++; } ?>
						</select>

						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button> 
						</div>
					</div>
				</div>
			</form>
				<div class="row mb-3">
					<div class="col-md-9 col-sm-12">
						<table id="example1" class="display" style="width: 100%">
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<?php foreach ($cpl as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<?php foreach ($cpl as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr>
							</tfoot>
							<tbody>
			                    <?php $i = 1; foreach($data_mahasiswa as $r) { ?>
			                    <tr>
			                        <td><?php echo $r->nim	; ?></td>
			                        <td><?php echo $r->nama ; ?></td>

			                        <?php foreach ($cpl as $row) { ?>
									<td> 
										<?php foreach($datas as $w) { ?>
												<?php if ($w->nim == $r->nim) {
													if ($row->id_cpl_langsung == $w->id_cpl_langsung) {
														echo $w->nilai;
													} } } ?>
			                    	</td>
									<?php } ?>


			                        
			                    </tr>
			                    <?php $i++; } ?>

							</tbody>
						</table>
					</div>
					<div class="col-md-3 col-sm-12">
						
					</div>

				</div>
			
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
