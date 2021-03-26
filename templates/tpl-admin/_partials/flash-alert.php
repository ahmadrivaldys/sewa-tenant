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