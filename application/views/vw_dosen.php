<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content bordered primary">
			<h4 class="box-title">Dosen</h4>
			<div class="form-group">
				<div class="text-right">
					<a class="btn btn-info waves-effect waves-light" href="<?php echo site_url('dosen/tambah') ?>" > + Tambah Dosen</a>
				</div>
				<br> 
			</div> 
			<table id="example1" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr> 
						<th>No.</th>
						<th>NIP</th> 
						<th>Nama</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>No.</th>
						<th>NIP</th> 
						<th>Nama</th>
					</tr>
				</tfoot>

				<tbody> 
                    <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><span class="label label-success"><?php echo $r->NIP; ?></span></td>
                        <td><?php echo ucwords(strtolower($r->nama_dosen)); ?></td>
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
