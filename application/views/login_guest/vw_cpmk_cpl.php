<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">CPL</h4>
			<p>

			
			 
			</p>
			
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				 

				<?php $i = 1; foreach($data_cpl as $r) { ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'active';}  ?>" id="<?php echo $r->id_cpl_langsung	;?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $r->id_cpl_langsung	;?>" type="button" role="tab" aria-controls="<?php echo $r->id_cpl_langsung	;?>" aria-selected="false"><?php echo $r->nama	;?></button>
				</li>
				<?php $i++; } ?>
				
			</ul>
			<div class="tab-content" id="myTabContent">

				<?php $i = 1; foreach($data_cpl as $r) { ?>
					<div class="tab-pane fade <?php if ($r->id_cpl_langsung == 'CPL_1'){echo 'show active';}  ?>" role="tabpanel" id="<?php echo $r->id_cpl_langsung;?>" aria-labelledby="<?php echo $r->id_cpl_langsung;?>-tab">
						<h4 class="box-title"><?php echo $r->nama	;?>
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
									
			                        </td>
								</tr>
								<?php } ?>
								<?php $i++; } ?>				 
							</tbody>
						</table>	
						<br>
						<div class="col-lg-12 col-xs-12">
							
						</div> 
					</div>
				<?php $i++; } ?>


				
			</div>
		</div>

	</div> 
</div>


 