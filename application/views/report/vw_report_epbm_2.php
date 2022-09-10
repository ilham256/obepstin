<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Laporan</h4>
			<ul class="nav nav-tabs" id="myTabs" role="tablist">

				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report')?>" ><button class="nav-link">Kinerja CPL Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report/kinerja_cpmk_mahasiswa')?>" ><button class="nav-link">Kinerja CPMK Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report/mahasiswa')?>" ><button class="nav-link">Rapor Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report/mata_kuliah')?>" ><button class="nav-link">Rapor Mata Kuliah</button></a>
				</li>				
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report/relevansi_ppm')?>" ><button class="nav-link">Relevansi PPM</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report/efektivitas_cpl')?>" ><button class="nav-link">Efektivitas CPL</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report/report_epbm')?>" ><button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Report EPBM</button></a>
				</li>
 
			</ul> 

			<div class="tab-content" id="myTabContent"> 
				<div class="row"> 
				<div class="row mb-3">
							<form role="form" id="contactform" action="<?php echo site_url('report/report_epbm')?>" method="post">
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Dosen</label>
								<div class="col-sm-9" class="form-control">
									<select id="cpl" class="form-control" name="dosen">
									<option value="<?php echo $dosen; ?>" style="background: lightblue;"><?php echo $dosen; ?></option>
									<?php $i = 1; foreach($data_dosen as $d) { ?>
									<option value="<?php echo $d->NIP; ?>"><?php echo $d->NIP.' ('.$d->nama_dosen.')' ; ?></option>
									<?php $i++; } ?>
									</select>					
								</div>
							</div>
							<br>
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label"></label>
								<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button>
							</form>	
							</div>	
											
				</div>
				</div> 
				<div>
				<Hr>
					<p>Evaluasi Proses Belajar Mengajar (EPBM)</p>
					<p> Nama Dosen : <?php  echo $dosen; ?></p>
					<div class="row row-inline-block small-spacing js__isotope_items">
					<?php 

		    			$jml_mk = count($kode_epbm_dosen);

						for ($i=0; $i<$jml_mk; $i++) {
						?>
							<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
								<div class="text-right"><strong><?php echo $kode_epbm_dosen[$i]." (".$nama_mata_kuliah[$i].") "."Tahun ".$nama_tahun[$i]." Semester ".$nama_semester[$i]; ?></strong></div>
								<br>
								<canvas id="pemenuhan_cpl<?php echo $i ?>" class="chartjs-chart" width="480" height="220"></canvas>
								<br>
							</div>

						<?php
						}
						//echo '<pre>';  var_dump($list_angkatan); echo '</pre>';
					?>
					</div>
				</div>
			</div>			
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>


<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<script>
</script>

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>


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

