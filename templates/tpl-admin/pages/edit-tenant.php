<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $content_title; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo base_url('dashboard/sunting-tenant/process'); ?>">
                    <input type="hidden" name="submit_type" value="update"/>
                    <input type="hidden" name="tenant_id" value="<?php echo $get_tenant->tenant_id; ?>"/>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tenant</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_name" value="<?php echo $get_tenant->tenant_name; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ukuran</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_size" value="<?php echo $get_tenant->tenant_size; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lokasi</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_location" value="<?php echo $get_tenant->tenant_location; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Sewa</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_price" value="<?php echo $get_tenant->tenant_price; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu Sewa Min. (Bulan)</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" min="1" class="form-control" name="tenant_min_period" value="<?php echo $get_tenant->tenant_min_period; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_info" value="<?php echo $get_tenant->tenant_info; ?>">
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>