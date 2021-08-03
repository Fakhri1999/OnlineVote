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
        $utils['title'] = '- Login';
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/login-header', $utils);
            $this->load->view('login/login');
        } else {
            // Jika pengisian form berhasil
            $data = [
                'username' => strtolower($this->input->post('username')),
                'password' => sha1($this->input->post('password'))
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

    public function register()
    {
        $utils['title'] = '- Register';
        $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]',  [
            'is_unique' => 'This username has already taken.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/login-header', $utils);
            $this->load->view('login/register');
            // Jika pengisian form berhasil
        } else {
            $data = [
                'username' => strtolower($this->input->post('username')),
                'nama' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'password' => sha1($this->input->post('password'))
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

    public function forgetPassword()
    {
        $utils['title'] = '- Forget Password';
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/login-header', $utils);
            $this->load->view('login/forgetPassword');
        } else {
            $data = [
                'username' => strtolower($this->input->post('username'))
            ];

            $result = $this->ModLogin->getSpecific($data);

            if ($result) {
                if ($this->sendEmail($result)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    We have send an email to your email address. Please follow the instruction in that email.
                    </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Send recovery email failed. Please contact our support at <b>admin@onlinevote.com</b>
                    </div>');
                }
                // return;
                redirect('login');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username incorrect. Please use the correct username.
                </div>');
                redirect('forget');
            }
        }
    }

    private function sendEmail($data)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'noreply.onlinevote@gmail.com',
            'smtp_pass' => 'sembarangwes12345@',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'smtp_crypto' => 'TLS'
        ];
        $kode = md5('voting' . $data['password']);
        $this->ModLogin->setExp($data['id_user'], $kode);
        // echo $data['email'];
        // return;
        $this->load->library('email', $config);
        $this->email->from('noreply.onlinevote@gmail.com', 'Online Vote');
        $this->email->to($data['email']);
        $this->email->subject('Reset Password');
        $this->email->message("Click <a href='" . base_url('reset/' . $kode) . "'>this link</a> to reset your password");
        return $this->email->send() ? true : false;
    }

    public function resetPassword($kode)
    {
        if (isset($kode)) {
            $result = $this->ModLogin->verifyKode($kode);
            // Jika kode yang dimasukkan di url benar
            if ($result) {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordConf]');
                $this->form_validation->set_rules('passwordConf', 'Password confirmation', 'trim|required|matches[password]');
                if ($this->form_validation->run() == false) {
                    $data = [
                        'kode' => $kode,
                        'title' => '- Reset Password'
                    ];
                    $this->load->view('templates/login-header', $data);
                    $this->load->view('login/resetPassword', $data);
                } else {
                    $data = [
                        'password' => sha1($this->input->post('password'))
                    ];

                    $this->ModLogin->resetPassword($result['id_user'], $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Your password has been updated! You can login with your new password.
                    </div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your link has expired or incorrect. Please request a new one.
                </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Your link has expired or incorrect. Please request a new one.
            </div>');
            redirect('login');
        }
    }
}

/* End of file Login.php */
