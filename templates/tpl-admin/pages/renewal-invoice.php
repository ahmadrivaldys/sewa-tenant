<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <h2><?php echo $page_title; ?></h2>
                    <div class="invoice-number">#<?php echo $get_inv_data->renewal_no; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Dibayarkan Kepada</strong><br>
                            PT Artisan Wahyu<br>
                            Jl. Sultan Iskandar Muda No.73, RT.13/RW.2<br>
                            Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan<br>
                            Daerah Khusus Ibukota Jakarta 12240
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Ditagihkan Kepada</strong><br>
                            <?php echo $get_inv_data->user_fullname; ?><br>
                            <?php echo $get_inv_data->user_address; ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Metode Pembayaran</strong><br>
                            <?php echo $get_inv_data->method_type; ?><br>
                            <?php echo $get_inv_data->method_bank_name; ?> - <?php echo $get_inv_data->method_bank_account; ?>
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>Tanggal Transaksi</strong><br>
                            <?php 
                                $trx_day   = date('d', strtotime($get_inv_data->renewal_date));
                                $trx_month = date('m', strtotime($get_inv_data->renewal_date));
                                $trx_year  = date('Y', strtotime($get_inv_data->renewal_date));

                                if($trx_month == '01')
                                {
                                    $trx_month = 'Januari';
                                }
                                elseif($trx_month == '02')
                                {
                                    $trx_month = 'Februari';
                                }
                                elseif($trx_month == '03')
                                {
                                    $trx_month = 'Maret';
                                }
                                elseif($trx_month == '04')
                                {
                                    $trx_month = 'April';
                                }
                                elseif($trx_month == '05')
                                {
                                    $trx_month = 'Mei';
                                }
                                elseif($trx_month == '06')
                                {
                                    $trx_month = 'Juni';
                                }
                                elseif($trx_month == '07')
                                {
                                    $trx_month = 'Juli';
                                }
                                elseif($trx_month == '08')
                                {
                                    $trx_month = 'Agustus';
                                }
                                elseif($trx_month == '09')
                                {
                                    $trx_month = 'September';
                                }
                                elseif($trx_month == '10')
                                {
                                    $trx_month = 'Oktober';
                                }
                                elseif($trx_month == '11')
                                {
                                    $trx_month = 'November';
                                }
                                elseif($trx_month == '12')
                                {
                                    $trx_month = 'Desember';
                                }

                                echo $trx_day . ' ' . $trx_month . ' ' . $trx_year;
                            ?>
                            <br><br>
                        </address>

                        <address>
                            <strong>Status Pembayaran</strong><br>
                            <?php if($get_inv_data->payment_status_code == 2 AND $get_inv_data->payment_verif_code == 2): ?>
                                <span class="badge badge-secondary activestatus-label bg-secondary"><?php echo $get_inv_data->payment_verif; ?></span>
                            <?php elseif($get_inv_data->payment_status_code == 1 AND $get_inv_data->payment_verif_code == 1): ?>
                                <span class="badge badge-light activestatus-label"><?php echo $get_inv_data->payment_status; ?></span>
                            <?php endif; ?>

                            <?php if($get_inv_data->payment_status_code == 2 AND $get_inv_data->payment_verif_code == 3): ?>
                                <span class="badge badge-success activestatus-label"><?php echo $get_inv_data->payment_status; ?></span>
                            <?php endif; ?>

                            <?php if($get_inv_data->payment_status_code == 3): ?>
                                <span class="badge badge-danger activestatus-label"><?php echo $get_inv_data->payment_status; ?></span>
                            <?php endif; ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="section-title">Ringkasan Pembayaran</div>
                <p class="section-lead">Silakan selesaikan pembayaran agar transaksi dapat diproses.</p>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                        <tr>
                            <th data-width="40">#</th>
                            <th>Item</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Periode Sewa</th>
                            <th class="text-center">Total Masa Sewa</th>
                            <th class="text-right">Jumlah Harga</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><?php echo $get_inv_data->tenant_name; ?></td>
                            <td class="text-center"><?php echo rupiah($get_inv_data->tenant_price); ?> / bulan</td>
                            <td class="text-center"><?php echo date('d/m/Y', strtotime($get_inv_data->renewal_rent_from)) . ' - ' . date('d/m/Y', strtotime($get_inv_data->renewal_rent_to)); ?></td>
                            <td class="text-center"><?php echo $get_inv_data->renewal_rent_total_month; ?> bulan</td>
                            <td class="text-right"><?php echo rupiah($get_inv_data->payment_nominal); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        &nbsp;
                    </div>
                    <div class="col-lg-4 text-right">
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Total</div>
                            <div class="invoice-detail-value invoice-detail-value-lg"><?php echo rupiah($get_inv_data->payment_nominal); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    <div class="text-md-left">
        <?php
            $usertype = $this->session->userdata('usertype');

            if($usertype == 'Customer'):
        ?>
            <?php if($get_inv_data->payment_status_code == 1 AND $get_inv_data->payment_verif_code == 1 
                OR $get_inv_data->payment_status_code == 2 AND $get_inv_data->payment_verif_code == 2): ?>      
                <button class="btn btn-primary btn-icon icon-left" onclick="modal_trigger('unggah-bukti-bayar')"><i class="fas fa-credit-card"></i> Unggah Bukti Pembayaran</button>
            <?php endif; ?>
        <?php endif; ?>

        <?php if($get_inv_data->payment_status_code == 1 AND $get_inv_data->payment_verif_code == 1): ?>      
            <button class="btn btn-danger btn-icon icon-left" onclick="modal_trigger('batalkan-transaksi')"><i class="fas fa-times"></i> Batalkan Transaksi</button>
        <?php endif; ?>
    </div>
