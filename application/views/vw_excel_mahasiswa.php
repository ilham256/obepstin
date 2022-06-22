<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
  <table width="100%">
 
      <thead>
 
           <tr>
                <th style="width: 700px;" colspan="6">Tabel Data Mahasiswa </th>

 
           </tr>
 
      </thead>
 
 </table>

 <table border="1" width="100%">
 
      <thead>
 
           <tr>
                <th style="width: 100px;">NO</th>
                <th style="width: 100px;">NIM</th>
                <th style="width: 200px;">Nama</th>
                <th style="width: 100px;">Semester</th>
                <th style="width: 100px;">Tahun Masuk</th>
                <th style="width: 100px;">Status</th>
           </tr>
 
      </thead>
 
      <tbody>
 
           <?php $i=1; foreach($data as $r) { ?>
 
           <tr>
           		<td style="width: 100px;"><?php echo $i; ?></td>
                <td style="width: 100px;"><?php echo $r->nim; ?></td>
                <td style="width: 200px;"><?php echo $r->nama; ?></td>
                <td style="width: 100px;"><?php echo $r->SemesterMahasiswa; ?></td>
                <td style="width: 100px;"><?php echo $r->tahun_masuk; ?></td>
                <td style="width: 100px;" ><?php echo $r->StatusAkademik; ?></td>
 
           </tr>
 
           <?php $i++; } ?>
 
      </tbody>
 
 </table>