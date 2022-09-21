		
				<br>
					<div class="row small-spacing">
						<div class="col-xs-30">
							<div class="invoice-box">
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
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
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
									</tbody>
								</table>
								<br>
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong>CPMK Tak Langsung
										</strong>
										</p>
									</div>
								</div> 
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<canvas id="rapor_matakuliah_tl" class="chartjs-chart" width="480" height="220"></canvas>
									</div>
								</div>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>							
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
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
								<div class="row">
									<div class="col-md-12 col-xs-12 text-center">
										<p><strong> EPBM Matakuliah
										</strong>
										</p>
									</div>
								</div> 
								<div class="row">
									<div class="col-md-12 col-xs-12">
										 <div>
										<Hr>
											<p>Evaluasi Proses Belajar Mengajar (EPBM)</p>
											<p>Mata Kuliah: <?php  echo $data_mk["0"]->nama_mata_kuliah; ?></p>
											<Hr>
											<div class="row row-inline-block small-spacing js__isotope_items">
											<?php 

								    			$jml_mk = count($kode_epbm_dosen);

												for ($i=0; $i<$jml_mk; $i++) {
												?>
													<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
														<br>
														<br>
														
														<div class="text-right">
															<p><?php echo $kode_epbm_dosen[$i]." (".$nama_mata_kuliah[$i].") "."Tahun ".$nama_tahun[$i]." Semester ".$nama_semester[$i]; ?></p>
															<p><?php  echo $nama_dosen[$i]; ?></p>
														</div> 														
														<canvas id="pemenuhan_cpl<?php echo $i ?>" class="chartjs-chart" width="480" height="220"></canvas>	
														<br>													
														<hr>														
													</div>

												<?php
												}
												//echo '<pre>';  var_dump($list_angkatan); echo '</pre>';
											?>
											</div>
										</div>
									</div>
								</div>
								<br>
							<!-- /.invoice-box -->
						</div>
						<!-- /.col-xs-12 -->
					</div>
					<!-- /.row small-spacing -->
				



<!-- chart.js Chart -->
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
<script>

	var arr = <?php echo json_encode($data_diagram_epbm_dosen); ?>;
	var arr_mk = <?php echo json_encode($data_diagram_epbm_mk); ?>;
	var psd = <?php echo json_encode($psd); ?>;
	var a = arr.length;
	console.log(arr_mk);
	console.log(a);

	var datai = [];
    for (var i = 0; i < a; i++) {

    		datai[i] = {
				labels: psd[i],
				datasets: [{
					label: "Dosen",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					borderColor: "rgba(28,138,226,0.7)",
					data: arr[i],

				}, {
					label: "Mata Kuliah",
					backgroundColor: "rgba(0, 128, 128, 0)",
					pointStyle: 'line',
					borderColor: "rgba(0, 128, 12, 0.7)",
					data: arr_mk[i],
				}]
			}

	}

	var cpl_descriptions = [" , , , , , , , , , "] ;

	var length_line = 68;

	
	var options = {

			legend: {
				position: "right",
				labels: {  
			        fontColor:'green',
			        fontSize: 14,  
			        boxWidth:27,
			        usePointStyle: true,			        
			      } 
			},

			elements: {
				line: {
					borderWidth: 4
				},
				
			},
			scale: { 
				reverse: !1,
				ticks: {
					beginAtZero: !0,
				      min: 0,
				      max: 5,
				      stepSize: 1,
				      fontColor: 'blue',
				      fontSize: 20,
				},
			pointLabels: { fontSize: 17 /* must be a number it translates to pixels */ }
			},
			plugins: {

				filler: {
					propagate: false
				},
				'samples-filler-analyser': {
					target: 'chart-analyser'
				}
			},
			interaction: {
				intersect: false
			},
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						var label = data.datasets[tooltipItem.datasetIndex].label || '';
						if (label) {
							label += ': ';
						}
						label += Math.round(tooltipItem.yLabel * 100) / 100;

						var labels = [label];

						
						return labels;
					}
				}
			}
		}
		



	for (var i = 0; i<a; i++) {
		var ctxEvaluasiCPL = document.getElementById('pemenuhan_cpl' + i);

		if (ctxEvaluasiCPL != null) {
			var chartCPL = new Chart(ctxEvaluasiCPL, {
				type: 'radar',
				data: datai[i],
				options: options
			});
		}
	}

</script>

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>