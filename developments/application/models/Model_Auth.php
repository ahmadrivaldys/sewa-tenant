<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Auth extends CI_Model
{
    public function get_user_customer($email, $password)
    {
     	$this->db->select('usr.user_id, usr.user_fullname, act.account_type');
        $this->db->from('tbl_users usr');
        $this->db->join('tbl_account_types act', 'act.account_type_id = usr.user_type_id');
        $this->db->where('usr.user_email', $email);
        $this->db->where('usr.user_password', $password);

        return $this->db->get();
    }

    public function get_user_admin($email, $password)
    {
     	$this->db->select('adm.admin_id, adm.admin_fullname, act.account_type');
        $this->db->from('tbl_admins adm');
        $this->db->join('tbl_account_types act', 'act.account_type_id = adm.admin_type_id');
        $this->db->where('adm.admin_email', $email);
        $this->db->where('adm.admin_password', $password);

        return $this->db->get();
    }

    public function add_user($data)
    {
        return $this->db->insert('tbl_users', $data);
    }
}