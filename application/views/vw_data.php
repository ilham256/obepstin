
<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12"> 
		<div class="box-content">
			<h4 class="box-title">Data (CPL) Mahasiswa</h4>			
			<form role="form" id="contactform" action="<?php echo site_url('data')?>" method="post">
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan Masukkan Tahun Angkatan</label>
								<div class="col-sm-3">
									<input type="text" name="tahun" class="form-control" placeholder="- Tahun Angkatan -" required>					
								</div>
								<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button>
							</div> 
					</form> 
			<br> 
			<div class="col-md-12 col-sm-12"> 
						<table id="example1" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<?php foreach ($data_cpl as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>NIM</th>
									<th>Nama</th> 
									<?php foreach ($data_cpl as $row) { ?>
									<th><?php echo $row->nama	; ?></th>
									<?php } ?>
								</tr> 
							</tfoot>
 
							<tbody>
			                    <?php $i = 1; foreach($data_mahasiswa as $r) { ?>
			                    <tr>
			                        <td><?php echo $r["Nim"]	; ?></td>
			                        <td><?php echo $r["Nama"] ; ?></td>

			                        <?php foreach ($data_cpl as $row) { ?>
									<td>
										<?php foreach($datas as $w) { ?>
												<?php if ($r["Nim"] == $w["nim"]) {
													if ($row->id_cpl_langsung == $w["id_cpl_langsung"]) {
														echo round($w["nilai_cpl"]);
													} } } ?>
			                    	</td>
									<?php } ?>
                                </tr>
			                    <?php $i++; } ?> 
							</tbody>
						</table>

						<form role="form" id="contactform" action="<?php echo site_url('data/export_excel/')?>" method="post" target="_blank">

							<input type="hidden" name="tahun" value="<?php echo $simpanan_tahun ?>">

							<button onclick="return confirm('Apakah anda ingin mendownload data excel CPL ?')" type="submit" class="btn btn-default waves-effect waves-light" name="download" value="download"><i class='fa fa-download'></i> Download</button>

						</form>
				</div>

		</div>
		<!-- /.box-content -->
	</div> 
	<!-- /.col-lg-9 col-xs-12 -->
</div>
 
<!-- chart.js Chart -->
<?php //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>'; ?>



<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<script>
	var arr = <?php echo json_encode($nilai_cpl); ?>;
	var arr_max = <?php echo json_encode($nilai_std_max); ?>;
	var arr_min = <?php echo json_encode($nilai_std_min); ?>;
	var target = [];

	console.log(arr); 
</script>