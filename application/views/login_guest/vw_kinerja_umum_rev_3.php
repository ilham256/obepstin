 
<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12"> 
		<div class="box-content">
			<h4 class="box-title">Kinerja Capaian Pembelajaran Lulusan (CPL)</h4>			
			<form role="form" id="contactform" action="<?php echo site_url('input_asesmen_guest/kinumum')?>" method="post">
				<div class="row mb-3">
					<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan pilih Tahun Angkatan</label>
					<div class="col-sm-3 ">
						<div class="input-group">
						<select id="angkatan" class="form-select" name="tahun_masuk">
							<option value="<?php echo $simpanan_tahun	; ?>" style="background: lightblue;"><?php echo $simpanan_tahun."/".$t_simpanan_tahun; ?></option>
							<?php $i = 1; foreach($tahun_masuk as $d) { ?>
							<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk.'/'.($d->tahun_masuk+1); ?></option>
							<?php $i++; } ?>
						</select>

						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button> 
						</div>
					</div>
				</div>
			</form>  
			<br> 
			<div class="col-lg-7 col-xs-12">
				<canvas id="pemenuhan_cpl" class="chartjs-chart" width="480" height="320" style="font-size: 30;"></canvas>
			</div>
			<br>
			<div class="col-lg-12 col-xs-12">
				<table class="table table-striped table-bordered display">
					<thead>
						<tr>
							<th></th>
							<?php $i = 1; foreach($data_cpl as $d) { ?>
							<th><?php echo $d->nama; ?></th>
							<?php $i++; } ?>
							<th> Target </th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Sangat Baik</td>
							<?php $a = 0; foreach($data_cpl as $d) { 
								 $j=0; 
								foreach ($nilai_cpl_mahasiswa[$a] as $key) {
									if ($key >= $target_cpl[0]->batas_bawah_kategori_sangat_baik_cpl) {
										$j += 1;
										}
									}
								 ?>
								<td>
								<?php
								$k = round($j/$jumlah[$a]*100,2);
								echo $k."%";
							?></td>
							<?php $a++; } ?>
							<td style="color: blue;"><?php echo $target_cpl[0]->target_jumlah_mahasiswa_sangat_baik_cpl.' %'; ?></td>
						</tr>
						<tr>
							<td>Baik</td>
							<?php $a = 0; foreach($data_cpl as $d) { 
								 $j=0; 
								foreach ($nilai_cpl_mahasiswa[$a] as $key) {
									if ($key >= $target_cpl[0]->batas_bawah_kategori_baik_cpl && $key < $target_cpl[0]->batas_bawah_kategori_sangat_baik_cpl) {
										$j += 1;
										}
									}
								 ?>
								<td>
								<?php
								$k = round($j/$jumlah[$a]*100,2);
								echo $k."%";
							?></td>
							<?php $a++; } ?>
							<td style="color: blue;"><?php echo $target_cpl[0]->target_jumlah_mahasiswa_baik_cpl.' %'; ?></td>
						</tr>
						<tr>
							<td>Cukup</td>
							<?php $a = 0; foreach($data_cpl as $d) { 
								 $j=0; 
								foreach ($nilai_cpl_mahasiswa[$a] as $key) {
									if ($key >= $target_cpl[0]->batas_bawah_kategori_cukup_cpl && $key < $target_cpl[0]->batas_bawah_kategori_baik_cpl) {
										$j += 1;
										}
									}
								 ?>
								<td>
								<?php
								$k = round($j/$jumlah[$a]*100,2);
								echo $k."%";
							?></td>
							<?php $a++; } ?>
							<td style="color: blue;"><?php echo $target_cpl[0]->target_jumlah_mahasiswa_cukup_cpl.' %'; ?></td>
						</tr>
						<tr>
							<td>Kurang</td>
							<?php $a = 0; foreach($data_cpl as $d) { 
								 $j=0; 
								foreach ($nilai_cpl_mahasiswa[$a] as $key) {
									if ($key > 0 && $key < $target_cpl[0]->batas_bawah_kategori_cukup_cpl) {
										$j += 1;
										}
									}
								 ?>
								<td>
								<?php
								$k = round($j/$jumlah[$a]*100,2);
								echo $k."%";
							?></td>
							<?php $a++; } ?>
							<td></td>
						</tr>
						<tr>
							<td>Total</td>
							<?php $a = 0; foreach($data_cpl as $d) { 
								 ?>
								<td>
								<?php
								$k = round(100,2);
								echo $k."%";
							?></td>
							<?php $a++; } ?>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.box-content -->
	</div> 
	<!-- /.col-lg-9 col-xs-12 -->
</div>
 
<!-- chart.js Chart -->
<?php //echo '<pre>';  var_dump($nilai_cpl_mahasiswa); echo '</pre>'; ?>



<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<script>
	var arr = <?php echo json_encode($nilai_cpl); ?>;
	var arr_max = <?php echo json_encode($nilai_std_max); ?>;
	var arr_min = <?php echo json_encode($nilai_std_min); ?>;
	var target = [];

	console.log(arr);

	for (var j = 0; j < arr.length; j++) {
		target.push(<?php echo $target; ?>);
	}

	var e = {},
        radarDataError = function() {
			var data = {
				labels: ["CPL 1", "CPL 2", "CPL 3", "CPL 4", "CPL 5", "CPL 6", "CPL 7", "CPL 8"],
				datasets: [{
					label: "Standar deviasi Bawah",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					pointBackgroundColor: "rgba(106,90,205,1)",
					borderColor: "rgba(28,138,226,0.2)",
					data: arr_min,

				}, {
					label: "Rata-rata",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					borderColor: "rgba(28,138,226,0.7)",
					data: arr,

				}, {
					label: "Standar deviasi Atas",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					pointBackgroundColor: "rgba(106,90,205,1)",
					borderColor: "rgba(50,80,220,0.2)",
					data: arr_max,
				}, {
					label: "Target",
					backgroundColor: "rgba(204,15,15,0)",
					pointStyle: 'line',
					borderColor: "rgba(204,15,15,0.7)",
					data: target,
				}]
			};

            return data;
        };

	var ctx = document.getElementById('pemenuhan_cpl');
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
				reverse: !1,
				ticks: {
					beginAtZero: !0,
				      min: 45,
				      max: 100,
				      stepSize: 5,
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




