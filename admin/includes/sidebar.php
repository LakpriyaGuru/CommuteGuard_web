<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">

    <span class="brand-text font-weight-light">CommuteGuard | Admin </span>
  </a>
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php echo $_SESSION['adminName']; ?>
        </a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <?php if ($_SESSION['adminID'] == 1): ?>

          <!--Subadmins--->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Sub-Admins
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="subadminAdd.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="subadminManage.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>

          </ul>
        </li>
        <?php endif; ?>




        <!----- Tables--->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-life-ring"></i>
            <p>Drivers
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="driverAdd.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="driverManage.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="userAdd.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="userManage.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-child"></i>
            <p>Chldren
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="childAdd.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="childManage.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            <p>Schools
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="schoolAdd.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="schoolManage.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>Payments
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="paymentAdd.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="paymentManage.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>





        <li class="nav-item">
          <a href="shiftManage.php" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Shift
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="locationManage.php" class="nav-link">
            <i class="nav-icon fas fa-map"></i>
            <p>
              Location
            </p>
          </a>
        </li>













        <!--Profile--->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Account Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="profile.php" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="change-password.php" class="nav-link">
                <i class="fas fa-cog nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>