<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Auth extends CI_Model
{
    public function auth_process($data)
    {
     	$this->db->select('usr.user_fullname, act.account_type');
        $this->db->from('tbl_users usr');
        $this->db->join('tbl_account_types act', 'act.account_type_id = usr.user_type_id');
        $this->db->where($data);

        return $this->db->get();
    }
}