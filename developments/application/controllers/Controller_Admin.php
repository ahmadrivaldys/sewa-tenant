<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Controller_Admin extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();

		// Load library for dashboard/admin panel templating
		$this->load->library('template');

		// Load the model
        $this->load->model('model_admin');

		// Check login status
        if($this->session->userdata('logged-in') != TRUE)
        {
            redirect('auth/login');
        }

		// Check if the transaction has ended or not
		$get_trx_list = $this->model_admin->get_all_transactions();
		$get_ret_list = $this->model_admin->get_all_renewals();
		$today_date   = new DateTime();
		
		foreach($get_trx_list as $trx_list)
		{
			// -- Update end time for transaction
			$trx_enddate       = new DateTime($trx_list->transaction_rent_to);
			$trx_active_status = $trx_list->transaction_active_status_id;

			if($today_date >= $trx_enddate && $trx_active_status != 3)
			{
				$trx['transaction_active_status_id'] = 3;
				$trx_no['transaction_no'] = $trx_list->transaction_no;

				$this->model_admin->update_transaction($trx, $trx_no);
			}

			// -- Update tenant availability to 'available' after the transaction is not renewed/extended within 7 days (data will be updated on day 8)
			$trx_8days = new DateTime($trx_list->transaction_rent_to);
			$trx_8days = $trx_8days->modify('+8days');
			$tenant_id = $trx_list->transaction_tenant_id;

			if($today_date >= $trx_8days && $trx_active_status == 3)
			{
				$where_tnt['tenant_id'] = $tenant_id;
				$tnt['tenant_availability'] = 1;

				$this->model_admin->update_tenant($tnt, $where_tnt);

				$trx['renewal_capability'] = 'No';
				$trx_no['transaction_no']  = $trx_list->transaction_no;

				$this->model_admin->update_transaction($trx, $trx_no);
			}
		}

		foreach($get_ret_list as $renewal_list)
		{
			// -- Update end time for transaction
			$ret_enddate       = new DateTime($renewal_list->renewal_rent_to);
			$ret_active_status = $renewal_list->renewal_active_status_id;
			$tenant_id         = $renewal_list->renewal_tenant_id;

			if($today_date >= $ret_enddate && $ret_active_status != 3)
			{
				$ret['renewal_active_status_id'] = 3;
				$ret_no['renewal_no'] = $renewal_list->renewal_no;

				$this->model_admin->update_renewal_transaction($ret, $ret_no);

				// -- Update tenant availability to 'available'
				$tnt['tenant_availability'] = 1;
				$where_tnt['tenant_id'] = $tenant_id;

				$this->model_admin->update_tenant($tnt, $where_tnt);
			}
		}
    }

	public function index()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$data['total_admins']       = $this->model_admin->count_all_admins();
			$data['total_tenants']      = $this->model_admin->count_all_tenants();
			$data['total_transactions'] = $this->model_admin->count_all_transaction();
			$data['total_renewals']     = $this->model_admin->count_all_renewals();
			$data['total_customers']    = $this->model_admin->count_all_customers();
			$data['page_title']         = 'Dashboard';
			$data['page_subtitle']      = 'Di menu ini Anda dapat memantau keseluruhan ringkasan data.';
			$data['content_title']      = 'Ringkasan Data';

			$this->template->main('tpl-admin/pages/dashboard', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function get_transactions_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		// Get user_id session
		$user_id = $this->session->userdata('user_id');

		if($usertype == 'Customer')
		{
			$where['trx.transaction_customer_id']     = $user_id;
			$where_renewal['ret.renewal_customer_id'] = $user_id;
		}

		$where[1] = 1;
		$where_renewal[1] = 1;

		$data['get_trx_list']  = $this->model_admin->get_transactions_list($where);
		$data['get_ret_list']  = $this->model_admin->get_renewals_list($where_renewal);
        $data['page_title']    = 'Kelola Transaksi';
		$data['page_subtitle'] = 'Di menu ini Anda dapat melihat pengajuan sewa tenant yang telah dibuat.';
		$data['content_title'] = 'Daftar Transaksi';
	
		$this->template->main('tpl-admin/pages/transactions', $data);
	}

	public function view_add_transaction()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Customer")
		{	
			$where['tenant_availability'] = 1;

			$data['get_tnt_list']  = $this->model_admin->get_tenants_list($where);
			$data['get_pay_mtd']   = $this->model_admin->get_payment_method_list();
			$data['page_title']    = 'Ajukan Sewa';
			$data['page_subtitle'] = 'Di menu ini Anda mengajukan penyewaan tenant.';
			$data['content_title'] = 'Ajukan Sewa Tenant';

			$this->template->main('tpl-admin/pages/add-transaction', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function save_transaction_process()
	{
		// Get user_id session
		$user_id = $this->session->userdata('user_id');

		// Getting all input
        $transaction_tenant_id  = $this->input->post('transaction_tenant');
        $transaction_rent_from  = $this->input->post('transaction_rent_from');
        $transaction_rent_to    = $this->input->post('transaction_rent_to');
        $transaction_tob        = $this->input->post('transaction_type_of_business');
        $transaction_comp_name  = $this->input->post('transaction_company_name');
        $transaction_pay_method = $this->input->post('transaction_payment_method');
        $transaction_note       = $this->input->post('transaction_note');

		// Validation if tenant and payment method has not been selected
		if($transaction_tenant_id == 0 OR $transaction_pay_method == 0)
		{
			$err_message = '';

			if($transaction_tenant_id == 0)
			{
				$err_message = 'Harap pilih tenant-nya terlebih dulu.';
			}

			if($transaction_pay_method == 0)
			{
				$err_message = 'Harap pilih metode pembayarannya terlebih dulu.';
			}

			if($transaction_tenant_id == 0 && $transaction_pay_method == 0)
			{
				$err_message = 'Harap pilih <b>tenant</b> dan <b>metode pembayarannya</b> terlebih dulu.';
			}

			$this->session->set_flashdata('tenant-not-selected', $err_message);

			// User will be redirected to 'Ajukan Sewa' page
			redirect('dashboard/ajukan-sewa');
		}
		else
		{
			// Date of transaction was added
			$transaction_date = date_create('now')->format('Y-m-d H:i:s');

			// Steps for creating transaction no
			$transaction_no = '';

			// -- Get last transaction id and no from all transactions
			$last_trx_id    = $this->model_admin->get_last_transactions_id()->transaction_id;
			$last_trx_no    = $this->model_admin->get_last_transactions_no($last_trx_id)->transaction_no;

			$last_trx_date  = substr($last_trx_no, 4, 6);
			$this_trx_date  = date_create('now')->format('dmy');

			// -- If the new transaction (this transaction) on the same day, get the previous transaction id on that day
			if($last_trx_date == $this_trx_date)
			{
				$previous_trx_id = substr($last_trx_no, 11);
				$next_trx_id     = ltrim($previous_trx_id) + 1;
				$this_trx_id     = sprintf('%03d', $next_trx_id);

				// -- Create the transaction no
				$transaction_no  = 'TRX-' . $this_trx_date . '.' . $this_trx_id;
			}
			else
			{
				$this_trx_id     = sprintf('%03d', 1);

				// -- Create the transaction no
				$transaction_no  = 'TRX-' . $this_trx_date . '.' . $this_trx_id;
			}

			// Validation for minimum rental time
			$rent_date_from   = date_create($transaction_rent_from);
			$rent_date_to     = date_create($transaction_rent_to);
			$rent_date_diff   = date_diff($rent_date_from, $rent_date_to);

			$rent_total_year  = $rent_date_diff->y;
			$rent_total_month = $rent_date_diff->m;
			$rent_total_month = ($rent_total_year * 12) + $rent_total_month;
			$rent_total_day   = $rent_date_diff->d;
			$rent_total_time  = '';

			// -- Get tenant minimum rental time
			$where['tenant_id'] = $transaction_tenant_id;
			$tenant_info        = $this->model_admin->get_tenant($where);
			$tenant_min_period  = $tenant_info->tenant_min_period;

			// -- If minimum rental time is qualified, store the data into the database. If not, show the error message.
			if($rent_total_month >= $tenant_min_period)
			{
				// Gathering all data that already available to be stored into the database (transaction data)
				$data['transaction_tenant_id']         = $transaction_tenant_id;
				$data['transaction_no']                = $transaction_no;
				$data['transaction_rent_from']         = date_create($transaction_rent_from)->format('Y-m-d H:i:s');
				$data['transaction_rent_to']           = date_create($transaction_rent_to)->format('Y-m-d H:i:s');
				$data['transaction_rent_total_month']  = $rent_total_month;
				$data['transaction_type_of_business']  = $transaction_tob;
				$data['transaction_company_name']      = $transaction_comp_name;
				$data['transaction_note']              = $transaction_note;
				$data['transaction_rent_type_id']      = 1;
				$data['transaction_active_status_id']  = 1;
				$data['transaction_contract_verif_id'] = 1;
				$data['transaction_customer_id']       = $user_id;
				$data['transaction_date']              = $transaction_date;
				$data['renewal_capability']            = 'Yes';
				$data['modified_by']                   = $user_id;
				$data['modified_date']                 = $transaction_date;

				// Storing the data into the database (create transaction)
				$save_transaction = $this->model_admin->add_transaction($data);

				// Gathering all data that already available to be stored into the database (payment data)
				$pay['payment_nominal']        = $rent_total_month * $tenant_info->tenant_price;
				$pay['payment_method_id']      = $transaction_pay_method;
				$pay['payment_status_id']      = 1;
				$pay['payment_verif_id']       = 1;
				$pay['payment_type']           = 'new';
				$pay['payment_transaction_no'] = $transaction_no;

				// Storing the data into the database (create payment data)
				$save_payment = $this->model_admin->add_payment_data($pay);

				// Storing the data into the database (update tenant availability)
				$tnt['tenant_availability']    = 2;

				$save_tenant = $this->model_admin->update_tenant($tnt, $where);

				// Show the message if the storing process was succeeded or failed
				if($save_transaction && $save_payment && $save_tenant)
				{
					$this->session->set_flashdata('add-transaction-succeeded', 'Pengajuan sewa tenant berhasil dibuat.');
				}
				else
				{
					$this->session->set_flashdata('add-transaction-failed', 'Pengajuan sewa tenant gagal dibuat.');
				}
			}
			else
			{
				if($rent_total_day == 0)
				{
					$rent_total_time = $rent_total_month . ' bulan.';
				}
				else
				{
					$rent_total_time = $rent_total_month . ' bulan ' . $rent_total_day . ' hari.';
				}

				// Get tenant name
				$tenant_name  = $this->model_admin->get_tenant($where)->tenant_name;

				$flash_msg    = 'Waktu sewa minimal untuk <b>[' . $tenant_name . ']</b> adalah <b>' . $tenant_min_period . ' bulan</b>. Waktu sewa yang Anda ajukan adalah <b>' . $rent_total_time . '</b> Silakan ajukan lagi.';

				$this->session->set_flashdata('min-rent-not-qualified', $flash_msg);

				// User will be redirected to 'Ajukan Sewa' page
				redirect('dashboard/ajukan-sewa');
			}

			// After finish, user will be redirected to 'Kelola Transaksi' page
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function view_transaction_detail($transaction_no)
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype != 'Collection')
		{
			$where = $transaction_no;

			$data['get_trx_detail'] = $this->model_admin->get_transaction_detail($where);
			$data['check_renewal']  = $this->model_admin->get_renewal($where);
			$data['page_title']     = 'Rincian Sewa';
			$data['page_subtitle']  = 'Di menu ini Anda melihat rincian dari data pengajuan sewa Anda.';
			$data['content_title']  = 'Rincian Sewa';

			$this->template->main('tpl-admin/pages/transaction-detail', $data);
		}
		else
		{
			redirect('dashboard/rincian-perpanjangan/' . $transaction_no);
		}
	}

	public function cancel_transaction()
	{
		$transaction_no   = $this->input->post('transaction_no');
		$transaction_type = $this->input->post('transaction_type');
		$tenant_id        = $this->input->post('tenant_id');

		if(!empty($transaction_no))
		{	
			// Set condition for transaction cancelling
			if($transaction_type == 'renewal')
			{
				$data['renewal_active_status_id'] = 3;
				$where['renewal_no']              = $transaction_no;

				$cancel_transaction = $this->model_admin->update_renewal_transaction($data, $where);

				$pay_where['payment_type'] = 'renewal';
			}
			else
			{
				$data['transaction_active_status_id'] = 3;
				$where['transaction_no']              = $transaction_no;

				$cancel_transaction = $this->model_admin->update_transaction($data, $where);

				$pay_where['payment_type'] = 'new';
			}

			// -- Update for Payment after transaction cancelling
			$pay['payment_status_id']            = 3;
			$pay_where['payment_transaction_no'] = $transaction_no;

			// Storing the data into the database (Payment)
			$cancel_payment = $this->model_admin->update_payment($pay, $pay_where);

			// -- Update for Tenant after transaction cancelling
			$tnt['tenant_availability'] = 1;
			$tnt_where['tenant_id']     = $tenant_id;
			
			// Storing the data into the database (Tenant)
			$cancel_tenant  = $this->model_admin->update_tenant($tnt, $tnt_where);


			// Show the message if the storing process was succeeded or failed
			if($cancel_payment && $cancel_transaction && $cancel_tenant)
			{
				$this->session->set_flashdata('cancel-transaction-succeeded', 'Pembatalkan transaksi berhasil.');
			}
			else
			{
				$this->session->set_flashdata('cancel-transaction-failed', 'Pembatalkan transaksi gagal.');
			}

			if($transaction_type == 'renewal')
			{
				// After finish, user will be redirected to 'Tagihan Perpanjangan' page
				redirect('dashboard/tagihan-perpanjangan/' . $transaction_no);
			}
			else
			{
				// After finish, user will be redirected to 'Tagihan' page
				redirect('dashboard/tagihan/' . $transaction_no);
			}
		}
		else
		{
			echo "Akses langsung tidak diperbolehkan.";
		}
	}

	public function view_invoice($transaction_no)
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype != 'Collection')
		{
			$where = $transaction_no;

			$data['get_inv_data']  = $this->model_admin->get_transaction_detail($where);
			$data['page_title']    = 'Tagihan';
			$data['page_subtitle'] = 'Di menu ini Anda melihat rincian tagihan pembayaran.';
			$data['content_title'] = 'Tagihan';

			$this->template->main('tpl-admin/pages/invoice', $data);
		}
		else
		{
			redirect('dashboard/tagihan-perpanjangan/' . $transaction_no);
		}
	}

	public function view_add_renewal($trx_no = null)
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		// Get transaction no
		$transaction_no = $this->input->post('transaction_no');

		if(!empty($transaction_no) || !empty($trx_no))
		{
			if($usertype == "Customer")
			{
				if(!empty($transaction_no))
				{
					$data['get_prev_trx']  = $this->model_admin->get_previous_transaction($transaction_no);
				}

				if(!empty($trx_no))
				{
					// Get user_id session
					$user_id = $this->session->userdata('user_id');

					$data['get_prev_trx'] = $this->model_admin->get_previous_transaction($trx_no);

					if($data['get_prev_trx']->transaction_customer_id != $user_id)
					{
						redirect('dashboard/kelola-transaksi');
					}
				}
				
				$data['get_pay_mtd']   = $this->model_admin->get_payment_method_list();
				$data['page_title']    = 'Ajukan Perpanjangan Sewa';
				$data['page_subtitle'] = 'Di menu ini Anda mengajukan perpanjangan masa sewa tenant yang telah berakhir.';
				$data['content_title'] = 'Ajukan Perpanjangan Sewa';

				$this->template->main('tpl-admin/pages/add-renewal', $data);
			}
			else
			{
				redirect('dashboard/kelola-transaksi');
			}
		}
		else
		{
			echo "Akses langsung tidak diperbolehkan.";
		}
	}

	public function save_renewal_process()
	{
		// Get user_id session
		$user_id = $this->session->userdata('user_id');

		// Get transaction no
		$transaction_no = $this->input->post('transaction_no');

		// Getting all input
        $renewal_rent_from  = $this->input->post('renewal_rent_from');
        $renewal_rent_to    = $this->input->post('renewal_rent_to');
        $renewal_pay_method = $this->input->post('renewal_payment_method');
        $renewal_note       = $this->input->post('renewal_note');

		// Validation if payment method has not been selected
		if($renewal_pay_method == 0)
		{
			$err_message = 'Harap pilih metode pembayarannya terlebih dulu.';

			$this->session->set_flashdata('payment-not-selected', $err_message);

			// User will be redirected to 'Ajukan Perpanjangan Sewa' page
			redirect('dashboard/ajukan-perpanjangan-sewa/' . $transaction_no);
		}
		else
		{
			// Date of renewal transaction was added
			$renewal_date = date_create('now')->format('Y-m-d H:i:s');

			// Get previous transaction
			$get_prev_trx = $this->model_admin->get_previous_transaction($transaction_no);

			// Validation for minimum rental time
			$rent_date_from   = date_create($renewal_rent_from);
			$rent_date_to     = date_create($renewal_rent_to);
			$rent_date_diff   = date_diff($rent_date_from, $rent_date_to);

			$rent_total_year  = $rent_date_diff->y;
			$rent_total_month = $rent_date_diff->m;
			$rent_total_month = ($rent_total_year * 12) + $rent_total_month;
			$rent_total_day   = $rent_date_diff->d;
			$rent_total_time  = '';

			// -- Get tenant minimum rental time
			$where['tenant_id'] = $get_prev_trx->transaction_tenant_id;
			$tenant_info        = $this->model_admin->get_tenant($where);
			$tenant_min_period  = $tenant_info->tenant_min_period;

			// -- If minimum rental time is qualified, store the data into the database. If not, show the error message.
			if($rent_total_month >= $tenant_min_period)
			{
				// Gathering all data that already available to be stored into the database
				$data['renewal_tenant_id']         = $get_prev_trx->transaction_tenant_id;
				$data['renewal_no']                = $transaction_no;
				$data['renewal_rent_from']         = date_create($renewal_rent_from)->format('Y-m-d H:i:s');
				$data['renewal_rent_to']           = date_create($renewal_rent_to)->format('Y-m-d H:i:s');
				$data['renewal_rent_total_month']  = $rent_total_month;
				$data['renewal_type_of_business']  = $get_prev_trx->transaction_type_of_business;
				$data['renewal_company_name']      = $get_prev_trx->transaction_company_name;
				$data['renewal_note']              = $renewal_note;
				$data['renewal_rent_type_id']      = 2;
				$data['renewal_active_status_id']  = 1;
				$data['renewal_contract_verif_id'] = 1;
				$data['renewal_customer_id']       = $user_id;
				$data['renewal_date']              = $renewal_date;
				$data['modified_by']               = $user_id;
				$data['modified_date']             = $renewal_date;

				// Storing the data into the database (create renewal transaction)
				$save_renewal = $this->model_admin->add_renewal($data);

				// Storing the data into the database (create payment data)
				$pay['payment_nominal']        = $rent_total_month * $tenant_info->tenant_price;
				$pay['payment_method_id']      = $renewal_pay_method;
				$pay['payment_status_id']      = 1;
				$pay['payment_verif_id']       = 1;
				$pay['payment_type']           = 'renewal';
				$pay['payment_transaction_no'] = $transaction_no;

				$save_payment = $this->model_admin->add_payment_data($pay);

				// Show the message if the storing process was succeeded or failed
				if($save_renewal && $save_payment)
				{
					$this->session->set_flashdata('add-renewal-succeeded', 'Pengajuan perpanjangan sewa tenant berhasil dibuat.');
				}
				else
				{
					$this->session->set_flashdata('add-renewal-failed', 'Pengajuan perpanjangan sewa tenant gagal dibuat.');
				}
			}
			else
			{
				if($rent_total_day == 0)
				{
					$rent_total_time = $rent_total_month . ' bulan.';
				}
				else
				{
					$rent_total_time = $rent_total_month . ' bulan ' . $rent_total_day . ' hari.';
				}

				// Get tenant name
				$tenant_name  = $this->model_admin->get_tenant($where)->tenant_name;

				$flash_msg    = 'Waktu sewa minimal untuk <b>[' . $tenant_name . ']</b> adalah <b>' . $tenant_min_period . ' bulan</b>. Waktu sewa yang Anda ajukan adalah <b>' . $rent_total_time . '</b> Silakan ajukan lagi.';

				$this->session->set_flashdata('min-rent-not-qualified', $flash_msg);

				// User will be redirected to 'Ajukan Perpanjangan Sewa' page
				redirect('dashboard/ajukan-perpanjangan-sewa/' . $transaction_no);
			}

			// After finish, user will be redirected to 'Kelola Transaksi' page
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function view_renewal_detail($renewal_no)
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');
		
		if($usertype == 'Administrator' OR $usertype == 'Collection' OR $usertype == 'Customer')
		{
			$where = $renewal_no;

			$data['get_ret_detail'] = $this->model_admin->get_renewal_detail($where);
			$data['page_title']     = 'Rincian Perpanjangan Sewa';
			$data['page_subtitle']  = 'Di menu ini Anda melihat rincian dari data perpanjangan sewa Anda.';
			$data['content_title']  = 'Rincian Perpanjangan Sewa';

			$this->template->main('tpl-admin/pages/renewal-detail', $data);
		}
		else
		{
			redirect('dashboard/rincian-sewa/' . $renewal_no);
		}
	}

	public function view_renewal_invoice($renewal_no)
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');
		
		if($usertype == 'Administrator' OR $usertype == 'Collection' OR $usertype == 'Customer')
		{
			$where = $renewal_no;

			$data['get_inv_data']  = $this->model_admin->get_renewal_detail($where);
			$data['page_title']    = 'Tagihan Perpanjangan';
			$data['page_subtitle'] = 'Di menu ini Anda melihat rincian tagihan pembayaran.';
			$data['content_title'] = 'Tagihan Perpanjangan';

			$this->template->main('tpl-admin/pages/renewal-invoice', $data);
		}
		else
		{
			redirect('dashboard/tagihan/' . $renewal_no);
		}
	}

	public function download_contract($transaction_no)
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		// Get user_id
		$user_id  = $this->session->userdata('user_id');

		if($usertype == "Customer")
		{
			$where['user_id']   = $user_id;
			$get_customer_data  = $this->model_admin->get_customer_contract($where);

			// Create date of contract
			$contract_date  = date('d');
			$contract_month = date('m');
			$contract_year  = date('Y');

			if($contract_month == '01')
			{
				$contract_month = 'Januari';
			}
			elseif($contract_month == '02')
			{
				$contract_month = 'Februari';
			}
			elseif($contract_month == '03')
			{
				$contract_month = 'Maret';
			}
			elseif($contract_month == '04')
			{
				$contract_month = 'April';
			}
			elseif($contract_month == '05')
			{
				$contract_month = 'Mei';
			}
			elseif($contract_month == '06')
			{
				$contract_month = 'Juni';
			}
			elseif($contract_month == '07')
			{
				$contract_month = 'Juli';
			}
			elseif($contract_month == '08')
			{
				$contract_month = 'Agustus';
			}
			elseif($contract_month == '09')
			{
				$contract_month = 'September';
			}
			elseif($contract_month == '10')
			{
				$contract_month = 'Oktober';
			}
			elseif($contract_month == '11')
			{
				$contract_month = 'November';
			}
			elseif($contract_month == '12')
			{
				$contract_month = 'Desember';
			}

			$contract_date = $contract_date . ' ' . $contract_month . ' ' . $contract_year;

			$cust_name     = $get_customer_data->user_fullname;
			$cust_company  = $get_customer_data->transaction_company_name;
			$cust_address  = $get_customer_data->user_address;
			$cust_tob      = $get_customer_data->transaction_type_of_business;
			$cust_phone_no = $get_customer_data->user_phone_no;

			$document_template = file_get_contents(base_url('assets/files/template-contract.rtf'));
			$document_template = str_replace('#CustomerName', $cust_name, $document_template);
			$document_template = str_replace('#CustomerCompany', $cust_company, $document_template);
			$document_template = str_replace('#CustomerAddress', $cust_address, $document_template);
			$document_template = str_replace('#CustomerBusinessType', $cust_tob, $document_template);
			$document_template = str_replace('#CustomerPhoneNumber', $cust_phone_no, $document_template);
			$document_template = str_replace('#ContractDate', $contract_date, $document_template);

			header("Content-type: application/msword");
			header("Content-disposition: inline; filename=Surat-Perjanjian_" . $transaction_no . ".doc");
			header("Content-length: ".strlen($document_template));
			
			echo $document_template;
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function upload_contract()
	{
		$transaction_no   = $this->input->post('transaction_no');
		$transaction_type = $this->input->post('transaction_type');

		if(!empty($transaction_no))
		{
			$config['upload_path']   = './assets/uploads/contract';
			$config['allowed_types'] = 'doc|docx|rtf';

			if($transaction_type == 'renewal')
			{
				$config['file_name']     = 'Unggahan_Surat-Perjanjian_' . str_replace('.', '-', $transaction_no) . '_Perpanjangan';
			}
			else
			{
				$config['file_name']     = 'Unggahan_Surat-Perjanjian_' . str_replace('.', '-', $transaction_no);
			}
		
			$this->load->library('upload', $config);
		
			if($this->upload->do_upload('transaction_contract'))
			{
				$upload_contract = $this->upload->data();

				if($transaction_type == 'renewal')
				{
					$data['renewal_contract_file']     = $upload_contract['file_name'];
					$data['renewal_contract_verif_id'] = 2;
					$where['renewal_no'] = $transaction_no;

					// Storing the data into the database
					$save_contract = $this->model_admin->update_renewal_transaction($data, $where);

					// Show the message if the upload process was succeeded
					$this->session->set_flashdata('add-contract-succeeded', 'Pengunggahan surat perjanjian berhasil.');

					// After finish, user will be redirected to 'Rincian Perpanjangan Sewa' page
					redirect('dashboard/rincian-perpanjangan/' . $transaction_no);
				}
				else
				{
					$data['transaction_contract_file']     = $upload_contract['file_name'];
					$data['transaction_contract_verif_id'] = 2;
					$where['transaction_no'] = $transaction_no;

					// Storing the data into the database
					$save_contract = $this->model_admin->update_transaction($data, $where);

					// Show the message if the upload process was succeeded
					$this->session->set_flashdata('add-contract-succeeded', 'Pengunggahan surat perjanjian berhasil.');

					// After finish, user will be redirected to 'Rincian Sewa' page
					redirect('dashboard/rincian-sewa/' . $transaction_no);
				}
			}
			else
			{
				$error = $this->upload->display_errors();
				
				// Show the message if the upload process was failed
				$this->session->set_flashdata('add-contract-failed', $error);
			}
		}
		else
		{
			echo "Akses langsung tidak diperbolehkan.";
		}
	}

	public function verify_contract()
	{
		// Get user_id session
		$user_id = $this->session->userdata('user_id');

		$transaction_no   = $this->input->post('transaction_no');
		$transaction_type = $this->input->post('transaction_type');

		if(!empty($transaction_no))
		{
			if($transaction_type == 'renewal')
			{
				$where['renewal_no'] = $transaction_no;
				$data['renewal_contract_verif_id'] = 3;
				$data['renewal_contract_verif_by'] = $user_id;

				// Storing the data into the database
				$verify_contract = $this->model_admin->update_renewal_transaction($data, $where);

				$get_ret_detail = $this->model_admin->get_renewal_detail($transaction_no);

				$contract_ver_status = $get_ret_detail->renewal_contract_verif_id;
				$payment_ver_status  = $get_ret_detail->payment_verif_id;

				if($contract_ver_status == 3 && $payment_ver_status == 3)
				{
					$active['renewal_active_status_id'] = 2;

					$this->model_admin->update_renewal_transaction($active, $where);
				}
			}
			else
			{
				$where['transaction_no'] = $transaction_no;
				$data['transaction_contract_verif_id'] = 3;
				$data['transaction_contract_verif_by'] = $user_id;

				// Storing the data into the database
				$verify_contract = $this->model_admin->update_transaction($data, $where);

				$get_trx_detail = $this->model_admin->get_transaction_detail($transaction_no);

				$contract_ver_status = $get_trx_detail->transaction_contract_verif_id;
				$payment_ver_status  = $get_trx_detail->payment_verif_id;

				if($contract_ver_status == 3 && $payment_ver_status == 3)
				{
					$active['transaction_active_status_id'] = 2;

					$this->model_admin->update_transaction($active, $where);
				}
			}

			// Show the message if the upload process was succeeded
			if($verify_contract)
			{
				$this->session->set_flashdata('contract-verification-succeeded', 'Berhasil melakukan verifikasi surat perjanjian/kontrak.');
			}
			else
			{
				$this->session->set_flashdata('contract-verification-failed', 'Gagal melakukan verifikasi surat perjanjian/kontrak.');
			}

			// After finish, user will be redirected to 'Kelola Transaksi' page
			redirect('dashboard/kelola-transaksi');
		}
		else
		{
			echo "Akses langsung tidak diperbolehkan.";
		}
	}

	public function upload_paymentslip()
	{
		$transaction_no   = $this->input->post('transaction_no');
		$transaction_type = $this->input->post('transaction_type');

		if(!empty($transaction_no))
		{
			$config['upload_path']   = './assets/uploads/payment-slip';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			
			if($transaction_type == 'renewal')
			{
				$config['file_name']     = 'Unggahan_Bukti-Pembayaran_' . str_replace('.', '-', $transaction_no) . '_Perpanjangan';
			}
			else
			{
				$config['file_name']     = 'Unggahan_Bukti-Pembayaran_' . str_replace('.', '-', $transaction_no);
			}
		
			$this->load->library('upload', $config);
		
			if($this->upload->do_upload('transaction_paymentslip'))
			{
				$upload_paymentslip = $this->upload->data();

                // Compress image
                $config['image_library']  = 'gd2';
                $config['source_image']   = './assets/uploads/payment-slip/'.$upload_paymentslip['file_name'];
                $config['create_thumb']   = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality']        = '90%';
                $config['width']          = 0;
                $config['height']         = 720;
                $config['new_image']      = './assets/uploads/payment-slip/'.$upload_paymentslip['file_name'];

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                // Set image name to be stored into the database
				$data['payment_paymentslip_file'] = $upload_paymentslip['file_name'];

				$data['payment_status_id']        = 2;
				$data['payment_verif_id']         = 2;
				$data['payment_date']             = date_create('now')->format('Y-m-d H:i:s');
				$where['payment_transaction_no']  = $transaction_no;

				if($transaction_type == 'renewal')
				{
					$where['payment_type'] = 'renewal';
				}
				else
				{
					$where['payment_type'] = 'new';
				}

				// Storing the data into the database
				$save_paymentslip = $this->model_admin->update_payment($data, $where);

				// Show the message if the upload process was succeeded
				$this->session->set_flashdata('add-paymentslip-succeeded', 'Pengunggahan bukti pembayaran berhasil.');				
			}
			else
			{
				$error = $this->upload->display_errors();
				
				// Show the message if the upload process was failed
				$this->session->set_flashdata('add-paymentslip-failed', $error);
			}

			if($transaction_type == 'renewal')
			{
				// After finish, user will be redirected to 'Tagihan Perpanjangan' page
				redirect('dashboard/tagihan-perpanjangan/' . $transaction_no);
			}
			else
			{
				// After finish, user will be redirected to 'Tagihan' page
				redirect('dashboard/tagihan/' . $transaction_no);
			}
		}
		else
		{
			echo "Akses langsung tidak diperbolehkan.";
		}
	}

	public function verify_payment()
	{
		// Get user_id session
		$user_id = $this->session->userdata('user_id');

		$transaction_no   = $this->input->post('transaction_no');
		$transaction_type = $this->input->post('transaction_type');

		if(!empty($transaction_no))
		{
			$where['payment_transaction_no'] = $transaction_no;
			$data['payment_verif_id'] = 3;
			$data['payment_verif_by'] = $user_id;

			if($transaction_type == 'renewal')
			{
				$where['payment_type'] = 'renewal';

				// Storing the data into the database
				$verify_payment = $this->model_admin->update_payment($data, $where);

				$get_ret_detail = $this->model_admin->get_renewal_detail($transaction_no);

				$contract_ver_status = $get_ret_detail->renewal_contract_verif_id;
				$payment_ver_status  = $get_ret_detail->payment_verif_id;

				if($contract_ver_status == 3 && $payment_ver_status == 3)
				{
					$whr['renewal_no'] = $transaction_no;
					$active['renewal_active_status_id'] = 2;

					$this->model_admin->update_renewal_transaction($active, $whr);
				}
			}
			else
			{
				$where['payment_type'] = 'new';

				// Storing the data into the database
				$verify_payment = $this->model_admin->update_payment($data, $where);

				$get_trx_detail = $this->model_admin->get_transaction_detail($transaction_no);

				$contract_ver_status = $get_trx_detail->transaction_contract_verif_id;
				$payment_ver_status  = $get_trx_detail->payment_verif_id;

				if($contract_ver_status == 3 && $payment_ver_status == 3)
				{
					$whr['transaction_no'] = $transaction_no;
					$active['transaction_active_status_id'] = 2;

					$this->model_admin->update_transaction($active, $whr);
				}
			}

			// Show the message if the upload process was succeeded
			if($verify_payment)
			{
				$this->session->set_flashdata('payment-verification-succeeded', 'Berhasil melakukan verifikasi bukti pembayaran.');
			}
			else
			{
				$this->session->set_flashdata('payment-verification-failed', 'Gagal melakukan verifikasi bukti pembayaran.');
			}

			// After finish, user will be redirected to 'Kelola Transaksi' page
			redirect('dashboard/kelola-transaksi');
		}
		else
		{
			echo "Akses langsung tidak diperbolehkan.";
		}
	}

	public function get_tenants_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$where[1] = 1;

			$data['get_tnt_list']  = $this->model_admin->get_tenants_list($where);
			$data['page_title']    = 'Kelola Tenant';
			$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola data-data tenant.';
			$data['content_title'] = 'Daftar Tenant';

			$this->template->main('tpl-admin/pages/tenants', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function get_tenant_info()
	{
		$tenant_id = $this->input->post('tenant_id', TRUE);

		$where['tenant_id'] = $tenant_id;
		$get_tenant_info    = $this->model_admin->get_tenant($where);
		$get_tenant_info->tenant_price = rupiah($get_tenant_info->tenant_price);

		echo json_encode($get_tenant_info);
	}

	public function view_add_tenant()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{	
			$data['page_title']    = 'Tambah Tenant';
			$data['page_subtitle'] = 'Di menu ini Anda menambah data tenant baru.';
			$data['content_title'] = 'Tambah Tenant Baru';

			$this->template->main('tpl-admin/pages/add-tenant', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function view_edit_tenant($tenant_id)
    {
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$where['tenant_id']    = $tenant_id;
			$data['get_tenant']    = $this->model_admin->get_tenant($where);
			$data['page_title']    = 'Sunting Tenant';
			$data['page_subtitle'] = 'Di menu ini Anda memperbarui data tenant yang ada.';
			$data['content_title'] = 'Sunting Data Tenant';

			$this->template->main('tpl-admin/pages/edit-tenant', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
    }

	public function save_tenant_process()
	{
		// Get submit type
		$submit_type = $this->input->post('submit_type');

		$submit_type != 'new' ? $tenant_id = $this->input->post('tenant_id') : '';

		// Get the input from 'tenant_image' field
        $tenant_image_name = $_FILES['tenant_image']['name'];

        // If 'tenant_image' field is not empty, then upload the photo
        if(!empty($tenant_image_name))
        {
            // Setting up the configuration for upload
            $config['upload_path']   = './assets/images/admin/tenant/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['file_name']     = str_replace(" ", "-", strtolower($tenant_image_name));

            // Load library for upload and set the config
            $this->load->library('upload', $config);

            if($this->upload->do_upload('tenant_image'))
            {
                $thumbnail = $this->upload->data();

                // Compress image
                $config['image_library']  = 'gd2';
                $config['source_image']   = './assets/images/admin/tenant/'.$thumbnail['file_name'];
                $config['create_thumb']   = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality']        = '90%';
                $config['width']          = 0;
                $config['height']         = 720;
                $config['new_image']      = './assets/images/admin/tenant/'.$thumbnail['file_name'];

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                // Set image name to be stored into the database
                $data['tenant_image']   = $thumbnail['file_name'];
            }
            else
            {
                $error = $this->upload->display_errors();
			
				// Show the message if the upload process was failed
				$this->session->set_flashdata('add-tenantimage-failed', $error);

				redirect('dashboard/sunting-tenant/'.$tenant_id);
            }
        }

		// Get user_id
		$user_id = $this->session->userdata('user_id');

		// Getting all input
        $tenant_name       = $this->input->post('tenant_name');
        $tenant_size       = $this->input->post('tenant_size');
        $tenant_location   = $this->input->post('tenant_location');
        $tenant_price      = $this->input->post('tenant_price');
        $tenant_min_period = $this->input->post('tenant_min_period');
        $tenant_info       = $this->input->post('tenant_info');

		// Date of tenant data was added
        $tenant_date     = date_create('now')->format('Y-m-d H:i:s');

		// Gathering all data that already available to be stored into the database
        $data['tenant_name']       = $tenant_name;
        $data['tenant_size']       = $tenant_size;
        $data['tenant_location']   = $tenant_location;
        $data['tenant_price']      = str_replace(',', '', $tenant_price);
        $data['tenant_min_period'] = $tenant_min_period;
        $data['tenant_info']       = $tenant_info;
        $data['modified_by']       = $user_id;
        $data['modified_date']     = $tenant_date;

		// Before storing the data, check the submit type first, is this new data or update
        if($submit_type == 'new')
        {
			$data['tenant_availability'] = 1;
            $data['created_by']          = $user_id;
			$data['created_date']        = $tenant_date;

            // Storing the data into the database
			$save_tenant = $this->model_admin->add_tenant($data);

			// Show the message if the storing process was succeeded or failed
			if($save_tenant)
			{
				$this->session->set_flashdata('add-tenant-succeeded', 'Penambahan data tenant berhasil.');
			}
			else
			{
				$this->session->set_flashdata('add-tenant-failed', 'Penambahan data tenant gagal.');
			}
        }
        else
        {
            $where['tenant_id'] = $this->input->post('tenant_id');

            // Storing the data into the database
            $save_tenant = $this->model_admin->update_tenant($data, $where);

            // Show the message if the storing process was succeeded or failed
			if($save_tenant)
			{
				$this->session->set_flashdata('update-tenant-succeeded', 'Pembaruan data tenant berhasil.');
			}
			else
			{
				$this->session->set_flashdata('update-tenant-failed', 'Pembaruan data tenant gagal.');
			}
        }

        // After finish, user (admin) will be redirected to 'Kelola Tenant' page
        redirect('dashboard/kelola-tenant');
	}

	public function delete_tenant_process()
    {
        // Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$tenant_id = $this->input->post('tenant_id');
			
			$where['tenant_id'] = $tenant_id;

			if(!empty($tenant_id))
			{
				// Deleting the data from the database
				$delete_tenant = $this->model_admin->delete_tenant($where);

				// Show the message if the deleting process was succeeded or failed
				if($delete_tenant)
				{
					$this->session->set_flashdata('delete-tenant-succeeded', 'Penghapusan data tenant berhasil.');
				}
				else
				{
					$this->session->set_flashdata('delete-tenant-failed', 'Penghapusan data tenant gagal.');
				}

				// After finish, user (admin) will be redirected to 'Kelola Tenant' page
				redirect('dashboard/kelola-tenant');
			}
			else
			{
				echo "Akses langsung tidak diperbolehkan.";
			}
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
    }

	public function get_paymentmethods_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator")
		{
			$where[1] = 1;

			$data['get_mtd_list']  = $this->model_admin->get_paymentmethods_list($where);
			$data['page_title']    = 'Kelola Metode Pembayaran';
			$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola metode pembayaran yang dapat dipilih oleh pelanggan.';
			$data['content_title'] = 'Daftar Metode Pembayaran';

			$this->template->main('tpl-admin/pages/payment-methods', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function save_paymentmethod_process()
    {
        // Getting all input
        $submit_type         = $this->input->post('submit_type');
        $method_bank_name    = $this->input->post('method_bank_name');
        $method_bank_account = $this->input->post('method_bank_account');
        $method_type         = $this->input->post('method_type');

        // Gathering all data that already available to be stored into the database
        $data['method_bank_name']    = $method_bank_name;
        $data['method_bank_account'] = $method_bank_account;
        $data['method_type']         = $method_type;

        // Before storing the data, check the user status type first, is this new user or update
        if($submit_type == 'new')
        {
            $total_account = $this->model_admin->total_paymentmethod_account($method_bank_name, $method_bank_account);

            // Check if account already exist or not
            if($total_account > 0)
            {
				$this->session->set_flashdata('paymentmethod-already-exist', 'Metode pembayaran dengan nomor rekening tersebut <b>sudah ada</b>. Silakan coba dengan nomor rekening lain.');
			}
            else
            {
                // Storing the data into the database
                $save_paymentmethod = $this->model_admin->add_paymentmethod($data);

                // Show the message if the storing process was succeeded or failed
                if($save_paymentmethod)
                {
					$this->session->set_flashdata('add-paymentmethod-succeeded', 'Metode pembayaran <b>' . $method_bank_name .'</b> [' . $method_bank_account . ' - ' . $method_type . '] berhasil dibuat.');
                }
                else
                {
                    $this->session->set_flashdata('add-paymentmethod-failed', 'Metode pembayaran <b>' . $method_bank_name .'</b> [' . $method_bank_account . ' - ' . $method_type . '] gagal dibuat.');
                }
            }
        }
        else
        {
            $where['method_id'] = $this->input->post('method_id');

            // Storing the data into the database
            $save_paymentmethod = $this->model_admin->update_paymentmethod($data, $where);

            // Show the message if the storing process was succeeded or failed
            if($save_paymentmethod)
            {
				$this->session->set_flashdata('update-paymentmethod-succeeded', 'Metode pembayaran <b>' . $method_bank_name .'</b> [' . $method_bank_account . ' - ' . $method_type . '] berhasil diperbarui.');
            }
            else
            {
				$this->session->set_flashdata('update-paymentmethod-failed', 'Metode pembayaran <b>' . $method_bank_name .'</b> [' . $method_bank_account . ' - ' . $method_type . '] gagal diperbarui.');
            }
        }

        // After finish, user (admin) will be redirected to 'Kelola Metode Pembayaran' page
        redirect('dashboard/kelola-metode-pembayaran');
    }

	public function delete_paymentmethod_process()
    {
        // Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator")
		{			
			$method_id           = $this->input->post('method_id');
			$method_bank_name    = $this->input->post('method_bank_name');
			$method_bank_account = $this->input->post('method_bank_account');
			$method_type         = $this->input->post('method_type');
			
			$where['method_id'] = $method_id;

			if(!empty($method_id))
			{
				// Deleting the data from the database
				$delete_paymentmethod = $this->model_admin->delete_paymentmethod($where);

				// Show the message if the deleting process was succeeded or failed
				if($delete_paymentmethod)
				{
					$this->session->set_flashdata('delete-paymentmethod-succeeded', 'Metode pembayaran <b>' . $method_bank_name .'</b> [' . $method_bank_account . ' - ' . $method_type . '] berhasil <b>dihapus</b>.');
				}
				else
				{
					$this->session->set_flashdata('delete-paymentmethod-failed', 'Metode pembayaran <b>' . $method_bank_name .'</b> [' . $method_bank_account . ' - ' . $method_type . '] gagal dihapus.');
				}

				// After finish, user (admin) will be redirected to 'Kelola Metode Pembayaran' page
				redirect('dashboard/kelola-metode-pembayaran');
			}
			else
			{
				echo "Akses langsung tidak diperbolehkan.";
			}
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
    }

	public function get_admins_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{	
			$data['get_adm_list']  = $this->model_admin->get_admins_list($usertype);
			$data['get_adm_type']  = $this->model_admin->get_admins_type();
			$data['page_title']    = 'Kelola Akun Admin';
			$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola akun admin.';
			$data['content_title'] = 'Daftar Akun Admin';

			$this->template->main('tpl-admin/pages/admins', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function save_admin_process()
    {
        // Getting all input
        $submit_type    = $this->input->post('submit_type');
        $admin_fullname = $this->input->post('admin_fullname');
        $admin_email    = $this->input->post('admin_email');
        $admin_password = $this->input->post('admin_password');
        $admin_type_id  = $this->input->post('admin_type_id');

        // Getting user-admin creator
        $admin_creator  = $this->session->userdata('user_id');

        // Creating date of user-admin adding
        $admin_date     = date_create('now')->format('Y-m-d H:i:s');

        // Gathering all data that already available to be stored into the database
        $data['admin_fullname'] = $admin_fullname;
        $data['admin_email']    = $admin_email;
        $data['admin_type_id']  = $admin_type_id;
        $data['modified_by']    = $admin_creator;
        $data['modified_date']  = $admin_date;

        /* Set password if only its field is not empty.
           This will be useful when admin wants to update the user's data without changing the user's password, so the password won't be changed accidentally when the field is empty.
           At default condition, the field is still considered as a data input when it's empty 
           and will change the existing password. So, I made an exception.
        */
        if(!empty($admin_password))
        {
            $data['admin_password'] = md5($admin_password);
        }

        // Before storing the data, check the user status type first, is this new user or update
        if($submit_type == 'new')
        {
			$admin_employee_no = $this->input->post('admin_employee_no');
            $total_account     = $this->model_admin->total_admin_account($admin_employee_no);

            // Check if account already exist or not
            if($total_account > 0)
            {
				$this->session->set_flashdata('admin-already-exist', 'Akun dengan NIP tersebut <b>sudah ada</b>. Silakan coba dengan NIP lain.');
			}
            else
            {
                $data['admin_employee_no'] = $admin_employee_no;
				$data['active_status']     = 1;
                $data['created_by']        = $admin_creator;
                $data['created_date']      = $admin_date;

                // Storing the data into the database
                $save_admin = $this->model_admin->add_admin($data);

                // Show the message if the storing process was succeeded or failed
                if($save_admin)
                {
					$this->session->set_flashdata('add-admin-succeeded', 'Akun admin <b>' . $admin_fullname .'</b> [' . $admin_employee_no . '] berhasil dibuat.');
                }
                else
                {
                    $this->session->set_flashdata('add-admin-failed', 'Akun admin <b>' . $admin_fullname .'</b> [' . $admin_employee_no . '] gagal dibuat.');
                }
            }
        }
        else
        {
			$admin_employee_no = $this->input->post('admin_employee_no_hidden');
            $where['admin_id'] = $this->input->post('admin_id');

            // Storing the data into the database
            $save_admin = $this->model_admin->update_admin($data, $where);

            // Show the message if the storing process was succeeded or failed
            if($save_admin)
            {
				$this->session->set_flashdata('update-admin-succeeded', 'Akun admin <b>' . $admin_fullname .'</b> [' . $admin_employee_no . '] berhasil diperbarui.');
            }
            else
            {
				$this->session->set_flashdata('update-admin-failed', 'Akun admin <b>' . $admin_fullname .'</b> [' . $admin_employee_no . '] gagal diperbarui.');
            }
        }

        // After finish, user (admin) will be redirected to 'Kelola Admin' page
        redirect('dashboard/kelola-admin');
    }

	public function delete_admin_process()
    {
        // Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$admin_id          = $this->input->post('admin_id');
			$admin_fullname    = $this->input->post('admin_fullname');
			$admin_employee_no = $this->input->post('admin_employee_no');
			
			$where['admin_id'] = $admin_id;

			if(!empty($admin_id))
			{
				// Deleting the data from the database
				$delete_admin = $this->model_admin->delete_admin($where);

				// Show the message if the deleting process was succeeded or failed
				if($delete_admin)
				{
					$this->session->set_flashdata('delete-admin-succeeded', 'Akun admin <b>' . $admin_fullname .'</b> [' . $admin_employee_no . '] berhasil <b>dihapus</b>.');
				}
				else
				{
					$this->session->set_flashdata('delete-admin-failed', 'Akun admin <b>' . $admin_fullname .'</b> [' . $admin_employee_no . '] gagal dihapus.');
				}

				// After finish, user (admin) will be redirected to 'Kelola Admin' page
				redirect('dashboard/kelola-admin');
			}
			else
			{
				echo "Akses langsung tidak diperbolehkan.";
			}
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
    }

	public function get_customers_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$data['get_cus_list']  = $this->model_admin->get_customers_list();
			$data['page_title']    = 'Kelola Akun Pelanggan';
			$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola akun pelanggan.';
			$data['content_title'] = 'Daftar Akun Pelanggan';

			$this->template->main('tpl-admin/pages/customers', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function save_customer_process()
    {
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator")
		{
			// Getting all input
			$user_id       = $this->input->post('user_id');
			$user_fullname = $this->input->post('user_fullname');
			$user_phone    = $this->input->post('user_phone');
			$user_address  = $this->input->post('user_address');
			$user_npwp     = $this->input->post('user_npwp');
			$user_siup     = $this->input->post('user_siup');
			$user_email    = $this->input->post('user_email');

			// Getting user creator
			$user_creator  = $this->session->userdata('user_id');

			// Creating date of user adding
			$user_date     = date_create('now')->format('Y-m-d H:i:s');

			// Gathering all data that already available to be stored into the database
			$data['user_fullname']            = $user_fullname;
			$data['user_phone_no']            = $user_phone;
			$data['user_address']             = $user_address;
			$data['user_taxpayer_id_no']      = $user_npwp;
			$data['user_business_license_no'] = $user_siup;
			$data['user_email']               = $user_email;
			$data['modified_by']              = $user_creator;
			$data['modified_date']            = $user_date;

			$user_nik_hidden  = $this->input->post('user_nik_hidden');
			$where['user_id'] = $user_id;

			if(!empty($user_id))
			{
				// Storing the data into the database
				$save_user = $this->model_admin->update_customer($data, $where);

				// Show the message if the storing process was succeeded or failed
				if($save_user)
				{
					$this->session->set_flashdata('update-customer-succeeded', 'Akun pelanggan <b>' . $user_fullname .'</b> [' . $user_nik_hidden . '] berhasil diperbarui.');
				}
				else
				{
					$this->session->set_flashdata('update-customer-failed', 'Akun pelanggan <b>' . $user_fullname .'</b> [' . $user_nik_hidden . '] gagal diperbarui.');
				}

				// After finish, user (admin) will be redirected to 'Kelola Pelanggan' page
				redirect('dashboard/kelola-pelanggan');
			}
			else
			{
				echo "Akses langsung tidak diperbolehkan.";
			}
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
    }

	public function delete_customer_process()
    {
        // Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator")
		{
			$user_id       = $this->input->post('user_id');
			$user_fullname = $this->input->post('user_fullname');
			$user_nik      = $this->input->post('user_nik');
			
			$where['user_id'] = $user_id;

			if(!empty($user_id))
			{
				// Deleting the data from the database
				$delete_user = $this->model_admin->delete_customer($where);

				// Show the message if the deleting process was succeeded or failed
				if($delete_user)
				{
					$this->session->set_flashdata('delete-customer-succeeded', 'Akun pelanggan <b>' . $user_fullname .'</b> [' . $user_nik . '] berhasil <b>dihapus</b>.');
				}
				else
				{
					$this->session->set_flashdata('delete-customer-failed', 'Akun pelanggan <b>' . $user_fullname .'</b> [' . $user_nik . '] gagal dihapus.');
				}

				// After finish, user (admin) will be redirected to 'Kelola Pelanggan' page
				redirect('dashboard/kelola-pelanggan');
			}
			else
			{
				echo "Akses langsung tidak diperbolehkan.";
			}
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
    }

	public function view_customer_detail($customer_name, $customer_id)
	{
		$where = $customer_id;

		$data['get_cus_detail'] = $this->model_admin->get_customer_detail($where);
		$data['page_title']     = 'Rincian Data Pelanggan';
		$data['page_subtitle']  = 'Di menu ini Anda melihat rincian data pelanggan.';
		$data['content_title']  = 'Rincian Data Pelanggan';

		$this->template->main('tpl-admin/pages/customer-detail', $data);
	}

	public function view_edit_profile()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		// Get user_id session
		$user_id = $this->session->userdata('user_id');

		if($usertype == 'Customer')
		{
			$data['get_cus_detail'] = $this->model_admin->get_customer_detail($user_id);
		}
		else
		{
			$data['get_adm_detail'] = $this->model_admin->get_admin_detail($user_id);
		}
		
		$data['page_title']     = 'Sunting Profil';
		$data['page_subtitle']  = 'Di menu ini Anda dapat memperbarui data profil.';
		$data['content_title']  = 'Sunting Profil';

		$this->template->main('tpl-admin/pages/personal-profile', $data);
	}

	public function save_profile_process()
    {
		// Get user_id session
		$user_id = $this->session->userdata('user_id');

        // Get account type
        $account_type = $this->input->post('account_type');

		if($account_type == 'customer')
		{
			// Getting all input
			$user_fullname = $this->input->post('user_fullname');
			$user_nik      = $this->input->post('user_nik');
			$user_phone    = $this->input->post('user_phone');
			$user_address  = $this->input->post('user_address');
			$user_npwp     = $this->input->post('user_npwp');
			$user_siup     = $this->input->post('user_siup');
			$user_password = $this->input->post('user_password');
	
			// Creating date of user data update
			$user_date     = date_create('now')->format('Y-m-d H:i:s');
	
			// Gathering all data that already available to be stored into the database
			$data['user_fullname']            = $user_fullname;
			$data['user_identity_no']         = $user_nik;
			$data['user_phone_no']            = $user_phone;
			$data['user_address']             = $user_address;
			$data['user_taxpayer_id_no']      = $user_npwp;
			$data['user_business_license_no'] = $user_siup;
			$data['modified_by']              = $user_id;
			$data['modified_date']            = $user_date;

			// Set password if only its field is not empty.
			if(!empty($user_password))
			{
				$data['user_password'] = md5($user_password);
			}

			$where['user_id'] = $user_id;

			// Storing the data into the database
            $save_account = $this->model_admin->update_customer($data, $where);
		}
		else
		{
			// Getting all input
			$admin_fullname = $this->input->post('admin_fullname');
			$admin_email    = $this->input->post('admin_email');
			$admin_password = $this->input->post('admin_password');

			// Creating date of user-admin data update
			$admin_date     = date_create('now')->format('Y-m-d H:i:s');

			// Gathering all data that already available to be stored into the database
			$data['admin_fullname'] = $admin_fullname;
			$data['admin_email']    = $admin_email;
			$data['modified_by']    = $user_id;
			$data['modified_date']  = $admin_date;

			// Set password if only its field is not empty.
			if(!empty($admin_password))
			{
				$data['admin_password'] = md5($admin_password);
			}

			$where['admin_id'] = $user_id;

			// Storing the data into the database
            $save_account = $this->model_admin->update_admin($data, $where);
		}

		// Show the message if the storing process was succeeded or failed
		if($save_account)
		{
			$this->session->set_flashdata('update-account-succeeded', 'Informasi akunmu berhasil diperbarui.');
		}
		else
		{
			$this->session->set_flashdata('update-account-failed', 'Informasi akunmu gagal diperbarui.');
		}

        // After finish, user/admin will be redirected to 'Sunting Profil' page
        redirect('dashboard/sunting-profil');
    }
}