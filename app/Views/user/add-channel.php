<?= $this->extend('layout/defaultUser'); ?>

<?= $this->section('title');?>
  Tambah Chat
<?= $this->endSection();?>

<?= $this->section('content'); ?> 
<div class="container" 
	style="margin-top:80px;margin-bottom:30px">        
   <div class="row content p-4">  
   		<div class="col-12 mb-4">
   			<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text" 
			    	id="basic-addon1">
			    	Cari
			    </span>
			  </div>

			  <input type="text" class="form-control input-ci-chat" 
   				placeholder="Cari Username Atau Email . . ."
   				onkeyup="createChannel.searchUser(event)"/>			
   			</div>   		
   		</div>

   		<div class="col-12 text-center text-mode"
   			id="start-create">
   			<img src="<?= base_url('assets/images/create-channel.png');?>"
   				class="img-fluid">
   			<h5>Buat channel sekarang</h5>
   			<p>
   				Buat channel chat sekarang
   			</p>
   		</div>
   	
   		<div class="col-12"
   			id="search-content"
   			style="display:none">   			   			 		   			   		
   		</div>   		
   </div>
</div>
<?= $this->endSection();?>

<?= $this->section("sc_footer");?>
<script>
const createChannel = {
	data : {
		data : [],
	},

	renderSearch : function(){
		$("#search-content > .list-user").remove();
		
		if(this.data.data.length){
      		var html = ``;
      		var mode = localStorage.getItem('mode-ci-chat');

      		for(i=0;i<this.data.data.length;i++){
      			html += `<div class="d-flex flex-row mt-3 mb-3 list-user text-mode"
      				style="${mode == 'light' ? 'color:black' : 'color:white'}">
	   				<div>
	   					<img src="<?= base_url('/assets/images/users/');?>/${this.data.data[i].photo}"
	   						width="100px">
	   				</div>
	   				
	   				<div class="d-flex flex-column ml-3">
	   					<div style="font-size:15px">
   							${this.data.data[i].username}
	   					</div>
	   					<div style="font-size:12px">
	   						${this.data.data[i].email}
	   					</div>
	   					<div style="font-size:12px">
	   						Dibuat Pada ${this.data.data[i].created_at}
	   					</div>   					
	   					<div class="mt-3">
	   						 <button class="btn btn-primary"
	   						 	id="list-user-${this.data.data[i].id}"
	   						 	onclick="createChannel.create('${this.data.data[i].id}')">
	   							Buat Channel
	   						</button>   
	   					</div>
	   				</div>   			  	
	   			</div>`;
	   		}

			$("#start-create").hide();
			$("#search-content").show();
			$("#search-content").append(html);
		}else{
			$("#start-create").show();
			$("#search-content").hide();
		}
	},

	searchUser : function(evt){
		var self = this;

		$.ajax({
			method : "get",
			url : "<?= base_url('/get-user');?>?search="+evt.target.value,
			success : function(res){
				self.data.data = res.data;
				self.renderSearch();
			},
			error  : function(err){
				console.log("Terjadi Kesalahan")
			}
		})		
	},

	create : function(id){
		$("#list-user-"+id).html("<i class='fa fa-spinner fa-spin'></i>");

		$.ajax({			
			method : "post",
			url : "<?= base_url('/create-channel');?>/"+id,
			success : function(res){
				toastr.success('Berhasil membuat channel');
				window.location = "<?= base_url('/user');?>";
			},
			error : function(err){
				toastr.error('Gagal membuat channel');
				console.log("Terjadi Kesalahan");
			}
		});
	}
}
</script>
<?= $this->endSection();?>