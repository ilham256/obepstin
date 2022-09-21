<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Mata Kuliah</h4>

			<div class="row mb-3">
					<label for="semester" class="col-sm-3 col-form-label">Silahkan Pilih Semester</label>
					<div class="col-sm-3">

						<form role="form" id="contactform" action="<?php echo site_url('input_asesmen_guest/matakuliah')?>" method="post">
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

					</tr>  
				</thead> 

				<tfoot> 
					<tr>
						<th>#</th>
						<th>Kode</th> 
						<th>Mata Kuliah</th> 
						<th>SKS</th> 
						<th>Semester</th> 

					</tr>  
				</tfoot>

				<tbody> 
                        <?php $i = 1; foreach($datas as $r) { ?>
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><span class="label label-success"><?php echo $r->nama_kode; ?></span></td>
                        <td> <?php echo $r->nama_mata_kuliah	; ?> </td>
                        <td><?php echo $r->sks; ?></td>
                        <td><?php echo $r->id_semester; ?></td>
                        
                        
                    </tr>
                    <?php $i++; } ?>

				</tbody> 
			</table>
		</div>
		
	</div>
 
</div>
