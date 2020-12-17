<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">

  <meta name="author" content="">

  <link rel="icon" href="<?= base_url('/assets/images/logo.png');?>" type="image/x-icon"/>

  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/assets/images/logo.png');?>" />

  <link href="<?= base_url('assets/admin/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">

  <link href="<?= base_url('assets/admin/css/sb-admin-2.min.css');?>" rel="stylesheet">
  
  <link rel="stylesheet" href="<?= base_url('/assets/css/toastr.min.css');?>" />

  <?= csrf_meta() ?>

  <title><?= $this->renderSection('title'); ?> </title>

  <?= $this->renderSection('sc_header');?>

  <style>
     .parsley-errors-list{
      color:red;
      list-style:none;
      padding:8px;
      opacity: 0.8;
     }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
  	<?= $this->include('parts/sidebarDefaultAdmin');?>

    <div id="content-wrapper" class="d-flex flex-column">      
      <div id="content">
      	<?= $this->include('parts/navbarDefaultAdmin');?>   
  		  <?= $this->renderSection('content'); ?>     
      </div>   
    </div>
  </div>
  
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?= base_url('assets/admin/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?= base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
  <script src="<?= base_url('assets/admin/js/sb-admin-2.min.js');?>"></script>
  <script src="<?= base_url('/assets/js/toastr.min.js');?>"></script>
  <script src="<?= base_url('/assets/js/parsley.min.js');?>"></script>
  <script src="<?= base_url('/assets/js/i18n/id.js');?>"></script>
  
  <?php 
  if(session('fallback')){
    if(session("fallback")["message"] == "success"){
      ?>
      <script>
        toastr.success("","<?= session('fallback')['success'];?>");
      </script>
      <?php
    }

    if(session('fallback')['message'] == "failed"){
      ?>
        <script>
          toastr.error("<?= session('fallback')['failed'];?>","Terjadi Kesalahan");
        </script>
      <?php
    }
  }
  ?>

  <?= $this->renderSection('sc_footer');?>
</body>
</html>