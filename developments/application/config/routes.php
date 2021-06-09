<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Controller_Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Routes for Dashboard
$route['dashboard']                  = 'Controller_Admin';
$route['dashboard/kelola-transaksi'] = 'Controller_Admin/get_transactions_list';
$route['dashboard/kelola-tenant']    = 'Controller_Admin/get_tenants_list';
$route['dashboard/kelola-admin']     = 'Controller_Admin/get_admins_list';
$route['dashboard/kelola-pelanggan'] = 'Controller_Admin/get_customers_list';
$route['dashboard/kelola-metode-pembayaran'] = 'Controller_Admin/get_paymentmethods_list';

$route['dashboard/tambah-tenant']             = 'Controller_Admin/view_add_tenant';
$route['dashboard/tambah-tenant/process']     = 'Controller_Admin/save_tenant_process';
$route['dashboard/tambah-admin/process']      = 'Controller_Admin/save_admin_process';
$route['dashboard/tambah-metode-pembayaran/process'] = 'Controller_Admin/save_paymentmethod_process';
$route['dashboard/sunting-tenant/(:num)']     = 'Controller_Admin/view_edit_tenant/$1';
$route['dashboard/sunting-tenant/process']    = 'Controller_Admin/save_tenant_process';
$route['dashboard/informasi-tenant']          = 'Controller_Admin/get_tenant_info';
$route['dashboard/sunting-metode-pembayaran/process'] = 'Controller_Admin/save_paymentmethod_process';
$route['dashboard/sunting-admin/process']     = 'Controller_Admin/save_admin_process';
$route['dashboard/sunting-pelanggan/process'] = 'Controller_Admin/save_customer_process';
$route['dashboard/hapus-tenant/process']      = 'Controller_Admin/delete_tenant_process';
$route['dashboard/hapus-admin/process']       = 'Controller_Admin/delete_admin_process';
$route['dashboard/hapus-pelanggan/process']   = 'Controller_Admin/delete_customer_process';
$route['dashboard/hapus-metode-pembayaran/process'] = 'Controller_Admin/delete_paymentmethod_process';
$route['dashboard/ajukan-sewa']               = 'Controller_Admin/view_add_transaction';
$route['dashboard/ajukan-sewa/process']       = 'Controller_Admin/save_transaction_process';
$route['dashboard/ajukan-perpanjangan-sewa']  = 'Controller_Admin/view_add_renewal';
$route['dashboard/ajukan-perpanjangan-sewa/process'] = 'Controller_Admin/save_renewal_process';
$route['dashboard/ajukan-perpanjangan-sewa/(:any)']  = 'Controller_Admin/view_add_renewal/$1';
$route['dashboard/rincian-sewa/(:any)']       = 'Controller_Admin/view_transaction_detail/$1';
$route['dashboard/rincian-perpanjangan/(:any)'] = 'Controller_Admin/view_renewal_detail/$1';
$route['dashboard/tagihan/(:any)']            = 'Controller_Admin/view_invoice/$1';
$route['dashboard/tagihan-perpanjangan/(:any)'] = 'Controller_Admin/view_renewal_invoice/$1';
$route['dashboard/surat-perjanjian/(:any)']   = 'Controller_Admin/download_contract/$1';
$route['dashboard/unggah-perjanjian']         = 'Controller_Admin/upload_contract';
$route['dashboard/batalkan-transaksi']        = 'Controller_Admin/cancel_transaction';
$route['dashboard/unggah-bukti-bayar']        = 'Controller_Admin/upload_paymentslip';
$route['dashboard/verifikasi-pembayaran']     = 'Controller_Admin/verify_payment';
$route['dashboard/verifikasi-kontrak']        = 'Controller_Admin/verify_contract';
$route['dashboard/sunting-profil']            = 'Controller_Admin/view_edit_profile';
$route['dashboard/sunting-profil/simpan']     = 'Controller_Admin/save_profile_process';

$route['dashboard/pelanggan/(:any)/(:num)/detail'] = 'Controller_Admin/view_customer_detail/$1/$2';


// Routes for Auth
$route['auth']                       = 'Controller_Auth';
$route['auth/login']                 = 'Controller_Auth/login';
$route['auth/register']              = 'Controller_Auth/register';
$route['auth/login/auth-process']    = 'Controller_Auth/auth_process_login';
$route['auth/register/auth-process'] = 'Controller_Auth/auth_process_register';
$route['dashboard/logout']           = 'Controller_Auth/logout';