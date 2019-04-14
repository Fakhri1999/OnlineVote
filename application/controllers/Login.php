<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') != null) {
            redirect('');
        }
        
        $this->load->model('ModLogin');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('login/login');
        } else {
            // Jika pengisian form berhasil
            $username = strtolower($this->input->post('username'));
            $password = sha1($this->input->post('password'));

            $data = [
                'username' => $username,
                'password' => $password
            ];

            $result = $this->ModLogin->getSpecific($data);
            if ($result) {
                // Jika username dan password ada di database
                $data = [
                    'id_user' => $result['id_user'],
                    'username' => $result['username'],
                    'name' => $result['nama'],
                    'email' => $result['email'],
                ];
                $this->session->set_userdata($data);
                redirect('');
            } else {
                // Jika username dan password tidak ada di database
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Invalid username or password.
                    </div>');
                redirect('login');
            }
        }
    }

    public function login()
    { }

    public function register()
    {
        $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]',  [
            'is_unique' => 'This username has already taken.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('login/register');
        } else {
            // Jika pengisian form berhasil
            $username = strtolower($this->input->post('username'));
            $fullname = $this->input->post('fullname');
            $email = $this->input->post('email');
            $password = sha1($this->input->post('password'));
            $data = [
                'username' => $username,
                'nama' => $fullname,
                'password' => $password,
                'email' => $email
            ];

            $result = $this->ModLogin->insert($data);
            if ($result) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your account has been created. You can now login with your account.
                </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Registration failed. Please contact our support at <b>admin@onlinevote.com</b>
                </div>');
            }
            redirect('login');
        }
    }

    public function do_login()
    { }
}

/* End of file Login.php */
