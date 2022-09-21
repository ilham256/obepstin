<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Laporan</h4> 

			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest')?>" ><button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Kinerja CPL Mahasiswa</button></a>
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
					<a href="<?php echo site_url('report_guest/relevansi_ppm')?>" ><button class="nav-link">Relevansi PPM</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/efektivitas_cpl')?>" ><button class="nav-link">Efektivitas CPL</button></a>
				</li>
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('report_guest/report_epbm')?>" ><button class="nav-link">Rekap EPBM</button></a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
					
							<form role="form" id="contactform" action="<?php echo site_url('report_guest')?>" method="post">
							<div class="row mb-3">
								<label for="mata_kuliah" class="col-sm-3 col-form-label">Silahkan Masukkan NIM</label>
								<div class="col-sm-3">
									<input type="text" name="nim_3" class="form-control" placeholder="NIM" required>					
								</div>
							</div>
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
							<hr>
							<div> 
								<p >Data Kinerja  <?php echo $simpanan_cpl; ?> </p>
								<p><?php echo $nama_mahasiswa[0]->nama; ?> (<?php echo $nim_3; ?>)</p>
							</div>		 	 				
						

						<div class="row">
							<div class="col-lg-12 col-xs-12">
								<canvas id="pemenuhan_cpl_tahun" class="chartjs-chart" width="480" height="320"></canvas>
							</div>
						</div> 
						<div class="float-end margin-top-30">
							<button type="button" class="btn btn-default waves-effect waves-light"><i class='fa fa-download'></i> Download</button>
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
				yAxes: [{
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
				
			}, 
			{
				label: "Target",
				backgroundColor: "rgba(246,14,14,1)",
				borderColor: "rgba(246,14,14,1)",
				data: nt,
				barThickness: 30,
				
			},
			{
				label: "Batas Maksimum",
				backgroundColor: "rgba(48,79,254,0.5)",
				borderColor: "rgba(48,79,254,1)",
				data: ntt, 
				barThickness: 30,
				
			}]
		};

		var cplTahun = new Chart(ctxCPLTahun, {
			type: 'bar',
			data: data,
			options: options
		});
	}
</script>
 



<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>