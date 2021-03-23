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