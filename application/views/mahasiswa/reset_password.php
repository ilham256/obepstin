<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Reset Password Akses Mahasiswa</h3>
              </div> 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('mahasiswa/submit_reset_password') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Nim Mahasiswa</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nim Yang Ingin Direset" name="NIM" maxlength="30" >
	                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('apakah anda Mereset Password ?')" >Reset Password</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
 