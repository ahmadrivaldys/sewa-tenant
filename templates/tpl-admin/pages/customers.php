<div class="card">
    <div class="card-header">
        <h4><?php echo $content_title; ?></h4>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>E-mail</th>
                    <th>Aksi</th>
                </tr>

                <?php if(empty($get_cus_list)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>

                <?php $no = 1; foreach($get_cus_list as $customer_list): ?>
                    <tr>
                        <?php
                            // Creating name slug from fullname
                            $preg_name_slug = preg_replace("/[^A-Za-z0-9\ ]/", "", $customer_list->user_fullname);
                            $trim_name_slug = trim($preg_name_slug);
                            $name_slug      = str_replace(" ", "-", strtolower($trim_name_slug));
                        ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $customer_list->user_fullname; ?></td>
                        <td><?php echo $customer_list->user_email; ?></td>
                        <td><a href="<?php echo base_url('dashboard/pelanggan/'.$name_slug.'/'.$customer_list->user_id.'/detail'); ?>" class="btn btn-secondary">Detail</a></td>
                    </tr>
                <?php $no++; endforeach; ?>
            </table>
        </div>
    </div>

    <div class="card-footer bg-whitesmoke">
        &nbsp;
    </div>
</div>