<div class="row small-spacing">
  <div class="col-lg-12 col-xs-12"> 
    <div class="box-content">
      <h4 class="box-title">Data Hasil Proses (CPL) Mahasiswa Angkatan <?php echo $simpanan_tahun ; ?></h4>     
       
      <div class="col-md-12 col-sm-12">
            <form role="form" id="contactform" action="<?php echo site_url('cpl_tersimpan/simpan')?>" method="post">

              <input type="hidden" name="tahun" value="<?php echo $simpanan_tahun ?>">

              <button onclick="return confirm('Apakah Anda Ingin Menyimpan Data Hasil Proses? (Menyimpan Data Hasil Proses akan menghapus data lama tahun angkatan bersangkutan)')" type="submit" class="btn btn-default waves-effect waves-light" name="simpan" value="simpan"><i class='fa fa-download'></i> Simpan</button>

            </form>
            <br>
            <table class="table table-bordered display" style="width:100%">
              <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <?php foreach ($data_cpl as $row) { ?>
                  <th><?php echo $row->nama ; ?></th>
                  <?php } ?>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th> 
                  <?php foreach ($data_cpl as $row) { ?>
                  <th><?php echo $row->nama ; ?></th>
                  <?php } ?>
                </tr> 
              </tfoot>
 
              <tbody>
                          <?php $i = 1; foreach($data_mahasiswa as $r) { ?>
                          <tr>
                              <td><?php echo $r["Nim"]  ; ?></td>
                              <td><?php echo $r["Nama"] ; ?></td>

                              <?php foreach ($data_cpl as $row) { ?>
                  <td>
                    <?php foreach($datas as $w) { ?>
                        <?php if ($r["Nim"] == $w["nim"]) {
                          if ($row->id_cpl_langsung == $w["id_cpl_langsung"]) {
                            echo round($w["nilai_cpl"]);
                          } } } ?>
                            </td>
                  <?php } ?>
                                </tr>
                          <?php $i++; } ?> 
              </tbody>
            </table>

            <form role="form" id="contactform" action="<?php echo site_url('cpl_tersimpan/simpan')?>" method="post">

              <input type="hidden" name="tahun" value="<?php echo $simpanan_tahun ?>">

              <button onclick="return confirm('Apakah Anda Ingin Menyimpan Data Hasil Proses? (Menyimpan Data Hasil Proses akan menghapus data lama tahun angkatan bersangkutan)')" type="submit" class="btn btn-default waves-effect waves-light" name="simpan" value="simpan"><i class='fa fa-download'></i> Simpan</button>

            </form>
        </div>

    </div>
    <!-- /.box-content -->
  </div> 
  <!-- /.col-lg-9 col-xs-12 -->
</div>
 
<!-- chart.js Chart -->
<?php //echo '<pre>';  var_dump($nilai_cpl); echo '</pre>'; ?>
 