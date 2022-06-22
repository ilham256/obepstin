<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">


			            <div class="card card-primary">
              <div class="card-header" >
                <h3 class="card-title" >Tambah Formula CPMK</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('formula_deskriptor/submit_tambah_formula') ?>" enctype="multipart/form-data">
	                <div class="card-body">
	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Kode Deskriptor</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1"  name="id" value="<?= $data->id_deskriptor ?>" >
	                  </div>
	                  <br>

			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Deskriptor</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1"  name="nama" value="<?= $data->nama_deskriptor ?>" disabled>
			                  </div>
			                  <br>
			                  <div class="form-group">
			                      <label>CPMK</label>
			                      <select class="form-control" style="width: 100%;" name="cpmk" >
		                      	<option >- Pilih CPMK - </option>
			                        <?php $no=1; foreach ($data_formula_cpmk as $row): ?>
			                        <option value="<?= $row->id_matakuliah_has_cpmk;  ?>"><?= $row->kode_mk." - ".$row->nama_mata_kuliah." - ".$row->nama;  ?></option>
			                        <?php $no++; endforeach; ?>
					                      </select>
					                    </div> 
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Persentasi/Bobot</label>

			                    <input type="number" class="form-control" name="persentasi" placeholder="0.00" required name="price" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
			                  </div>
			                  <br>

 
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                </div>
              </form>


            </div>
 
		</div>
		
	</div>

</div>
