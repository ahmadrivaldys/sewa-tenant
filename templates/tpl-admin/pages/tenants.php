<div class="table-responsive">
    <table class="table table-striped table-md">
        <tr>
            <th>#</th>
            <th>Nama Tenant</th>
            <th>Ukuran</th>
            <th>Lokasi</th>
            <th>Harga</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php foreach($get_tnt_list as $tenant_list): ?>
            <tr>
                <td>1</td>
                <td><?php echo $tenant_list->tenant_name; ?></td>
                <td><?php echo $tenant_list->tenant_size; ?></td>
                <td><?php echo $tenant_list->tenant_location; ?></td>
                <td><?php echo $tenant_list->tenant_price; ?></td>
                <td><?php echo $tenant_list->tenant_info; ?></td>
                <td><?php echo $tenant_list->tenant_image; ?></td>
                <td><a href="#" class="btn btn-secondary">Detail</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>