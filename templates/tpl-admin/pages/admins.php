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


<!-- Modal Add Admin -->
<div class="modal-backdrop" id="tambah-admin" onclick="windowOnClick(this)">
    <div class="modal-content modal-form-content">
        <div class="modal-header modal-form-header">
            <h5 class="modal-title">Tambah Admin</h5>
            <span class="close-modal" onclick="modal_trigger('tambah-admin')">
                <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                    <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                </svg>
            </span>
        </div>
        
        <?php echo form_open('dashboard/tambah-admin'); ?>
            <div class="modal-body modal-form-body">
                <input type="hidden" name="submit_type" value="new"/>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="far fa-address-card"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="NIP" name="admin_nip">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-font"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="admin_fullname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="far fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email" class="form-control" placeholder="E-mail" name="admin_email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </div>
                        <select class="selectric form-control">
                            <option>- Pilih -</option>
                            <?php foreach($get_adm_type as $adm_type_list): ?>
                                <option value="<?php echo $adm_type_list->account_type_id; ?>"><?php echo $adm_type_list->account_type; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control pwstrength" placeholder="Kata Sandi" data-indicator="pwindicator" name="admin_password">
                    </div>
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" onclick="modal_trigger('tambah-admin')">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>