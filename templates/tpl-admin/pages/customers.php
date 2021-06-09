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
                        <td>
                            <a href="<?php echo base_url('dashboard/pelanggan/'.$name_slug.'/'.$customer_list->user_id.'/detail'); ?>" class="btn btn-primary">Detail</a>
                            <a href="#" class="btn btn-icon btn-primary" onclick="modal_trigger('sunting-pelanggan_<?php echo $customer_list->user_id; ?>')">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-secondary" onclick="modal_trigger('hapus-pelanggan_<?php echo $customer_list->user_id; ?>')">
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


<!-- Modal Edit Pelanggan -->
<?php foreach($get_cus_list as $customer_list): ?>
    <div class="modal-backdrop" id="sunting-pelanggan_<?php echo $customer_list->user_id; ?>" onclick="windowOnClick(this)">
        <div class="modal-content modal-form-content">
            <div class="modal-header modal-form-header">
                <h5 class="modal-title">Sunting Akun Pelanggan</h5>
                <span class="close-modal" onclick="modal_trigger('sunting-pelanggan_<?php echo $customer_list->user_id; ?>')">
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                    </svg>
                </span>
            </div>
            
            <?php echo form_open('dashboard/sunting-pelanggan/process'); ?>
                <div class="modal-body modal-form-body">
                    <input type="hidden" name="user_id" value="<?php echo $customer_list->user_id; ?>"/>
                    <input type="hidden" name="user_nik_hidden" value="<?php echo $customer_list->user_identity_no; ?>"/>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="far fa-address-card"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="NIK" name="user_nik" value="<?php echo $customer_list->user_identity_no; ?> (tidak bisa diubah)" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="fas fa-font"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="user_fullname" value="<?php echo $customer_list->user_fullname; ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nomor Ponsel" name="user_phone" value="<?php echo $customer_list->user_phone_no; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <input type="email" class="form-control" placeholder="E-mail" name="user_email" value="<?php echo $customer_list->user_email; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend" style="height: 100px;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                            <textarea class="form-control custom-textarea" placeholder="Alamat" name="user_address" required><?php echo $customer_list->user_address; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="far fa-id-card"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="No. NPWP" name="user_npwp" value="<?php echo $customer_list->user_taxpayer_id_no; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="far fa-list-alt"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="No. SIUP" name="user_siup" value="<?php echo $customer_list->user_business_license_no; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" onclick="modal_trigger('sunting-pelanggan_<?php echo $customer_list->user_id; ?>')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus Pelanggan -->
<?php foreach($get_cus_list as $customer_list): ?>
    <div class="modal-backdrop" id="hapus-pelanggan_<?php echo $customer_list->user_id; ?>" onclick="windowOnClick(this)">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Akun Pelanggan</h5>
                <span class="close-modal" onclick="modal_trigger('hapus-pelanggan_<?php echo $customer_list->user_id; ?>')">
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                    </svg>
                </span>
            </div>
            
            <?php echo form_open('dashboard/hapus-pelanggan/process'); ?>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?php echo $customer_list->user_id; ?>"/>
                    <input type="hidden" name="user_fullname" value="<?php echo $customer_list->user_fullname; ?>"/>
                    <input type="hidden" name="user_nik" value="<?php echo $customer_list->user_identity_no; ?>"/>

                    Apa Anda yakin ingin menghapus akun pelanggan <b><?php echo $customer_list->user_fullname; ?></b> [<?php echo $customer_list->user_identity_no; ?>]?
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" onclick="modal_trigger('hapus-pelanggan_<?php echo $customer_list->user_id; ?>')">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php endforeach; ?>