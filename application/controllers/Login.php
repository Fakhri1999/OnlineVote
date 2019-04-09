<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    
    public function __construct()
    {
        parent::__construct();
        if (condition) {
            # code...
        }
    }

    public function index()
    { }

    public function login()
    { }

    public function do_login()
    { }

    public function logout()
    { 
        $this->session->sess_destroy();
        redirect('');
    }
}

/* End of file Login.php */
