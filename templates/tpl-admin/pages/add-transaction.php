<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $content_title; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo base_url('dashboard/ajukan-sewa/process'); ?>">
                    <input type="hidden" name="submit_type" value="new"/>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tenant</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="selectric form-control full-width" name="transaction_tenant" id="transaction_tenant" required>
                                <option>- Pilih Tenant -</option>
                                <?php foreach($get_tnt_list as $tenant_list): ?>
                                    <option value="<?php echo $tenant_list->tenant_id; ?>"><?php echo $tenant_list->tenant_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4" id="tenant-info-wrapper">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7 transaction_tenant_info" id="transaction_tenant_info">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-light tenant-info-list tenant-info-color"><div class="tenant-info">Spesifikasi Tenant</div></li>
                                <li class="list-group-item tenant-info-list" id="tenant_size"></li>
                                <li class="list-group-item tenant-info-list" id="tenant_location"></li>
                                <li class="list-group-item tenant-info-list" id="tenant_price"></li>
                                <li class="list-group-item tenant-info-list" id="tenant_min_period"></li>
                                <li class="list-group-item tenant-info-list" id="tenant_info"></li>
                                <li class="list-group-item tenant-info-list" id="tenant_image" data-toggle="sidebar"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 d-flex justify-content-end align-items-center">Periode Sewa</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="row">
                                <div class="col-6">
                                    <label class="d-block">Mulai</label>
                                    <input type="text" class="form-control datepicker" name="transaction_rent_from" required>
                                </div>
                                <div class="col-6">
                                    <label class="d-block">Hingga</label>
                                    <input type="text" class="form-control datepicker" name="transaction_rent_to" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Usaha</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="transaction_type_of_business" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Perusahaan / Usaha</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="transaction_company_name" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Metode Pembayaran</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="selectric form-control full-width" name="transaction_payment_method" id="transaction_payment_method" required>
                                <option>- Pilih Metode Pembayaran -</option>
                                <?php foreach($get_pay_mtd as $payment_method): ?>
                                    <option value="<?php echo $payment_method->method_id; ?>"><?php echo $payment_method->method_bank_name; ?> - <?php echo $payment_method->method_type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Catatan</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control custom-textarea" name="transaction_note"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Image Preview -->
<div class="modal-backdrop" id="pratinjau-gambar" onclick="windowOnClick(this)" data-toggle="sidebar">
    <div class="preview-img" id="preview-img" onclick="modal_trigger('pratinjau-gambar')"></div>
</div>


<script>
    $(document).ready(function()
    {
        $('#tenant-info-wrapper').hide();

        $('#transaction_tenant').change(function()
        {
            $('#tenant-info-wrapper').show();
            
            var tenant_id = $(this).val();

            $.ajax({
                url : "<?php echo base_url('dashboard/informasi-tenant'); ?>",
                method : "POST",
                data : {tenant_id: tenant_id},
                async : true,
                dataType : 'json',
                success: function(data)
                {
                    var image_url    = "<?php echo base_url('assets/images/admin/tenant/'); ?>" + data.tenant_image;
                    var tenant_image = "<img src=" + image_url + " alt='Tenant Image' class='w-50 hover-img' onclick=modal_trigger('pratinjau-gambar')>";
                    var tenant_image_preview = "<span class='close-modal'><svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='32' d='M368 368L144 144M368 144L144 368'/></svg></span><img src=" + image_url + " alt='Tenant Image'>";

                    $('#tenant_size').html('<div class="tenant-info">Ukuran</div>' + data.tenant_size);
                    $('#tenant_location').html('<div class="tenant-info">Lokasi</div>' + data.tenant_location);
                    $('#tenant_price').html('<div class="tenant-info">Harga Sewa</div>' + data.tenant_price + ' / bulan');
                    $('#tenant_min_period').html('<div class="tenant-info">Waktu Sewa Min.</div>' + data.tenant_min_period + ' bulan');
                    $('#tenant_info').html('<div class="tenant-info">Keterangan</div>' + data.tenant_info);

                    if(data.tenant_image)
                    {
                        $('#tenant_image').html('<div class="tenant-info">Foto Tampilan</div>' + tenant_image);
                        $('#preview-img').html(tenant_image_preview);
                    }
                    else
                    {
                        $('#tenant_image').html('<div class="tenant-info">Foto Tampilan</div> -');
                    }
                }
            });
            return false;
        }); 
    });
</script>