<div class="row small-spacing"> 
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Langsung / Evaluasi Trend</h4>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Analisis Kinerja CPL</button>
				</li> 
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('evaluasi_l/evaluasi_kinerja_cpl')?>" ><button class="nav-link">Analisis Status Pencapaian CPL</button></a>
				</li> 
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" role="tabpanel" id="cpl" aria-labelledby="cpl-tab">

					<div class="box-content">		 
						<h5 class="box-title">Evaluasi Trend</h5>
					

						<?php 

						//$data_tahun = array_map('intval', explode(',', str_replace(array('[', ']'),'', $tahun)));
						//echo '<pre>';  var_dump($nilai_cpl); echo '</pre>'; ?>

						<table class="table table-striped table-bordered display" style="width:100%">

							<thead>
								<tr>
									<th>CPL</th>
									<?php $j=0; foreach($tahun as $key) { ?>
									<th><?php echo $key ?></th>
									<?php } ?>
	
									<th>Trend</th>
								</tr>
							</thead>
						
							<tbody> 
								<?php $j=0; foreach($data_cpl as $key2) { ?>
								<tr>
									<td><?php echo $key2->nama ?></td>
									<?php $i=0; foreach($tahun as $key) { ?>
									<td><?php echo $nilai_cpl[$i][$j] ?></td>
									<?php $i++; }; ?>
									<td>
										<?php 
										$n = count($tahun);
										$jml_nilai = 0;
										$k=0; foreach ($tahun as $key) {
											$jml_nilai += $nilai_cpl[$k][$j] ;
											$k++;
										}
										$rata_rata = $jml_nilai/$n;
										$perubahan = $rata_rata - $nilai_cpl[0][$j];
										if ($perubahan > 1) {
											$trend = "Naik";
										} elseif ($perubahan < -1) {
											$trend = "Turun";
										} else {$trend = "Fluktuatif";}
										echo $trend;
										 ?>	
									</td>

								</tr>
								<?php $j++;}; ?>
							</tbody>
						
						</table>
						<br>
						<br>

					</div>
				</div>
				</div>
				
			</div>
			

		</div>
		<!-- /.box-content -->
	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>

<script>

</script>
<?php  //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';?>