<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    
    // Administrator (Admin)
    if($this->session->userdata('usertype') == "Administrator")
    {
        $this->load->view('tpl-admin/_partials/sidebar-admin');
    }

    // Leasing (Admin)
    if($this->session->userdata('usertype') == "Leasing")
    {
        $this->load->view('tpl-admin/_partials/sidebar-admin');
    }

    // Billing (Admin)
    if($this->session->userdata('usertype') == "Billing")
    {
        $this->load->view('tpl-admin/_partials/sidebar-user');
    }

    // Collection (Admin)
    if($this->session->userdata('usertype') == "Collection")
    {
        $this->load->view('tpl-admin/_partials/sidebar-user');
    }

    // Customer
    if($this->session->userdata('usertype') == "Customer")
    {
        $this->load->view('tpl-admin/_partials/sidebar-user');
    }
?>