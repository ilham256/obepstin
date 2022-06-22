<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Deskriptor 1.Xxx</h4>
			<p>
			Menggunakan teknik dan perangkat modern dalam menyelesaikan permasalahan agroindustri
			</p>			
			<table id="example-edit" class="display" style="width: 100%">
				<thead>
					<tr>
						<th>Kode CPMK</th>
						<th>Nama Mata Kuliah</th>
						<th>Bobot (Persen)</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Kode CPMK</th>
						<th>Nama Mata Kuliah</th>
						<th>Bobot (Persen)</th>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td>CPMK X</td>
						<td>MK 1</td>
						<td>0.25</td>
					</tr>								
				</tbody>
			</table>	

			<div class="float-end mt-3">
				<a href="<?php echo site_url('formula/detail') ?>" class="btn btn-primary mb-3 waves-effect waves-light" data-toggle="modal">Kembali</a>
				<button type="button" class="btn btn-primary mb-3 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#tambahDeskriptorCPMK">Tambah</button>
			</div>

		</div>

	</div>
</div>


<div class="modal fade" id="tambahDeskriptorCPMK" tabindex="-1" role="dialog" aria-labelledby="tambahDeskriptorCPMKLabel" aria-hidden="true">
    <div class="modal-dialog">    
      	<div class="modal-content">
			<div class="modal-header">		
				<h5 class="modal-title" id="tambahDeskriptorCPMKLabel">Tambah CPMK</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="" role="form" method="post" action="<?php echo site_url('inventory/checkin'); ?>">					
					<div class="mb-3">
						<input type="hidden" id="desk_cpmk_id" name="desk_cpmk_id" />
						<label for="mata_kuliah" class="form-label">Pilih Mata Kuliah</label>

						<select id="mata_kuliah" class="form-select">
							<option value="2020">TIN 311 Penelitian Operasi</option>
							<option value="2019">TIN 310 Tata Letak dan Penanganan Bahan</option>
							<option value="2018">TIN 326 Peralatan Industri</option>
							<option value="2017">TIN 351 Rekayasa Mutu</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="cpmk" class="form-label">Pilih Kode</label>
						<select id="cpmk" class="form-select">
							<option value="2020">CPMK A</option>
							<option value="2019">CPMK B</option>
							<option value="2018">CPMK C</option>
							<option value="2017">CPMK D</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
			</div>
      	</div>      
    </div>
</div>
