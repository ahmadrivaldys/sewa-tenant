<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title invoice-title-custom">
                    <div>
                        <div class="section-title mt-0"><?php echo $page_title; ?></div>
                        <p class="section-lead mb-0"><?php echo $page_subtitle; ?></p>
                    </div>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-icon icon-left btn-info button-radius"><i class="fas fa-upload"></i> Unggah Dok. Perjanjian</a>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-md">
                        <tr>
                            <td data-width="215" class="tbl-label">No. Transaksi</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_trx_detail->transaction_no; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Tenant</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_trx_detail->tenant_name; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Periode Sewa</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo date('d/m/Y', strtotime($get_trx_detail->transaction_rent_from)) . ' - ' . date('d/m/Y', strtotime($get_trx_detail->transaction_rent_to)); ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Jenis Usaha</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_trx_detail->transaction_type_of_business; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Nama Perusahaan / Usaha</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_trx_detail->transaction_company_name; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Jenis Sewa</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0">
                                <?php if($get_trx_detail->renttype_status_code == 1): ?>
                                    <span class="badge badge-primary activestatus-label"><?php echo $get_trx_detail->renttype_status; ?></span>
                                <?php endif; ?>

                                <?php if($get_trx_detail->renttype_status_code == 2): ?>
                                    <span class="badge badge-secondary activestatus-label bg-secondary"><?php echo $get_trx_detail->renttype_status; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Status Penyewaan</td>
                            <td data-width="25" class="text-center">:</td>
                            <td class="pl-0">
                                <?php if($get_trx_detail->rent_status_code == 1): ?>
                                    <span class="badge badge-light activestatus-label"><?php echo $get_trx_detail->rent_status; ?></span>
                                <?php endif; ?>

                                <?php if($get_trx_detail->rent_status_code == 2): ?>
                                    <span class="badge badge-success activestatus-label"><?php echo $get_trx_detail->rent_status; ?></span>
                                <?php endif; ?>

                                <?php if($get_trx_detail->rent_status_code == 3): ?>
                                    <span class="badge badge-danger activestatus-label"><?php echo $get_trx_detail->rent_status; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Tanggal Pengajuan Sewa</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo date('d/m/Y', strtotime($get_trx_detail->transaction_date)); ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Diajukan oleh</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_trx_detail->user_fullname; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Dokumen Perjanjian</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Status Pembayaran</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0">
                                <?php if($get_trx_detail->payment_status_code == 1): ?>
                                    <span class="badge badge-light activestatus-label"><?php echo $get_trx_detail->payment_status; ?></span>
                                <?php endif; ?>

                                <?php if($get_trx_detail->payment_status_code == 2): ?>
                                    <span class="badge badge-success activestatus-label"><?php echo $get_trx_detail->payment_status; ?></span>
                                <?php endif; ?>

                                <?php if($get_trx_detail->payment_status_code == 3): ?>
                                    <span class="badge badge-danger activestatus-label"><?php echo $get_trx_detail->payment_status; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            dscs
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
</div>