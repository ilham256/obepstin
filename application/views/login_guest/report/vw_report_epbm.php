<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Laporan</h4>
			<ul class="nav nav-tabs" id="myTabs" role="tablist">

				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest')?>" ><button class="nav-link">Kinerja CPL Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest')?>" ><button class="nav-link">Kinerja CPMK Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest')?>" ><button class="nav-link">Rapor Mahasiswa</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest')?>" ><button class="nav-link">Rapor Mata Kuliah</button></a>
				</li>				
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/relevansi_ppm')?>" ><button class="nav-link">Relevansi PPM</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/efektivitas_cpl')?>" ><button class="nav-link">Efektivitas CPL</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/report_epbm')?>" ><button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Report EPBM</button></a>
				</li>

			</ul> 
			<div class="tab-content" id="myTabContent"> 
				<div class="row"> 
				<div class="row mb-3">
							<form role="form" id="contactform" action="<?php echo site_url('report_guest/report_epbm')?>" method="post">
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Tahun</label>
								<div class="col-sm-9">
									<input type="number" name="tahun" class="form-control" placeholder="Tahun" required>					
								</div>
							</div>
							<br>
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Semester</label>
								<div class="col-sm-9">
									<select id="cpl" class="form-select" name="semester">
										<option value="Ganjil">Ganjil</option>
										<option value="Genap">Genap</option>
									</select>					
								</div> 
								 
							</div>
							<br>
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Dosen</label>
								<div class="col-sm-9">
									<select id="cpl" class="form-select" name="dosen">
									<option value="<?php echo $dosen; ?>" style="background: lightblue;"><?php echo $dosen; ?></option>
									<?php $i = 1; foreach($data_dosen as $d) { ?>
									<option value="<?php echo $d->NIP; ?>"><?php echo $d->NIP.' ('.$d->nama_dosen.')' ; ?></option>
									<?php $i++; } ?>
									</select>					
								</div>
							</div>
							<br>
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Mata Kuliah</label>
								<div class="col-sm-9">
									<select id="cpl" class="form-select" name="mk">
									<option value="<?php echo $mk; ?>" style="background: lightblue;"><?php echo $mk; ?></option>
									<?php $i = 1; foreach($data_epbm_mk as $d) { ?>
									<option value="<?php echo $d->kode_epbm_mk; ?>"><?php echo $d->kode_epbm_mk.' ('.$d->nama_mata_kuliah.')' ; ?></option>
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
					<br>
					<p> Mata Kuliah <?php  echo $mk; ?> Semester <?php  echo $semester; ?> tahun <?php  echo $tahun; ?> </p>
					<p> Nama Dosen : <?php  echo $dosen; ?></p>
					<br>
 					
					<div class="col-lg-8 col-xs-12">
						<canvas id="pemenuhan_cpl" class="chartjs-chart" width="480" height="320" style="font-size: 30;"></canvas>
					</div>
					<br> 
					<table class="table table-bordered display">
						<thead>
							<tr>
								<th></th>
								<?php for ($i=0; $i < count($data_nilai_epbm_dosen); $i++) {  ?>
								<th> <?php  echo $data_psd[$i]->nama; ?> </th>
								<?php } ?>
		
							</tr>
						</thead>
						<tbody>
							<tr style="background-color: rgba(28,138,226,0.1);">
								<td>Nilai EPBM Dosen</td>
								<?php foreach ($data_nilai_epbm_dosen as $key) { ?>
								<td> <?php  echo $key->nilai;?> </td>
								<?php } ?>
							</tr>
							<tr style="background-color: rgba(0, 128, 12,0.1);">
								<td>Nilai EPBM Mata Kuliah</td>
								<?php foreach ($data_nilai_epbm_mk as $key) { ?>
								<td> <?php  echo $key->nilai;?> </td>
								<?php } ?>
							</tr>
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
</script>

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>


<script>

	var arr = <?php echo json_encode($data_diagram_epbm_dosen); ?>;
	var arr_mk = <?php echo json_encode($data_diagram_epbm_mk); ?>;
	var psd = <?php echo json_encode($psd); ?>;

	console.log(arr);

	var e = {},
        radarDataError = function() {
			var data = {
				labels: psd ,
				datasets: [{
					label: "Dosen",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					borderColor: "rgba(28,138,226,0.7)",
					data: arr,

				}, {
					label: "Mata Kuliah",
					backgroundColor: "rgba(0, 128, 128, 0)",
					pointStyle: 'line',
					borderColor: "rgba(0, 128, 12, 0.7)",
					data: arr_mk,
				}]
			};

            return data;
        };

	var ctx = document.getElementById('pemenuhan_cpl');
	var cpl_descriptions = psd ;

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
			type: 'radar',
			data: radarDataError(),
			options: options
		});
	} 
	
</script>