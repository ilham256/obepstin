<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">CPL</h4>
			<p>

			<a class="btn btn-outline-primary" href="<?php echo site_url('cpmk_cpl/tambah_cpl') ?>" > + CPL</a>
			 
			</p>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				 

				<?php $i = 1; foreach($data_cpl as $r) { ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'active';}  ?>" id="<?php echo $r->id_cpl_langsung	;?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $r->id_cpl_langsung	;?>" type="button" role="tab" aria-controls="<?php echo $r->id_cpl_langsung	;?>" aria-selected="false"><?php echo $r->nama	;?></button>
				</li>
				<?php $i++; } ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="cpmk-tab" data-bs-toggle="tab" data-bs-target="#cpmk" type="button" role="tab" aria-controls="cpmk" aria-selected="false">CPMK</button>
				</li>
				
			</ul>
			<div class="tab-content" id="myTabContent">

				<?php $i = 1; foreach($data_cpl as $r) { ?>
					<div class="tab-pane fade <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'show active';}  ?>" role="tabpanel" id="<?php echo $r->id_cpl_langsung;?>" aria-labelledby="<?php echo $r->id_cpl_langsung;?>-tab">
						<h4 class="box-title"><a  class="btn btn-info waves-effect waves-light" href="<?php echo site_url('cpmk_cpl/edit_cpl/'.$r->id_cpl_langsung); ?>"><?php echo $r->nama	;?></a> 

						 | <a onclick="return confirm('Apakah anda ingin mengubah CPL ?')" href="<?php echo site_url('cpmk_cpl/edit_cpl/'.$r->id_cpl_langsung); ?>"><i class="fa fa-edit" title="Edit CPL"></i></a> |
				                        <a onclick="return confirm('Apakah anda ingin menghapus CPL ?')" href="<?php echo site_url('cpmk_cpl/hapus_cpl/'.$r->id_cpl_langsung); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>


						</h4> 
						<p>
						<?php echo $r->deskripsi	;?>
						</p>
						<table id="example-edit" class="display" style="width: 100%">
							<thead>
								<tr>
									<th style="width: 200px;">Deskriptor</th>
									<th style="width: 800px;">Deskripsi Deskriptor</th>
									<th style="width: 300px; text-align: center;">Bobot</th>
									<th style="width: 400px;"></th> 
								</tr>
							</thead>
							<tfoot> 
								<tr>
									<th>Total</th>
									<th></th>
									<th style=" text-align: center; font-weight: normal;">
									<b>
									<?php 
									$jumlah = 0;
									$i = 1; foreach($rumus_deskriptor as $p) { 
									if ($r->id_cpl_langsung == $p->id_cpl_langsung) { 
										$jumlah += floatval($p->persentasi);
									 }
									 $i++; }
									 //echo '<pre>';  var_dump($p->persentasi); echo '</pre>';
									 echo "<hr>".$jumlah; ?>
									</b>
									<p style="color: red; font-size: 20px;">
									 <?php
									 if ($jumlah != 1) {
											//echo "<br>"." Jumlah bobot"."<br>"."tidak sama dengan 1";
									 }
									  ?>
									 </p>
									</th>
									<th> 
										<?php 
										
									  ?> 
									</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 1; foreach($rumus_deskriptor as $p) { ?>
								<?php if ($r->id_cpl_langsung == $p->id_cpl_langsung) { ?>
								<tr> 
									<td><br><?php echo $p->nama_deskriptor; ?></td>
									<td><br><?php echo $p->deskripsi; ?></td>
									<td style=" text-align: center;"><br><?php echo ' '.$p->persentasi; ?></td>
									<td><br><a href="<?php  echo site_url('formula/edit_rumus_deskriptor/'.$p->id_cpl_rumus_deskriptor); ?>"><i class="fa fa-edit" title="Edit Formula Bobot"></i></a> |
			                        <a onclick="return confirm('Apakah anda ingin menghapus Formula Bobot ?')" href="<?php echo site_url('formula/hapus_rumus_deskriptor/'.$p->id_cpl_rumus_deskriptor); ?>"><i class="fa fa-trash" title="Hapus Rumus Bobot"></i></a>
			                        </td>
								</tr>
								<?php } ?>
								<?php $i++; } ?>				 
							</tbody>
						</table>	
						<br>
						<div class="col-lg-12 col-xs-12">
							<div class="text-right"> 

								<a class="btn btn-block btn" href="<?php echo site_url('cpmk_cpl/tambah_deskriptor/'.$r->id_cpl_langsung); ?>" > + Deskriptor</a>
							</div>
						</div> 
					</div>
				<?php $i++; } ?>

			<div class="tab-pane fade" role="tabpanel" id="cpmk" aria-labelledby="cpmk-tab">
					<h4 class="box-title">CPMK</h4>
					<p>

					<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('cpmk_cpl/tambah_cpmk') ?>" > + CPMK</a>
					
					</p>

					<table id="example-edit" class="display" style="width: 100%">
						<thead>
							<tr style="color: green">
								<th>No</th>
								<th>CPMK</th> 
								<th>Deskripsi</th> 
								<th></th> 
							</tr>  
						</thead> 
						<tbody> 
		                        <?php $i = 1; foreach($data_cpmk as $r) { ?>
		                    <tr style="color: green">
		                        <td scope="row"><?php echo $i; ?></td>
		                        <td><span class="label label-success"><?php echo $r->nama; ?></span></td>
		                        <td><?php echo $r->deskripsi	; ?></td>

		                        <td><a href="<?php echo site_url('cpmk_cpl/edit_cpmk/'.$r->id_cpmk_langsung); ?>"><i class="fa fa-edit" title="Edit Data produk"></i></a> |
		                        <a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('cpmk_cpl/hapus_cpmk/'.$r->id_cpmk_langsung); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
		                        </td>
		                    </tr>
		                    <?php $i++; } ?>

						</tbody> 
					</table>
					
				</div>
				
			</div>
		</div>

	</div> 
</div>


 