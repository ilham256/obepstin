<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
  
 
			 <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Edit Perbaikan Matakuliah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('perbaikan_matakuliah/submit_edit') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                			
  			                  <div class="form-group">
			                    <label for="exampleInputEmail1">NIP</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data->NIP; ?>" >
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Dosen</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data->nama_dosen; ?>">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Matakuliah</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?= $data->nama_mata_kuliah; ?>">
			                  </div>
			                  <br>
					            <div class="form-group">
					              <label for="exampleInputEmail1">Tahun</label>
					              <input type="number" class="form-control" id="exampleInputEmail1" disabled value="<?= $data->tahun; ?>">
					            </div>
					            <br>

					            <div class="form-group">
					              <label for="exampleInputEmail1">Hasil Analisis dan Evaluasi</label><br>
					              <textarea class="form-control" rows="5" name="analisis"><?= $data->analisis; ?></textarea>
					            </div>
					            <br>

					            <div class="form-group">
					              <label for="exampleInputEmail1">Tindak Lanjut dan Bukti Perbaikan</label>
					              <textarea class="form-control" rows="5" name="perbaikan"><?= $data->perbaikan; ?></textarea>
                    			</div>

                    			<input type="hidden" name="id" value="<?= $data->id; ?>">

                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>

              </form>
              	<div class="card-body">
              	<a onclick="return confirm('Apakah Anda Ingin Mencetak Data?')" href="<?php echo site_url('perbaikan_matakuliah/download/'.$data->id); ?>" target="_blank">
              		<button class="btn btn-default waves-effect waves-light"><i class='fa fa-download'></i> Download</button>
              	</a>
              	</div>

            </div>

		</div>
		
	</div>

</div>
