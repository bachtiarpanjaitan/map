<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= APPNAME ?></title>
  <!-- plugins:css -->
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
	 rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/fontawesome/css/font-awesome.min.css">
  	<link rel="stylesheet" href="<?= ASSETS ?>vendors/themify-icons/themify-icons.min.css">
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?= ASSETS ?>css/custom.css">
  <link rel="stylesheet" href="<?= ASSETS ?>vendors/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
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
              <a class="dropdown-item" style="cursor: pointer" href="<?= site_url('user/changepassword') ?>">
                Change Password
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
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#blok" aria-expanded="false" aria-controls="blok">
                <i class="menu-icon mdi mdi-city"></i>
                <span class="menu-title">Blok</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="blok">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('user/addblok') ?>">Add Blok</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('user/bloklist') ?>">BLok List</a>
                  </li>
                </ul>
              </div>
            </li>
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
            <?php if(getuserlogin('allowapproverequest') == true){ ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#approval" aria-expanded="false" aria-controls="unit">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Approval</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="approval">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('user/approvallist') ?>">Request List</a>
                  </li>
                </ul>
              </div>
            </li>
            <?php } ?>
          <?php } ?>
          
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#request" aria-expanded="false" aria-controls="unit">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">Request</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="request">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link" href="<?= site_url('user/addrequest') ?>">Add Request</a>
                </li>
                <?php if(isCustomer()){ ?>
                  <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('user/customerrequestlist') ?>">My Unit Request</a>
                  </li>
                <?php }else{ ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('user/listrequestdetail') ?>">Request List</a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
