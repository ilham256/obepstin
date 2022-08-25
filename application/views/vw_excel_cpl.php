<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
  <table width="100%">
      <thead>
           <tr>
                <th style="width: 700px;" colspan="6">Tabel Data CPL</th>
           </tr>
       </thead>
  </table>

 <table border="1" width="100%">
       <thead>
            <tr>
                <th style="width: 100px;">NIM</th>
                <th style="width: 100px;">Nama</th>
                <?php foreach ($data_cpl as $row) { ?>
                <th style="width: 100px;"><?php echo $row->nama ; ?></th>
                  <?php } ?>
           </tr>
       </thead>
 
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