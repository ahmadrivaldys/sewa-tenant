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
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-selectric/selectric.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css'); ?>">
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

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <?php echo $sidebar_menu; ?>
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
                    <!-- Section Header -->
                    <?php echo $section_header; ?>

                    <!-- Flash Alert -->
                    <?php echo $flash_alert; ?>

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
    <script src="<?php echo base_url('assets/plugins/jquery.pwstrength/jquery.pwstrength.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-selectric/jquery.selectric.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js'); ?>"></script>
    <script>
        "use strict";

        // PW Strength
        $(".pwstrength").pwstrength();


        // Modal
        function modal_trigger(trigger)
        {
            var modal = document.getElementById(trigger);

            modal_toggle(modal);
        }

        function windowOnClick(trigger)
        {
            if(window.event.target === trigger);
            {
                modal_toggle(window.event.target);
            }
        }

        function modal_toggle(modal)
        {
            modal.classList.toggle("show");
        }
    </script>
</body>
</html>