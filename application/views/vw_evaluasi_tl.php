<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Tidak Langsung</h4>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Analisis Kinerja CPL Tidak Langsung</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="cpl2-tab" data-bs-toggle="tab" data-bs-target="#cpl2" type="button" role="tab" aria-controls="cpl2" aria-selected="false">Evaluasi Kinerja CPL Tidak Langsung</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" role="tabpanel" id="cpl" aria-labelledby="cpl-tab">
					<form role="form" id="contactform" action="<?php echo site_url('evaluasi_tl')?>" method="post">
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
					      array_push($list_angkatan, $d->tahun_masuk);
		    				}

		    			$jml_mk = count($list_angkatan);

						for ($i=0; $i<$jml_mk; $i++) {
						?>
							<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
								<div class="text-right"><strong>Angkatan <?php echo $list_angkatan[$i]; ?></strong></div>
								<canvas id="evaluasi_cpl_pertama<?php echo $i ?>" class="chartjs-chart" width="480" height="220"></canvas>
							</div>
						<?php
						}
						//echo '<pre>';  var_dump($list_angkatan); echo '</pre>';
						?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" role="tabpanel" id="cpl2" aria-labelledby="cpl2-tab">
					<form class="">
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan pilih Tahun Akademik</label>
							<div class="col-sm-3">
								<select id="angkatan" class="form-select">
									<option value="2020">2020/2021</option>
									<option value="2019">2019/2020</option>
									<option value="2018">2018/2019</option>
									<option value="2017">2017/2018</option>
									<option value="2016">2016/2017</option>
									<option value="2016">2015/2016</option>
								</select>
							</div>
						</div> 
						<div class="row mb-3">
							<label for="angkatan" class="col-sm-3 col-form-label">Silahkan Pilih CPL</label>
							<div class="col-sm-3">
								<select id="cpl" class="form-select">
									<option value="2020">1</option>
									<option value="2019">2</option>
									<option value="2018">3</option>
									<option value="2017">4</option>
									<option value="2016">5</option>
									<option value="2016">6</option>
									<option value="2016">7</option>
								</select>
							</div>
						</div>
					</form>
					<div class="box-content">		
						<div class="col-md-9 col-sm-12" style="">
							<canvas id="evaluasi_cpl2" class="chartjs-chart" width="480" height="220"></canvas>
						</div>
					</div>
				</div>
			</div>
			

		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
