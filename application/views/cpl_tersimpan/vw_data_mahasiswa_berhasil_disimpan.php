<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
      <div class="text-right">
          <a class="btn" href="<?php echo site_url('mahasiswa') ?>">
          <i class="menu-icon ti-arrow-left"></i>
           Kembali </a>
        </div>
        <br>
      <div class="alert alert-success alert-dismissible">
        <div class="box-title">
          Data Mahasiswa Angkatan <?php echo $datas_tahun; ?> Berhasil Diupdate :
        </div>
          
          <table class="table table-striped table-bordered display" style="width:100%" >
            <caption>Mahasiswa</caption>
            <thead>
              <tr>
                <th>Nim</th>
                <th>Nama</th>
                <th>SMS</th>
                <th>Status Akademik</th>
                <th>Angkatan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datas as $key) { ?>
              <tr>
                <td><?php echo $key['nim']; ?></td>
                <td><?php echo $key['nama']; ?></td>
                <td><?php echo $key['SemesterMahasiswa']; ?></td>
                <td><?php echo $key['StatusAkademik']; ?></td>
                <td><?php echo $key['tahun_masuk']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>


      </div>

		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div>
  