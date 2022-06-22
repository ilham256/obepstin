<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			<div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit CPL</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('formula/submit_edit') ?>" enctype="multipart/form-data">
	                <div class="card-body">

			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama CPL</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->nama ?>" name="nama_cpl">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Deskripsi</label>
			                    
			                    <textarea class="form-control" rows="3" id="text" name="deskripsi"><?= $data->deskripsi ?></textarea>
			                  </div>
			                  <input type="hidden" name="id" value="<?= $data->id_cpl_langsung ?>" >
			                  <br>


                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
              </form>

	              <div class="card-footer">	                
	              	<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('formula/hapus_cpl/'.$data->id_cpl_langsung); ?>"><button type="submit" class="btn btn-danger" name="simpan" value="simpan">Hapus CPL</button></a>
	               </div>


            </div> 

		</div> 
		
	</div>

</div> 
