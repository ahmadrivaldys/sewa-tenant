<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $content_title; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo base_url('dashboard/sunting-tenant/process'); ?>" enctype="multipart/form-data">
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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Sewa (per Bulan)</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control tenant-price" name="tenant_price" value="<?php echo $get_tenant->tenant_price; ?>" required>
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
                            <input type="file" class="form-control" name="tenant_image"/>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <label class="col-form-label col-12"><b>Jenis Gambar yang Diperbolehkan:</b> .gif, .jpg, .jpeg, .png, .bmp</label>
                        </div>
                    </div>
                    <?php if(!empty($get_tenant->tenant_image)): ?>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">&nbsp;</label>
                            <div class="col-sm-12 col-md-7">
                                <img class="w-50 hover-img" data-toggle="sidebar" onclick="modal_trigger('pratinjau-gambar')" src="<?php echo base_url('assets/images/admin/tenant/'.$get_tenant->tenant_image); ?>" alt="<?php echo $get_tenant->tenant_image; ?>">
                            </div>
                        </div>
                    <?php endif; ?>
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


<!-- Modal Image Preview -->
<div class="modal-backdrop" id="pratinjau-gambar" onclick="windowOnClick(this)" data-toggle="sidebar">
    <div class="preview-img" onclick="modal_trigger('pratinjau-gambar')">
        <span class="close-modal">
            <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/>
            </svg>
        </span>
        <img class="w-50" src="<?php echo base_url('assets/images/admin/tenant/'.$get_tenant->tenant_image); ?>" alt="<?php echo $get_tenant->tenant_image; ?>">
    </div>
</div>


<script>
    var cleave = new Cleave('.tenant-price', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>