<div class="card">
    <div class="card-header">
        <h4><?php echo $content_title; ?></h4>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tr>
                    <th>#</th>
                    <th>Nama Bank</th>
                    <th>Rekening</th>
                    <th>Metode Pembayaran</th>
                    <th>Aksi</th>
                </tr>

                <?php if(empty($get_mtd_list)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>

                <?php $no = 1; foreach($get_mtd_list as $method_list): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $method_list->method_bank_name; ?></td>
                        <td><?php echo $method_list->method_bank_account; ?></td>
                        <td><?php echo $method_list->method_type; ?></td>
                        <td>
                            <a href="<?php echo base_url('dashboard/sunting-metode-pembayaran/'.$method_list->method_id); ?>" class="btn btn-icon btn-primary">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-secondary" onclick="modal_trigger('hapus-metode-pembayaran_<?php echo $method_list->method_id; ?>')">
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


