
<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12"> 
		<div class="box-content">
			<h4 class="box-title">Data nilai CPMK Per-Mahasiswa</h4>			
			<form role="form" id="contactform" action="<?php echo site_url('data/data_cpmk')?>" method="post">
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan Masukkan NIM</label>
								<div class="col-sm-3">
									<input type="text" name="nim" class="form-control" placeholder="- nim -" required>					
								</div>
								<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button>
							</div> 
					</form> 
			<br>
			<div class="col-md-12 col-sm-12"> 
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>Deskriptor</th>
									<th>Kode-2018</th>
									<th>Kode-2020</th>
									<th>Matakuliah</th>
									<th>CPMK</th>
									<th>Persentasi Desk</th>
									<th>Nilai</th>
								</tr>
							</thead>
 
							<tbody>
			                    <?php $i = 0; foreach($data_rumus_deskriptor as $r) { ?>
			                    <tr>
			                        <td><?php echo $r->id_deskriptor	; ?></td>
			                        <td><?php echo $r->nama_kode ; ?></td>
			                        <td><?php echo $r->nama_kode_2 ; ?></td>
			                        <td><?php echo $r->nama_mata_kuliah ; ?></td>
			                        <td><?php echo $r->id_cpmk_langsung ; ?></td>
			                        <td><?php echo ($r->persentasi*100)."%" ; ?></td>
			                        <td><?php if (empty($nilai[$i])) {
			                        	echo "Nilai Kosong" ;
			                        } else {echo $nilai[$i][0]->nilai_langsung ;} ?></td>
                                </tr>
			                    <?php $i++; } ?> 
							</tbody>
						</table>

				</div>

		</div>
		<!-- /.box-content -->
	</div> 
	<!-- /.col-lg-9 col-xs-12 -->
</div>
 
<!-- chart.js Chart -->
<?php //echo '<pre>';  var_dump($data_rumus_deskriptor); echo '</pre>'; ?>



