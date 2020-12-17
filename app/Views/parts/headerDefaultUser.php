<!-- HEADER DEKSTOP -->
<div class="header py-3 fixed-top" 
  style="background:white;box-shadow: 0px 0px 5px -1px lightgray;">
  <div class="container">
    <div class="d-flex">
      <a class="header-brand" 
        href="<?= base_url('/user');?>">
        <img src="<?= base_url('/assets/images/logo-header.png');?>"
          style="height:30px">                
      </a>      

      <div class="d-flex ml-auto">
        <div class="nav-item flex-row mr-3"
          style="cursor:pointer"
          onclick="onChangeMode(localStorage.getItem('mode-ci-chat') != 'dark' ? 'dark' : 'light')"
          id="mode-ci-chat">
          <span class="text-mode"
            style="font-size:13px">
            <i class="fa fa-moon"></i> Dark Mode
          </span>                  
        </div>    
                
       <div class="nav-item flex-row mr-3 d-none d-xl-block d-lg-block d-md-block d-sm-none"
        style="cursor:pointer"
        onclick="window.location='<?= base_url('/add-channel');?>'">
        <span class="text-mode"
          style="font-size:13px">
          <i class="fa fa-plus"></i> Tambah Chat
        </span>
       </div>

       <div class="nav-item flex-row mr-3 d-none d-xl-block d-lg-block d-md-block d-sm-none"
        style="cursor:pointer"
        onclick="window.location='<?= base_url('/profil');?>'">
        <span class="text-mode"
          style="font-size:13px">
          <i class="fa fa-user"></i> Profil
        </span>
       </div>

       <div class="nav-item flex-row mr-3 d-none d-xl-block d-lg-block d-md-block d-sm-none"
        style="cursor:pointer"
        onclick="window.location='<?= base_url('logout');?>'">
        <span class="text-mode"
          style="font-size:13px">
          <i class="fa fa-power-off"></i> Keluar
        </span>
       </div>

       <div class="nav-item flex-row mr-3 d-block d-xl-none d-lg-none d-md-none d-sm-block"        
        onclick="onNavbarMobileShow()">
        <span class="text-mode"
          style="font-size:13px">
          <i class="fa fa-align-right"></i>
        </span>
       </div>
      </div>
    </div>
  </div>
</div>   
<!-- HEADER DEKSTOP -->

<!-- NAVBAR MOBILE -->
<div id="navbar-mobile">
  <div class="container-fluid">
    <div class="row">
      <div class="col-3" 
        style="background:black;opacity:0.5;text-align:center;padding:10px">
        <span class="fa fa-window-close" 
          style="font-size:30px;color:white;cursor:pointer" 
          onclick="onNavbarMobileHide()"></span>
      </div>

      <div class="col-9 p-3" 
        id="menu-navbar-mobile"
        style="height:100vh">
          <ul class="nav nav-tabs border-0 flex-column">
            <li class="nav-item">
              <a href="<?= base_url('/add-channel');?>" class="nav-link text-mode">
                <i class="fa fa-plus"></i> Tambah Chat
              </a>
            </li>

            <li class="nav-item mt-n5">
              <a href="<?= base_url('/profil');?>" class="nav-link text-mode">
                <i class="fa fa-user"></i> Profil
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link text-mode" 
                onclick="window.location='<?= base_url('logout');?>'">
                <i class="fa fa-power-off"></i> Keluar
              </a>
            </li>      
          </ul>       
      </div>
    </div>
  </div>
</div>
<!-- NAVBAR MOBILE -->

<style>
#navbar-mobile{
  position:fixed;
  top:0px;
  bottom:0px;
  z-index:999999;
  width:100%;
  height:100%;
  display: none;
}
</style>

<script>
function onNavbarMobileShow(){
  $("#navbar-mobile").show();
}

function onNavbarMobileHide(){
  $("#navbar-mobile").hide();
}

function onNavbarProfilMobile(){
  let display = $("#navbar-profil-mobile").css("display");

  if(display == "none"){  
    $("#navbar-profil-mobile").show();
  }else{
    $("#navbar-profil-mobile").hide();
  }
}
</script>