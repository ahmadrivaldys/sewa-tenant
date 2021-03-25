<div class="card">
    <div class="card-header">
        <h4><?php echo $content_title; ?></h4>
    </div>
    
    <div class="card-body p-0">
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

                <?php if(empty($get_tnt_list)): ?>
                    <tr>
                        <td colspan="8" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>

                <?php $no = 1; foreach($get_tnt_list as $tenant_list): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $tenant_list->tenant_name; ?></td>
                        <td><?php echo $tenant_list->tenant_size; ?></td>
                        <td><?php echo $tenant_list->tenant_location; ?></td>
                        <td><?php echo $tenant_list->tenant_price; ?></td>
                        <td><?php echo $tenant_list->tenant_info; ?></td>
                        <td><?php echo $tenant_list->tenant_image; ?></td>
                        <td>
                            <a href="<?php echo base_url('dashboard/sunting-tenant/'.$tenant_list->tenant_id); ?>" class="btn btn-icon btn-primary">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-secondary" id="hapus-tenant_<?php echo $tenant_list->tenant_id; ?>">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php $no++; endforeach; ?>
            </table>
        </div>
    </div>

    <div class="card-footer bg-whitesmoke">
        &nbsp;
    </div>
</div>


<!-- <?php foreach($get_tnt_list as $tenant_list): ?>
    <div class="modal fade" tabindex="1" role="dialog" id="hapus-tenant_<?php echo $tenant_list->tenant_id; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php $no++; endforeach; ?> -->