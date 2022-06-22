<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Kinerja Capaian Pembelajaran Mata Kuliah (CPMK)</h4>
			<form role="form" id="contactform" action="<?php echo site_url('Kincpmk')?>" method="post">
				<div class="row mb-3">
					<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan pilih Tahun Angkatan</label>
					<div class="col-sm-3 ">
						<select id="angkatan" class="form-select" name="tahun_masuk">
							<option value="<?php echo $simpanan_tahun	; ?>" style="background: lightblue;"><?php echo $simpanan_tahun.'/'.$t_simpanan_tahun; ?></option>
							<?php $i = 1; foreach($tahun_masuk as $d) { ?>
							<option value="<?php echo $d->tahun_masuk; ?>"><?php echo $d->tahun_masuk.'/'.($d->tahun_masuk+1); ?></option>
							<?php $i++; } ?>
						</select>
					</div> 
				</div>
				<div class="row mb-3"> 
					

					<label for="angkatan" class="col-sm-3 col-form-label">Silahkan pilih Semester</label>
					<div class="col-sm-3">
						<div class="input-group">
						<select id="semester" class="form-select" name="semester">
							<option value="<?php echo $simpanan_semester	; ?>" style="background: lightblue;"><?php echo $simpanan_semester; ?></option>
							<?php $i = 1; foreach($data_semester as $d) { ?>
							<option value="<?php echo $d->id_semester; ?>"><?php echo $d->id_semester; ?></option>
							<?php $i++; } ?>
						</select>

						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button> 
						</div>
					</div>
				</div> 
				
			</form>  
			<br><br>
			<div class="row row-inline-block small-spacing js__isotope_items" style="">
			<?php
				$list_matakuliah = [];
				foreach($mata_kuliah as $d) {
			      array_push($list_matakuliah, $d->nama_mata_kuliah);
    				}
    			$jml_mk = count($list_matakuliah);

				for ($i=1; $i<=$jml_mk; $i++) {
			?>
				<?php //$b = $cpmklang_a[$i-1]; ?>
				<div class="col-md-4 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
					<canvas id="pemenuhan_cpmk<?php echo $i?>" class="chartjs-chart"></canvas>
					<p class="text-center"><?php echo $list_matakuliah[$i-1] ?></p>
				</div>
			<?php
					if ($i%3 == 0) {
			?>
				<div class="col-md-12" style="">
						<p></p>
				</div>
			<?php						
					}
				}

			?>
			</div>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>

<script>
	var temp;
	var title = 'Nilai Rata-rata';

	var arr = <?php echo json_encode($mk_cpmk); ?>;
	var arr_nilai = <?php echo json_encode($nilai_cpmk); ?>;
	var jumlah_mk = <?php echo(count($mk_cpmk)); ?>;


	var warna = ['#6495ED', '#008000', '#FF8C00','#DC143C', '#946b3a', '#7a5931','#614729', '#493620', '#322618','#1d170f','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];

	var datai = [];

	for (var i = 0; i < jumlah_mk; i++){

		datai[i] = { 
		labels: [title],
		datasets: []
		};

		var l = arr[i].length;
		
		for (var j = 0; j < l; j++) {
			datai[i].datasets.push(
				{
				label: arr[i][j],
				backgroundColor: warna[j],
				borderColor: warna[j],
				pointBackgroundColor: warna[j],
				pointBorderColor: "#fff",
				borderWidth: 1,
				data: [arr_nilai[i][j]],
				errorBars: {
					'Nilai Rata-rata': {plus: 15, minus: 10},
						}
					},
				)
		}
	}




	
	for (var i = 1; i <= jumlah_mk; i++) {
		var ctxPemenuhanCPMK = document.getElementById('pemenuhan_cpmk' + i);
		if (ctxPemenuhanCPMK != null) {
			var pemenuhanCPMK = new Chart(ctxPemenuhanCPMK, {
				type: 'bar',
				data: datai[i-1],
				options: {
					responsive: true,
					legend: {
						position: 'top',
						display: false,
					},
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
									labelString: 'CPMK'
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
	}
</script>
