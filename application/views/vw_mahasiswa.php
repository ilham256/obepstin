<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">Mahasiswa</h4>
			<div class="form-group">
				<div class="text-right">
					<a class="btn btn-info waves-effect waves-light" href="<?php echo site_url('mahasiswa/tambah') ?>" > + Update Data Mahasiswa</a>
				</div>
				<br>
			</div> 
			<table id="example1" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr> 
						<th>No.</th>
						<th>NIM</th> 
						<th>Nama</th>
						<th>Semester</th>
						<th>Tahun Angkatan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>No.</th>
						<th>NIM</th> 
						<th>Nama</th>
						<th>Semester</th>
						<th>Tahun Angkatan</th>
						<th>Status</th>
					</tr>
				</tfoot>

				<tbody> 
                    <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><span class="label label-success"><?php echo $r->nim; ?></span></td>
                        <td><?php echo $r->nama; ?></td>
                        <td><?php echo $r->SemesterMahasiswa; ?></td>
						<td><?php echo $r->tahun_masuk; ?></td>
						<td><?php echo $r->StatusAkademik; ?></td>
                    </tr>
                    <?php $i++; } ?>

				</tbody>
			</table>
			<br>
			<div class="form-group">
				<div class="text-right" >
					<a class="btn btn-success waves-effect waves-light" href="<?php echo site_url('mahasiswa/export_excel/') ?>">Download Excel</a>
				</div>
			</div>
		</div>
		<!-- /.box-content -->
	</div>

</div> 
