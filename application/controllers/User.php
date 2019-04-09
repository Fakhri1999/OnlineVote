<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('username')==null) {
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
