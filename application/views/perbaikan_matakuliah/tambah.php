<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah Data - Asesmen dan Tindak Lanjut Perbaikan Matakuliah</h3>
              </div> 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('perbaikan_matakuliah/submit_tambah') ?>" enctype="multipart/form-data">
	                <div class="card-body"> 
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Mata Kuliah</label>
	                    <select id="mata_kuliah" class="form-select" name="mata_kuliah">
                        <?php $i = 1; foreach($mata_kuliah as $d) { ?>
                        <option value="<?php echo $d->kode_mk; ?>"><?php echo $d->nama_kode.' ('.$d->nama_mata_kuliah.')'; ?></option>
                        <?php $i++; } ?>
                      </select>
	                  </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Dosen</label>
                      <select id="mata_kuliah" class="form-select" name="dosen">
                        <?php $i = 1; foreach($dosen as $d) { ?>
                        <option value="<?php echo $d->NIP; ?>"><?php echo $d->NIP.' ('.$d->nama_dosen.')'; ?></option>
                        <?php $i++; } ?>
                      </select>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun</label>
                      <input type="number" class="form-control" id="exampleInputEmail1" name="tahun">
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Hasil Analisis dan Evaluasi</label><br>
                      <textarea class="form-control" rows="5" placeholder="Enter ..." name="analisis"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tindak Lanjut dan Bukti Perbaikan</label>
                      <textarea class="form-control" rows="5" placeholder="Enter ..." name="perbaikan"></textarea>
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan" onclick="return confirm('Apakah Anda Ingin Menyimpan Data ?')" >Submit</button>
                </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
 