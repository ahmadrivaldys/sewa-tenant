<div class="table-responsive">
    <table class="table table-striped table-md">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>E-mail</th>
            <th>Aksi</th>
        </tr>

        <?php foreach($get_cus_list as $customer_list): ?>
            <tr>
                <td>1</td>
                <td><?php echo $customer_list->user_fullname; ?></td>
                <td><?php echo $customer_list->user_email; ?></td>
                <td><a href="#" class="btn btn-secondary">Detail</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>