<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
  
 
			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Akun / Ganti Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('dashboard_mahasiswa/edit_password') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                	<?php if (!is_null($keterangan)) { 
	                			if ($keterangan == "Password Baru Berhasil Disimpan") {
	                		?>
	                		<div class="alert alert-success alert-dismissible">		                  
			                  <?php echo $keterangan;  ?>
			                </div>
			            <?php } else { ?>
			            	<div class="alert alert-danger alert-dismissible">		                  
			                  <?php echo $keterangan;  ?>
			                </div>
	                	<?php }} ?>
	                			<input type="hidden" name="nim" value="<?= $data[0]->username; ?>">
  			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Password Lama</label>
			                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_lama" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Password Baru</label>
			                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_baru" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Ketik Ulang Password Baru</label>
			                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_baru_verifikasi" >
			                  </div>
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Ganti Password</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
