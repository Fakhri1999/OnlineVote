<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $utils['title'] = '- Home';
        $this->load->view('templates/header', $utils);
        $this->load->view('home/index');
        $this->load->view('templates/footer');
    }
}

/* End of file Home.php */
