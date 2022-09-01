<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">Tambah Admin</h4>
			<form role="form" method="post" action="<?= base_url("user/submit_tambah_admin")  ?>">
                <div class="card-body">
                  <input type="hidden" name="id" value="<?= $data->id ?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->username ?>" name="username">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->username ?>" name="email">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="Masukan Password">
                  </div>
                  <br>

                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
            </form> 
			<br> 

		</div>
		<!-- /.box-content -->
	</div>

</div> 
