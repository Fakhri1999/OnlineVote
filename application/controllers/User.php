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

        $this->load->model(['ModRoom', 'ModUser', 'ModLogin']);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }

    public function index()
    {
        $utils['title'] = '- Profile';
        $data = array(
            'sql' => $this->ModRoom->loadRoom(),
            'room' => $this->ModUser->getCountRoomCreated(),
            'voted' => $this->ModUser->getCountRoomVoted()
        );

        $this->load->view('templates/header', $utils);
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
        if (isset($_POST['inputOne']) && isset($_POST['inputTwo']) && isset($_POST['inputThree'])) {
            $name = $this->input->post('inputOne');
            $username = strtolower($this->input->post('inputTwo'));
            $email = $this->input->post('inputThree');
            $update = [
                'nama' => $name,
                'username' => $username,
                'email' => $email
            ];

            $this->session->unset_userdata(['username', 'name', 'email']);
            $data = [
                'username' => $username,
                'name' => $name,
                'email' => $email
            ];
            $this->session->set_userdata($data);

            $this->ModUser->editProfile($update);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-12 text-center" role="alert">
                Profile has been updated.
                </div>');
        }
        redirect('user');
    }

    public function editPassword()
    {
        if (isset($_POST['inputOne']) && isset($_POST['inputTwo']) && isset($_POST['inputThree'])) {
            $oldPass = sha1($this->input->post('inputOne'));
            $newPass = sha1($this->input->post('inputTwo'));
            $confNewPass = sha1($this->input->post('inputThree'));

            $where = [
                'id_user' => $this->session->userdata('id_user')
            ];

            // Jika old password benar
            if ($this->ModLogin->getSpecific($where)['password'] == $oldPass) {
                // Jika new pass sama dengan conf new pas
                if ($newPass == $confNewPass) {
                    $update = [
                        'password' => $newPass
                    ];
                    $this->ModUser->editProfile($update);
                    $this->session->set_flashdata('message', '<div class="alert alert-success col-12 text-center" role="alert">
                        Your password has been updated.
                        </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-12 text-center" role="alert">
                        Your new password doesn\'t match with the confirmation password.
                        </div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-12 text-center" role="alert">
                    Your old password is incorrect.
                    </div>');
            }
        }
        redirect('user');
    }
}
