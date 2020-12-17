<?= $this->extend('layout/defaultAdmin'); ?>

<?= $this->section('title');?>
  Home
<?= $this->endSection();?>

<?= $this->section('content'); ?> 
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  	User
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $user;?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  	Channel
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $channel;?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  	Chat Active
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $chat_active;?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comment fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  	Chat Nonactive
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $chat_nonactive;?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comment fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?= $this->endSection();?>