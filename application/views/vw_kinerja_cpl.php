<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Progress Capaian Pembelajaran Lulusan (CPL) - Tahun <?php echo $tahun; ?></h4>
			<form role="form" id="contactform" action="<?php echo site_url('Kincpl')?>" method="post">
				<div class="row mb-3">
					<label for="angkatan" class="col-sm-3 col-form-label">Masukkan Tahun Angkatan</label>
					<div class="col-sm-3"> 
						<input type="text" name="tahun" class="form-control" placeholder="- Tahun Angkatan -" required>
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
						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button> 
						</div>
					</div>
				</div>
			</form>
			<hr>
				<div> 
					<p >Data Kinerja  <?php echo $simpanan_cpl; ?> </p>
					<p>Tahun Angkatan (<?php echo $tahun; ?>)</p>
				</div>	
			<div class="col-md-12 col-sm-12" style="">
				<canvas id="pemenuhan_cpl_tahun" class="chartjs-chart" width="480" height="320"></canvas>
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


		console.log(cap);

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
				borderColor: "rgba(246,14,14,0.3)",
				data: nt,
				barThickness: 30,

			},
			{
				label: "Nilai Tertinggi yang dapat dicapai",
				backgroundColor: "rgba(48,79,254,0.5)",
				borderColor: "rgba(48,79,254,0.3)",
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