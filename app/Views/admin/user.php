<?= $this->extend('layout/defaultAdmin'); ?>

<?= $this->section('title');?>
  User
<?= $this->endSection();?>

<?= $this->section('content'); ?> 
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">User</h1>

  <div class="row">
    <div class="card card-body border-0">
      <div class="clearfix mb-3">
        <div class="float-right" style="width:200px">
          <form action="<?= base_url('admin/user');?>" method="get">
            <input type="text" name="search" class='form-control' placeholder="Search . . .">
          </form>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <td><b>Id</b></td>
            <td><b>Photo</b></td>
            <td><b>Username</b></td>
            <td><b>Email</b></td>        
            <td><b>Dibuat</b></td>
            <td><b>Opsi</b></td>
          </tr>
          <?php foreach($user as $key => $item){ ?>
            <tr>
              <td><?= $item['id'];?></td>
              <td>
                <img src="<?= base_url('assets/images/users/'.$item['photo']);?>" width="100px"/>
              </td>
              <td><?= $item['username'];?></td>
              <td><?= $item['email'];?></td>
              <td><?= $item['created_at'];?></td>
              <td>
                <?php if($item['role'] != "admin"){ ?>
                  <button class="btn btn-success"
                    onclick="editUser('<?= $item['id'];?>','<?= $item['username'];?>','<?= $item['email'];?>')" data-toggle="modal" data-target="#editModal">Edit</button>            
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
          <?php if(count($user) == 0){ ?> 
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-user" method="post" action="<?= base_url('/admin/edit-user');?>">
            <?= csrf_field();?>
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="exampleInputUsername1"
                  class="text-mode">Username</label>
                <input type="text" name="username" class="form-control input-ci-chat" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Masukan Username" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1"
                class="text-mode">Email</label>
              <input type="email" name="email" class="form-control input-ci-chat" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1"
                class="text-mode">Password</label>
              <input type="password" name="password" class="form-control input-ci-chat" id="exampleInputPassword1" placeholder="Masukan Password Jika Ingin Menganti">         
              <div class="text-muted small">Masukan password jika ingin menganti password</div>
            </div>                  
            <button type="submit" class="btn btn-primary"
              id="button-user">Kirim</button>
          </form>
        </div>    
      </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('sc_footer')?>
<script>
$("#form-user").parsley().on('form:validate',function(){
  if(this.isValid()){
    $("#button-user").attr("disabled",true);
  }else{
    toastr.warning("Sepertinya ada data yang belum valid","");
  }  
});

function editUser(id,username,email){
  $("input[name=id]").val(id);
  $("input[name=username]").val(username);
  $("input[name=email]").val(email);
}
</script>
<?= $this->endSection();?>