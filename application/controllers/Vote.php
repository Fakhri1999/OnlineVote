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
            'judul' => $this->input->post('title'),
            'deskripsi' => $this->input->post('description'),
            'waktu_pembuatan' => $this->input->post('dateStart'),
            'waktu_akhir' => $this->input->post('dateFinish'),
            'kode_room' => $this->generateCode()
        );

        // do upload
        $config['upload_path']      = realpath(APPPATH . '../bukti-bayar/');
        $config['allowed_types']    = 'png|jpeg|jpg';
        $config['file_name']        = $this->session->userdata('username');
        $config['remove_spaces']    = true;
        $config['overwrite']        = true;
        $config['max_sizes']        = '512';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('message', '<div class="alert alert-danger pb-0" role="alert">
            '.$error.'.            
            </div>');
            redirect('user/upload');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your file has been succesfully uploaded.
            </div>');
            $where = [
                'username' => $this->session->userdata('username')
            ];
            $update = [
                'bukti_bayar' => $this->upload->data()['file_name']
            ];
            $this->loginModel->update_data($where, $update);

            redirect('user/upload');
        }
        // end do upload

        $nameAll = $this->input->post('list[]');
        echo json_encode(array(
            'Identitas' => $insertData,
            'pilihan' => $nameAll
        ));
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
