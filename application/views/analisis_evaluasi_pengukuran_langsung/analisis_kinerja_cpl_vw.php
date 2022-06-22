<div class="row small-spacing"> 
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Langsung</h4>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Analisis Kinerja CPL</button>
				</li> 
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('evaluasi_l/evaluasi_kinerja_cpl')?>" ><button class="nav-link">Evaluasi Kinerja CPL</button></a>
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

						for ($i=0; $i<$jml_mk; $i++) {
						?>
							<div class="col-md-6 col-sm-6 col-tb-6 col-xs-12 js__isotope_item beauty" style="">
								<div class="text-right"><strong>Angkatan <?php echo $list_angkatan[$i]; ?></strong></div>
								<canvas id="evaluasi_cpl_pertama<?php echo $i ?>" class="chartjs-chart" width="480" height="220"></canvas>
								<br>
							</div>

						<?php
						}
						//echo '<pre>';  var_dump($list_angkatan); echo '</pre>';
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

<script src="<?php echo base_url() ?>assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>

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


	var arr = <?php echo json_encode($nilai_cpl); ?>;
	var arr_max = <?php echo json_encode($nilai_std_max); ?>;
	var arr_min = <?php echo json_encode($nilai_std_min); ?>;
	var target = <?php echo json_encode($target); ?>;

	console.log(arr);



	var data_target_cpl = <?php echo $katkin[0]->nilai_target_pencapaian_cpl; ?>;
	var datai = [];
	var a = arr.length
	for (var i = 0; i < a; i++) {
		datai[i] = {
				labels: ["CPL 1", "CPL 2", "CPL 3", "CPL 4", "CPL 5", "CPL 6", "CPL 7", "CPL 8"],
				datasets: [{
					label: "Rata-rata",
					backgroundColor: "rgba(24,138,226,0)",
					borderColor: "rgba(24,138,226,0.7)",
					pointBackgroundColor: "rgba(24,138,226,0.01)",
					pointStyle: 'line',
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(24,138,226,0.01)",
					data: arr[i],
				}, {
					label: "Target",
					backgroundColor: "rgba(204,15,15,0)",
					borderColor: "rgba(204,15,15,0.7)",
					pointBackgroundColor: "rgba(204,15,15,0.01)",
					pointStyle: 'line',
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(204,15,15,0.01)",
					data: target[i],
				}, {
					label: "Standar deviasi Bawah",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					pointBackgroundColor: "rgba(106,90,205,1)",
					borderColor: "rgba(28,138,226,0.2)",
					data: arr_min[i],

				}, {
					label: "Standar deviasi Atas",
					backgroundColor: "rgba(24,138,226,0)",
					pointStyle: 'line',
					pointBackgroundColor: "rgba(106,90,205,1)",
					borderColor: "rgba(50,80,220,0.2)",
					data: arr_max[i],
				}]
			}

	}
	 


 
		var e = {},
        radarData = function() {
			var data = {
				labels: ["CPL 1", "CPL 2", "CPL 3", "CPL 4", "CPL 5", "CPL 6", "CPL 7", "CPL 8"],
				datasets: [{
					label: "Rata-rata",
					backgroundColor: "rgba(24,138,226,0)",
					borderColor: "rgba(24,138,226,0.2)",
					pointBackgroundColor: "rgba(24,138,226,0.01)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(24,138,226,0.01)",
					data: [70, 60, 75, 70, 72, 80, 68, 40],
				}, {
					label: "Target",
					backgroundColor: "rgba(204,15,15,0)",
					borderColor: "rgba(0,15,15,0.2)",
					pointBackgroundColor: "rgba(204,15,15,0.01)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgba(204,15,15,0.01)",
					data: [o(80), o(80), o(80), o(80), o(80), o(80), o(80), o(10)]
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
						max : 100,
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