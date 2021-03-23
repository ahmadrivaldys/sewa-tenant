<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <!-- Header Logo -->
    <?php echo $header_logo; ?>

    <?php if($this->session->flashdata('message')): ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('registration-succeeded')): ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?php echo $this->session->flashdata('registration-succeeded'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('registration-failed')): ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?php echo $this->session->flashdata('registration-failed'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="card card-primary">
        <div class="card-header"><h4>Login</h4></div>

        <div class="card-body">
            <form method="POST" action="<?php echo base_url('auth/login/auth-process'); ?>" class="needs-validation" novalidate="">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Kata Sandi</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>">Daftar</a>
    </div>

    <!-- Footer -->
    <?php echo $footer; ?>
</div>