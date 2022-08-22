		
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
							</div>
							<!-- /.invoice-box -->
							<p><?php  //echo '<pre>';  var_dump($data_cpl); echo '</pre>';?></p>
						</div>
						<!-- /.col-xs-12 -->
					</div>
					<!-- /.row small-spacing -->
				



<!-- chart.js Chart -->

<?php  //echo '<pre>';  var_dump($mk_cpmk[0]); echo '</pre>';?>