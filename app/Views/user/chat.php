<?= $this->extend('layout/defaultUser'); ?>

<?= $this->section('title');?>
  Chat
<?= $this->endSection();?>

<?= $this->section('content'); ?>   
<div class="container-fluid">
  <div class="row">
    <?= $this->include('parts/sidebarDefaultUser'); ?>

    <div class="col-lg-9 col-12 offset-lg-3"
      style="margin-top:70px;margin-bottom:30px">            
      <?= $this->include('user/chat/initial-page.php');?>

      <?= $this->include('user/chat/dekstop-content-chat');?> 

      <?= $this->include('user/chat/mobile-channel-chat');?>
   
      <?= $this->include('user/chat/mobile-content-chat');?>
    </div>
  </div>
</div>
<?= $this->endSection();?>