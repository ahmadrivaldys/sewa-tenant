<div class="card">
    <div class="card-header">
        <h4><?php echo $content_title; ?></h4>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">No. Transaksi</th>
                    <th class="text-center">Tenant</th>
                    <th class="text-center">Periode Sewa</th>
                    <th class="text-center">Status Sewa</th>
                    <th class="text-center">Template Kontrak</th>
                    <th class="text-center">Aksi</th>
                </tr>

                <?php if(empty($get_trx_list)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
                
                <?php $no = 1; foreach($get_trx_list as $transaction_list): ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td class="text-center">
                            <a href="<?php echo base_url('dashboard/tagihan/'.$transaction_list->transaction_no); ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Lihat Tagihan">
                                <?php echo $transaction_list->transaction_no; ?>
                            </a>
                        </td>
                        <td><?php echo $transaction_list->tenant_name; ?></td>
                        <td class="text-center">
                            <?php echo date('d/m/Y', strtotime($transaction_list->transaction_rent_from)) . ' - ' . date('d/m/Y', strtotime($transaction_list->transaction_rent_to)); ?>
                        </td>
                        <td class="text-center">
                            <?php if($transaction_list->status_code == 1): ?>
                                <span class="badge badge-light activestatus-label"><?php echo $transaction_list->status_name; ?></span>
                            <?php endif; ?>

                            <?php if($transaction_list->status_code == 2): ?>
                                <span class="badge badge-success activestatus-label"><?php echo $transaction_list->status_name; ?></span>
                            <?php endif; ?>

                            <?php if($transaction_list->status_code == 3): ?>
                                <span class="badge badge-danger activestatus-label"><?php echo $transaction_list->status_name; ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url('dashboard/surat-perjanjian/'.$transaction_list->transaction_no); ?>">Unduh</a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url('dashboard/rincian-sewa/'.$transaction_list->transaction_no); ?>" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                <?php $no++; endforeach; ?>
            </table>
        </div>
    </div>

    <div class="card-footer bg-whitesmoke">
        &nbsp;
    </div>
</div>