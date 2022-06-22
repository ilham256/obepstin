<div class="row small-spacing">
  <div class="col-lg-12 col-xs-12">
    <div class="box-content">
      <div class="alert alert-success alert-dismissible">
        <div class="box-title">
          Data Relevansi PPM Berhasil Diupdate :
        </div>
          
          <table class="table table-striped table-bordered display" style="width:100%" >
            <caption>Lulusan</caption>
            <thead>
              <tr>
                <th>Nama</th>
                <th>Posisi Dalam Organisasi</th>
                <th>Jenis Kelamin</th>
                <th>Tahun Lulusan</th>
                <th>Nama Organisasi</th>
                <th>Alamat</th>
                <th>HP</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datas_relevansi_ppm as $key) { ?>
              <tr>
                <td><?php echo $key['nama']; ?></td>
                <td><?php echo $key['posisi']; ?></td>
                <td><?php echo $key['jenis_kelamin']; ?></td>
                <td><?php echo $key['tahun_lulusan']; ?></td>
                <td><?php echo $key['nama_organisasi']; ?></td>
                <td><?php echo $key['alamat']; ?></td>
                <td><?php echo $key['hp']; ?></td>
                <td><?php echo $key['email']; ?></td>
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
  