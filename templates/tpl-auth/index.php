<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> &mdash; Sewa Tenant</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin/custom.css'); ?>">
    <link rel="icon" href="<?php echo base_url('assets/images/admin/logo-round.png'); ?>">
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <?php echo $content; ?>
                </div>
            </div>
        </section>
    </div>


    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/popper/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/moment.js/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/stisla.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/scripts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/admin/custom.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery.pwstrength/jquery.pwstrength.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/cleave.js/cleave.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/cleave.js/cleave-phone.id.js'); ?>"></script>
    <script>
        "use strict";

        $(".pwstrength").pwstrength();
        
        var cleave = new Cleave('.phone-number', {
            phone: true,
            phoneRegionCode: 'id'
        });
    </script>
</body>
</html>