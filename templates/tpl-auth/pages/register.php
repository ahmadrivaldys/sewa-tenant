<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
    <!-- Header Logo -->
    <?php echo $header_logo; ?>

    <div class="card card-primary">
        <div class="card-header"><h4>Pendaftaran</h4></div>

        <div class="card-body">
            <form method="POST" action="<?php echo base_url('auth/register/auth-process'); ?>">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="user_fullname" autofocus>
                </div>

                <div class="form-group">
                    <label>NIK</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="user_nik">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Ponsel</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control phone-number" name="user_phone">
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control custom-textarea" name="user_address" required></textarea>
                </div>

                <div class="form-group">
                    <label>No. NPWP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-id-card"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="user_npwp">
                    </div>
                </div>

                <div class="form-group">
                    <label>No. SIUP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-list-alt"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="user_siup">
                    </div>
                </div>

                <div class="form-divider">
                    Informasi Akun
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email" class="form-control" name="user_email">
                    </div>
                </div>

                <div class="form-group reg-form-group">
                    <label>Kata Sandi</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control pwstrength" data-indicator="pwindicator" name="user_password">
                    </div>
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php echo $footer; ?>
</div>