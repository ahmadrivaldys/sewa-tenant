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
                            <select class="selectric form-control full-width" name="transaction_tenant" required>
                                <option>- Pilih Tenant -</option>
                                <?php foreach($get_tnt_list as $tenant_list): ?>
                                    <option value="<?php echo $tenant_list->tenant_id; ?>"><?php echo $tenant_list->tenant_name; ?></option>
                                <?php endforeach; ?>
                            </select>
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