<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Laporan</h4>
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
 
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest')?>" ><button class="nav-link">Kinerja CPL Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/kinerja_cpmk_mahasiswa')?>" ><button class="nav-link">Kinerja CPMK Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/mahasiswa')?>" ><button class="nav-link">Rapor Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/mata_kuliah')?>" ><button class="nav-link">Rapor Mata Kuliah</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/relevansi_ppm')?>" ><button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Relevansi PPM</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/efektivitas_cpl')?>" ><button class="nav-link">Efektivitas CPL</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/report_epbm')?>" ><button class="nav-link">Rekap EPBM</button></a>
				</li>
			</ul> 
			<div class="tab-content" id="myTabContent"> 
				
				<div class="box-content"> 
					<div class="row row-inline-block small-spacing js__isotope_items">
					<h4 class="box-title">Relevansi PPM</h4>			
					<br>
					<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
						<canvas id="pemenuhan_ppm" class="chartjs-chart" width="480" height="320" style="font-size: 30;"></canvas>
					</div>
					<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
						<canvas id="pemenuhan_cpl" class="chartjs-chart" width="480" height="320" style="font-size: 30;"></canvas>
					</div>
					</div>
				</div>
				<div>
					<p>Relevansi PPM</p>
					<table class="table table-striped table-bordered display">	

						<thead>
							<tr>
								<th>Nilai</th>
								<?php
								foreach ($ppm as $key) { ?>
								<th><?php echo $key->nama; ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
								for ($i=0; $i < 5; $i++) { ?>
							<tr>
								<td><?php echo $i+1; ?></td>
								<?php
								foreach ($nilai_diagram_ppm[$i] as $key) { ?>
								<td><?php echo $key." %";?></td>
								<?php } ?>
							</tr>
							<?php } ?>
						</tbody>

					</table>
					<br>
					<p>Relevansi PPM (CPL)</p>
					<table class="table table-striped table-bordered display">						
						<thead>
							<tr>
								<th>Nilai</th>
								<?php
								foreach ($cpl as $key) { ?>
								<th><?php echo $key->nama; ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
								for ($i=0; $i < 5; $i++) { ?>
							<tr>
								<td><?php echo $i+1; ?></td>
								<?php
								foreach ($nilai_diagram_cpl[$i] as $key) { ?>
								<td><?php echo $key." %";?></td>
								<?php } ?>
							</tr>
							<?php } ?>
						</tbody>

					</table>
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
	var arr = <?php echo json_encode($nilai_diagram_cpl); ?>;
	var ppm = <?php echo json_encode($nilai_diagram_ppm); ?>;
	var nama_cpl = <?php echo json_encode($nama_cpl); ?>; 
	var nama_ppm = <?php echo json_encode($nama_ppm); ?>;
	var warna = ['#008000', '#6495ED', '#FF8C00','#DC143C', '#946b3a', '#7a5931','#614729', '#493620', '#322618','#1d170f','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];


	console.log(nama_cpl);
	console.log(arr);


	var e = {},
        radarDataError = function() {
			var data = {
				labels: nama_cpl,
				datasets: []
			};

			for (var j = 0; j < arr.length; j++) {
			data.datasets.push(
				{
				label: j+1,
				backgroundColor: warna[j],
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#00FF00",
				borderWidth: 1,
				data: arr[j],
				}
				)
			}
            return data;
        }; 

        radarDataErrorPpm = function() {
			var data = {
				labels: nama_ppm,
				datasets: []
			};

			for (var j = 0; j < ppm.length; j++) {
			data.datasets.push(
				{
				label: j+1,
				backgroundColor: warna[j],
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#00FF00",
				borderWidth: 1,
				data: ppm[j],
				}
				)
			}
            return data;
        }; 



	var ctx = document.getElementById('pemenuhan_cpl');
	var ctx_ppm = document.getElementById('pemenuhan_ppm');
	var cpl_descriptions = [
		"Mampu mengidentifikasi, menganalisis, dan menyelesaikan permasalahan keteknikan agroindustri, yang mencakup sistem, proses, manajemen, dan lingkungan, melalui penerapan pengetahuan matematika, IPA, keteknikan dan teknologi informasi, menggunakan teknik dan perangkat-perangkat modern", 
		"Mampu merancang sistem/komponen, proses dan produk agroindustri untuk memenuhi kebutuhan yang diinginkan dalam kendala yang realistis.", 
		"Merancang dan melaksanakan penelitian menggunakan metode ilmiah dan keteknikan dan menganalisis serta menginterpretasikan data yang dihasilkan", 
		"Menyadari pentingnya dan memiliki kemampuan untuk terlibat dalam pembelajaran sepanjang hayat", 
		"Berkomunikasi secara tertulis dan lisan dengan efektif", 
		"Berperan secara efektif dalam tim multidisiplin dan multikultur", 
		"Mampu memahami penerapan etika dan profesionalisme dalam menyelesaikan permasalahan keteknikan agroindustri dalam konteks ekonomi, lingkungan, masyarakat dan isu-isu kontemporer lainnya.", 
		"Mampu mentransformasi ide-ide bisnis berbasis ilmu pengetahuan dan teknologi ke dalam konsep bisnis agroindustri (teknoprener)"];	
	var length_line = 68;

	if (ctx != null) {
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
				 y: {
			        beginAtZero: true
			      }
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
						label += '%';

						var labels = [label];

						var desc = cpl_descriptions[tooltipItem.index];

						while (desc.length>length_line) {
							var desc_line = desc.substring(0, length_line);
							var spaceIndex = desc_line.lastIndexOf(" ") + 1;
							var sentence = desc_line.substr(0, spaceIndex);
							desc = desc.substring(spaceIndex);
							labels.push(sentence);
						}
						labels.push(desc);

						return labels;
					}
				}
			}
		};
		
	var myRadarChart = new Chart(ctx, {
			type: 'bar',
			data: radarDataError(),
			options: options
		});

	} 
	
	if (ctx_ppm != null) {
		var options_ppm = {

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
				      max: 6,
				      stepSize: 1,
				      fontColor: 'blue',
				      fontSize: 13,
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
						label += '%';

						var labels = [label];

						var desc = "";

						while (desc.length>length_line) {
							var desc_line = desc.substring(0, length_line);
							var spaceIndex = desc_line.lastIndexOf(" ") + 1;
							var sentence = desc_line.substr(0, spaceIndex);
							desc = desc.substring(spaceIndex);
							labels.push(sentence);
						}
						labels.push(desc);

						return labels;
					}
				}
			}
		};
		
	var myRadarChartPpm = new Chart(ctx_ppm, {
			type: 'bar',
			data: radarDataErrorPpm(),
			options: options_ppm
		});
	
	}
</script>

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>