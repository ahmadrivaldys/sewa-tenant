<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $content_title; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo base_url('dashboard/tambah-tenant/process'); ?>">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tenant</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_name">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ukuran</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_size">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lokasi</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_location">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Sewa</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_price">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_info">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Tampilan</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>