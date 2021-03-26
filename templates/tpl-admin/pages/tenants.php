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
                            <a href="#" class="btn btn-icon btn-secondary" onclick="modal_trigger('hapus-tenant_<?php echo $tenant_list->tenant_id; ?>')">
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


<!-- Modal Hapus Tenant -->
<?php foreach($get_tnt_list as $tenant_list): ?>
    <div class="modal-backdrop" id="hapus-tenant_<?php echo $tenant_list->tenant_id; ?>" onclick="windowOnClick(this)">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Tenant</h5>
                <span class="close-modal" onclick="modal_trigger('hapus-tenant_<?php echo $tenant_list->tenant_id; ?>')">
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                    </svg>
                </span>
            </div>
            
            <?php echo form_open('dashboard/hapus-tenant'); ?>
                <div class="modal-body">
                    <input type="hidden" name="tenant_id" value="<?php echo $tenant_list->tenant_id; ?>"/>

                    Apa Anda yakin ingin menghapus <?php echo $tenant_list->tenant_name; ?>?
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" onclick="modal_trigger('hapus-tenant_<?php echo $tenant_list->tenant_id; ?>')">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php $no++; endforeach; ?>