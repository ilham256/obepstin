<div class="row small-spacing"> 
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Analisis & Evaluasi Pengukuran Langsung / Evaluasi Ketercapaian CPL</h4>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="cpl-tab" data-bs-toggle="tab" data-bs-target="#cpl" type="button" role="tab" aria-controls="cpl" aria-selected="true">Analisis Kinerja CPL</button>
				</li> 
				<li class="nav-item" role="presentation">
					<a href="<?php echo site_url('evaluasi_l/evaluasi_kinerja_cpl')?>" ><button class="nav-link">Analisis Status Pencapaian CPL</button></a>
				</li> 
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" role="tabpanel" id="cpl" aria-labelledby="cpl-tab">

					<div class="box-content">		 
						<h5 class="box-title">Evaluasi Ketercapaian CPL</h5>
					

						<?php 

						//$data_tahun = array_map('intval', explode(',', str_replace(array('[', ']'),'', $tahun)));
						//echo '<pre>';  var_dump($tahun); echo '</pre>'; ?>

						<?php $i=0; foreach($tahun as $key) { ?>
						<table class="table table-striped table-bordered display" style="width:100%">
							<p><?php echo "Evaluasi Ketercapaian CPL Tahun ".$key ?></p>

							<thead>
								<tr>
									<th></th>
									<th>Nilai CPL</th>
									<th>Target</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
						
							<tbody> 
								<?php $j=0; foreach($data_cpl as $key2) { ?>
								<tr>
									<td><?php echo $key2->nama ?></td>
									<td><?php echo $nilai_cpl[$i][$j] ?></td>
									<td><?php echo $target_cpl[0]->nilai_target_pencapaian_cpl ?></td>
									<td><?php if ($nilai_cpl[$i][$j]>$target_cpl[0]->nilai_target_pencapaian_cpl) {
										echo "Lebih dari target"; 
									} 
									else { echo "Kurang dari target"; }  ?></td>
									<td><?php if ($nilai_cpl[$i][$j]>$target_cpl[0]->nilai_target_pencapaian_cpl) { ?>
										<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('katkin') ?>" > Sesuaikan Target </a> 
									<?php } else { ?> 
										<a class="btn btn-warning waves-effect waves-light" href="<?php echo site_url('evaluasi_l/identifikasi/'.$key) ?>" > Identifikasi CPMK </a>
									<?php } ?></td>

								</tr>
								<?php $j++;}; ?>
							</tbody>
						
						</table>
						<br>
						<br>
						<?php $i++; }; ?>

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

</script>
<?php  //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';?>