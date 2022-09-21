<div class="row long-spacing">
	<div class="col-lg-100 col-xs-100">		 
		<div class="col-lg-100 box-content">
			<h4 class="box-title"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Kurikulum</h4>

			<?php
				foreach($semesters as $semester) { 
			?>
			<div class="card-group text-center">
				<?php 
					$bg_color = 'kk-head'; 
					if ($semester->id_semester == 7 || $semester->id_semester == 9) {
						$bg_color = 'kk-head2';
					}
				?>
				<div class="card m-1 border-0 <?php echo $bg_color ?> text-white" style="max-width: 6rem;font-size: 20px!important;">
					<div class="card-body">
					<p class="card-text"><?php echo $semester->nama ?></p>
					</div>
				</div> 
				<?php 
					$matakuliah = $dictionary[$semester->id_semester];
					$empty = 9 - count($matakuliah);
					foreach($matakuliah as $item) {
				?>
				<div style="font-size: 12px!important; width: 150px; margin-left: 10px; height: 170px;">
					<div class="card-body" style="width: 150px; height: 120px;">
					<span class="fw-bold" style="font-size: 16px!important;"><?php if ($item->nama_kode_2 == "") {
						echo $item->nama_kode;
					}else {echo $item->nama_kode_2;}  ?></span>	


					<p class="card-text text-grey"><?php echo $item->nama_mata_kuliah ?></p>
					</div> 
					<div class="card-footer" style="width: 150px;">
					<small class="text-grey" style="font-size: 16px!important"><?php echo $item->sks ?></small>
					</div>
				</div>
				<?php
					}

					for ($i = 1; $i<=$empty; $i++) {
				?>
				<div class="card m-1 border-0" style="font-size: 16px!important">
					<div class="card-body">					
					<p class="card-text"></p>
					</div>
				</div> 

				<?php
					}
				?>
			</div>
			<?php
				}
			?>
			
			
		</div>
	</div>
</div>
<div class="card overflow-auto"></div>
