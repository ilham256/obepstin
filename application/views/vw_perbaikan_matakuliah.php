<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">Asesmen dan Tindak Lanjut Perbaikan Matakuliah</h4>
			<div class="form-group">
				<div class="text-right">
					<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('perbaikan_matakuliah/tambah') ?>" > + Tambah Data</a>
				</div>
				<br> 
			</div> 
			<table id="example1" style="width:100%">
				<thead>
					<tr> 
						<th >No.</th>
						<th style="width: 100px">NIP</th> 
						<th style="width: 100px">Nama</th>
						<th style="width: 100px">Mata Kuliah</th>
						<th>Analisis & Evaluasi</th>
						<th>Perbaikan</th>
						<th></th>
						<th></th>
						<th></th> 
					</tr>
				</thead>
				<tbody> 
                    <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><?php echo $r->NIP; ?></td>
                        <td><?php echo $r->nama_dosen; ?></td>
                        <td><?php echo $r->nama_mata_kuliah; ?></td>
                        
                        <td><textarea class="form-control" rows="10" placeholder="<?= $r->analisis; ?>" disabled></textarea></td>
                        <td> <textarea class="form-control" rows="10" placeholder="<?= $r->perbaikan; ?>" disabled></textarea></td>
                        <td>
                        <a onclick="return confirm('Apakah Anda Ingin Mencetak Data?')" href="<?php echo site_url('perbaikan_matakuliah/download/'.$r->id); ?>" target="_blank"><i class="ti-printer" title="download" ></i></a>
                        </td>
                        <td>
                        <a onclick="return confirm('Apakah Anda Ingin Mengubah Data?')" href="<?php echo site_url('perbaikan_matakuliah/edit/'.$r->id); ?>"><i class="fa fa-edit" title="Edit Data"></i></a>
                        </td>
                        <td>
                        <a onclick="return confirm('Apakah Anda Ingin Menghapus Data?')" href="<?php echo site_url('perbaikan_matakuliah/hapus/'.$r->id); ?>"><i class="fa fa-trash" title="Hapus Data"></i></a>
                        </td>
                    </tr>
                    <?php $i++; } ?>

				</tbody>
			</table>
			<br>
			<div class="form-group">
			</div>
		</div>
		<!-- /.box-content -->
	</div>

</div> 
