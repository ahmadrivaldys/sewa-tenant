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
                            <a href="#" class="btn btn-icon btn-primary" onclick="modal_trigger('sunting-metode-pembayaran_<?php echo $method_list->method_id; ?>')">
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


<!-- Modal Add Payment Method -->
<div class="modal-backdrop" id="tambah-metode-pembayaran" onclick="windowOnClick(this)">
    <div class="modal-content modal-form-content">
        <div class="modal-header modal-form-header">
            <h5 class="modal-title">Tambah Metode Pembayaran</h5>
            <span class="close-modal" onclick="modal_trigger('tambah-metode-pembayaran')">
                <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                    <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                </svg>
            </span>
        </div>
        
        <?php echo form_open('dashboard/tambah-metode-pembayaran/process'); ?>
            <div class="modal-body modal-form-body">
                <input type="hidden" name="submit_type" value="new"/>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-font"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Bank" name="method_bank_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Rekening" name="method_bank_account" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </div>
                        <select class="selectric form-control" name="method_type" required>
                            <option>- Pilih Metode Pembayaran -</option>
                            <option value="Akun Virtual">Akun Virtual</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" onclick="modal_trigger('tambah-metode-pembayaran')">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>


<!-- Modal Edit Payment Method -->
<?php foreach($get_mtd_list as $method_list): ?>
    <div class="modal-backdrop" id="sunting-metode-pembayaran_<?php echo $method_list->method_id; ?>" onclick="windowOnClick(this)">
        <div class="modal-content modal-form-content">
            <div class="modal-header modal-form-header">
                <h5 class="modal-title">Sunting Metode Pembayaran</h5>
                <span class="close-modal" onclick="modal_trigger('sunting-metode-pembayaran_<?php echo $method_list->method_id; ?>')">
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                    </svg>
                </span>
            </div>
            
            <?php echo form_open('dashboard/sunting-metode-pembayaran/process'); ?>
                <div class="modal-body modal-form-body">
                    <input type="hidden" name="method_id" value="<?php echo $method_list->method_id; ?>"/>
                    <input type="hidden" name="method_bank_name" value="<?php echo $method_list->method_bank_name; ?>"/>
                    <input type="hidden" name="method_type" value="<?php echo $method_list->method_type; ?>"/>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="fas fa-font"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama Bank" name="method_bank_name" value="<?php echo $method_list->method_bank_name; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nomor Rekening" name="method_bank_account" value="<?php echo $method_list->method_bank_account; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text fix-prepend">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                            <select class="selectric form-control" name="method_type" required>
                                <option>- Pilih Metode Pembayaran -</option>
                                <option value="Akun Virtual" <?php if($method_list->method_type == "Akun Virtual"): ?>selected<?php endif;?>>Akun Virtual</option>
                                <option value="Bank Transfer" <?php if($method_list->method_type == "Bank Transfer"): ?>selected<?php endif;?>>Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" onclick="modal_trigger('sunting-metode-pembayaran_<?php echo $method_list->method_id; ?>')">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Delete Payment Method -->
<?php foreach($get_mtd_list as $method_list): ?>
    <div class="modal-backdrop" id="hapus-metode-pembayaran_<?php echo $method_list->method_id; ?>" onclick="windowOnClick(this)">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Metode Pembayaran</h5>
                <span class="close-modal" onclick="modal_trigger('hapus-metode-pembayaran_<?php echo $method_list->method_id; ?>')">
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                    </svg>
                </span>
            </div>
            
            <?php echo form_open('dashboard/hapus-metode-pembayaran/process'); ?>
                <div class="modal-body">
                    <input type="hidden" name="method_id" value="<?php echo $method_list->method_id; ?>"/>
                    <input type="hidden" name="method_bank_name" value="<?php echo $method_list->method_bank_name; ?>"/>
                    <input type="hidden" name="method_bank_account" value="<?php echo $method_list->method_bank_account; ?>"/>
                    <input type="hidden" name="method_type" value="<?php echo $method_list->method_type; ?>"/>

                    Apa Anda yakin ingin menghapus metode pembayaran <b><?php echo $method_list->method_bank_name; ?></b> [<?php echo $method_list->method_bank_account; ?> - <?php echo $method_list->method_type; ?>]?
                </div>

                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" onclick="modal_trigger('hapus-metode-pembayaran_<?php echo $method_list->method_id; ?>')">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php endforeach; ?>