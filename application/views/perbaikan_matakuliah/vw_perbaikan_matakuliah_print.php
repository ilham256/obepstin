		
					<div class="row small-spacing">
						<div class="col-xs-12">
							<div class="invoice-box" style="font-style: 'calibri'; ">
								<div class="row">
									<div class="col-md-12 col-xs-12" style="color: black; font-size: 20px;">
										<p style="text-align: center;"><strong>HASIL EVALUASI </p>
										</strong>
										<p><b>A. EVALUASI PENCAPAIAN CAPAIAN PEMBELAJARAN MATA KULIAH</b>
										<br>
										</p>
									</div>
								</div>
								<p>Berikut hasil evaluasi pencapaian mahasiswa untuk CPMK untuk mata kuliah 
										<b><?php echo $data_mk["0"]->nama_mata_kuliah; ?></b></p>
								<hr>
								<div class="row">
									<div class="col-md-20 col-xs-20 text-center">
										<p><strong>INSTITUT PERTANIAN BOGOR<br>
										DEPARTEMEN TEKNOLOGI INDUSTRI PERTANIAN<br>
										P.S. TEKNIK INDUSTRI PERTANIAN
										<br><br>
										</strong>
										</p>
									</div>
								</div> 
								<table>  
									<tbody>
										<tr>
											<td>Nama Mata Kuliah</td>
											<td style="text-align: left;"><?php echo $data_mk["0"]->nama_mata_kuliah; ?></td>
										</tr>
										<tr>
											<td>Kode TM-2018 & 2019</td>
											<td style="text-align: left;"><?php echo $data_mk["0"]->nama_kode; ?></td>
										</tr>
										<tr>
											<td>Kode K-2020</td>
											<td style="text-align: left;"><?php echo $data_mk["0"]->nama_kode_2; ?></td>
										</tr>
										<tr>
											<td>Beban SKS</td>
											<td style="text-align: left;"><?php echo $data_mk["0"]->sks; ?></td>
										</tr>
										<tr>
											<td>Dosen Pengajar</td>
											<td style="text-align: left;"><?php echo $data_mk["0"]->dosen; ?></td>
										</tr>
										<tr>
											<td>Angkatan</td>
											<td style="text-align: left;"><?php echo $tahun_mk; ?></td>
										</tr>
									</tbody>
								</table> 
								<br>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>CPMK Langsung
										</strong>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<canvas id="rapor_matakuliah" class="chartjs-chart" width="480" height="220"></canvas>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>Persentase CPMK Langsung
										</strong>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<table class="table table-striped table-bordered display">
											<thead>
												<tr>
													<th ></th>
													<?php $i = 1; foreach($mk_raport as $d) { ?>
													<th style="text-align: center;"><?php echo $d; ?></th>
													<?php $i++; } ?>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Sangat Baik</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key >= $target_cpl[0]->batas_bawah_kategori_sangat_baik_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;" >
														<?php
														$k = round($j/$jumlah[$a] * 100 ,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
												</tr>
												<tr>
													<td>Baik</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key >= $target_cpl[0]->batas_bawah_kategori_baik_cpl && $key < $target_cpl[0]->batas_bawah_kategori_sangat_baik_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;" >
														<?php
														$k = round($j/$jumlah[$a]*100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
												</tr>
												<tr>
													<td>Cukup</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key >= $target_cpl[0]->batas_bawah_kategori_cukup_cpl && $key < $target_cpl[0]->batas_bawah_kategori_baik_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;">
														<?php
														$k = round($j/$jumlah[$a]*100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
												</tr>
												<tr>
													<td>Kurang</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 $j=0; 
														foreach ($nilai_mk_raport_keseluruhan[$a] as $key) {
															if ($key > 0 && $key < $target_cpl[0]->batas_bawah_kategori_cukup_cpl) {
																$j += 1;
																}
															}
														 ?>
														<td style="text-align: center;">
														<?php
														$k = round($j/$jumlah[$a]*100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
												</tr>
												<tr>
													<td>Total</td>
													<?php $a = 0; foreach($mk_raport as $d) { 
														 ?>
														<td style="text-align: center;">
														<?php
														$k = round(100,2);
														echo $k."%";
													?></td>
													<?php $a++; } ?>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12 col-xs-12" style="color: black; font-size: 20px;">
										<p>
										<br>
										<b>B. EVALUASI DOSEN, MITRA DAN MAHASISWA</b>
										<br>
										</p>
									</div>
								</div>
								<div style="color: black; font-size: 20px;">
									<p><pre style="font-family: 'Calibri'; white-space:pre-line;"><?php print_r($data->analisis);?></pre></p>
									
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12" style="color: black; font-size: 20px;">
										<p>
										<br>
										<b>C. TINDAK LANJUT PERBAIKAN </b>
										<br>
										</p>
									</div>
								</div>
								<div style="color: black; font-size: 20px;">
									<p><pre style="font-family: 'Calibri'; white-space:pre-line;"><?php print_r($data->perbaikan);?></pre></p>
									
								</div>
								<hr>
								<div>
									<p>Diperiksa Oleh</p>
									<p>Bogor,_____________</p>
									<p>Komisi Pendidikan</p>
									<br>
									<br>
									<p style="margin-left: 700px">__________________________________</p>
									<p>NIP.</p>
									<br>
									<br>
									<p>Disetujui Oleh</p>
									<p>Ketua Departemen</p>
									<br>
									<br>
									<p style="margin-left: 700px">__________________________________</p>
									<p>NIP.</p>
								</div>
							</div>
							<!-- /.invoice-box -->
							<p><?php  //echo '<pre>';  var_dump($data_cpl); echo '</pre>';?></p>
						</div>
						<!-- /.col-xs-12 -->
					</div>
					<!-- /.row small-spacing -->
				



<!-- chart.js Chart -->

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>

<script>
	var temp;
	var title = 'Nilai'

	var labels = ['Raport_Mata_Kuliah'];

	var warna = ['#008000', '#6495ED', '#FF8C00','#DC143C', '#00FFFF', '#00008B','#008B8B', '#4cc9f0', '#f72585','#b5179e','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];



	var mk_raport = <?php echo json_encode($mk_raport); ?>;
	var mk_raport_nilai = <?php echo json_encode($nilai_mk_raport); ?>;
	var mk_raport_nilai_tl = <?php echo json_encode($nilai_mk_raport_tak_langsung); ?>;


	var barChartDataError = {
		labels: [title],
		datasets: []
		};

	var p = mk_raport.length;

	for (var j = 0; j < p; j++) {
			barChartDataError.datasets.push(
				{
				label: mk_raport[j],
				backgroundColor: warna[j], 
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#fff",
				borderWidth: 1,
				data: [mk_raport_nilai[j]],
				errorBars: {
					'Nilai': {plus: 15, minus: 10},
						}
					},
				)
		}
	

	var ctxRapor = document.getElementById('rapor_matakuliah');

	if (ctxRapor != null) {
			var chartCPMK = new Chart(ctxRapor, {
				type: 'bar',
				data: barChartDataError,
				options: {
					responsive: true,
					legend: {
						position: "right"}
					,
					title: {
						display: false,
						text: 'Chart.js Error Bars Plugin'
					},
					plugins: {
						chartJsPluginErrorBars: {
							color: 'darkgrey',
							width: 10 | '10px' | '60%',
							lineWidth: 2 | '2px',
							absoluteValues: false
						}
					},
					scales: {
						xAxes: [{
								display: false,
								scaleLabel: {
									display: false,
									labelString: 'Raport_Mata_Kuliah'
								},
							}],
						yAxes: [{
								display: true,
								ticks: {
									beginAtZero: true,
									steps: 10,
									stepValue: 5,
									max: 100
								},
								scaleLabel: {
									display: true,
									labelString: title
								}
							}]
					},
					tooltips: {
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label || '';
								var errorBars = data.datasets[tooltipItem.datasetIndex].errorBars;
								if (label) {
									label += ': ';
								}

								var value = Math.round(tooltipItem.yLabel * 100) / 100;
								label += value;
								var stdMin = value - errorBars[title].minus;
								var stdMax = value + errorBars[title].plus;								
								label += ' (' + stdMin + '..' + stdMax + ')'
								return label;
							}
						}
					}
				},
			});			

		}


	var barChartDataError_tl = {
		labels: [title],
		datasets: []
		};

	var p = mk_raport.length;

	for (var j = 0; j < p; j++) {
			barChartDataError_tl.datasets.push(
				{
				label: mk_raport[j],
				backgroundColor: warna[j], 
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#fff",
				borderWidth: 1,
				data: [mk_raport_nilai_tl[j]],
				errorBars: {
					'Nilai': {plus: 0.5, minus: 0.5},
						}
					},
				)
		}
	

	var ctxRapor_tl = document.getElementById('rapor_matakuliah_tl');

	if (ctxRapor_tl != null) {
			var chartCPMK_tl = new Chart(ctxRapor_tl, {
				type: 'bar',
				data: barChartDataError_tl,
				options: {
					responsive: true,
					legend: {
						position: "right"}
					,
					title: {
						display: false,
						text: 'Chart.js Error Bars Plugin'
					},
					plugins: {
						chartJsPluginErrorBars: {
							color: 'darkgrey',
							width: 10 | '10px' | '60%',
							lineWidth: 2 | '2px',
							absoluteValues: false
						}
					},
					scales: {
						xAxes: [{
								display: false,
								scaleLabel: {
									display: false,
									labelString: 'Raport_Mata_Kuliah'
								},
							}],
						yAxes: [{
								display: true,
								ticks: {
									beginAtZero: true,
									steps: 1,
									stepValue: 1,
									max: 6
								},
								scaleLabel: {
									display: true,
									labelString: title
								}
							}]
					},
					tooltips: {
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label || '';
								var errorBars = data.datasets[tooltipItem.datasetIndex].errorBars;
								if (label) {
									label += ': ';
								}

								var value = Math.round(tooltipItem.yLabel * 100) / 100;
								label += value;
								var stdMin = value - errorBars[title].minus;
								var stdMax = value + errorBars[title].plus;								
								label += ' (' + stdMin + '..' + stdMax + ')'
								return label;
							}
						}
					}
				},
			});			

		}



	
</script>