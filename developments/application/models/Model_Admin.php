<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model
{
    public function get_transactions_list()
    {
        $this->db->select('trx.transaction_number, trx.transaction_date, tnt.tenant_name, usr.user_fullname');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->join('tbl_users usr', 'usr.user_id = trx.transaction_customer_id');

        return $this->db->get()->result();
    }

    public function get_tenants_list()
    {
        $this->db->select('tenant_name, tenant_size, tenant_location, tenant_price, tenant_info, tenant_image');
        $this->db->from('tbl_tenants');

        return $this->db->get()->result();
    }

    public function get_admins_list($user_id, $usertype)
    {
        $this->db->select('adm.admin_employee_no, adm.admin_fullname, adm.admin_email, adm.admin_photo, act.account_type');
        $this->db->from('tbl_admins adm');
        $this->db->join('tbl_account_types act', 'act.account_type_id = adm.admin_type_id');
        $this->db->where('adm.admin_type_id !=', 1);

        if($usertype == 'Leasing')
        {
            $this->db->where('adm.admin_type_id !=', 2);
        }

        return $this->db->get()->result();
    }

    public function get_customers_list()
    {
        $this->db->select('user_identity_no, user_taxpayer_id_no, user_fullname, user_email, user_photo');
        $this->db->from('tbl_users');

        return $this->db->get()->result();
    }
}