<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= csrf_meta() ?>
    
    <link rel="icon" href="<?= base_url('/assets/images/logo.png');?>" type="image/x-icon"/>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/assets/images/logo.png');?>" />

    <title>Home</title>

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

    <link rel="stylesheet" href="<?= base_url('/assets/css/animate.min.css');?>" />

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
  <div class="container-fluid" 
    style="background-image: linear-gradient(rgba(255,0,215,107), #0f3450)">
    <div class="row p-5">
      <div class="text-white text-center col-lg-6 col-md-6 col-xl-6 col-sm-12">      
         <img src="<?= base_url('assets/landing/img/phone.jpg');?>" height="550px" alt=""            
            style="border-radius:10px;transform:rotate(-3deg);margin-bottom:20px;box-shadow:0px 0px 5px -1px lightgray"
            class="animated headShake">
      </div>

      <div class="text-white col-lg-6 col-md-6 col-xl-6 col-sm-12 pt-5">      
       <h2 class="animated bounce">
        Chating Dengan Teman-Teman Dan
         Keluarga Lebih Nyamana Dan Aman 
       </h2>

       <p class="animated rollIn">
        Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus
       </p>  

       <?php if(!session('user')){ ?>
        <p class="animated rollIn">
          <button class="btn btn-primary mb-2"
            onclick="window.location='<?= base_url('/signin');?>'">Masuk Sekarang</button> 
          <button class="btn btn-primary mb-2"
            onclick="window.location='<?= base_url('/signup');?>'">Daftar Sekarang</button>
        </p>
        <?php }else{ ?>
        <p class="animated rollIn">
          <button class="btn btn-primary mb-2"
            onclick="window.location='<?= base_url('/user');?>'">
            Dashboard
          </button>
        </p>
        <?php } ?>
      </div>    
    </div>
  </div>

  <div class="container-fluid bg-light">
    <div class="row p-5">
      <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12 text-center">
        <i class="fa fa-trash"></i>
        <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus.</p>
      </div>
      <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12 text-center">
        <i class="fa fa-globe"></i>
        <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus.</p>
      </div>
      <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12 text-center">
        <i class="fa fa-laptop"></i>
        <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus.</p>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-xl-7 col-md-7 col-lg-7 col-sm-12 text-center">
        <img src="<?= base_url('assets/landing/img/tablet.png');?>" alt="" class="img-fluid">
      </div>
      <div class="col-xl-5 col-md-5 col-lg-5 col-sm-12">
         <h2 class="mb">Responsive Desain</h2>
          <p>Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta.</p>
          <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus.</p>
          <p>Mellentesque habitant morbi tristique senectus et netus et malesuada famesac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Dummy text of the printing and typesetting.</p>
         <?php if(!session('user')){ ?>
         <p class="animated rollIn">
            <button class="btn btn-primary mb-2"
              onclick="window.location='<?= base_url('/signin');?>'">Masuk Sekarang</button> 
            <button class="btn btn-primary mb-2"
              onclick="window.location='<?= base_url('/signup');?>'">Daftar Sekarang</button>
          </p>
          <?php }else{ ?>
          <p class="animated rollIn">
            <button class="btn btn-primary mb-2"
              onclick="window.location='<?= base_url('/user');?>'">
              Dashboard
            </button>
          </p>
          <?php } ?>
      </div>
    </div>
  </div>

  <div class="container-fluid bg-light">
    <div class="row p-5">
      <div class="col-12 text-center mb-5">
        <h2>Pertanyaan yang sering diajukan</h2>
      </div>

      <div class="col-md-6">
        <h4>Dummy text of the printing</h4>
        <p>Mellentesque habitant morbi tristique senectus et netus et malesuada famesac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Dummy text of the printing and typesetting.</p>
        <h4 class="mt">Mellentesque habitant morbi </h4>
        <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus.</p>
      </div>
    
      <div class="col-md-6">
        <h4>Dummy text of the printing</h4>
        <p>Mellentesque habitant morbi tristique senectus et netus et malesuada famesac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Dummy text of the printing and typesetting.</p>
        <h4 class="mt">Mellentesque habitant morbi </h4>
        <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown ristique senectus et netus.</p>
      </div>    
    </div>
  </div>
</body>
</html>