<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Controller_Auth extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();

        // Load library for templating
		$this->load->library('template');
        
        // Load the model
        $this->load->model('model_auth');
    }
    
    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        $data['page_title'] = 'Login';

        $this->template->auth('tpl-auth/pages/login', $data);
    }

    public function auth_process_login()
    {
        // Getting all input
        $email    = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        // Check the data
        $auth_process_admin    = $this->model_auth->get_user_admin($email, md5($password));
        $auth_process_customer = $this->model_auth->get_user_customer($email, md5($password));

        // If the data was found, set the user session
        if($auth_process_admin->num_rows() > 0)
        {
            $auth_res = $auth_process_admin->row();

            $user_session = array
            (
                'logged-in' => TRUE,
                'fullname'  => $auth_res->admin_fullname,
                'usertype'  => $auth_res->account_type,
                'user_id'   => $auth_res->admin_id
            );

            $this->session->set_userdata($user_session);

            redirect('dashboard');
        }
        elseif($auth_process_customer->num_rows() > 0)
        {
            $auth_res = $auth_process_customer->row();

            $user_session = array
            (
                'logged-in' => TRUE,
                'fullname'  => $auth_res->user_fullname,
                'usertype'  => $auth_res->account_type,
                'user_id'   => $auth_res->user_id
            );

            $this->session->set_userdata($user_session);

            redirect('dashboard/kelola-transaksi');
        }
        else
        {
            $this->session->set_flashdata('message', 'E-mail atau kata sandi salah.');

            redirect('auth/login');
        }
    }

    public function register()
    {
        $data['page_title'] = 'Pendaftaran';

        $this->template->auth('tpl-auth/pages/register', $data);
    }

    public function auth_process_register()
    {
        // Getting all input
        $user_fullname = $this->input->post('user_fullname');
        $user_nik      = $this->input->post('user_nik');
        $user_phone    = $this->input->post('user_phone');
        $user_address  = $this->input->post('user_address');
        $user_npwp     = $this->input->post('user_npwp');
        $user_siup     = $this->input->post('user_siup');
        $user_email    = $this->input->post('user_email');
        $user_password = $this->input->post('user_password');

        // Creating registration date
        $user_regdate  = date_create('now')->format('Y-m-d H:i:s');

        // Gathering all data that already available to be stored into the database
        $data['user_fullname']            = $user_fullname;
        $data['user_identity_no']         = $user_nik;
        $data['user_phone_no']            = $user_phone;
        $data['user_address']             = $user_address;
        $data['user_taxpayer_id_no']      = $user_npwp;
        $data['user_business_license_no'] = $user_siup;
        $data['user_email']               = $user_email;
        $data['user_password']            = md5($user_password);
        $data['user_type_id']             = 5;
        $data['user_registration_date']   = $user_regdate;
        $data['active_status']            = 1;

        // Storing the data into the database
        $user_registration = $this->model_auth->add_user($data);

        // Show the message if the storing process was succeeded or failed
        if($user_registration)
        {
            $this->session->set_flashdata('registration-succeeded', 'Pendaftaran berhasil.');
        }
        else
        {
            $this->session->set_flashdata('registration-failed', 'Pendaftaran gagal.');
        }

        // After finish, user will be redirected to login page
        redirect('auth/login');
    }

    public function logout()
    {
        // Clear the user session
        $user_session = array
        (
            'logged-in',
            'fullname',
            'usertype'
        );

        $this->session->unset_userdata($user_session);
        
        redirect('auth/login');
    }
}