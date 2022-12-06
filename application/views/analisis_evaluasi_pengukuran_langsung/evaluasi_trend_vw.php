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
						<?php 

						//$data_tahun = array_map('intval', explode(',', str_replace(array('[', ']'),'', $tahun)));
						//echo '<pre>';  var_dump($nilai_cpl); echo '</pre>'; ?>
						<?php  //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';?>
						<?php  //echo '<pre>';  var_dump($data_cpl); echo '</pre>';?>

						<h5 class="box-title">Evaluasi Trend</h5>
						<?php  
							$nama_cpl = [];
							foreach ($data_cpl as $key) {
								array_push($nama_cpl, $key->nama);
							}
							$jml_cpl = count($nama_cpl);

							for ($i=0; $i<$jml_cpl; $i++) {
						?>
						<div class="row row-inline-block small-spacing js__isotope_items" style="">
							<div class="col-md-7 col-sm-5" style="">
								<h5 class="text-center"><?php echo $nama_cpl[$i] ?></h5>
								<canvas id="evaluasi_trend<?php echo $i?>" class="chartjs-chart"></canvas>
								
							</div>
							<div class="col-md-1 col-sm-6" style="vertical-align: center;">
							</div>
							<div class="col-md-3 col-sm-6" style="vertical-align: center;">
									

								<br>
								<br>
								<br>
								<?php 							
									$n = count($tahun);
									$jml_nilai = 0;
									$k=0; foreach ($tahun as $key) {
										$jml_nilai += $nilai_cpl[$k][$i] ;
										$k++;
									}
									$rata_rata = $jml_nilai/$n;
									$perubahan = $rata_rata - $nilai_cpl[0][$i];
									if ($perubahan > 1) {
										$trend = "Naik";
										$stat = "info";
										$icon = "ti-stats-up";
									} elseif ($perubahan < -1) {
										$trend = "Turun";
										$stat = "danger";
										$icon = "ti-stats-down";
									} else {
										$trend = "Fluktuatif";
										$stat = "success";
										$icon = "ti-arrows-horizontal";
									} 
								?>
								<div class="alert alert-<?php echo $stat; ?> alert-dismissible" >
				                  <h4 style="text-align: center;"><i class="menu-icon <?php echo $icon; ?>"></i><?php echo "  ".$trend; ?></h4>
				                </div>
				                <a href="<?php echo site_url('katkin') ?>">
				                <div class="alert alert-dismissible" style="background-color: #FCF9BE; text-align: center; color: black;" >
				                  <h4 style="text-align: center;"> &nbsp;  &nbsp; Ubah Target</h4>
				                </div>
				                </a>		                
							</div>
							<div class="col-md-1 col-sm-6" style="vertical-align: center;">
							</div>
						</div>
						<br>
						<hr>
						<?php }  ?>
						<?php  //echo '<pre>';  var_dump($nama_cpl); echo '</pre>';?>
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

	var title = 'Nilai';

	nilai = <?php echo json_encode($nilai_cpl); ?>;
	var tahun = <?php echo json_encode($tahun); ?>;

	var jumlah_cpl = <?php echo(count($nama_cpl)); ?>;
	var jumlah_tahun = <?php echo(count($tahun)); ?>;

	

	


	console.log(tahun);
	console.log(nilai);

	var datai = [];

	for (var i = 0; i < jumlah_cpl; i++){

		nilai_cpl = [];
		for (var j = 0; j < jumlah_tahun; j++){
			nilai_cpl.push(nilai[j][i]);
		}

		console.log(nilai_cpl);
		datai[i] = {
		labels: tahun,
		datasets: [{
		    label: "Nilai",
		    data: nilai_cpl,
		    borderColor: 'rgb(75, 192, 192)',
		    tension: 0,
		  }]
		};
	}


	for (var i = 0; i < jumlah_cpl; i++) {
		var ctxPemenuhanCPMK = document.getElementById('evaluasi_trend' + i);
		if (ctxPemenuhanCPMK != null) {
			var pemenuhanCPMK = new Chart(ctxPemenuhanCPMK, {
				type: 'line',
				data: datai[i],
				options: {	
					scales: {
						yAxes: [{
							stacked: false,
		                 	ticks: {
		                        beginAtZero: true 
		                    }
						}]

					},
				},			
			});			

		}
	}


</script>
