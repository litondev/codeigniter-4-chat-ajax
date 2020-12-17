<?= $this->extend('layout/empty'); ?>

<?= $this->section('title');?>
	Masuk
<?= $this->endSection();?>

<?= $this->section('content'); ?>		
	<div style="margin:auto;max-width:400px"
		class="mt-5 mb-5">				
    
		<div id="logo" 
      style="max-width: 120px;margin:auto"></div> 			

		<div class="container-fluid pt-4 pb-4"
			style="border:1px solid white;border-top:3px solid rgba(255,0,215,107);border-radius:5px;border-bottom:3px solid rgba(255,0,215,107);border-left:5px solid white;border-right:5px solid white">
			<form id="form-signin" method="post" action="<?= base_url('/signin');?>">
        <?= csrf_field();?>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email" required>		
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan Password" required>			   
			  </div>				  
			  <button type="submit" class="btn btn-primary"
			  	id="button-signin"
			  	style="background:rgba(255,0,215,107);border:0px">Masuk</button>
			</form>

			<div class="mt-4">
				<a href="<?= base_url('/signup');?>">Belum Punya Akun</a>
			</div>
		</div>
	</div>
<?= $this->endSection();?>

<?= $this->section("sc_footer");?>
<script>
new Vivus('logo', {
  file: "<?= base_url('assets/images/logo.svg');?>",
  type: 'oneByOne',
},function(){      	      	
	setTimeout(function(){
		document.getElementById('path1125').style = "opacity:1;fill:#ff00d7;fill-opacity:0.42140473;fill-rule:evenodd;stroke:#fffbfb;stroke-width:3.80162787;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:markers fill stroke";
	},500);

	setTimeout(function(){
		document.getElementById('path1125-5').style = "opacity:1;fill:#c738b0;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:3.19099998;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.60869565;paint-order:markers fill stroke";
	},1000);

	setTimeout(function(){
		document.getElementById('path1125-1').style = "opacity:1;fill:#ff00d7;fill-opacity:0.42140473;fill-rule:evenodd;stroke:#fffbfb;stroke-width:3.80162787;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:markers fill stroke";
	},1500);

	setTimeout(function(){
		document.getElementById('path1125-5-1').style = "opacity:1;fill:#c738b0;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:3.19099998;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:0.60869565;paint-order:markers fill stroke";
	},2000);

	setTimeout(function(){
		document.getElementById('path1384').style.display = "block";
	},2500);
});

$("#form-signin").parsley().on('form:validate',function(){
  if(this.isValid()){
    $("#button-signin").attr("disabled",true);
  }else{
    toastr.warning("Sepertinya ada data yang belum valid","");
  }  
});
</script>
<?= $this->endSection();?>