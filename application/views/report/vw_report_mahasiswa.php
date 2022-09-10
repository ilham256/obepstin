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
					<a href="<?php echo site_url('report/mahasiswa')?>" ><button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Rapor Mahasiswa</button></a>
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
					<a href="<?php echo site_url('report/report_epbm')?>" ><button class="nav-link">Rekap EPBM</button></a>
				</li> 
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="row mb-3">
							<form role="form" id="contactform" action="<?php echo site_url('report/mahasiswa')?>" method="post">
							<div class="input-group">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan Masukkan NIM</label>
								<div class="col-sm-3">
									<input type="text" name="nim_2" class="form-control" placeholder="NIM" required>					
								</div>
								<button type="submit" class="btn btn-primary" name="pilih_2" value="pilih_2">Pilih</button>
							</div> 
							</form>
							<div>

							</div>
							
					</div>
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

									<form role="form" id="contactform" action="<?php echo site_url('report/download_report_mahasiswa')?>" method="post" target="_blank">

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