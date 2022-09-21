<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Langsung</h4>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Analisis Kinerja CPL</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="cpl2-tab" data-bs-toggle="tab" data-bs-target="#cpl2" type="button" role="tab" aria-controls="cpl2" aria-selected="false">Evaluasi Kinerja CPL</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="cpmk-tab" data-bs-toggle="tab" data-bs-target="#cpmk" type="button" role="tab" aria-controls="cpmk" aria-selected="false">Evaluasi Kinerja CPMK</button>
				</li>  
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" role="tabpanel" id="cpmk" aria-labelledby="cpmk-tab">
					<form role="form" id="contactform" action="<?php echo site_url('evaluasi_l/evaluasi_kinerja_cpmk')?>" method="post">
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan pilih Tahun Akademik</label>
							<div class="col-sm-3">
								<select id="angkatan" class="form-select">
									<option value="2020">2020/2021</option>
									<option value="2019">2019/2020</option>
									<option value="2018">2018/2019</option>
									<option value="2017">2017/2018</option>
									<option value="2016">2016/2017</option>
									<option value="2016" selected>2015/2016</option>
								</select>
							</div>
							<label class="col-sm-1 col-form-label">s/d</label>
							<div class="col-sm-3">
								<select id="angkatan" class="form-select">
									<option value="2020" selected>2020/2021</option>
									<option value="2019">2019/2020</option>
									<option value="2018">2018/2019</option>
									<option value="2017">2017/2018</option>
									<option value="2016">2016/2017</option>
									<option value="2016">2015/2016</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan Pilih Mata Kuliah</label>
							<div class="col-sm-3">
								<div class="input-group">
								<select id="cpl" class="form-select" name="mk">
									<option value="<?php echo $simpanan_mk; ?>" style="background: lightblue;"><?php echo $simpanan_mk; ?></option>
									<?php $i = 1; foreach($mata_kuliah as $d) { ?>
									<option value="<?php echo $d->kode_mk; ?>"><?php echo $d->nama_kode; ?></option>
									<?php $i++; } ?>
								</select>
								<button type="submit" class="btn btn-primary" name="pilih_4" value="pilih_4">Pilih</button> 
								</div>
							</div>
						</div>	
					</form>
					<div class="box-content">
						<div class="row row-inline-block small-spacing js__isotope_items">
						<?php 
						for ($i = 2017; $i<=2020; $i++) {
						?>
							<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
								<div class="text-right"><strong>Angkatan <?php echo $i ?></strong></div>
								<canvas id="evaluasi_cpmk<?php echo $i ?>" class="chartjs-chart" width="480" height="220"></canvas>
							</div>
						<?php
						}
						?>
						</div>
					</div>

				</div>
			</div>
			

		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<script>
	var options = {
		scale: {
			reverse: !1,
			gridLines: {
			},
			ticks: {
				beginAtZero: !0
			}
		}
	};

	for (var i = 2017; i<=2020; i++) {
		var ctxEvaluasiCPL = document.getElementById('evaluasi_cpl' + i);

		if (ctxEvaluasiCPL != null) {
			var chartCPL = new Chart(ctxEvaluasiCPL, {
				type: 'radar',
				data: radarData(),
				options: options
			});
		}
	}

</script>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>

<script>
	var temp;
	var title = 'Nilai Rata-rata';
	var labels = ['Sangat Baik', 'Baik', 'Cukup'];

	var ctxEvalCPL2 = document.getElementById('evaluasi_cpl2');

	if (ctxEvalCPL2 != null) {
		var options = {
			legend: {
				position: "bottom"
			},
			scales: {
				xAxes: [{
					stacked: true,
					id: "bar-x-axis1",
				},{
					display: false,
					stacked: true,
					id: "bar-x-axis2",
					// these are needed because the bar controller defaults set only the first x axis properties
					type: 'category',
					gridLines: {
						offsetGridLines: true
					},
					offset: true
				}],
				yAxes: [{
				stacked: false,
	                    stacked: false,
                    ticks: {
                        beginAtZero: true
                    }
				}]

			},
			responsive: true,
			maintainAspectRatio: false,
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
						//label += '%';
						return label;
					}
				},
				intersect : false,
				mode:'index'
			}
		};
		
		var data = {
			labels: ["Cukup", "Baik", "Sangat Baik", "Rata-rata"],
			datasets: [
			{
				label: "Capaian",
				backgroundColor: "rgba(48,79,254,1)",
				borderColor: "rgba(48,79,254,1)",
				data: [40, 44, 60, 66],
				barThickness: 30,
				xAxisID: "bar-x-axis1",
			},
			{
				label: "Target",
				backgroundColor: "rgba(246,14,14,1)",
				borderColor: "rgba(246,14,14,1)",
				data: [40, 45, 65, 67],
				barThickness: 30,
				xAxisID: "bar-x-axis2",
			}]
		};

		var evalCPL2 = new Chart(ctxEvalCPL2, {
			type: 'bar',
			data: data,
			options: options
		});

		$('#evaluasi_cpl2').height(320);
	}

	var barChartData = {
		labels: labels,
		datasets: [{
			label: 'CPMK A',
			backgroundColor: "rgba(58,201,214,1)",
			borderColor: "rgba(58,201,214,1)",
			pointBackgroundColor: "rgba(58,201,214,1)",
			pointBorderColor: "#fff",
			borderWidth: 1,
			data: [o(75), o(70), o(60)],
			errorBars: {
				'Sangat Baik': {plus: 15, minus: 10},
				'Baik': {plus: 15, minus: 10},
				'Cukup': {plus: 15, minus: 10}
			}
		}, {
			label: 'CPMK B',
			backgroundColor: "rgba(24,138,226,1)",
			borderColor: "rgba(24,138,226,1)",
			pointBackgroundColor: "rgba(24,138,226,1)",
			pointBorderColor: "#fff",
			borderWidth: 1,
			data: [o(75), o(70), o(60)],
			errorBars: {
				'Sangat Baik': {plus: 15, minus: 10},
				'Baik': {plus: 15, minus: 10},
				'Cukup': {plus: 15, minus: 10}
			}
		}, {
			label: 'CPMK C',
			backgroundColor: "rgba(63,81,181,1)",
			borderColor: "rgba(63,81,181,1)",
			pointBackgroundColor: "rgba(63,81,181,1)",
			pointBorderColor: "#fff",
			borderWidth: 1,
			data: [o(75), o(70), o(60)],
			errorBars: {
				'Sangat Baik': {plus: 15, minus: 10},
				'Baik': {plus: 15, minus: 10},
				'Cukup': {plus: 15, minus: 10}
			}
		}]

	};

	for (var i = 2017; i<=2020; i++) {
		var ctxEvaluasiCPMK = document.getElementById('evaluasi_cpmk' + i);

		if (ctxEvaluasiCPMK != null) {
			var options = {
				responsive: true,
				legend: {
					position: "bottom"
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
					xAxes: [],
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
							temp = errorBars;
							if (label) {
								label += ': ';
							}

							var value = Math.round(tooltipItem.yLabel * 100) / 100;
							label += value;
							var stdMin = value - errorBars[labels[tooltipItem.datasetIndex]].minus;
							var stdMax = value + errorBars[labels[tooltipItem.datasetIndex]].plus;								
							label += ' (' + stdMin + '..' + stdMax + ')'
							return label;
						}
					}
				}
			};
			var chartCPMK = new Chart(ctxEvaluasiCPMK, {
				type: 'bar',
				data: barChartData,
				options: options
			});
		}
	}
</script>