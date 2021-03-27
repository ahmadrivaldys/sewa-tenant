<div class="card">
    <div class="card-header">
        <h4><?php echo $content_title; ?></h4>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tr>
                    <th>#</th>
                    <th>No. Transaksi</th>
                    <th>Nama Penyewa</th>
                    <th>Tenant</th>
                    <th>Aksi</th>
                </tr>

                <?php if(empty($get_trx_list)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>

                <?php $no = 1; foreach($get_trx_list as $transaction_list): ?>
                    <tr>
                        <td>1</td>
                        <td><?php echo $transaction_list->transaction_no; ?></td>
                        <td><?php echo $transaction_list->user_fullname; ?></td>
                        <td><?php echo $transaction_list->tenant_name; ?></td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                <?php $no++; endforeach; ?>
            </table>
        </div>
    </div>

    <div class="card-footer bg-whitesmoke">
        &nbsp;
    </div>
</div>