<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model
{
    // Dashboard
    public function count_all_admins()
    {
        $this->db->from('tbl_admins');
        $this->db->where('admin_id !=', 1);

        return $this->db->count_all_results();
    }

    public function count_all_tenants()
    {
        $this->db->from('tbl_tenants');

        return $this->db->count_all_results();
    }

    public function count_all_transaction()
    {
        $this->db->from('tbl_transactions');
        $this->db->where('transaction_active_status_id', 2);

        return $this->db->count_all_results();
    }

    public function count_all_renewals()
    {
        $this->db->from('tbl_renewal_transactions');
        $this->db->where('renewal_active_status_id', 2);

        return $this->db->count_all_results();
    }

    public function count_all_customers()
    {
        $this->db->from('tbl_users');
        $this->db->where('active_status', 1);

        return $this->db->count_all_results();
    }

    // Transaction
    public function add_transaction($data)
    {
        return $this->db->insert('tbl_transactions', $data);
    }

    public function get_all_transactions()
    {
        $this->db->select('*');
        $this->db->from('tbl_transactions');

        return $this->db->get()->result();
    }

    public function get_transactions_list($where)
    {
        $this->db->select('trx.transaction_no, trx.transaction_rent_from, trx.transaction_rent_to');
        $this->db->select('trx.transaction_active_status_id');
        $this->db->select('trx.transaction_contract_file, trx.transaction_contract_verif_id, trx.transaction_date');
        $this->db->select('tnt.tenant_name, sts.status_code, sts.status_name, pay.payment_paymentslip_file');
        $this->db->select('vec.status_code as verifycon_status_code, vec.status_name as verifycon_status_name');
        $this->db->select('vep.status_code as verifyps_status_code, vep.status_name as verifyps_status_name');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->join('tbl_payments pay', 'pay.payment_transaction_no = trx.transaction_no');
        $this->db->join('tbl_status sts', 'sts.status_code = trx.transaction_active_status_id');
        $this->db->join('tbl_status vec', 'vec.status_code = trx.transaction_contract_verif_id');
        $this->db->join('tbl_status vep', 'vep.status_code = pay.payment_verif_id');
        $this->db->where('sts.status_category_code', 'ACTIVE_PERIOD');
        $this->db->where('vec.status_category_code', 'DOC_VERIFICATION');
        $this->db->where('vep.status_category_code', 'PAY_VERIFICATION');
        $this->db->where('pay.payment_type', 'new');
        $this->db->where($where);

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

    public function get_previous_transaction($where)
    {
        $this->db->select('trx.transaction_no, trx.transaction_tenant_id, tnt.tenant_name');
        $this->db->select('trx.transaction_type_of_business, trx.transaction_company_name, trx.transaction_note');
        $this->db->select('trx.transaction_customer_id');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->where('trx.transaction_no', $where);

        return $this->db->get()->row();
    }

    public function get_transaction_detail($where)
    {
        $this->db->select('trx.transaction_no, trx.transaction_rent_from, trx.transaction_rent_to');
        $this->db->select('trx.transaction_type_of_business, trx.transaction_company_name, trx.transaction_contract_file');
        $this->db->select('trx.transaction_date, tnt.tenant_id, tnt.tenant_name');
        $this->db->select('trx.transaction_contract_verif_id, trx.transaction_rent_type_id, pay.payment_verif_id');
        $this->db->select('trx.renewal_capability, trx.transaction_rent_total_month, tnt.tenant_price');
        $this->db->select('ren.status_code as rent_status_code, ren.status_name as rent_status');
        $this->db->select('rty.status_code as renttype_status_code, rty.status_name as renttype_status');
        $this->db->select('pst.status_code as payment_status_code, pst.status_name as payment_status');
        $this->db->select('vep.status_code as payment_verif_code, vep.status_name as payment_verif');
        $this->db->select('vec.status_code as verifycon_status_code, vec.status_name as verifycon_status_name');
        $this->db->select('usr.user_fullname, usr.user_address, pay.payment_nominal');
        $this->db->select('mtd.method_bank_name, mtd.method_bank_account, mtd.method_type');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->join('tbl_status ren', 'ren.status_code = trx.transaction_active_status_id');
        $this->db->join('tbl_status rty', 'rty.status_code = trx.transaction_rent_type_id');
        $this->db->join('tbl_users usr', 'usr.user_id = trx.transaction_customer_id');
        $this->db->join('tbl_payments pay', 'pay.payment_transaction_no = trx.transaction_no');
        $this->db->join('tbl_status pst', 'pst.status_code = pay.payment_status_id');
        $this->db->join('tbl_status vep', 'vep.status_code = pay.payment_verif_id');
        $this->db->join('tbl_status vec', 'vec.status_code = trx.transaction_contract_verif_id');
        $this->db->join('tbl_payment_methods mtd', 'mtd.method_id = pay.payment_method_id');
        $this->db->where('ren.status_category_code', 'ACTIVE_PERIOD');
        $this->db->where('rty.status_category_code', 'RENT_TYPE');
        $this->db->where('pst.status_category_code', 'PAYMENT');
        $this->db->where('vep.status_category_code', 'PAY_VERIFICATION');
        $this->db->where('vec.status_category_code', 'DOC_VERIFICATION');
        $this->db->where('pay.payment_type', 'new');
        $this->db->where('trx.transaction_no', $where);

        return $this->db->get()->row();
    }

    public function update_transaction($data, $where)
    {
        return $this->db->update('tbl_transactions', $data, $where);
    }


    // Renewal Transaction
    public function add_renewal($data)
    {
        return $this->db->insert('tbl_renewal_transactions', $data);
    }

    public function get_all_renewals()
    {
        $this->db->select('*');
        $this->db->from('tbl_renewal_transactions');

        return $this->db->get()->result();
    }

    public function get_renewals_list($where)
    {
        $this->db->select('ret.renewal_no, ret.renewal_rent_from, ret.renewal_rent_to');
        $this->db->select('ret.renewal_active_status_id');
        $this->db->select('ret.renewal_contract_file, ret.renewal_contract_verif_id, ret.renewal_date');
        $this->db->select('tnt.tenant_name, sts.status_code, sts.status_name, pay.payment_paymentslip_file');
        $this->db->select('vec.status_code as verifycon_status_code, vec.status_name as verifycon_status_name');
        $this->db->select('vep.status_code as verifyps_status_code, vep.status_name as verifyps_status_name');
        $this->db->from('tbl_renewal_transactions ret');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = ret.renewal_tenant_id');
        $this->db->join('tbl_payments pay', 'pay.payment_transaction_no = ret.renewal_no');
        $this->db->join('tbl_status sts', 'sts.status_code = ret.renewal_active_status_id');
        $this->db->join('tbl_status vec', 'vec.status_code = ret.renewal_contract_verif_id');
        $this->db->join('tbl_status vep', 'vep.status_code = pay.payment_verif_id');
        $this->db->where('sts.status_category_code', 'ACTIVE_PERIOD');
        $this->db->where('vec.status_category_code', 'DOC_VERIFICATION');
        $this->db->where('vep.status_category_code', 'PAY_VERIFICATION');
        $this->db->where('pay.payment_type', 'renewal');
        $this->db->where($where);

        return $this->db->get()->result();
    }

    public function get_renewal($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_renewal_transactions');
        $this->db->where('renewal_no', $where);

        return $this->db->get()->result();
    }

    public function get_renewal_detail($where)
    {
        $this->db->select('ret.renewal_no, ret.renewal_rent_from, ret.renewal_rent_to');
        $this->db->select('ret.renewal_type_of_business, ret.renewal_company_name, ret.renewal_contract_file');
        $this->db->select('ret.renewal_date, tnt.tenant_id, tnt.tenant_name');
        $this->db->select('ret.renewal_contract_verif_id, ret.renewal_rent_type_id, pay.payment_verif_id');
        $this->db->select('ret.renewal_rent_total_month, tnt.tenant_price');
        $this->db->select('ren.status_code as rent_status_code, ren.status_name as rent_status');
        $this->db->select('rty.status_code as renttype_status_code, rty.status_name as renttype_status');
        $this->db->select('pst.status_code as payment_status_code, pst.status_name as payment_status');
        $this->db->select('vep.status_code as payment_verif_code, vep.status_name as payment_verif');
        $this->db->select('vec.status_code as verifycon_status_code, vec.status_name as verifycon_status_name');
        $this->db->select('usr.user_fullname, usr.user_address, pay.payment_nominal');
        $this->db->select('mtd.method_bank_name, mtd.method_bank_account, mtd.method_type');
        $this->db->from('tbl_renewal_transactions ret');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = ret.renewal_tenant_id');
        $this->db->join('tbl_status ren', 'ren.status_code = ret.renewal_active_status_id');
        $this->db->join('tbl_status rty', 'rty.status_code = ret.renewal_rent_type_id');
        $this->db->join('tbl_users usr', 'usr.user_id = ret.renewal_customer_id');
        $this->db->join('tbl_payments pay', 'pay.payment_transaction_no = ret.renewal_no');
        $this->db->join('tbl_status pst', 'pst.status_code = pay.payment_status_id');
        $this->db->join('tbl_status vep', 'vep.status_code = pay.payment_verif_id');
        $this->db->join('tbl_status vec', 'vec.status_code = ret.renewal_contract_verif_id');
        $this->db->join('tbl_payment_methods mtd', 'mtd.method_id = pay.payment_method_id');
        $this->db->where('ren.status_category_code', 'ACTIVE_PERIOD');
        $this->db->where('rty.status_category_code', 'RENT_TYPE');
        $this->db->where('pst.status_category_code', 'PAYMENT');
        $this->db->where('vep.status_category_code', 'PAY_VERIFICATION');
        $this->db->where('vec.status_category_code', 'DOC_VERIFICATION');
        $this->db->where('pay.payment_type', 'renewal');
        $this->db->where('ret.renewal_no', $where);

        return $this->db->get()->row();
    }

    public function update_renewal_transaction($data, $where)
    {
        return $this->db->update('tbl_renewal_transactions', $data, $where);
    }


    // Payment
    public function add_payment_data($data)
    {
        return $this->db->insert('tbl_payments', $data);
    }

    public function get_payment_method_list()
    {
        $this->db->select('method_id, method_bank_name, method_type');
        $this->db->from('tbl_payment_methods');

        return $this->db->get()->result();
    }

    public function update_payment($data, $where)
    {
        return $this->db->update('tbl_payments', $data, $where);
    }


    // Tenant
    public function add_tenant($data)
    {
        return $this->db->insert('tbl_tenants', $data);
    }

    public function get_tenants_list($where)
    {
        $this->db->select('tnt.tenant_id, tnt.tenant_name, tnt.tenant_size, tnt.tenant_location, tnt.tenant_price, tnt.tenant_min_period, tnt.tenant_info, tnt.tenant_image, sts.status_name');
        $this->db->from('tbl_tenants tnt');
        $this->db->join('tbl_status sts', 'sts.status_code = tnt.tenant_availability');
        $this->db->where('sts.status_category_code', 'AVAILABILITY');
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


    // Payment Method
    public function total_paymentmethod_account($bank_name, $bank_account)
    {
        $this->db->select('method_bank_name, method_bank_account');
        $this->db->from('tbl_payment_methods');
        $this->db->where('method_bank_name', $bank_name);
        $this->db->where('method_bank_account', $bank_account);

        return $this->db->get()->num_rows();
    }

    public function add_paymentmethod($data)
    {
        return $this->db->insert('tbl_payment_methods', $data);
    }

    public function get_paymentmethods_list($where)
    {
        $this->db->select('pym.method_id, pym.method_bank_name, pym.method_bank_account, pym.method_type');
        $this->db->from('tbl_payment_methods pym');
        $this->db->where($where);

        return $this->db->get()->result();
    }

    public function update_paymentmethod($data, $where)
    {
        return $this->db->update('tbl_payment_methods', $data, $where);
    }

    public function delete_paymentmethod($where)
    {
        return $this->db->delete('tbl_payment_methods', $where);
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

    public function get_admin_detail($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_admins');
        $this->db->where('admin_id', $where);

        return $this->db->get()->row();
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
        $this->db->select('user_id, user_identity_no, user_taxpayer_id_no, user_business_license_no, user_fullname, user_phone_no, user_email, user_address, user_photo');
        $this->db->from('tbl_users');

        return $this->db->get()->result();
    }

    public function get_customer_contract($where)
    {
        $this->db->select('usr.user_id, usr.user_fullname, usr.user_phone_no, usr.user_address, trx.transaction_type_of_business, trx.transaction_company_name');
        $this->db->from('tbl_users usr');
        $this->db->join('tbl_transactions trx', 'trx.transaction_customer_id = usr.user_id');
        $this->db->where($where);

        return $this->db->get()->row();
    }

    public function get_customer_detail($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_id', $where);

        return $this->db->get()->row();
    }

    public function update_customer($data, $where)
    {
        return $this->db->update('tbl_users', $data, $where);
    }

    public function delete_customer($where)
    {
        return $this->db->delete('tbl_users', $where);
    }
}