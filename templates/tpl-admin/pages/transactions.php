<div class="table-responsive">
    <table class="table table-striped table-md">
        <tr>
            <th>#</th>
            <th>No. Transaksi</th>
            <th>Nama Pemesan</th>
            <th>Tenant</th>
            <th>Aksi</th>
        </tr>

        <?php foreach($get_trx_list as $transaction_list): ?>
            <tr>
                <td>1</td>
                <td><?php echo $transaction_list->transaction_number; ?></td>
                <td><?php echo $transaction_list->user_fullname; ?></td>
                <td><?php echo $transaction_list->tenant_name; ?></td>
                <td><a href="#" class="btn btn-secondary">Detail</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>