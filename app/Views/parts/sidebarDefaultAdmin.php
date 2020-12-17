<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin');?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Ci Chat</div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin');?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/user');?>">
      <i class="fa fa-user"></i>
      <span>User</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/chat');?>">
      <i class="fa fa-comment"></i>
      <span>Chat</span>
    </a>
  </li>

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>