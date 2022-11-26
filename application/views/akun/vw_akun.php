<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
  
 
			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Akun</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('dashboard_mahasiswa/edit_password') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                			<input type="hidden" name="nim" value="<?= $data[0]->username; ?>">
  			                  <div class="form-group">
			                    <label for="exampleInputEmail1">ID User</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data[0]->username; ?>" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Level</label>
			                    <?php  
			                    	$level = $data[0]->level;
			                    	if ($level == 0) {
			                    	$l = "Admin";}
			                    	elseif ($level == 1) {
			                    	$l = "Dosen";
			                    	}
			                    	elseif ($level == 2) {
			                    	$l = "Mahasiswa";
			                    	}
			                    	elseif ($level == 4) {
			                    	$l = "Guest";
			                    	}
			                     ?>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $l; ?>">
			                  </div>
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="ganti_password" value="ganti_password">Ganti Password</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
