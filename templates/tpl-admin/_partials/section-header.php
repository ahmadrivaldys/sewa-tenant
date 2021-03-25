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