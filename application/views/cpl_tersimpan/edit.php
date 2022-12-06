<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
  
 
			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit Mahasiswa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('mahasiswa/submit_edit') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                			<input type="hidden" name="nim" value="<?= $data->nim; ?>">
  			                  <div class="form-group">
			                    <label for="exampleInputEmail1">NIM</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data->nim; ?>" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Mahasiswa</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" value="<?= $data->nama; ?>">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Asal SMA</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" name="asal_sma" value="<?= $data->asal_sma; ?>">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Jalur Masus</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" name="jalur_masuk" value="<?= $data->jalur_masuk; ?>">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Tahun Masuk</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" name="tahun_masuk" value="<?= $data->tahun_masuk; ?>">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Tempat Lahir</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" name="tempat_lahir" value="<?= $data->tempat_lahir; ?>">
			                  </div>
			                  <br>

			                  <div class="form-group">
		                      <label for="exampleInputEmail1">Tanggal Lahir</label>
		                      <div class="input-group">
		                        <input type="date" class="form-control" data-inputmask-alias="datetime" data-mask name="tanggal_lahir" value="<?= $data->tanggal_lahir; ?>">
		                      </div>
		                    </div>

                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
