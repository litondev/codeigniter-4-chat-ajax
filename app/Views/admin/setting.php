<?= $this->extend('layout/defaultAdmin'); ?>

<?= $this->section('title');?>
  Setting
<?= $this->endSection();?>

<?= $this->section('content'); ?> 
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Setting</h1>

  <div class="card card-body border-0">
  	<form id="form-setting" method="post" action="<?= base_url('admin/setting');?>">
	  <?= csrf_field();?>
	  <div class="form-group">
	    <label for="exampleInputSiteName1">Nama Server</label>
	    <input type="text" name="site_name" class="form-control" id="exampleInputSiteName1" aria-describedby="siteNameHelp" placeholder="Masukan Nama Webiste" required
	    	value="<?= $_ENV['app.site_name'];?>">		
	  </div>
	  <div class="form-group">
	    <label for="exampleInputIntervalChannelAjax1">Interval Channel Ajax</label>
	    <input type="number" name="interval_channel" class="form-control" id="exampleInputIntervalChannelAjax1" placeholder="Masukan Interval Channel" required
	    	value="<?= $_ENV['app.interval_channel'];?>">			  
	    <div class="text-muted small">Satuan Detik</div>
	  </div>				  
	  <div class="form-group">
	    <label for="exampleInputIntervalChatAjax1">Interval Chat Ajax</label>
	    <input type="number" name="interval_chat" class="form-control" id="exampleInputIntervalChatAjax1" placeholder="Masukan Interval Chat" required
	    	value="<?= $_ENV['app.interval_chat'];?>">			   
	   	<div class="text-muted small">Satuan Detik</div>
	  </div>
	  <button type="submit" class="btn btn-primary" id="button-setting">Kirim</button>	
	</form>
  </div>
</div>
<?= $this->endSection();?>

<?= $this->section('sc_footer');?>
<script>
$("#form-setting").parsley().on('form:validate',function(){
  if(this.isValid()){
    $("#button-setting").attr("disabled",true);
  }else{
    toastr.warning("Sepertinya ada data yang belum valid","");
  }  
});
</script>
<?= $this->endSection();?>