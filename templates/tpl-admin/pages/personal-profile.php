<?php $usertype = $this->session->userdata('usertype'); ?>

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
                <form method="POST" action="<?php echo base_url('dashboard/sunting-profil/simpan'); ?>">
                    <?php if($usertype == 'Customer'): ?>
                        <!-- Customer Form -->
                        <input type="hidden" name="account_type" value="customer"/>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="user_fullname" value="<?php echo $get_cus_detail->user_fullname; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="user_nik" value="<?php echo $get_cus_detail->user_identity_no; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Ponsel</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control phone-number" name="user_phone" value="<?php echo $get_cus_detail->user_phone_no; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="form-control custom-textarea" name="user_address" required><?php echo $get_cus_detail->user_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No. NPWP</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="user_npwp" value="<?php echo $get_cus_detail->user_taxpayer_id_no; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No. SIUP</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="user_siup" value="<?php echo $get_cus_detail->user_business_license_no; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="user_email" value="<?php echo $get_cus_detail->user_email; ?> (tidak bisa diubah)" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kata Sandi</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="password" class="form-control pwstrength" data-indicator="pwindicator" name="user_password">
                            </div>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- Admin Form -->
                        <input type="hidden" name="account_type" value="admin"/>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="admin_employee_no" value="<?php echo $get_adm_detail->admin_employee_no; ?> (tidak bisa diubah)" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="admin_fullname" value="<?php echo $get_adm_detail->admin_fullname; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" class="form-control" name="admin_email" value="<?php echo $get_adm_detail->admin_email; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kata Sandi</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="password" class="form-control pwstrength" data-indicator="pwindicator" name="admin_password">
                            </div>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <hr>
</div>

<script>
    var cleave = new Cleave('.phone-number', {
        phone: true,
        phoneRegionCode: 'id'
    });
</script>