<?php //echo '<pre>';  var_dump($cpl_1); echo '</pre>'; ?> 
<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
	<script>
		var e = {},
        o = function(min) {
            return Math.round(1 * Math.random()) + min
        };

		var e = {},
        barData = function(mk) {
			var data = {
				labels: ["MK " + mk],
				datasets: [{
					label: "CPMK A",
					backgroundColor: "rgba(58,201,214,1)",
					borderColor: "rgba(58,201,214,1)",
					pointBackgroundColor: "rgba(58,201,214,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(58,201,214,1)",
					data: [o(60), o(60), o(60), o(60), o(60), o(60), o(60), o(60)]
				}, {
					label: "CPMK B",
					backgroundColor: "rgba(24,138,226,1)",
					borderColor: "rgba(24,138,226,1)",
					pointBackgroundColor: "rgba(24,138,226,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(24,138,226,1)",
					data: [o(70), o(70), o(70), o(70), o(70), o(70), o(70), o(70)]
				}, {
					label: "CPMK C",
					backgroundColor: "rgba(63,81,181,1)",
					borderColor: "rgba(63,81,181,1)",
					pointBackgroundColor: "rgba(63,81,181,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(63,81,181,1)",
					data: [o(80), o(80), o(80), o(80), o(80), o(80), o(80), o(80)]
				}]
			};

            return data;
        };


	var data_cpl_1 = [<?php echo '"'.implode('","', $cpl_1).'"' ?>];
	var data_cpl_2 = [<?php echo '"'.implode('","', $cpl_2).'"' ?>];
	var data_cpl_3 = [<?php echo '"'.implode('","', $cpl_3).'"' ?>];
	var data_cpl_4 = [<?php echo '"'.implode('","', $cpl_4).'"' ?>];
	var data_cpl_5 = [<?php echo '"'.implode('","', $cpl_5).'"' ?>];
	var data_cpl_6 = [<?php echo '"'.implode('","', $cpl_6).'"' ?>];
	var data_cpl_7 = [<?php echo '"'.implode('","', $cpl_7).'"' ?>];
	var data_cpl_8 = [<?php echo '"'.implode('","', $cpl_8).'"' ?>];

	var data_target_cpl = <?php echo $katkin[0]->nilai_target_pencapaian_cpl; ?>;
	var datai = [];
	var a = data_cpl_1.length
	for (var i = 0; i < a; i++) {
		datai[i] = {
				labels: ["CPL 1", "CPL 2", "CPL 3", "CPL 4", "CPL 5", "CPL 6", "CPL 7", "CPL 8"],
				datasets: [{
					label: "Rata-rata",
					backgroundColor: "rgba(24,138,226,0)",
					borderColor: "rgba(24,138,226,0.6)",
					pointBackgroundColor: "rgba(24,138,226,0.01)",
					pointStyle: 'line',
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(24,138,226,0.01)",
					data: [o(7), o(8), o(7), o(8), o(8), o(8), o(8), o(6)],
				}]
			}

	}
	


 
		var e = {},
        radarData = function() {
			var data = {
				labels: ["CPL 1", "CPL 2", "CPL 3", "CPL 4", "CPL 5", "CPL 6", "CPL 7", "CPL 8"],
				datasets: [{
					label: "Target",
					backgroundColor: "rgba(204,15,15,0)",
					borderColor: "rgba(204,15,15,0.6)",
					pointBackgroundColor: "rgba(204,15,15,0.01)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(204,15,15,0.01)",
					data: [o(7), o(8), o(7), o(8), o(8), o(8), o(8), o(6)]
				}]
			};

            return data;
        };

	var options = {
		legend: {
			position: "right",
			labels: {  
				usePointStyle: true,			        
			      	}
			}, 
		scale: {
			reverse: !1,
			gridLines: {
			},
			ticks: {
				beginAtZero: !0
			}
		}
	};

	for (var i = 0; i<=10; i++) {
		var ctxEvaluasiCPL = document.getElementById('evaluasi_cpl_pertama' + i);

		if (ctxEvaluasiCPL != null) {
			var chartCPL = new Chart(ctxEvaluasiCPL, {
				type: 'radar',
				data: datai[i],
				options: options
			});
		}
	}

</script>

<!-- chart.js Chart -->
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/node_modules/chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/chart/node_modules/chartjs-plugin-error-bars/build/Plugin.Errorbars.js"></script>

	<script>


		var ctxEvaluasiCPL = document.getElementById('evaluasi_cpl_pertama');

		if (ctxEvaluasiCPL != null) {
			var data = {
				labels: ["2017", "2016", "2015", "2014"],
				datasets: [{
					label: "Sangat Baik",
					backgroundColor: "rgba(58,201,214,1)",
					borderColor: "rgba(58,201,214,1)",
					pointBackgroundColor: "rgba(58,201,214,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(58,201,214,1)",
					data: [o(40), o(60), o(80), o(60)]
				}, {
					label: "Baik",
					backgroundColor: "rgba(24,138,226,1)",
					borderColor: "rgba(24,138,226,1)",
					pointBackgroundColor: "rgba(24,138,226,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(24,138,226,1)",
					data: [o(70), o(40), o(60), o(70)]
				}, {
					label: "Cukup",
					backgroundColor: "rgba(63,81,181,1)",
					borderColor: "rgba(63,81,181,1)",
					pointBackgroundColor: "rgba(63,81,181,1)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(63,81,181,1)",
					data: [o(40), o(50), o(70), o(50)]
				}]
			};

			var options = {
				legend: {
					position: "bottom"
				},
				scale: {
					reverse: !1,
					gridLines: {
						color: ["black", "red", "orange", "yellow", "green", "blue", "indigo", "violet"]
					},
					ticks: {
						beginAtZero: !0
					}
				}
			};
			var chart = new Chart(ctxEvaluasiCPL, {
				type: 'bar',
				data: data,
				options: options
			});
		}
			
		function saveDeskriptor() {
			$("#formDeskriptor").submit();
		}

	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	    });
	  });
	</script>
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