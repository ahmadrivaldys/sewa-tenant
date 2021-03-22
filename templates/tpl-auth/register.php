<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran &mdash; Sewa Tenant</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/components.css'); ?>">
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="<?php echo base_url('assets/images/admin/logo.svg'); ?>" width="150" alt="Logo Gandaria City">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>Pendaftaran</h4></div>

                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="first_name">Nama Lengkap</label>
                                        <input id="first_name" type="text" class="form-control" name="fullname" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="first_name">Nama Pengguna (<i>Username</i>)</label>
                                        <input id="first_name" type="text" class="form-control" name="fullname" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input id="email" type="email" class="form-control" name="email">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Kata Sandi</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Konfirmasi Kata Sandi</label>
                                            <input id="password2" type="password" class="form-control" name="password-confirm">
                                        </div>
                                    </div>

                                    <div class="form-divider">
                                        Domisili
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <input type="text" name="province" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Kota</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control">
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

                        <div class="simple-footer">
                            <?php $copyright_year = ''; date('Y') == 2021 ? $copyright_year = date('Y') : $copyright_year = '2021-' . date('Y'); ?>
                            Copyright &copy; <?php echo $copyright_year; ?> <div class="bullet"></div> <a href="#">Ari Adrian</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?php echo base_url('assets/js/admin/stisla.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/scripts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/custom.js'); ?>"></script>
</body>
</html>