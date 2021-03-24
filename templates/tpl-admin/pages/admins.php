<div class="card">
    <div class="card-header">
        <h4><?php echo $content_title; ?></h4>
    </div>
    
    <div class="card-body p-0">
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

                <?php if(empty($get_adm_list)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>

                <?php $no = 1; foreach($get_adm_list as $admin_list): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $admin_list->admin_employee_no; ?></td>
                        <td><?php echo $admin_list->admin_fullname; ?></td>
                        <td><?php echo $admin_list->admin_email; ?></td>
                        <td><?php echo $admin_list->account_type; ?></td>
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