<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $content_title; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo base_url('dashboard/tambah-tenant/process'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="submit_type" value="new"/>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tenant</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_name" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ukuran</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_size" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lokasi</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant_location" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Sewa (per Bulan)</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control tenant-price" name="tenant_price" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu Sewa Min. (Bulan)</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" min="1" class="form-control" name="tenant_min_period" required>
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
                            <input type="file" class="form-control" name="tenant_image"/>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <label class="col-form-label col-12"><b>Jenis Gambar yang Diperbolehkan:</b> .gif, .jpg, .jpeg, .png, .bmp</label>
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

<script>
    var cleave = new Cleave('.tenant-price', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>