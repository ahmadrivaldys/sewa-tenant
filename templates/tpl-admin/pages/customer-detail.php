<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title invoice-title-custom">
                    <div>
                        <div class="section-title mt-0"><?php echo $page_title; ?></div>
                        <p class="section-lead mb-0"><?php echo $page_subtitle; ?></p>
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
                            <td data-width="215" class="tbl-label">Nama Lengkap</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_fullname; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">NIK</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_identity_no; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Nomor Ponsel</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_phone_no; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">E-mail</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_email; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Alamat</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_address; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">No. NPWP</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_taxpayer_id_no; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">No. SIUP</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo $get_cus_detail->user_business_license_no; ?></td>
                        </tr>
                        <tr>
                            <td data-width="215" class="tbl-label">Tanggal Pendaftaran</td>
                            <td data-width="25" class="text-center px-0">:</td>
                            <td class="pl-0"><?php echo date('d/m/Y', strtotime($get_cus_detail->user_registration_date)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
</div>