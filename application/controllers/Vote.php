<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vote extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == null) {
            redirect('login');
        }

        $this->load->model('ModRoom');
    }

    private function generateCode()
    {
        $listed = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $generatedCode = '';
        for ($i = 0; $i < 5; $i++) {
            $generatedCode .= substr($listed, rand(0, strlen($listed) - 1), 1);
        }

        return $generatedCode;
    }

    public function createVote()
    {
        $insertData = array(
            'judul' => $this->session->post('title'),
            'deskripsi' => $this->session->post('description'),
            'waktu_pembuatan' => $this->session->post('dateStart'),
            'waktu_akhir' => $this->session->post('dateFinish'),
            'kode_room' => $this->generateCode()
        );

        // Loop buat ambil kandidat
        // push tiap kandidat ke dalam array insertData




        $this->ModRoom->createVoteRoom($insertData);
        $this->session->set_flashdata('createvote', '<div class="alert alert-success" role="alert"> Vote room successfully created </div>');
        redirect('User');
    }

    public function detailVote($code)
    {
        $data['room'] = $this->ModRoom->loadSpecificRoom($code);
        $this->load->view('templates/header');
        $this->load->view('room/detail', $data);
        $this->load->view('templates/footer');
    }

    public function endVoteNow($code)
    {
        $this->ModRoom->endVoteRoom($code);
        $this->session->set_flashdata('endvote', '<div class="alert alert-success" role="alert"> Vote room is closed </div>');
        redirect('User');
    }

    public function roomVote()
    {
        $code = str_replace("_", "", $this->input->post('codeVote'));
        $re = '/^[\w|\d]{8}/';

        preg_match_all($re, $code, $matches, PREG_SET_ORDER, 0);
        if (!$matches) {
            $this->session->set_flashdata('rooms', '<p class="text-danger lead wow shake mt-3"> Special character isn\'t allowed</p>');
            redirect('#vote');
        }

        if (!$this->ModRoom->checkSpecificRoom($code)) {
            $this->session->set_flashdata('rooms', '<p class="text-danger lead wow shake mt-3"> Invalid room code</p>');
            redirect('#vote');
        }

        if (!$this->ModRoom->checkRoomActive($code)) {
            $this->session->set_flashdata('rooms', '<p class="text-danger lead wow shake mt-3"> Sorry, the vote room has been closed</p>');
            redirect('#vote');
        }

        $data['sql'] = $this->ModRoom->loadSpecificRoom($code);
        $this->load->view('templates/header');
        $this->load->view('room/vote', $data);
        $this->load->view('templates/footer');
    }
}

/* End of file Vote.php */
