<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah CPMK</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('matakuliah/submit_tambah_matakuliah_has_cpmk') ?>" enctype="multipart/form-data">
	                <div class="card-body">

			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Kode Mata Kuliah</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Deskriptor" name="mk" value="<?= $data->kode_mk ?>" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">CPMK</label>
			                    
			                    <select class="form-control" style="width: 100%;" name="cpmk" placeholder="Pilih Semester">
			                      	<option> - Pilih CPMK - </option>
				                        <?php $no=1; foreach ($data_cpmk as $row): ?>
				                    <option value="<?= $row->id_cpmk_langsung;  ?>"><?= $row->nama;  ?></option>
				                        <?php $no++; endforeach; ?>
			                      </select>
			                  </div>
			                  
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Deskripsi</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Deskripsi" name="deskripsi"  >
			                  </div>
			                  <br> 


                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Tambah</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div> 
