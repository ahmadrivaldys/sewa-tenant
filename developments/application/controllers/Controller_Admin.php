<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Controller_Admin extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();

		// Load the model
        $this->load->model('model_admin');
    }

	public function index()
	{
		$data['get_trx_list']  = $this->model_admin->get_transaction_list();
        $data['page_title']    = 'Kelola Transaksi';
		$data['page_subtitle'] = 'Di menu ini Anda dapat mengelola data-data transaksi yang masuk.';

		$this->load->view('tpl-admin/index', $data);
	}
}