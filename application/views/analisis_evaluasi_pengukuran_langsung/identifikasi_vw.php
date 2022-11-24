
<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12"> 
		<div class="box-content">
			<h4 class="box-title">Identifikasi Nilai CPMK Angkatan <?php echo $tahun	; ?> </h4>			

			<br>

			<br>
			<div class="col-md-12 col-sm-12"> 
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>CPL</th>
									<th>Kode-2018</th>
									<th>Kode-2020</th>
									<th>Matakuliah</th>
									<th>CPMK</th>
									<th>Nilai</th>
									<th>Target</th>
									<th>Status</th>
								</tr>
							</thead>
 
							<tbody>
			                    <?php $i = 0; foreach($data_rumus_deskriptor as $r) { ?>
			                    	<?php if ($r->persentasi > 0) { 
			                    			if ($nilai[$i]<$target_cpl[0]->nilai_target_pencapaian_cpl) {
			                    			 	# code...
			                    			  ?>
			                    <tr>
			                        <td><?php echo "CPL ".substr($r->id_deskriptor,11,1)	; ?></td>
			                        <td><?php echo $r->nama_kode ; ?></td>
			                        <td><?php echo $r->nama_kode_2 ; ?></td>
			                        <td><?php echo $r->nama_mata_kuliah ; ?></td>
			                        <td><?php echo $r->id_cpmk_langsung ; ?></td>
			                        <td><?php if (empty($nilai[$i])) {
			                        	echo "Nilai Kosong" ;
			                        } else {echo $nilai[$i] ;} ?></td>
			                        <td><?php echo $target_cpl[0]->nilai_target_pencapaian_cpl ?></td>
			                        <td><?php if (empty($nilai[$i])) {
			                        	echo "Tidak Terpenuhi" ;
			                        } elseif ($nilai[$i]<$target_cpl[0]->nilai_target_pencapaian_cpl) {
			                        	echo "Tidak Terpenuhi" ;
			                        } else{echo "Terpenuhi" ;} ?></td>
                                </tr>
			                    <?php }} $i++; } ?> 
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



