<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			<div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit CPMK</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('matakuliah/submit_edit_matakuliah_has_cpmk') ?>" enctype="multipart/form-data">
	                <div class="card-body">

			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Kode Mata Kuliah</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Deskriptor" name="mk" value="<?= $data->kode_mk ?>" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">CPMK</label>
			                    
			                    <select class="form-control" style="width: 100%; " name="cpmk" placeholder="Pilih Semester"> 
			                      	<option value="<?= $data->id_cpmk_langsung; ?>" style="background: lightblue;"> <?= $data->id_cpmk_langsung; ?> </option>
				                        <?php $no=1; foreach ($data_cpmk as $row): ?>
				                    <option value="<?= $row->id_cpmk_langsung;  ?>"><?= $row->id_cpmk_langsung;  ?></option>
				                        <?php $no++; endforeach; ?>
			                      </select>
			                  </div> 
			                  <input type="hidden" name="id_matakuliah_has_cpmk" value="<?= $data->id_matakuliah_has_cpmk ?>">
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Deskripsi </label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Deskriptor" name="deskripsi" value="<?= $data->deskripsi_matakuliah_has_cpmk ?>" >
			                  </div>
			                  <br>
 

                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
              </form>

	              <div class="card-footer">	                
	              	<a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('matakuliah/hapus_matakuliah_has_cpmk/'.$data->id_matakuliah_has_cpmk); ?>"><button type="submit" class="btn btn-danger" name="simpan" value="simpan">Hapus CPMK</button></a>
	               </div>


            </div> 

		</div> 
		
	</div>

</div> 
