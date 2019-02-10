<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= APPNAME ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?= ASSETS ?>css/custom.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= ASSETS ?>css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= ASSETS ?>images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?= site_url() ?>">
          <img src="<?= ASSETS ?>images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?= ASSETS ?>index.html">
          <img src="<?= ASSETS ?>images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a href="<?= base_url() ?>" class="nav-link">Dashboard
              <!-- <span class="badge badge-primary ml-1">New</span> -->
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?= getuserlogin('username') ?> !</span>
              <i class="mdi mdi-account-box" style="font-size: 35px"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" style="cursor: pointer" id="btnsignout">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">      
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <i class="mdi mdi-account-box" style="font-size: 35px"></i>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?= getuserlogin('username') ?></p>
                  <div>
                    <small class="designation text-muted"><?= getuserlogin('email') ?></small>
                    <!-- <span class="status-indicator online"></span> -->
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url() ?>">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <?php if(isAdmin()){ ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-account-circle"></i>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('user/adduser') ?>">Add User</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('user/userlist') ?>">User List</a>
                  </li>
                </ul>
              </div>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#unit" aria-expanded="false" aria-controls="unit">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">Units</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="unit">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link" href="<?= site_url('user/addunit') ?>">Add Unit</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= site_url('user/unitlist') ?>">Unit List</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
