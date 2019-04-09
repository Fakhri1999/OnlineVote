<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModLogin');

        if ($this->session->userdata('username')!=null) {
            redirect('');
        }
    }

    public function index()
    {       
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if( $this->form_validation->run()==false){
            $this->load->view('templates/header');
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
            if($result){
                // Jika username dan password ada di database
                $data = [
                    'username' => $result['username']
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
        
        if($this->form_validation->run()==false){
            $this->load->view('templates/header');
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

            $this->ModLogin->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your account has been created.
            </div>');            
            redirect('login');
            
        }
    }

    public function do_login()
    { }
}

/* End of file Login.php */
