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
        $listed = "0123456789ABCDEFGHJKMNOPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz";
        $generatedCode = '';
        for ($i = 0; $i < 5; $i++) {
            $generatedCode .= substr($listed, rand(0, strlen($listed) - 1), 1);
        }

        return $generatedCode;
    }

    private function generateNameImage()
    {
        $listed = "0123456789abcdefghijklmnopqrstuvwxyz";
        $generatedImage = '';
        for ($i = 0; $i < 10; $i++) {
            $generatedImage .= substr($listed, rand(0, strlen($listed) - 1), 1);
        }

        return $generatedImage;
    }

    private function uploadImages($filename)
    {
        // BELUM FIX
        $config['upload_path']      = './uploads/images/';
        $config['allowed_types']    = 'png|jpeg|jpg';
        $config['remove_spaces']    = true;
        $config['overwrite']        = true;
        $config['max_sizes']        = '512';
        // $config['max_width']        = '1080';
        // $config['max_height']       = '1080';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($filename)) {
            $error = array('error' => $this->upload->display_errors());
            return false;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return true;
        }
    }

    public function createVote()
    {
        $roomCode = $this->generateCode();
        $start = strtotime($this->input->post('dateStart'));
        $finish = strtotime($this->input->post('dateFinish'));

        $insertData = array(
            'judul' => $this->input->post('title'),
            'id_user' => $this->session->userdata('id_user'),
            'deskripsi' => $this->input->post('description'),
            'waktu_pembuatan' => date('Y-m-d', $start),
            'waktu_akhir' => date('Y-m-d', $finish),
            'kode_room' => $roomCode,
        );

        $pilihan = array();

        for ($i = 0; $i < sizeof($this->input->post('list[]')); $i++) {
            $pilihanData = array(
                'id_pilihan' => $this->input->post("list[{$i}][id_pilihan]"),
                'kode_room' => $roomCode,
                'nama_pilihan' => $this->input->post("list[{$i}][nama_pilihan]"),
                'foto' => $this->input->post("list[{$i}][foto]")
            );

            array_push($pilihan, $pilihanData);
        }

        $this->ModRoom->createVoteRoom($insertData, $pilihan);
        $this->session->set_flashdata('createvote', '<div class="alert alert-success" role="alert"> Vote room successfully created </div>');
        redirect('User');
    }

    public function detailVote($code)
    {

        $data = array(
            'room' => $this->ModRoom->loadSpecificRoom($code),
            'chart' => $this->ModRoom->loadChartDataSpecificRoom($code)
        );

        $this->load->view('templates/header');
        $this->load->view('vote/detail', $data);
        $this->load->view('templates/footer');
    }

    public function detailVoteChart($code)
    {
        $chart = $this->ModRoom->loadChartDataSpecificRoom($code);
        echo json_encode($chart);
    }

    public function endVoteNow($code)
    {
        $this->ModRoom->endVoteRoom($code);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-success" role="alert"> Vote room is closed </div>');
        redirect('User');
    }

    public function startVoteNow($code)
    {
        $this->ModRoom->startVoteRoom($code);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-success" role="alert"> Vote room is started </div>');
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

        if ($this->ModRoom->checkRoomEnded($code)) {
            redirect('');
        }

        if ($this->ModRoom->checkUserVoted($code)) {
            $this->session->set_flashdata('rooms', 'Sorry, You\'ve already voted');
            redirect('#vote');
        }

        $data['sql'] = $this->ModRoom->loadSpecificRoom($code);
        $this->load->view('templates/header');
        $this->load->view('vote/vote', $data);
        $this->load->view('templates/footer');
    }

    public function submitVote()
    {
        $insertData = array(
            'id_pilihan' => $this->input->post('candidateVote'),
            'kode_room' => $this->input->post('kode_room'),
            'id_user' => $this->session->userdata('id_user')
        );

        $this->ModRoom->insertVoter($insertData);
        $this->session->set_flashdata('voted', 'Thanks for voting');
        redirect('');
    }

    public function saveToExcel($code = null)
    {
        if ($code == null) {
            redirect('');
        }

        $this->load->library('excel');
        $data = $this->ModRoom->getDataFiles($code);

        // var_dump($data);
        // return;
        $fileExcel = "vote-" . $data[0]->judul . ".xlsx";
        $excel = new Excel();

        // Styling
        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->getActiveSheet()->setTitle($data[0]->judul);
        $excel->setActiveSheetIndex(0);

        // Set Judul, Kode, Start-end
        $excel->getActiveSheet()->mergeCells('A1:C1');
        $excel->getActiveSheet()->SetCellValue('A1', $data[0]->judul)
            ->getStyle('A1')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->SetCellValue('A2', 'Kode : ' . $data[0]->kode_room);
        $excel->getActiveSheet()->SetCellValue('C2', 'Mulai    : ' . date('d-m-Y', strtotime($data[0]->waktu_pembuatan)));
        $excel->getActiveSheet()->SetCellValue('C3', 'Selesai : ' . date('d-m-Y', strtotime($data[0]->waktu_akhir)));

        // Set Header
        $excel->getActiveSheet()->SetCellValue('A5', 'No');
        $excel->getActiveSheet()->SetCellValue('B5', 'Candidate');
        $excel->getActiveSheet()->SetCellValue('C5', 'Jumlah');

        // Set Styling Header
        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);

        // Set Width Column
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth('25');
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');

        // Set Height 
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Isi
        $no = 0;
        $numRows = 6;
        foreach ($data as $val) {
            // Table Values
            $excel->setActiveSheetIndex()->setCellValue('A' . $numRows, ($no + 1));
            $excel->setActiveSheetIndex()->setCellValue('B' . $numRows, $data[$no]->nama_pilihan);
            $excel->setActiveSheetIndex()->setCellValue('C' . $numRows, $data[$no]->qty);

            // Styling Table
            $excel->getActiveSheet()->getStyle('A' . $numRows)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numRows)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numRows)->applyFromArray($style_row);

            $no++;
            $numRows++;
        }

        // Set Total
        $excel->getActiveSheet()->mergeCells("A{$numRows}:B{$numRows}");
        $excel->setActiveSheetIndex()->setCellValue('A' . $numRows, 'Total');
        $excel->setActiveSheetIndex()->setCellValue('C' . $numRows, $data[0]->total);

        $excel->getActiveSheet()->getStyle('A' . $numRows)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B' . $numRows)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C' . $numRows)->applyFromArray($style_row);

        // Save
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=$fileExcel");
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}

/* End of file Vote.php */
