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
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?php echo base_url('assets/images/admin/avatar.png'); ?>" width="30" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Halo, <?php echo $this->session->userdata('fullname'); ?></div>
                            <span class="badge badge-light usertype-label"><?php echo $this->session->userdata('usertype'); ?></span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item has-icon">
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
                        <?php echo $sidebar; ?>
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

                        <?php if($page_title == 'Tambah Tenant'
                              OR $page_title == 'Sunting Tenant'
                              OR $page_title == 'Tambah Admin'
                              OR $page_title == 'Sunting Admin'): ?>

                            <div class="section-header-back">
                                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        <?php endif; ?>

                        <h1>Sewa Tenant</h1>

                        <?php if($page_title == 'Kelola Tenant' OR $page_title == 'Kelola Akun Admin'): ?>
                            <?php
                                if($page_title == 'Kelola Tenant')
                                {
                                    $url_add_new = base_url('dashboard/tambah-tenant');
                                }
                                else
                                {
                                    $url_add_new = base_url('dashboard/tambah-admin');
                                }
                            ?>

                            <div class="section-header-button">
                                <a href="<?php echo $url_add_new; ?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a>
                            </div>
                        <?php endif; ?>

                        
                        <?php if($page_title == 'Kelola Transaksi' AND $usertype = $this->session->userdata('usertype') == 'Customer'): ?>
                            <?php $url_add_leasing = base_url('dashboard/ajukan-sewa'); ?>

                            <div class="section-header-button">
                                <a href="<?php echo $url_add_leasing; ?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Ajukan Sewa</a>
                            </div>
                        <?php endif; ?>

                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><?php echo $page_title; ?></div>
                        </div>
                    </div>

                    <!-- Flash Alert -->
                    <?php if($this->session->flashdata('add-tenant-succeeded')): ?>
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                <?php echo $this->session->flashdata('add-tenant-succeeded'); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('add-tenant-failed')): ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                <?php echo $this->session->flashdata('add-tenant-failed'); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Content -->
                    <div class="section-body">
                        <h2 class="section-title"><?php echo $page_title; ?></h2>
                        <p class="section-lead"><?php echo $page_subtitle; ?></p>
                        
                        <?php echo $content; ?>
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