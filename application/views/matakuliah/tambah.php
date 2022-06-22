<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah Mata Kuliah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('matakuliah/submit_tambah') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Kode Mata Kuliah (K2020) </label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Kode Mata Kuliah . . ." name="kode_mata_kuliah">
	                  </div>
	                  <br>
	                  <div class="form-group">
	                      <label>Semester</label>
	                      <select class="form-control" style="width: 100%;" name="semester" placeholder="Pilih Semester">
                      	<option >- Pilih Semester - </option>
	                        <?php $no=1; foreach ($datas as $row): ?>
	                        <option value="<?= $row->id_semester;  ?>"><?= $row->id_semester;  ?></option>
	                        <?php $no++; endforeach; ?>
			                      </select>
			                    </div> 
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Mata Kuliah</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Mata Kuliah" name="nama_mata_kuliah">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">SKS</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Jumlah SKS" name="sks">
			                  </div>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Dosen</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Dosen" name="dosen">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                  		<p><label for="exampleInputEmail1">RPS</label>
			                  		(Maksimum ukuran file 10 MB)</p>
									<input type="file" id="input-file-to-destroy" class="form-control" data-allowed-formats="portrait square" data-max-file-size="10M" data-max-height="2000" name="rps">
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