</div>


<!-- Modal Upload Payment Slip -->
<div class="modal-backdrop" id="unggah-bukti-bayar" onclick="windowOnClick(this)">
    <div class="modal-content modal-form-content">
        <div class="modal-header modal-form-header">
            <h5 class="modal-title">Unggah Bukti Pembayaran</h5>
            <span class="close-modal" onclick="modal_trigger('unggah-bukti-bayar')">
                <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                    <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                </svg>
            </span>
        </div>
        
        <?php echo form_open_multipart('dashboard/unggah-bukti-bayar'); ?>
            <div class="modal-body modal-form-body">
                <input type="hidden" name="transaction_no" value="<?php echo $get_inv_data->renewal_no; ?>"/>
                <input type="hidden" name="transaction_type" value="renewal"/>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text fix-prepend">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <input type="file" class="form-control" placeholder="Unggah" name="transaction_paymentslip" required>
                        <label class="col-form-label col-12"><b>Jenis Gambar yang Diperbolehkan:</b> .gif, .jpg, .jpeg, .png, .bmp</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" onclick="modal_trigger('unggah-bukti-bayar')">Batal</button>
                <button type="submit" class="btn btn-primary">Unggah</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>


<!-- Modal Cancel Transaction -->
<div class="modal-backdrop" id="batalkan-transaksi" onclick="windowOnClick(this)">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Batalkan Transaksi</h5>
            <span class="close-modal" onclick="modal_trigger('batalkan-transaksi')">
                <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                    <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
                </svg>
            </span>
        </div>
        
        <?php echo form_open('dashboard/batalkan-transaksi'); ?>
            <div class="modal-body">
                <input type="hidden" name="transaction_no" value="<?php echo $get_inv_data->renewal_no; ?>"/>
                <input type="hidden" name="transaction_type" value="renewal"/>
                <input type="hidden" name="tenant_id" value="<?php echo $get_inv_data->tenant_id; ?>"/>

                Apa Anda yakin ingin membatalkan transaksi ini?
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" onclick="modal_trigger('batalkan-transaksi')">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>