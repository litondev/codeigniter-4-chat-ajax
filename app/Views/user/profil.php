<?= $this->extend('layout/defaultUser'); ?>

<?= $this->section('title');?>
	Profil
<?= $this->endSection();?>

<?= $this->section('content'); ?>		
<div class="container" 
	style="margin-top:80px;margin-bottom:30px">        
   <div class="row">
		<div class="col-lg-6 col-md-6 col-xl-6 col-sm-12 content text-center p-4">
			<img 	
				src="<?= base_url('/assets/images/users/'.session('user')['photo']);?>" 
				class="img-fluid"/>

			<form id="form-photo" method="post" 
				action="<?= base_url('/edit-profil-photo');?>"
				class="p-3" enctype="multipart/form-data">
				<?= csrf_field();?>

				<input type="file" name="photo"
					onchange="onChangePhoto(event)"
					class="input-ci-chat mb-2"
					required>

				<button class="btn btn-primary"
					id="button-photo">Kirim</button>
			</form>
		</div>

		<div class="col-lg-6 col-md-6 col-xl-6 col-sm-12 content p-4">
			<h5 class="text-mode">Data Profil</h5>

			<form id="form-data" method="post" action="<?= base_url('/edit-profil-data');?>">
		    	<?= csrf_field();?>
		    	<div class="form-group">
		      		<label for="exampleInputUsername1"
		      			class="text-mode">Username</label>
			      	<input type="text" name="username" class="form-control input-ci-chat" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Masukan Username" required
		      			value="<?= session('user')['username'];?>">    
		    		</div>
			  	<div class="form-group">
				    <label for="exampleInputEmail1"
				    	class="text-mode">Email</label>
			    	<input type="email" name="email" class="form-control input-ci-chat" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email" required
				    	value="<?= session('user')['email'];?>">		
			  	</div>
			  	<div class="form-group">
				    <label for="exampleInputPassword1"
				    	class="text-mode">Password</label>
			    	<input type="password" name="password" class="form-control input-ci-chat" id="exampleInputPassword1" placeholder="Masukan Password Jika Ingin Menganti">			   
			  	</div>			
			  	<div class="form-group">
			  		<label for="exampleInputPasswordConfirm1"
			  			class="text-mode">Password Confirm</label>
			  		<input type="password" name="password_confirm" class="form-control input-ci-chat" id="exampleInputPasswordConfirm1" placeholder="Masukan Password Confirm" required>
			  	</div>
			  	<button type="submit" class="btn btn-primary"
				  	id="button-data">Kirim</button>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection();?>

<?= $this->section("sc_footer");?>
<script>
$("#form-data").parsley().on('form:validate',function(){
  if(this.isValid()){
    $("#button-data").attr("disabled",true);
  }else{
    toastr.warning("Sepertinya ada data yang belum valid","");
  }  
});

$("#form-photo").parsley().on('form:validate',function(){
	if(this.isValid()){
    	$("#button-photo").attr("disabled",true);
	}else{
	    toastr.warning("Sepertinya ada data yang belum valid","");
	}
});

function onChangePhoto(evt){
    let target = evt.target.files[0]

    if(target){
        let type = target["type"];
        let size = target["size"];

        if(size > 10000000){
          document.getElementById("form-photo").reset();       
          toastr.warning("Maaf ukuran file sudah melebihi 10 mb","");
        }else if(type == "image/png" || type == "image/jpg" || type == "image/jpeg" || type == "image/gif"){
        }else{
          toastr.warning("Maaf file harus gambar","");
          document.getElementById("form-photo").reset();       
        }
    }
}
</script>
<?= $this->endSection();?>