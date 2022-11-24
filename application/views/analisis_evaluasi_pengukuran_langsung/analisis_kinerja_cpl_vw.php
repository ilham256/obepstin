<div class="row small-spacing"> 
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Langsung</h4>
			
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
					<form role="form" id="contactform" action="<?php echo site_url('evaluasi_l')?>" method="post">
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan pilih Tahun Akademik</label>
							<div class="col-sm-3"> 
								<select id="angkatan" class="form-select" name="tahun_masuk_min">
									<option value="<?php echo $simpanan_tahun_min	; ?>" style="background: lightblue;"><?php echo $simpanan_tahun_min.'/'.$t_simpanan_tahun_min; ?></option>
									<?php $i = 1; foreach($tahun_masuk as $d) { ?>
									<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk.'/'.($d->tahun_masuk+1); ?></option>
									<?php $i++; } ?>
								</select>  
							</div>
							<label class="col-sm-1 col-form-label">s/d</label> 
							<div class="col-sm-3">
								<div class="input-group">
								<select id="angkatan" class="form-select" name="tahun_masuk_max">
									<option value="<?php echo $simpanan_tahun_max	; ?>" style="background: lightblue;"><?php echo $simpanan_tahun_max.'/'.$t_simpanan_tahun_max; ?></option>
									<?php $i = 1; foreach($tahun_masuk as $d) { ?>
									<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk.'/'.($d->tahun_masuk+1); ?></option>
									<?php $i++; } ?>
								</select>
								<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button> 
								</div> 
							</div> 
						</div>

					</form> 
					
					<div class="box-content">		 
						<div class="row row-inline-block small-spacing js__isotope_items">
						<?php 
						$list_angkatan = [];
						foreach($tahun_masuk_select as $d) {
					      array_push($list_angkatan, $d);
		    				}

		    			$jml_mk = count($list_angkatan);

						
						?>
							<div class="col-md-12 col-sm-12" style="">
								<div class="text-right"><strong>Data Analisis Kinerja CPL</strong></div>
								<br>
								<canvas id="evaluasi_cpl_pertama" class="chartjs-chart" width="480" height="220"></canvas>
								<br>
							</div>

						<?php
						
						//echo '<pre>';  var_dump($list_angkatan); echo '</pre>';
						?>
						</div>
					</div>


					<div class="text-right">
						<?php 

						//$data_tahun = array_map('intval', explode(',', str_replace(array('[', ']'),'', $tahun)));
						//echo '<pre>';  var_dump($tahun_masuk_select); echo '</pre>'; ?>

					<form role="form" id="contactform" action="<?php echo site_url('evaluasi_l/evaluasi_ketercapaian')?>" method="post">
						<?php foreach($tahun_masuk_select as $key2) { ?>
						<input type="hidden" name="tahun[]" value="<?php echo json_encode($key2); ?>">
						<?php }; ?>
						<?php foreach ($nilai_cpl as $key) {
							# code...
						

						foreach($key as $key2) { ?>
						<input type="hidden" name="nilai_cpl[]" value="<?php echo json_encode($key2); ?>">
						<?php }}; ?>
						<button style="width: 300px" type="submit" class="btn btn-primary" name="pilih" value="pilih">Evaluasi Ketercapaian CPL</button> 

					</form>
					<br>
					<form role="form" id="contactform" action="<?php echo site_url('evaluasi_l/evaluasi_trend')?>" method="post">
						<?php foreach($tahun_masuk_select as $key2) { ?>
						<input type="hidden" name="tahun[]" value="<?php echo json_encode($key2); ?>">
						<?php }; ?>
						<?php foreach ($nilai_cpl as $key) {
							# code...
						

						foreach($key as $key2) { ?>
						<input type="hidden" name="nilai_cpl[]" value="<?php echo json_encode($key2); ?>">
						<?php }}; ?>
						<button style="width: 300px" type="submit" class="btn btn-success" name="pilih" value="pilih">Evaluasi Trend</button> 

					</form>

					
					</div>

				
			</div>
			

		</div>
		<!-- /.box-content -->
	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>

<script>
		var e = {},
        o = function(min) {
            return Math.round(15 * Math.random()) + min
        };

	var arr = <?php echo json_encode($nilai_cpl); ?>;
	var arr_max = <?php echo json_encode($nilai_std_max); ?>;
	var arr_min = <?php echo json_encode($nilai_std_min); ?>;
	var target = <?php echo json_encode($target); ?>;
	var nama_cpl = <?php echo json_encode($nama_cpl); ?>;
	var tahun_masuk_select = <?php echo json_encode($tahun_masuk_select); ?>;
	
	console.log(arr);
	console.log(nama_cpl);

	var title = 'Nilai'
	var data_target_cpl = <?php echo $katkin[0]->nilai_target_pencapaian_cpl; ?>;
	var warna = ['#1C9B8E','#0F1E64', '#53DFD1', '#50655B','#614729', '#493620', '#322618','#1d170f','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];


	
	var datai = [];
	var a = arr.length
	
		radarDataError = function() {
			var data = {
				labels: nama_cpl,
				datasets: []
			};

			for (var j = 0; j < arr.length; j++) {
			data.datasets.push(
				{
				label: tahun_masuk_select[j],
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

			scales: {
				yAxes: [{
					stacked: false,
                 	ticks: {
                        beginAtZero: true 
                    }
				}]

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

	
		var ctxEvaluasiCPL = document.getElementById('evaluasi_cpl_pertama');

		if (ctxEvaluasiCPL != null) {
			var chartCPL = new Chart(ctxEvaluasiCPL, {
				type: 'bar',
				data: radarDataError(),
				options: options,
			});
		}

</script>
<?php  //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';?>