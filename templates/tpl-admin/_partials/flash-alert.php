<!-- Transaction -->
<?php if($this->session->flashdata('add-transaction-succeeded')
        OR $this->session->flashdata('add-contract-succeeded')
        OR $this->session->flashdata('cancel-transaction-succeeded')
        OR $this->session->flashdata('add-paymentslip-succeeded')
        OR $this->session->flashdata('contract-verification-succeeded')
        OR $this->session->flashdata('payment-verification-succeeded')): ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('add-transaction-succeeded'))
                {
                    echo $this->session->flashdata('add-transaction-succeeded');
                }
                if($this->session->flashdata('add-contract-succeeded'))
                {
                    echo $this->session->flashdata('add-contract-succeeded');
                }
                if($this->session->flashdata('cancel-transaction-succeeded'))
                {
                    echo $this->session->flashdata('cancel-transaction-succeeded');
                }
                if($this->session->flashdata('add-paymentslip-succeeded'))
                {
                    echo $this->session->flashdata('add-paymentslip-succeeded');
                }
                if($this->session->flashdata('contract-verification-succeeded'))
                {
                    echo $this->session->flashdata('contract-verification-succeeded');
                }
                if($this->session->flashdata('payment-verification-succeeded'))
                {
                    echo $this->session->flashdata('payment-verification-succeeded');
                }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('add-transaction-failed')
        OR $this->session->flashdata('add-contract-failed')
        OR $this->session->flashdata('cancel-transaction-failed')
        OR $this->session->flashdata('add-paymentslip-failed')
        OR $this->session->flashdata('contract-verification-failed')
        OR $this->session->flashdata('payment-verification-failed')): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('add-transaction-failed'))
                {
                    echo $this->session->flashdata('add-transaction-failed');
                }
                if($this->session->flashdata('add-contract-failed'))
                {
                    echo $this->session->flashdata('add-contract-failed');
                }
                if($this->session->flashdata('cancel-transaction-failed'))
                {
                    echo $this->session->flashdata('cancel-transaction-failed');
                }
                if($this->session->flashdata('add-paymentslip-failed'))
                {
                    echo $this->session->flashdata('add-paymentslip-failed');
                }
                if($this->session->flashdata('contract-verification-failed'))
                {
                    echo $this->session->flashdata('contract-verification-failed');
                }
                if($this->session->flashdata('payment-verification-failed'))
                {
                    echo $this->session->flashdata('payment-verification-failed');
                }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('min-rent-not-qualified') OR $this->session->flashdata('tenant-not-selected')): ?>
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('min-rent-not-qualified'))
                {
                    echo $this->session->flashdata('min-rent-not-qualified');
                }
                if($this->session->flashdata('tenant-not-selected'))
                {
                    echo $this->session->flashdata('tenant-not-selected');
                }
            ?>
        </div>
    </div>
<?php endif; ?>


<!-- Tenant -->
<?php if($this->session->flashdata('add-tenant-succeeded') OR $this->session->flashdata('update-tenant-succeeded') OR $this->session->flashdata('delete-tenant-succeeded')): ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('add-tenant-succeeded'))
                {
                    echo $this->session->flashdata('add-tenant-succeeded');
                }
                if($this->session->flashdata('update-tenant-succeeded'))
                {
                    echo $this->session->flashdata('update-tenant-succeeded');
                }
                if($this->session->flashdata('delete-tenant-succeeded'))
                {
                    echo $this->session->flashdata('delete-tenant-succeeded');
                }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('admin-already-exist')): ?>
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php echo $this->session->flashdata('admin-already-exist'); ?>
        </div>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('add-tenant-failed') OR $this->session->flashdata('update-tenant-failed') OR $this->session->flashdata('delete-tenant-failed') OR $this->session->flashdata('add-tenantimage-failed')): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('add-tenant-failed'))
                {
                    echo $this->session->flashdata('add-tenant-failed');
                }
                if($this->session->flashdata('update-tenant-failed'))
                {
                    echo $this->session->flashdata('update-tenant-failed');
                }
                if($this->session->flashdata('delete-tenant-failed'))
                {
                    echo $this->session->flashdata('delete-tenant-failed');
                }
                if($this->session->flashdata('add-tenantimage-failed'))
                {
                    echo $this->session->flashdata('add-tenantimage-failed');
                }
            ?>
        </div>
    </div>
<?php endif; ?>


<!-- Admin -->
<?php if($this->session->flashdata('add-admin-succeeded') OR $this->session->flashdata('update-admin-succeeded') OR $this->session->flashdata('delete-admin-succeeded')): ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('add-admin-succeeded'))
                {
                    echo $this->session->flashdata('add-admin-succeeded');
                }
                if($this->session->flashdata('update-admin-succeeded'))
                {
                    echo $this->session->flashdata('update-admin-succeeded');
                }
                if($this->session->flashdata('delete-admin-succeeded'))
                {
                    echo $this->session->flashdata('delete-admin-succeeded');
                }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('add-admin-failed') OR $this->session->flashdata('update-admin-failed') OR $this->session->flashdata('delete-admin-failed')): ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('add-admin-failed'))
                {
                    echo $this->session->flashdata('add-admin-failed');
                }
                if($this->session->flashdata('update-admin-failed'))
                {
                    echo $this->session->flashdata('update-admin-failed');
                }
                if($this->session->flashdata('delete-admin-failed'))
                {
                    echo $this->session->flashdata('delete-admin-failed');
                }
            ?>
        </div>
    </div>
<?php endif; ?>