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

<?php if($this->session->flashdata('min-rent-not-qualified') OR $this->session->flashdata('tenant-not-selected') OR $this->session->flashdata('payment-not-selected')): ?>
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
                if($this->session->flashdata('payment-not-selected'))
                {
                    echo $this->session->flashdata('payment-not-selected');
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

<?php if($this->session->flashdata('admin-already-exist') OR $this->session->flashdata('paymentmethod-already-exist')): ?>
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php
                if($this->session->flashdata('admin-already-exist'))
                {
                    echo $this->session->flashdata('admin-already-exist');
                }
                if($this->session->flashdata('paymentmethod-already-exist'))
                {
                    echo $this->session->flashdata('paymentmethod-already-exist');
                }
            ?>
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


<!-- Admin, Account, and Payment Method -->
<?php if($this->session->flashdata('add-admin-succeeded')
      OR $this->session->flashdata('update-admin-succeeded')
      OR $this->session->flashdata('delete-admin-succeeded')
      OR $this->session->flashdata('update-customer-succeeded')
      OR $this->session->flashdata('delete-customer-succeeded')
      OR $this->session->flashdata('update-account-succeeded')
      OR $this->session->flashdata('add-paymentmethod-succeeded')
      OR $this->session->flashdata('update-paymentmethod-succeeded')
      OR $this->session->flashdata('delete-paymentmethod-succeeded')): ?>
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
                if($this->session->flashdata('update-customer-succeeded'))
                {
                    echo $this->session->flashdata('update-customer-succeeded');
                }
                if($this->session->flashdata('delete-customer-succeeded'))
                {
                    echo $this->session->flashdata('delete-customer-succeeded');
                }
                if($this->session->flashdata('update-account-succeeded'))
                {
                    echo $this->session->flashdata('update-account-succeeded');
                }
                if($this->session->flashdata('add-paymentmethod-succeeded'))
                {
                    echo $this->session->flashdata('add-paymentmethod-succeeded');
                }
                if($this->session->flashdata('update-paymentmethod-succeeded'))
                {
                    echo $this->session->flashdata('update-paymentmethod-succeeded');
                }
                if($this->session->flashdata('delete-paymentmethod-succeeded'))
                {
                    echo $this->session->flashdata('delete-paymentmethod-succeeded');
                }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('add-admin-failed') 
      OR $this->session->flashdata('update-admin-failed')
      OR $this->session->flashdata('delete-admin-failed')
      OR $this->session->flashdata('update-customer-failed')
      OR $this->session->flashdata('delete-customer-failed')
      OR $this->session->flashdata('update-account-failed')
      OR $this->session->flashdata('add-paymentmethod-failed')
      OR $this->session->flashdata('update-paymentmethod-failed')
      OR $this->session->flashdata('delete-paymentmethod-failed')): ?>
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
                if($this->session->flashdata('update-customer-failed'))
                {
                    echo $this->session->flashdata('update-customer-failed');
                }
                if($this->session->flashdata('delete-customer-failed'))
                {
                    echo $this->session->flashdata('delete-customer-failed');
                }
                if($this->session->flashdata('update-account-failed'))
                {
                    echo $this->session->flashdata('update-account-failed');
                }
                if($this->session->flashdata('add-paymentmethod-failed'))
                {
                    echo $this->session->flashdata('add-paymentmethod-failed');
                }
                if($this->session->flashdata('update-paymentmethod-failed'))
                {
                    echo $this->session->flashdata('update-paymentmethod-failed');
                }
                if($this->session->flashdata('delete-paymentmethod-failed'))
                {
                    echo $this->session->flashdata('delete-paymentmethod-failed');
                }
            ?>
        </div>
    </div>
<?php endif; ?>