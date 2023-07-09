<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Laporan</h4> 
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo $naf_3; ?>" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Kinerja CPL Mahasiswa</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo $naf; ?>" id="cpmk-tab" data-bs-toggle="tab" data-bs-target="#cpmk" type="button" role="tab" aria-controls="cpmk" aria-selected="false">Kinerja CPMK Mahasiswa</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo $naf_2; ?>" id="rapormsh-tab" data-bs-toggle="tab" data-bs-target="#rapormsh" type="button" role="tab" aria-controls="rapormsh" aria-selected="false">Rapor Mahasiswa</button>
				</li>
			</ul> 
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade <?php echo $status_aktif_3; ?>" role="tabpanel" id="cpl" aria-labelledby="cpl-tab">
					
						
							<form role="form" id="contactform" action="<?php echo site_url('report_mahasiswa')?>" method="post">
							<div class="row mb-3">
								<label for="cpl" class="col-sm-3 control-label">Silahkan Pilih CPL</label>
								<div class="col-sm-3">
									<div class="input-group">
									<select id="cpl" class="form-select" name="cpl">
										<option value="<?php echo $simpanan_cpl; ?>" style="background: lightblue;"><?php echo $simpanan_cpl; ?></option>
										<?php $i = 1; foreach($cpl as $d) { ?>
										<option value="<?php echo $d->id_cpl_langsung; ?>"><?php echo $d->nama; ?></option>
										<?php $i++; } ?>
									</select>
									<button type="submit" class="btn btn-primary" name="pilih_3" value="pilih_3">Pilih</button> 
									</div>
								</div>
							</div> 
							</form>					

						<div class="row">
							<div class="col-lg-9 col-xs-12">
								<canvas id="pemenuhan_cpl_tahun" class="chartjs-chart" width="480" height="320"></canvas>
							</div>
						</div> 
						<div class="float-end margin-top-30">
							<button type="button" class="btn btn-default waves-effect waves-light"><i class='fa fa-download'></i> Download</button>
						</div> 
					
				</div>
				<div class="tab-pane fade <?php echo $status_aktif; ?>" role="tabpanel" id="cpmk" aria-labelledby="cpmk-tab">
					

						<p> <?php echo $ns ;?></p>
						
						<div class="row row-inline-block small-spacing js__isotope_items" style="">
							<?php
								$list_matakuliah = [];
									foreach($mata_kuliah as $d) {
								      array_push($list_matakuliah, $d->nama_mata_kuliah);
					    				}
					    			$jml_mk = count($list_matakuliah);

								for ($i=1; $i<=$jml_mk; $i++) {
							?>
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
						<form>
						<div class="float-end margin-top-30">
							<button type="button" class="btn btn-default waves-effect waves-light"><i class='fa fa-download'></i> Download</button>
						</div>
					</form>
				</div>
				<div class="tab-pane fade <?php echo $status_aktif_2; ?>" role="tabpanel" id="rapormsh" aria-labelledby="rapormsh-tab">
					<div class="row small-spacing">
						<div class="col-xs-12">
							<div class="invoice-box" style="font-style: 'calibri'; ">
								<a href="<?php echo base_url('assets/images/logo_raport_ipb.JPG')?>" class="lightview" data-lightview-group="group">
										<img src="<?php echo base_url('assets/images/logo_raport_ipb.JPG')?>" alt="">
								</a>
								<div class="row">
									<div class="col-md-12 col-xs-12" style="color: darkblue; font-size: 24px;">
										<p><strong>INSTITUT PERTANIAN BOGOR<br>
										DEPARTEMEN TEKNOLOGI INDUSTRI PERTANIAN<br>
										P.S. TEKNIK INDUSTRI PERTANIAN
										<br><br>
										</strong>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: darkblue;'>
										Nama Lengkap
									</div>
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: darkblue;'>
										Tempat, Tanggal Lahir
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: grey;'>
										<?php echo $nama_rapor_mahasiswa; ?>
									</div>
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: grey;'>
										-
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: darkblue;'>
										Nomor Induk Mahasiswa
									</div>
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: darkblue;'>
										Tahun Masuk
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: grey;'>
										<?php echo $nim_rapor_mahasiswa; ?>
									</div>
									<div class="col-md-6 col-xs-12" style='font-weight: bold; color: grey;'>
										-
									</div>
								</div>
								<br>
								<table class="table"> 
									<thead style="background-color: darkblue; color: white; vertical-align: middle; ">
										<tr>
											<th style='font-weight: normal;'>Capaian Pembelajaran Lulusan</th>
											<th style='font-weight: normal;'>Deskripsi</th> 
											<th style='font-weight: normal; width : 100px; text-align: center;'>Nilai</th> 
											<th style='font-weight: normal;'>Pencapaian</th> 
										</tr> 
									</thead>  
									<tbody > 

										<?php for ($i=0; $i < count($data_cpl); $i++) { ?>
										<tr> 
											<th scope="row"><?php  echo substr($data_cpl[$i]->nama,-1); ?></th> 
											<td style="text-align: justify; "><p><?php  echo ($data_cpl[$i]->deskripsi); ?></p></td> 
											<td style="text-align: center; "><?php echo round($nilai_cpl_mahasiswa[$i]); ?></td> 
											<td><?php echo $status_nilai_cpl_mahasiswa[$i]; ?></td> 
										</tr> 
										<?php } ?>
									</tbody>  
								</table>
								<div class="float-end margin-top-50">

									<form role="form" id="contactform" action="<?php echo site_url('Report_mahasiswa/download_report_mahasiswa')?>" method="post" target="_blank">

										<input type="hidden" name="nim_2" value="<?php echo $nim_rapor_mahasiswa; ?>">

										<button onclick="return confirm('Apakah anda ingin mencetak report ?')" type="submit" class="btn btn-default waves-effect waves-light" name="download" value="download"><i class='fa fa-download'></i> Download</button>

									</form>

									
								</div>
							</div>
							<!-- /.invoice-box -->
							<p><?php  //echo '<pre>';  var_dump($data_cpl); echo '</pre>';?></p>
						</div>
						<!-- /.col-xs-12 -->
					</div>
					<!-- /.row small-spacing -->			
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
		var e = {},
        o = function(min) {
            return Math.round(15 * Math.random()) + min
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
    </script>



<script>

	/*Chart.plugin.register({
      afterDatasetsUpdate: function(chart) {
        Chart.helpers.each(chart.getDatasetMeta(0).data, function(rectangle, index) {
          rectangle._view.width = rectangle._model.width = 30;
        });
      },
    })*/

	var ctxCPLTahun = document.getElementById('pemenuhan_cpl_tahun');

	if (ctxCPLTahun != null) {
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
				},{
					display: false,
					stacked: true,
					id: "bar-x-axis3",
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

		var sms = <?php echo json_encode($nama_semester); ?>;
		var cap = <?php echo json_encode($capaian); ?>;
		var ntt = <?php echo json_encode($nilai_tertinggi); ?>;
		var nt = <?php echo json_encode($target); ?>;
		
		var data = {
			labels: sms,
			datasets: [
			{
				label: "Capaian",
				backgroundColor: "rgba(48,79,254,1)",
				borderColor: "rgba(48,79,254,1)",
				data: cap,
				barThickness: 30,
				xAxisID: "bar-x-axis1",
			}, 
			{
				label: "Target",
				backgroundColor: "rgba(246,14,14,1)",
				borderColor: "rgba(246,14,14,1)",
				data: nt,
				barThickness: 30,
				xAxisID: "bar-x-axis2",
			},
			{
				label: "Batas Maksimum",
				backgroundColor: "rgba(48,79,254,0.5)",
				borderColor: "rgba(48,79,254,1)",
				data: ntt,
				barThickness: 70,
				xAxisID: "bar-x-axis3",
			}]
		};

		var cplTahun = new Chart(ctxCPLTahun, {
			type: 'bar',
			data: data,
			options: options
		});
	}
</script>


<script>
	var temp;
	var title = 'Nilai'
	var jumlah_mk = <?php echo(count($mk_cpmk)); ?>;

	var labels = ['Raport_Mata_Kuliah'];

	var warna = ['#008000', '#6495ED', '#FF8C00','#DC143C', '#00FFFF', '#00008B','#008B8B', '#4cc9f0', '#f72585','#b5179e','#7209b7', '#560bad', '#480ca8','#3a0ca3', '#3f37c9', '#4361ee','#4895ef', '#4cc9f0'];

	var arr = <?php echo json_encode($mk_cpmk); ?>;
	var arr_nilai = <?php echo json_encode($nilai_cpmk); ?>;

	var ab = arr.length
	console.log(arr);

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
					'Nilai': {plus: 15, minus: 10},
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

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>