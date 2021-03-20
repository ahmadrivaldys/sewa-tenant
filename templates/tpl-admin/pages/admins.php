<div class="table-responsive">
    <table class="table table-striped table-md">
        <tr>
            <th>#</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>E-mail</th>
            <th>Peran</th>
            <th>Aksi</th>
        </tr>

        <?php foreach($get_adm_list as $admin_list): ?>
            <tr>
                <td>1</td>
                <td><?php echo $admin_list->admin_employee_no; ?></td>
                <td><?php echo $admin_list->admin_fullname; ?></td>
                <td><?php echo $admin_list->admin_email; ?></td>
                <td><?php echo $admin_list->account_type; ?></td>
                <td><a href="#" class="btn btn-secondary">Detail</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>