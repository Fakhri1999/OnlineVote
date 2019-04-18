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
        $this->load->library('upload');
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

    private function uploadConfig()
    {
        $config['upload_path']      = './uploads/images/';
        $config['allowed_types']    = 'png|jpeg|jpg';
        $config['remove_spaces']    = true;
        $config['overwrite']        = true;
        $config['max_sizes']        = '512';
        $config['max_width']        = '1080';
        $config['max_height']       = '1080';

        return $config;
    }

    public function createVote()
    {
        $insertData = array(
            'judul' => $this->input->post('title'),
            'deskripsi' => $this->input->post('description'),
            'waktu_pembuatan' => $this->input->post('dateStart'),
            'waktu_akhir' => $this->input->post('dateFinish'),
            'kode_room' => $this->generateCode(),
            'candidate' => $this->input->post('list[]')
        );

        $this->upload->initialize($this->uploadConfig($insertData));

        for ($i = 0; $i < sizeof($insertData['candidate']); $i++) {

            $file = $this->input->post("list[{$i}][foto]");

            if (!$this->upload->do_upload($file)) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('uploadFile', '<div class="alert alert-danger pb-0" role="alert">' . $error . '.</div>');
                echo 'error';
            } else {
                $this->session->set_flashdata('uploadFile', '<div class="alert alert-success" role="alert">Your file has been succesfully uploaded.</div>');
                echo $this->upload->data();
            }
        }

        // echo json_encode(array(
        //     'identitas' => $insertData,
        // ));

        return;
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
        $re = '/^[\w|\d]{5}/';

        preg_match_all($re, $code, $matches, PREG_SET_ORDER, 0);
        if (strlen($code) < 5) {
            $this->session->set_flashdata('rooms', 'Please input the correct code');
            redirect('#vote');
        }

        if (!$matches) {
            $this->session->set_flashdata('rooms', 'Special character isn\'t allowed');
            redirect('#vote');
        }

        if (!$this->ModRoom->checkSpecificRoom($code)) {
            $this->session->set_flashdata('rooms', 'Invalid room code');
            redirect('#vote');
        }

        if (!$this->ModRoom->checkRoomActive($code)) {
            $this->session->set_flashdata('rooms', 'Sorry, the vote room has been closed');
            redirect('#vote');
        }

        if (!$this->ModRoom->checkUserVoted($code)) {
            $this->session->set_flashdata('rooms', 'Sorry, You\'ve already voted');
            redirect('#vote');
        }

        $data['sql'] = $this->ModRoom->loadSpecificRoom($code);
        $this->load->view('templates/header');
        $this->load->view('room/vote', $data);
        $this->load->view('templates/footer');
    }
}

/* End of file Vote.php */
