<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
		<?php foreach ($datas as $key) { ?>
		
			<div class="col-12">
            <div class="alert alert-<?php if ($key["id"] == "Data_efektivitas_CPL_Kosong") {
                   	echo "danger";
                   } 
                   else { echo "success"; }?> alert-dismissible">                
                   <?php if ($key["id"] == "Data_efektivitas_CPL_Kosong") {
                   	echo "Data CPL (".$key["id_cpl_langsung"].") Tidak Ada, Harap Masukan Data CPMK Mata Kuliah";
                   } 
                   else { echo $key["nim"]." -> ".$key["id_cpl_langsung"]." -> ".$key["nilai"]." Berhasil Disimpan"; }?>
                </div>
            <!-- /.card-body -->
          <!-- /.card -->
        	</div>	
		

		<?php } ?>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-lg-9 col-xs-12 -->
</div> 
 