<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $content_title; ?></h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo base_url('dashboard/ajukan-perpanjangan-sewa/process'); ?>">
                    <input type="hidden" name="transaction_no" value="<?php echo $get_prev_trx->transaction_no; ?>"/>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No. Transaksi</label>
                        <div class="col-sm-12 col-md-7 input-field">
                            <?php echo $get_prev_trx->transaction_no; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tenant</label>
                        <div class="col-sm-12 col-md-7 input-field">
                            <?php echo $get_prev_trx->tenant_name; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 d-flex justify-content-end align-items-center">Periode Sewa</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="row">
                                <div class="col-6">
                                    <label class="d-block">Mulai</label>
                                    <input type="text" class="form-control datepicker" name="renewal_rent_from" required>
                                </div>
                                <div class="col-6">
                                    <label class="d-block">Hingga</label>
                                    <input type="text" class="form-control datepicker" name="renewal_rent_to" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Usaha</label>
                        <div class="col-sm-12 col-md-7 input-field">
                            <?php echo $get_prev_trx->transaction_type_of_business; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Perusahaan / Usaha</label>
                        <div class="col-sm-12 col-md-7 input-field">
                            <?php echo $get_prev_trx->transaction_company_name; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Metode Pembayaran</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="selectric form-control full-width" name="renewal_payment_method" id="renewal_payment_method" required>
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
                            <textarea class="form-control custom-textarea" name="renewal_note"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Ajukan Perpanjangan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>