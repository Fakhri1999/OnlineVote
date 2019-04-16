<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == null) {
            redirect('login');
        }

        $this->load->model(['ModRoom', 'ModUser']);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }

    public function index()
    {
        $data = array(
            'sql' => $this->ModRoom->loadRoom(),
            'room' => $this->ModUser->getCountRoomCreated(),
            'voted' => $this->ModUser->getCountRoomVoted()
        );

        $this->load->view('templates/header');
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer');
    }

    public function getProfile()
    {
        $data = array(
            'name' => $this->session->userdata('name'),
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email')
        );

        echo json_encode($data);
    }

    public function editProfile()
    {
        if (isset($_POST['']))
    }
}
