<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model
{
    // Transaction
    public function add_transaction($data)
    {
        return $this->db->insert('tbl_transactions', $data);
    }

    public function get_transactions_list()
    {
        $this->db->select('trx.transaction_no, trx.transaction_rent_from, trx.transaction_rent_to, trx.transaction_date, tnt.tenant_name, sts.status_code, sts.status_name');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->join('tbl_status sts', 'sts.status_code = trx.transaction_active_status_id');
        $this->db->where('sts.status_category_code', 'ACTIVE_PERIOD');

        return $this->db->get()->result();
    }

    public function get_last_transactions_id()
    {
        $this->db->select_max('transaction_id');
        $this->db->from('tbl_transactions');

        return $this->db->get()->row();
    }
    
    public function get_last_transactions_no($where)
    {
        $this->db->select('transaction_no');
        $this->db->from('tbl_transactions');
        $this->db->where('transaction_id', $where);

        return $this->db->get()->row();
    }

    public function get_transaction_detail($where)
    {
        $this->db->select('trx.transaction_no, trx.transaction_rent_from, trx.transaction_rent_to, trx.transaction_type_of_business, trx.transaction_company_name, trx.transaction_date, tnt.tenant_name, ren.status_code as rent_status_code, ren.status_name as rent_status, rty.status_code as renttype_status_code, rty.status_name as renttype_status, stp.status_code as payment_status_code, stp.status_name as payment_status, usr.user_fullname');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->join('tbl_status ren', 'ren.status_code = trx.transaction_active_status_id');
        $this->db->join('tbl_status rty', 'rty.status_code = trx.transaction_rent_type_id');
        $this->db->join('tbl_users usr', 'usr.user_id = trx.transaction_customer_id');
        $this->db->join('tbl_payments pay', 'pay.payment_transaction_no = trx.transaction_no');
        $this->db->join('tbl_status stp', 'stp.status_code = pay.payment_status_id');
        $this->db->where('ren.status_category_code', 'ACTIVE_PERIOD');
        $this->db->where('rty.status_category_code', 'RENT_TYPE');
        $this->db->where('stp.status_category_code', 'PAYMENT');
        $this->db->where('trx.transaction_no', $where);

        return $this->db->get()->row();
    }


    // Payment
    public function add_payment_data($data)
    {
        return $this->db->insert('tbl_payments', $data);
    }


    // Tenant
    public function add_tenant($data)
    {
        return $this->db->insert('tbl_tenants', $data);
    }

    public function get_tenants_list($where)
    {
        $this->db->select('tenant_id, tenant_name, tenant_size, tenant_location, tenant_price, tenant_min_period, tenant_info, tenant_image');
        $this->db->from('tbl_tenants');
        $this->db->where($where);

        return $this->db->get()->result();
    }

    public function get_tenant($where)
    {
        $this->db->select('tenant_id, tenant_name, tenant_size, tenant_location, tenant_price, tenant_min_period, tenant_info, tenant_image');
        $this->db->from('tbl_tenants');
        $this->db->where($where);

        return $this->db->get()->row();
    }

    public function get_tenant_info($tenant_id)
    {
        $query = $this->db->get_where('tbl_tenants', array('tenant_id' => $tenant_id));
        return $query;
    }

    public function update_tenant($data, $where)
    {
        return $this->db->update('tbl_tenants', $data, $where);
    }

    public function delete_tenant($where)
    {
        return $this->db->delete('tbl_tenants', $where);
    }


    // Admin
    public function total_admin_account($where)
    {
        $this->db->select('admin_employee_no');
        $this->db->from('tbl_admins');
        $this->db->where('admin_employee_no', $where);

        return $this->db->get()->num_rows();
    }

    public function add_admin($data)
    {
        return $this->db->insert('tbl_admins', $data);
    }

    public function get_admins_list($usertype)
    {
        $this->db->select('adm.admin_id, adm.admin_employee_no, adm.admin_fullname, adm.admin_email, adm.admin_photo, adm.admin_type_id, act.account_type');
        $this->db->from('tbl_admins adm');
        $this->db->join('tbl_account_types act', 'act.account_type_id = adm.admin_type_id');
        $this->db->where('adm.admin_type_id !=', 1);

        if($usertype == 'Leasing')
        {
            $this->db->where('adm.admin_type_id !=', 2);
        }

        return $this->db->get()->result();
    }

    public function get_admins_type()
    {
        $this->db->select('account_type_id, account_type');
        $this->db->from('tbl_account_types');
        $this->db->where('account_type_id >', 1);
        $this->db->where('account_type_id !=', 5);
        $this->db->order_by('account_type_order');

        return $this->db->get()->result();
    }

    public function update_admin($data, $where)
    {
        return $this->db->update('tbl_admins', $data, $where);
    }

    public function delete_admin($where)
    {
        return $this->db->delete('tbl_admins', $where);
    }


    // Customer
    public function get_customers_list()
    {
        $this->db->select('user_identity_no, user_taxpayer_id_no, user_fullname, user_email, user_photo');
        $this->db->from('tbl_users');

        return $this->db->get()->result();
    }
}