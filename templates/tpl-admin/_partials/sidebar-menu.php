<?php
    // Get usertype session
    $usertype = $this->session->userdata('usertype');

    // Defines the URL for each menu
    $url_dashboard   = base_url('dashboard');
    $url_transaction = base_url('dashboard/kelola-transaksi');
    $url_tenant      = base_url('dashboard/kelola-tenant');
    $url_admin       = base_url('dashboard/kelola-admin');
    $url_customer    = base_url('dashboard/kelola-pelanggan');
?>


<?php if($usertype == "Administrator" OR $usertype == "Leasing"): ?>
    <li class="menu-header">Panel Utama</li>
    <!-- Menu: Dashboard -->
    <li <?php if($page_title == 'Dashboard') echo "class='active'"; ?>><a href="<?php echo $url_dashboard; ?>" class="nav-link"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
<?php endif; ?>


<li class="menu-header">Menu</li>
<!-- Menu: Transaction -->
<li <?php if($page_title == 'Kelola Transaksi') echo "class='active'"; ?>><a href="<?php echo $url_transaction; ?>" class="nav-link"><i class="far fa-file-alt"></i> <span>Transaksi</span></a></li>


<?php if($usertype == "Administrator" OR $usertype == "Leasing"): ?>
    <!-- Menu: Tenant -->
    <li <?php if($page_title == 'Kelola Tenant') echo "class='active'"; ?>><a href="<?php echo $url_tenant; ?>" class="nav-link"><i class="fas fa-store"></i> <span>Tenant</span></a></li>
    
    <!-- Menu: User Account -->
    <li <?php if($page_title == 'Kelola Akun Admin' OR $page_title == 'Kelola Akun Pelanggan') echo "class='active'"; ?>>
        <?php if($usertype == "Administrator"): ?>
            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Akun Pengguna</span></a>
            <ul class="dropdown-menu">
                <li <?php if($page_title == 'Kelola Akun Admin') echo "class='active'"; ?>><a href="<?php echo $url_admin; ?>">Admin</a></li> 
                <li <?php if($page_title == 'Kelola Akun Pelanggan') echo "class='active'"; ?>><a href="<?php echo $url_customer; ?>">Pelanggan</a></li>
            </ul>
        <?php else: ?>
            <a href="<?php echo $url_customer; ?>" class="nav-link"><i class="far fa-user"></i> <span>Pelanggan</span></a>
        <?php endif; ?>
    </li>
<?php endif; ?>