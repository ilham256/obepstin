<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<hr>
			<h4 class="box-title">Hasil Pengukuran CPL</h4>
			<hr>
			<form role="form" id="contactform" action="<?php echo site_url('cpl_tersimpan/tambah')?>" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								Masukan Tahun <input type="number" id="angkatan"  name="tahun"> &nbsp;
							</td>
							<td>
								<button type="submit" class="btn waves-effect waves-light" onclick="return confirm('Apakah Anda Ingin Memproses Data Baru?')" name="proses" value="proses" style="background-color: lightblue; color: darkblue;">Proses Data</button> 
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<hr>
			<h4 class="box-title">Data List Nilai CPL Tersimpan</h4>
			<form role="form" id="contactform" action="<?php echo site_url('cpl_tersimpan')?>" method="post">
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
					<div class="col-md-12 col-sm-12">
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

				</div>
			
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
