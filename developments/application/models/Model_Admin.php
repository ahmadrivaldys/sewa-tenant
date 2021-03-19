<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model
{
    public function get_transaction_list()
    {
        $this->db->select('trx.transaction_number, trx.transaction_date, tnt.tenant_name, usr.user_fullname');
        $this->db->from('tbl_transactions trx');
        $this->db->join('tbl_tenants tnt', 'tnt.tenant_id = trx.transaction_tenant_id');
        $this->db->join('tbl_users usr', 'usr.user_username = trx.transaction_customer');

        return $this->db->get()->result();
    }
}