<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

    public function auth_process()
    {
        // Getting all input
        $email    = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        // Set data into array
        $data = array
        (
            'user_email'    => $email,
            'user_password' => md5($password)
        );

        // Check the data
        $auth_process = $this->model_auth->auth_process($data);

        // If the data was found, set the user session
        if($auth_process->num_rows() > 0)
        {
            $auth_res = $auth_process->row();

            $user_session = array
            (
                'logged-in' => TRUE,
                'fullname'  => $auth_res->user_fullname,
                'usertype'  => $auth_res->account_type
            );

            $this->session->set_userdata($user_session);

            redirect('dashboard');
        }
        else
        {
            $this->session->set_flashdata('message', 'E-mail atau kata sandi salah.');

            redirect('auth');
        }
    }

    public function register()
    {
        $data['page_title'] = 'Pendaftaran';

        $this->template->auth('tpl-auth/pages/register', $data);
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