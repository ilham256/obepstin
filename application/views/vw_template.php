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



</head>

<body>
	
<div class="main-menu">
	<header class="header">
		<a href="<?php echo site_url() ?>" class="logo"><img src="<?php echo base_url() ?>assets/images/Logo_web.png" width="170" /></a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">
		<div class="navigation">
			<h5 class="title">Admin</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li <?php echo ($breadcrumbs == 'dashboard' || $breadcrumbs == 'infumum' || $breadcrumbs == 'kinumum' || $breadcrumbs == 'kincpmk' || $breadcrumbs == 'kincpl'? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url()?>"><i class="menu-icon ti-dashboard"></i>Dashboard<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">

						<li <?php echo ($breadcrumbs == 'infumum' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('infumum') ?>">Informasi Umum</a>
						</li>
						<li <?php echo ($breadcrumbs == 'kinumum' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('kinumum') ?>">Kinerja CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'kincpmk' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('kincpmk') ?>">Kinerja CPMK</a>
						</li>
						<li <?php echo ($breadcrumbs == 'kincpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('kincpl') ?>">Status Pencapaian CPL</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'matakuliah' || $breadcrumbs == 'profil_matakuliah' || $breadcrumbs == 'kurikulum' || $breadcrumbs == 'cpmklang' || $breadcrumbs == 'cpmktlang' || $breadcrumbs == 'cpltlang' || $breadcrumbs == 'formula' || $breadcrumbs == 'formula_deskriptor' || $breadcrumbs == 'katkin' || $breadcrumbs == 'cpmk_cpl' || $breadcrumbs == 'efektifitas_cpl' || $breadcrumbs == 'relevansi_ppm' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-layers-alt"></i>Input Asesmen<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'kurikulum' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('kurikulum') ?>">Kurikulum</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpmk_cpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('cpmk_cpl') ?>">CPL dan Deskriptor</a>
						</li>
						<li <?php echo ($breadcrumbs == 'matakuliah' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('matakuliah') ?>">Mata Kuliah menurut Semester</a>
						</li>
						<li <?php echo ($breadcrumbs == 'profil_matakuliah' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('profil_matakuliah') ?>">Profil Mata Kuliah & CPMK</a>
						</li>
						<li <?php echo ($breadcrumbs == 'formula' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('formula') ?>">Formula CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'katkin' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('katkin') ?>">Kategori Kinerja</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpmklang' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('cpmklang') ?>">Nilai CPMK Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpmktlang' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('cpmktlang') ?>">Nilai CPMK Tak Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'cpltlang' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('cpltlang') ?>">Nilai CPL Tak Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'efektivitas_cpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('efektivitas_cpl') ?>">Evaluasi Efektivitas CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'relevansi_ppm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('relevansi_ppm') ?>">Evaluasi Relevansi PPM</a> 
						</li>
						<li <?php echo ($breadcrumbs == 'epbm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('epbm') ?>">Rekap EPBM</a> 
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'mahasiswa' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect" href="<?php echo site_url('mahasiswa') ?>"><i class="menu-icon ti-user"></i>Mahasiswa</a>
				</li>
				<li <?php echo ($breadcrumbs == 'evaluasi_l'  || $breadcrumbs == 'evaluasi_tl' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url()?>"><i class="menu-icon ti-dashboard"></i>Analisis & Evaluasi<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'evaluasi_l' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('evaluasi_l') ?>">Pengukuran Langsung</a>
						</li>
						<li <?php echo ($breadcrumbs == 'evaluasi_l' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('evaluasi_tl') ?>">Pengukuran Tak Langsung</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'report' || $breadcrumbs == 'report_kinerja_cpmk_mahasiswa' || $breadcrumbs == 'report_mahasiswa' || $breadcrumbs == 'report_mata_kuliah' || $breadcrumbs == 'report_relevansi_ppm' || $breadcrumbs == 'report_efektivitas_cpl' || $breadcrumbs == 'report_epbm' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url('report') ?>"><i class="menu-icon ti-layers"></i>Laporan<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'report' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report') ?>">Kinerja CPL Mahasiswa</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_kinerja_cpmk_mahasiswa' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report/kinerja_cpmk_mahasiswa') ?>">Kinerja CPMK Mahasiswa</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_mahasiswa' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report/mahasiswa') ?>">Report Mahasiswa</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_mata_kuliah' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report/mata_kuliah') ?>">Report Matakuliah</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_relevansi_ppm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report/relevansi_ppm') ?>">Relevansi PPM</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_efektivitas_cpl' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report/efektivitas_cpl') ?>">Efektifitas CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'report_epbm' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('report/report_epbm') ?>">Report EPBM</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'data' || $breadcrumbs == 'data_cpmk' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect parent-item js__control" href="<?php echo site_url('data') ?>"><i class="menu-icon ti-layers"></i>Data<span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li <?php echo ($breadcrumbs == 'data' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('data') ?>">Data CPL</a>
						</li>
						<li <?php echo ($breadcrumbs == 'data_cpmk' ? ' class = "current"' : '') ?>>
							<a href="<?php echo site_url('data/data_cpmk') ?>">Data CPMK Mahasiswa</a>
						</li>
					</ul>
				</li>
				<li <?php echo ($breadcrumbs == 'logout' ? ' class = "current active"' : '') ?>>
					<a class="waves-effect" href="<?php echo site_url('Auth/logout') ?>"  onclick="return confirm('apakah anda ingin Keluar ?')"><i class="menu-icon"></i>Logout</a>
				</li>
			</ul>
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>


<!-- /.main-menu -->

<div class="fixed-navbar" <?php if ($breadcrumbs == 'kurikulum'){echo 'style="width: 3500px;"';} ?>>
	<div class="pull-left">
		<!-- <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button> -->
		<h1 class="page-title">DIPLOMACY: Sistem Asesmen OBE PS TIN</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<!-- /#message-popup -->
<div >
	<div class="main-content" <?php if ($breadcrumbs == 'kurikulum'){echo 'style="width: 3500px;"';} ?>>
		<?php $this->load->view($content); ?>

		<footer class="footer">
			<div class="row">
				<div class="col-lg-5 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2">2021 © Departemen Teknologi Industri Pertanian</li>
					</ul>
				</div>
				<div class="col-6 col-lg-1 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#">Privacy</a></li>
					</ul>
				</div>
				<div class="col-6 col-lg-1 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#">Terms</a></li>
					</ul>
				</div>
				<div class="col-6 col-lg-1 mb-3">
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#">Help</a></li>
					</ul>
				</div>
			</div>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->

<!-- Modal -->

<div class="modal fade" id="tambahCPMK" role="dialog" aria-labelledby="tambahCPMKLabel">
    <div class="modal-dialog" role="document">    
      <!-- Modal content-->
      	<div class="modal-content">
			<div class="modal-header">		
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tambahCPMKLabel">Tambah CPMK</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('inventory/checkin'); ?>">					
					<div class="form-group">
						<input type="hidden" id="cpmk_id" name="cpmk_id" />
						<label class="control-label col-sm-3">Kode</label>

						<div class="controls col-sm-9">
							<input type="text" name="kode" class="form-control" placeholder="Kode CPMK" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Capaian</label>
						<div class="controls col-sm-9">
							<textarea class="form-control" id="capaian_cpmk" placeholder="Capaian"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info btn-sm waves-effect waves-light">Simpan</button>
			</div>
      	</div>      
    </div>
</div>

<div class="modal fade" id="tambahMK" role="dialog" aria-labelledby="tambahMKLabel">
    <div class="modal-dialog" role="document">    
      <!-- Modal content-->
      	<div class="modal-content">
			<div class="modal-header">		
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tambahMKLabel">Tambah Mata Kuliah</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('inventory/checkin'); ?>">					
					<div class="form-group">
						<input type="hidden" id="mk_id" name="mk_id" />
						<label class="control-label col-sm-3">Kode</label>

						<div class="controls col-sm-9">
							<input type="text" name="kode" class="form-control" placeholder="Kode CPL" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Nama Mata Kuliah</label>

						<div class="controls col-sm-9">
							<input type="text" name="nama_mk" class="form-control" placeholder="Nama Mata Kuliah" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">SKS</label>

						<div class="controls col-sm-9">
							<input type="text" name="sks" class="form-control" placeholder="Jumlah SKS" required>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info btn-sm waves-effect waves-light">Simpan</button>
			</div>
      	</div>      
    </div>
</div>

	<script src="<?php echo base_url();?>assets/scripts/main.min.js"></script>

	<!-- Select2 -->
	<script src="<?php echo base_url();?>assets/Adminlte/plugins/select2/js/select2.full.min.js"></script>

	<script>

		
			
		function saveDeskriptor() {
			$("#formDeskriptor").submit();
		}

	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	    });
	  });
	</script>

<script>



  $(function () {
    //Initialize Select2 Elements
	$('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

</body>
</html>