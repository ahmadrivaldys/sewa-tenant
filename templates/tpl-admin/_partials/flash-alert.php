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

<?php if($this->session->flashdata('add-tenant-failed') OR $this->session->flashdata('update-tenant-failed') OR $this->session->flashdata('delete-tenant-failed')): ?>
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