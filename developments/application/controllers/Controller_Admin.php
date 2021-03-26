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
    }

	public function index()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$data['get_trx_list']  = $this->model_admin->get_transactions_list();
			$data['page_title']    = 'Dashboard';
			$data['page_subtitle'] = 'Di menu ini Anda dapat memantau keseluruhan ringkasan data.';
			$data['content_title'] = 'Ringkasan Data';

			$this->template->main('tpl-admin/pages/dashboard', $data);
		}
		else
		{
			redirect('dashboard/kelola-transaksi');
		}
	}

	public function get_transactions_list()
	{
		$data['get_trx_list']  = $this->model_admin->get_transactions_list();
        $data['page_title']    = 'Kelola Transaksi';
		$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola data-data transaksi yang masuk.';
		$data['content_title'] = 'Daftar Transaksi';

		$this->template->main('tpl-admin/pages/transactions', $data);
	}

	public function get_tenants_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator" OR $usertype == "Leasing")
		{
			$data['get_tnt_list']  = $this->model_admin->get_tenants_list();
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
		// Get user_id
		$user_id = $this->session->userdata('user_id');

		// Getting all input
		$submit_type     = $this->input->post('submit_type');
        $tenant_name     = $this->input->post('tenant_name');
        $tenant_size     = $this->input->post('tenant_size');
        $tenant_location = $this->input->post('tenant_location');
        $tenant_price    = $this->input->post('tenant_price');
        $tenant_info     = $this->input->post('tenant_info');

		// Date of tenant data was added
        $tenant_date     = date_create('now')->format('Y-m-d H:i:s');

		// Gathering all data that already available to be stored into the database
        $data['tenant_name']     = $tenant_name;
        $data['tenant_size']     = $tenant_size;
        $data['tenant_location'] = $tenant_location;
        $data['tenant_price']    = $tenant_price;
        $data['tenant_info']     = $tenant_info;
        $data['modified_by']     = $user_id;
        $data['modified_date']   = $tenant_date;

		// Before storing the data, check the submit type first, is this new data or update
        if($submit_type == 'new')
        {
            $data['created_by']      = $user_id;
			$data['created_date']    = $tenant_date;

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
        // $user_type_id  = $this->input->post('user_type_id');

        // Getting user-admin creator
        $admin_creator  = $this->session->userdata('user_id');

        // Creating date of user-admin adding
        $admin_date     = date_create('now')->format('Y-m-d H:i:s');

        // Gathering all data that already available to be stored into the database
        $data['admin_nip']      = $admin_fullname;
        $data['admin_fullname'] = $admin_fullname;
        $data['admin_email']    = $admin_email;
        // $data['admin_type_id']  = $admin_type_id;
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
			$admin_nip      = $this->input->post('admin_nip');
            $total_account  = $this->model_admin->total_admin_account($admin_nip);

            // Check if account already exist or not
            if($total_account > 0)
            {
				$this->session->set_flashdata('admin-already-exist', 'Akun dengan NIP tersebut <b>sudah ada</b>. Silakan coba dengan NIP lain.');
			}
            else
            {
                $data['admin_nip']    = $admin_nip;
                $data['created_by']   = $admin_creator;
                $data['created_date'] = $admin_date;

                // Storing the data into the database
                $save_user = $this->model_admin->add_admin($data);

                // Show the message if the storing process was succeeded or failed
                if($save_user)
                {
                    $this->native_session->flash_alert('add-user-succeeded', 'Successfully <b>added</b> new user.', 'alert-success');
                }
                else
                {
                    $this->native_session->flash_alert('add-user-failed', 'Failed to <b>add</b> new user.', 'alert-danger');
                }
            }
        }
        else
        {
            $where['admin_id'] = $this->input->post('admin_id');

            // Storing the data into the database
            $save_user = $this->model_admin->update_admin($data, $where);

            // Show the message if the storing process was succeeded or failed
            if($save_user)
            {
                $this->native_session->flash_alert('update-user-succeeded', 'Successfully <b>updated</b> the user.', 'alert-success');
            }
            else
            {
                $this->native_session->flash_alert('update-user-failed', 'Failed to <b>update</b> user.', 'alert-danger');
            }
        }

        // After finish, user (admin) will be redirected to 'Kelola Admin' page
        redirect('dashboard/kelola-admin');
    }

	public function get_customers_list()
	{
		// Get usertype session
		$usertype = $this->session->userdata('usertype');

		if($usertype == "Administrator")
		{
			$data['get_cus_list']  = $this->model_admin->get_customers_list();
			$data['page_title']    = 'Kelola Akun Pelanggan';
			$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola akun pelanggan.';
			$data['content_title'] = 'Daftar Akun Pelanggan';

			$this->template->main('tpl-admin/pages/customers', $data);
		}
		else
		{
			if($usertype == "Leasing")
			{
				redirect('dashboard');
			}
			else
			{
				redirect('dashboard/kelola-transaksi');
			}
		}
	}
}