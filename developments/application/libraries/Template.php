<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template 
{
	protected $_ci;
    
    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function auth($content, $data = NULL)
  	{
        $data['header_logo'] = $this->_ci->load->view('tpl-auth/_partials/header-logo', $data, TRUE);
        $data['footer']      = $this->_ci->load->view('tpl-auth/_partials/footer', $data, TRUE);
        $data['content']     = $this->_ci->load->view($content, $data, TRUE);
        
        $this->_ci->load->view('tpl-auth/index', $data);
    }
    
  	function main($content, $data = NULL)
  	{
        $data['sidebar_menu']   = $this->_ci->load->view('tpl-admin/_partials/sidebar-menu', $data, TRUE);
        $data['flash_alert']    = $this->_ci->load->view('tpl-admin/_partials/flash-alert', $data, TRUE);
        $data['section_header'] = $this->_ci->load->view('tpl-admin/_partials/section-header', $data, TRUE);
        $data['content']        = $this->_ci->load->view($content, $data, TRUE);
        
        $this->_ci->load->view('tpl-admin/index', $data);
    }
}