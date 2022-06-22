<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<h4 class="box-title">Formula Deskriptor</h4>
			<p>
			<br>
			<a class="btn btn-info waves-effect waves-light" href="<?php echo site_url('formula_deskriptor/tambah_deskriptor') ?>" > + Tambah Deskriptor</a>
			
			</p>


		<?php $i = 1; foreach($data_deskriptor as $d) { ?> 
		<div class="box-content bordered primary">
			<h4 class="box-title"><a class="btn btn-block btn" href="<?php echo site_url('formula_deskriptor/edit_deskriptor/'.$d->id_deskriptor); ?>"><?php echo $d->nama_deskriptor	;?></a></h4>
			<p>
			<?php echo $d->deskripsi	;?>
			</p>
			<table id="example-edit" class="display" style="width: 100%">
				<thead>
					<tr>
						<th style="width: 300px;">Kode CPMK</th>
						<th style="width: 450px;">Nama Mata Kuliah</th>
						<th style="width: 200px;">Bobot (Persen)</th>
						<th></th>  
					</tr>
				</thead>
				<tfoot>  
					<tr>
						<th>Kode CPMK</th>
						<th>Nama Mata Kuliah</th>
						<th>Bobot (Persen)</th>
						<th></th>
					</tr>
				</tfoot>
				<tbody>
					<?php $i = 1; foreach($rumus as $s) { ?>
					<?php if ($d->id_deskriptor == $s->id_deskriptor) { ?>
					<tr> 
						<td><?php echo $s->nama; ?></td>
						<td><?php echo $s->nama_kode.' '.$s->nama_mata_kuliah; ?></td>
						<td><?php echo $s->persentasi; ?></td>
						<td><a href="<?php echo site_url('formula_deskriptor/edit_formula_deskriptor/'.$s->id_deskriptor_rumus_cpmk); ?>"><i class="fa fa-edit" title="Edit Data produk"></i></a> |
                        <a onclick="return confirm('apakah anda ingin menghapus data')" href="<?php echo site_url('formula_deskriptor/hapus_formula_deskriptor/'.$s->id_deskriptor_rumus_cpmk); ?>"><i class="fa fa-trash" title="Hapus Data produk"></i></a>
                        </td>
					</tr>
					<?php } ?>
					<?php $i++; } ?>				 
				</tbody>
			</table>	
			<br>
			<div class="col-lg-12 col-xs-12">
				<div class="text-right">

					<a class="btn btn-block btn-success" href="<?php echo site_url('formula_deskriptor/tambah_formula_deskriptor/'.$d->id_deskriptor); ?>" > + Bobot CPMK</a>
				</div>
			</div>
		</div>
		<?php $i++; } ?>
			
	</div>
	
	<!-- /.col-lg-9 col-xs-12 -->
</div>
<?php  //echo '<pre>';  var_dump($rumus); echo '</pre>'; ?>
<?php // echo '<pre>';  var_dump($datas); echo '</pre>'; ?>