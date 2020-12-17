<?= $this->extend('layout/defaultAdmin'); ?>

<?= $this->section('title');?>
  Chat
<?= $this->endSection();?>

<?= $this->section('content'); ?> 
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Chat</h1>

  <div class="row">
    <div class="card card-body border-0">
      <div class="clearfix mb-3">
        <div class="float-right" style="width:200px">
          <form action="<?= base_url('admin/chat');?>" method="get">
            <input type="text" name="search" class='form-control' placeholder="Search . . .">
          </form>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <td><b>Id</b></td>
            <td><b>Channel Id</b></td>
            <td><b>Pengirim</b></td>
            <td><b>Penerima</b></td>        
            <td><b>Pesan</b></td>
            <td><b>Dibuat</b></td>
            <td><b>Status</b></td>
          </tr>
          <?php foreach($chat as $key => $item){ ?>
            <tr>
              <td><?= $item['id'];?></td>
              <td><?= $item['channel_id'];?></td>
              <td><?= $item['sender_username'];?></td>
              <td><?= $item['accepter_username'];?></td>
              <td>
                <?php if($item['type'] == "image"){ ?>
                  <img src="<?= base_url('assets/files/'.$item['message']);?>"
                      width="200px"/>
                <?php }else if($item['type'] == "file"){ ?>
                  <a href="<?= base_url('assets/files/'.$item['message']);?>"
                      target="_blank">File</a>
                <?php }else{ ?>
                  <?= $item['message'];?>
                <?php } ?>
              </td>
              <td><?= $item['created_at'];?></td>
              <td>
                <?php if($item['status'] == 'active'){ ?>
                  <button class="btn btn-danger"
                    onclick="window.location='<?= base_url('admin/chat-status/'.$item['id']);?>'">Nonactivekan</button>
                <?php } ?>

                <?php if($item['status'] == 'nonactive'){ ?>
                  <button class="btn btn-success"
                    onclick="window.location='<?= base_url('admin/chat-status/'.$item['id']);?>'">Activekan</button>
                <?php }?>
              </td>    
            </tr>
          <?php } ?>
          <?php if(count($chat) == 0){ ?> 
            <tr>
              <td colspan="10" class="text-center">
                <h3>Data Tidak Ditemukan</h3>
              </td>
            </tr>
          <?php } ?>          
        </table>
      </div>

      <div class="clearfix">
        <div class="float-left">
          <?= $pager->links('query','bootstrap_pagination');?>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection();?>