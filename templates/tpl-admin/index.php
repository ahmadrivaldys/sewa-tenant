<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/custom.css'); ?>">
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?php echo base_url('assets/images/admin/avatar.png'); ?>" width="30" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Halo, <?php echo $this->session->userdata('fullname'); ?></div></a>
                        
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo base_url('dashboard/logout'); ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand sidebar-logo">
                        <a href="index.html">
                            <img src="<?php echo base_url('assets/images/admin/logo.svg'); ?>" class="main-logo" alt="Logo Gandaria City">
                        </a>
                    </div>

                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="menu-header">Panel Utama</li>
                        <li <?php if($page_title == 'Dashboard') echo "class='active'"; ?>><a href="<?php echo base_url('dashboard'); ?>" class="nav-link"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                        <li class="menu-header">Menu</li>
                        <li <?php if($page_title == 'Kelola Transaksi') echo "class='active'"; ?>><a href="<?php echo base_url('dashboard/kelola-transaksi'); ?>" class="nav-link"><i class="far fa-file-alt"></i> <span>Transaksi</span></a></li>
                        <li <?php if($page_title == 'Kelola Tenant') echo "class='active'"; ?>><a href="<?php echo base_url('dashboard/kelola-tenant'); ?>" class="nav-link"><i class="fas fa-store"></i> <span>Tenant</span></a></li>
                        <li <?php if($page_title == 'Kelola Akun Admin' OR $page_title == 'Kelola Akun Pelanggan') echo "class='active'"; ?>>
                            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Akun Pengguna</span></a>
                            <ul class="dropdown-menu">
                                <li <?php if($page_title == 'Kelola Akun Admin') echo "class='active'"; ?>><a href="<?php echo base_url('dashboard/kelola-admin'); ?>">Admin</a></li> 
                                <li <?php if($page_title == 'Kelola Akun Pelanggan') echo "class='active'"; ?>><a href="<?php echo base_url('dashboard/kelola-pelanggan'); ?>">Pelanggan</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="p-3 mt-4 mb-4 hide-sidebar-mini">
                    
                    <a href="documentation.html" class="btn btn-primary btn-lg btn-icon-split btn-block">
                        <i class="far fa-question-circle"></i> <div>Documentation</div>
                    </a>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Sewa Tenant</h1>

                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><?php echo $page_title; ?></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title"><?php echo $page_title; ?></h2>
                        <p class="section-lead"><?php echo $page_subtitle; ?></p>
                        
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $content_title; ?></h4>
                            </div>
                            
                            <div class="card-body p-0">
                                <?php echo $content; ?>
                            </div>

                            <div class="card-footer bg-whitesmoke">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            <footer class="main-footer">
                <?php $copyright_year = ''; date('Y') == 2021 ? $copyright_year = date('Y') : $copyright_year = '2021-' . date('Y'); ?>
                <div class="footer-left">
                    Copyright &copy; <?php echo $copyright_year; ?> <div class="bullet"></div> <a href="#">Ari Adrian</a>
                </div>
            </footer>
        </div>
    </div>
    

    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/popper/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/moment.js/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/stisla.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/scripts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/custom.js'); ?>"></script>
</body>
</html>