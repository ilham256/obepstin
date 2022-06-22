<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Mata Kuliah</h4>
			<div class="form-group">
				<div class="text-right">
					<a class="btn btn-info waves-effect waves-light" href="<?php echo site_url('matakuliah/tambah') ?>" > + Mata Kuliah</a>
				</div>
				<br>
			</div>
			<div class="row mb-3">
					<label for="semester" class="col-sm-3 col-form-label">Silahkan Pilih Semester</label>
					<div class="col-sm-3">

						<form role="form" id="contactform" action="<?php echo site_url('matakuliah')?>" method="post">
						<div class="input-group">
						<select class="form-control select" name="semester">
							<option value="1">- Pilih Semester - </option>
							<?php $i = 1; foreach($data_semester as $d) { ?>
							<option value="<?php echo $d->id_semester; ?>"><?php echo $d->id_semester; ?></option>
							<?php $i++; } ?>
						</select>
						<button type="submit" class="btn btn-primary" name="pilih" value="pilih">Pilih</button>
						</div>
						</form>
						
					</div>
			</div>
			<br>
			<table id="example-edit" class="display" style="width: 100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Kode</th> 
						<th>Mata Kuliah</th> 
						<th>SKS</th> 
						<th>Semester</th> 
						<th>RPS</th> 
						<th></th> 
					</tr>  
				</thead> 

				<tfoot> 
					<tr>
						<th>#</th>
						<th>Kode</th> 
						<th>Mata Kuliah</th> 
						<th>SKS</th> 
						<th>Semester</th> 
						<th>RPS</th> 
						<th></th> 
					</tr>  
				</tfoot>

				<tbody> 
                        <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><span class="label label-success"><?php echo $r->nama_kode; ?></span></td>
                        <td><a href="<?php echo site_url('matakuliah/edit/'.$r->kode_mk); ?>"><i class="fa " title="Edit Mata Kuliah"> <?php echo $r->nama_mata_kuliah	; ?> </a></td>
                        <td><?php echo $r->sks; ?></td>
                        <td><?php echo $r->id_semester; ?></td>
                        <td><a href="<?= base_url('uploads/'.$r->rps) ?> " target="_blank">Lihat</a></td>
                        <td>
                        <a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('matakuliah/hapus/'.$r->kode_mk); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
                        </td>
                    </tr>
                    <?php $i++; } ?>

				</tbody> 
			</table>
		</div>
		
	</div>
 
</div>
