<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">Ganti Password</h4>
			<hr>
			<div class="col-lg-6">
				<?php 
					if ($konfirmasi == "salah") { ?>
					<div class="alert alert-danger alert-dismissible">
					Password konfirmasi tidak sama					
					</div>

				<?php } elseif ($konfirmasi == "benar") { ?>
					<div class="alert alert-success alert-dismissible">
					Password berhasil dirubah					
					</div>
				<?php }  ?>

			<form role="form" method="post" action="<?php echo site_url('akun_dosen/submit_ganti_password') ?>" enctype="multipart/form-data">
             	<div class="info-box-content">
	              	<br>
	              	Password Baru (2-12 Character)<div><input type="password" name="password_baru"  maxlength="12" minlength="2"></div>
	              	<br>
	              	Konfirmasi Password Baru <div><input type="password" name="konfirmasi_password_baru" maxlength="12" minlength="2"></div>
	              	<br>
	                <hr>
	                <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
             	</div>
             </form>
              <!-- /.info-box-content-->
            </div>
		</div> 
		<!-- /.box-content-->
	</div>
	<!-- /.col-lg-9 col-xs-12-->
</div>
  