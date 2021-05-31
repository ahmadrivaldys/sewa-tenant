<div class="section-header">

    <?php if($page_title == 'Tambah Tenant'
            OR $page_title == 'Sunting Tenant'
            OR $page_title == 'Tambah Admin'
            OR $page_title == 'Sunting Admin'
            OR $page_title == 'Ajukan Sewa'
            OR $page_title == 'Rincian Sewa'
            OR $page_title == 'Tagihan'
            OR $page_title == 'Rincian Data Pelanggan'
            OR $page_title == 'Ajukan Perpanjangan Sewa'
            OR $page_title == 'Rincian Perpanjangan Sewa'
            OR $page_title == 'Tagihan Perpanjangan'
            OR $page_title == 'Sunting Profil'): ?>

        <div class="section-header-back">
            <a href="#" onclick="back_to_previous()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
    <?php endif; ?>

    <h1>Sewa Tenant</h1>

    <?php if($page_title == 'Kelola Tenant' OR $page_title == 'Kelola Akun Admin' OR $page_title == 'Kelola Metode Pembayaran'): ?>

        <div class="section-header-button">
            <?php if($page_title == 'Kelola Tenant'): ?>
                <a href="<?php echo base_url('dashboard/tambah-tenant'); ?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a>
            <?php elseif($page_title == 'Kelola Akun Admin'): ?>
                <a href="#" class="btn btn-primary" onclick="modal_trigger('tambah-admin')"><i class="fas fa-plus-circle"></i> Tambah</a>
            <?php elseif($page_title == 'Kelola Metode Pembayaran'): ?>
                <a href="#" class="btn btn-primary" onclick="modal_trigger('tambah-metode-pembayaran')"><i class="fas fa-plus-circle"></i> Tambah</a>
            <?php endif; ?>
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

<script>
    function back_to_previous()
    {
        history.go(-1);
    }
</script>