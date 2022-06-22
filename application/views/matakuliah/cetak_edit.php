<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home - Sistem Asesmen OBE PS TIN</title>

	<!-- Themify Icon -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/themify-icons/themify-icons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/waves/waves.min.css">

	<!-- Jquery UI -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/jquery-ui/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/jquery-ui/jquery-ui.theme.min.css">

	<!-- Data Tables -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/datatables/media/css/jquery.dataTables.min.css">

	<!-- Dropify -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugin/dropify/css/dropify.min.css">

	<!-- Main Styles -->
    <link href="<?php echo base_url() ?>assets/plugin/bootstrap-5.0.1/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/styles/style.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url() ?>assets/scripts/jquery2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/modernizr.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/bootstrap-5.0.1/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/bootstrap-5.0.1/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/waves/waves.min.js"></script>

	<!-- Jquery UI -->
	<script src="<?php echo base_url() ?>assets/plugin/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/jquery-ui/jquery.ui.touch-punch.min.js"></script>

	<!-- Sparkline Chart -->
	<script src="<?php echo base_url() ?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/chart.sparkline.init.min.js"></script>

	<!-- Data Tables -->
	<script src="<?php echo base_url() ?>assets/plugin/datatables/media/datatables/jquery.dataTables.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugin/editable-table/mindmup-editabletable.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/datatables.demo.min.js"></script>

	<!-- Dropify -->
	<script src="<?php echo base_url() ?>assets/plugin/dropify/js/dropify.min.js"></script>
	<script src="<?php echo base_url() ?>assets/scripts/fileUpload.demo.min.js"></script>

	<!-- Data table -->
	<script src="<?php echo base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>


</head>

<body>

<div class="row small-spacing">
	<div class="col-lg-12 col-xs-12">
		<div class="box-content">
 
  
			            <div class="card card-primary"> 
              <div class="card-header" >
                <h3 class="card-title" >Data Mata Kuliah</h3> 
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('matakuliah/submit_edit') ?>" enctype="multipart/form-data">
	                <div class="card-body">

	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Kode Mata Kuliah</label>
	                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->nama_kode ?>" name="kode_mata_kuliah">
	                  </div>
	                  <br>
	                  <div class="form-group">
	                      <label>Semester</label>
	                      <select class="form-control" style="width: 100%;" name="semester" placeholder="Pilih Semester">
                      	<option value="<?= $data->id_semester ?>" > <?= $data->id_semester ?> </option>
	                        <?php $no=1; foreach ($datas as $row): ?>
	                        <option value="<?= $row->id_semester;  ?>"><?= $row->id_semester;  ?></option>
	                        <?php $no++; endforeach; ?>
			                      </select>
			                    </div> 
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Nama Mata Kuliah</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->nama_mata_kuliah ?>" name="nama_mata_kuliah">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">SKS</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->sks ?>" name="sks">
			                  </div>
			                  <br>
			                  <div class="form-group">
			                    <label for="exampleInputEmail1">Dosen</label>
			                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data->dosen ?>" name="dosen">
			                  </div>
			                   
			                  <br>
					  		<div class="form-group">
			                  	<div class="box-content bordered primary">
			                  		<label for="exampleInputEmail1">CPMK</label>
			                  		<hr>
			                  		<div>
			                  			 
			                  		<?php $i = 1; foreach($cpmk as $p) { ?>

			                  			<a href="<?php echo site_url('matakuliah/edit_matakuliah_has_cpmk/'.$p->id_matakuliah_has_cpmk); ?>">
			                  			<b><?php echo $p->id_cpmk_langsung; ?></b></a>
										<p><?php echo $p->deskripsi_matakuliah_has_cpmk; ?></p>          		
			                  		
			                  		<?php $i++; } ?> 
			                  		<hr>
			                  		 	<a class="btn btn-block btn-primary" href="<?php echo site_url('matakuliah/tambah_matakuliah_has_cpmk/'.$p->kode_mk); ?>">+</a>
			                  		</div>
			                  	</div>
			                  </div> 
			                  <br> 

					  		<input type="hidden" name="kode_mk" value="<?= $data->kode_mk ?>">

 

                  </div>
              </form>


            </div>

		</div>
		
	</div>

</div>
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>

</body>
</html>