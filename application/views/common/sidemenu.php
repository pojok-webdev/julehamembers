<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ($_SESSION['memberlevel']==='2')?'Member':'Admin';?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if($_SESSION['memberlevel']<2){?>
            <li class="nav-item menu-open">
            <a href="/members/index" class="nav-link  <?php echo $active['list'];?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Daftar Anggota
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
          </li>
          <?php }?>
          <li class="nav-item menu-open">
            <a href="/members/profile" class="nav-link <?php echo $active['profile'];?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Profil Anggota
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
