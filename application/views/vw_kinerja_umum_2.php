
<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12"> 
		<div class="box-content">
			<h4 class="box-title">Kinerja CPL</h4>			
			<form role="form" id="contactform" action="<?php echo site_url('kinumum')?>" method="post">
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
			<div class="col-lg-9 col-xs-12">
				<canvas id="pemenuhan_cpl" class="chartjs-chart" width="480" height="320"></canvas>
			</div>
		</div>
		<!-- /.box-content -->
	</div> 
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<?php 
$cpl = [];
foreach ($data_cpl as $key) {
	array_push($cpl,$key->nama);
}


echo '<pre>';  var_dump($cpl); echo '</pre>'; ?>

<script>

	var e = {},
        radarDataError = function() { 
        	var data_cpl = [<?php echo '"'.implode('","', $cpl).'"' ?>];

			var data = { 
				labels: [<?php foreach ($data_cpl as $key) {echo '"'.$key->nama.'"'.','; } ?>],
				datasets: [{
					label: "Std Min",
					backgroundColor: "rgba(242,242,242,1)",
					borderColor: "rgba(24,126,206,1)",
					data: [<?php echo $cpl1_min; ?>, <?php echo $cpl2_min; ?>, <?php echo $cpl3_min; ?>, <?php echo $cpl4_min; ?>, <?php echo $cpl5_min; ?>, <?php echo $cpl6_min; ?>],
					fill: 1,
				}, {
					label: "Rata-rata",
					backgroundColor: "rgba(24,138,226,1)",
					borderColor: "rgba(28,138,226,1)",
					data: [<?php echo $cpl1_average; ?>, <?php echo $cpl2_average; ?>, <?php echo $cpl3_average; ?>, <?php echo $cpl4_average; ?>, <?php echo $cpl5_average; ?>, <?php echo $cpl6_average; ?>],
					fill: '-1'
				}, {
					label: "Std Max",
					backgroundColor: "rgba(24,138,226,1)",
					borderColor: "rgba(24,138,226,1)",
					data: [<?php echo $cpl1_max; ?>, <?php echo $cpl2_max; ?>, <?php echo $cpl3_max; ?>, <?php echo $cpl4_max; ?>, <?php echo $cpl5_max; ?>, <?php echo $cpl6_max; ?>],
					fill: '-1'
				}, {
					label: "Target",
					backgroundColor: "rgba(204,15,15,0.1)",
					borderColor: "rgba(204,15,15,1)",
					data: [(<?php echo $target; ?>), (<?php echo $target; ?>), (<?php echo $target; ?>), (<?php echo $target; ?>), (<?php echo $target; ?>), (<?php echo $target; ?>)]
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
				display: false,
				position: "top"
			},
			elements: {
				line: {
					borderWidth: 3
				}
			},
			scale: {
				reverse: !1,
				ticks: {
					beginAtZero: !0
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
document.write(data_cpl);
</script>