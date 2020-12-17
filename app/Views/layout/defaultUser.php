<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= csrf_meta() ?>
    
    <link rel="icon" href="<?= base_url('/assets/images/logo.png');?>" type="image/x-icon"/>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/assets/images/logo.png');?>" />

    <title><?= $this->renderSection('title'); ?> </title>

    <script src="<?= base_url('/assets/js/jquery.min.js');?>"></script>
  
    <script src="<?= base_url('/assets/js/popper.min.js');?>"></script>
    
    <script src="<?= base_url('/assets/js/bootstrap.min.js');?>"></script>

    <script src="<?= base_url('/assets/js/toastr.min.js');?>"></script>

    <script src="<?= base_url('/assets/js/parsley.min.js');?>"></script>

    <script src="<?= base_url('/assets/js/i18n/id.js');?>"></script>

    <script src="<?= base_url('/assets/js/fontawesome.min.js');?>"></script>

    <script src="<?= base_url('/assets/js/sweetalert2.js');?>"></script>

    <script src="<?= base_url('/assets/js/vivus.min.js');?>"></script>
    
    <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css');?>" />

    <link rel="stylesheet" href="<?= base_url('/assets/css/toastr.min.css');?>" />

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
<body>
  <?= $this->include('parts/headerDefaultUser'); ?>

  <?= $this->renderSection('content'); ?>

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

  <script>
    function onChangeMode(mode = false){                  
       if(!mode){   
          $("#navbar-mobile").css({"background" : "white"});
          $(".input-ci-chat").css({"color" : "black",'background' : 'white','border' : '1px solid lightgray'});
          $("#mode-ci-chat").html('<span class="text-mode" style="font-size:13px"> <i class="fa fa-moon"></i> Dark Mode </span>')
          $(".text-mode").css({"color" : "#000000"});
          $(".header,#sidebar,.content").css({"background" : "white"});
          $("body").css({"background" : '#f5f7fb'});
          localStorage.setItem('mode-ci-chat','light');    
        }else{
          if(mode == 'dark'){
            $("#navbar-mobile").css({"background" : "#333333"});
            $(".input-ci-chat").css({"color" : "white",'background' : '#333333','border' : '1px solid #333333'});
            $("#mode-ci-chat").html('<span class="text-mode" style="font-size:13px"> <i class="fa fa-sun"></i> Dark Mode</span>')
            $(".text-mode").css({"color" : "white"});
            $(".header,#sidebar").css({"background" : "#000000"});
            $(".content").css({"background" : "#000000"});
            $("body").css({"background"  : "#000000"});
          }else{
            $("#navbar-mobile").css({"background" : "white"});
            $(".input-ci-chat").css({"color" : "black",'background' : 'white','border' : '1px solid lightgray'});
            $("#mode-ci-chat").html('<span class="text-mode" style="font-size:13px"> <i class="fa fa-moon"></i> Dark Mode </span>')
            $(".text-mode").css({"color" : "#000000"});
            $(".header,#sidebar,.content").css({"background" : "white"});
            $("body").css({"background" : '#f5f7fb'});
          }            
          
          localStorage.setItem('mode-ci-chat',mode);
        }
    }

    onChangeMode(localStorage.getItem('mode-ci-chat'));
  </script>

	<?= $this->renderSection('sc_footer');?>
</body>
</html>