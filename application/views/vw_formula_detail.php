<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Formula Pemenuhan CPL 1</h4>
			<p>
			Mampu mengidentifikasi, menganalisis, dan menyelesaikan permasalahan keteknikan agroindustri, yang mencakup sistem, proses, manajemen, dan lingkungan, melalui penerapan pengetahuan matematika, IPA, keteknikan dan teknologi informasi menggunakan teknik, dan perangkat-perangkat modern
			</p>
			<div class="card-group">
				<div class="card m-1 border-0">
					<div class="card-header kk-head text-white"><h5 class="card-title">Deskriptor 1.A</h5></div>
					<div class="card-body">
						<div class="card-content">
							<div class="list-group">
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK A TIN 470</h5>
									<div class="text-right">0.25</div>
								</a>
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK B TIN 450</h5>
									<div class="text-right">0.50</div>
								</a>
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK C TIN 330</h5>
									<div class="text-right">0.25</div>
								</a>
							</div>	
						</div>
					</div>
				</div>
				<div class="card m-1 border-0">
					<div class="card-header kk-head text-white"><h5 class="card-title">Deskriptor 1.B</h5></div>
					<div class="card-body">
						<div class="card-content">
							<div class="list-group">
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK A TIN 211</h5>
									<div class="text-right">0.25</div>
								</a>
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK B TIN 242</h5>
									<div class="text-right">0.50</div>
								</a>
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK C TIN 224</h5>
									<div class="text-right">0.25</div>
								</a>
							</div>	
						</div>
					</div>
				</div>
				<div class="card m-1 border-0">
					<div class="card-header kk-head text-white"><h5 class="card-title">Deskriptor 1.C</h5></div>
					<div class="card-body">
						<div class="card-content">
							<div class="list-group">
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK A TIN 230</h5>
									<div class="text-right">0.25</div>
								</a>
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK B TIN 234</h5>
									<div class="text-right">0.50</div>
								</a>
								<a href="#" class="list-group-item list-group-item-light">
									<h5 class="list-group-item-heading">CPMK C TIN 253</h5>
									<div class="text-right">0.25</div>
								</a>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="float-end mt-3">
				<a href="<?php echo site_url('formula') ?>" class="btn btn-primary mb-3 waves-effect waves-light">Kembali</a>
				<button type="button" class="btn btn-primary mb-3 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#tambahDeskriptor">Tambah</button>
			</div>
		</div>
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>

<div class="modal fade" id="tambahDeskriptor" tabindex="-1"  role="dialog" aria-labelledby="tambahDeskriptorLabel" aria-hidden="true">
    <div class="modal-dialog">    
      	<div class="modal-content">
			<div class="modal-header">		
				<h5 class="modal-title" id="tambahDeskriptorLabel">Tambah Deskriptor</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formDeskriptor" class="" role="form" method="post" action="<?php echo site_url('formula/deskriptorn'); ?>">					
					<div class="mb-3">
						<input type="hidden" id="deskriptor_id" name="deskriptor_id" />
						<label for="nama" class="form-label">Nama Deskriptor</label>
						<input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Deskriptor" required>
					</div>
					<div class="mb-3">
						<label for="keterangan" class="form-label">Keterangan</label>
						<textarea class="form-control" id="keterangan" placeholder="Keterangan"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="saveDeskriptor()">Simpan</button>
			</div>
      	</div>      
    </div>
</div>