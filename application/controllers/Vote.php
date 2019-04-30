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
        // echo $generatedImage;
        return $generatedImage;
    }

    private function uploadImages($field_name)
    {
        // Image Generate
        do {
            $nameImage = $this->generateNameImage();
            $where = ['foto' => $nameImage];
        } while ($this->ModRoom->checkExist($where, 'pilihan'));

        $config = [
            'upload_path'   => './uploads/images/',
            'allowed_types' => 'png|jpeg|jpg',
            'remove_spaces' => true,
            // 'overwrite'     => true,
            // 'max_sizes'     => '512',
            // 'max_width'     => '1080',
            // 'max_heigth'    => '1080',
            'file_name'     => $nameImage
        ];

        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            return false;
        } else {
            $data = array('upload_data' => $this->upload->data());
            echo "Sukses";
            return $this->upload->data('file_name');
        }
    }

    public function createVote()
    {
        $titles = $this->input->post('title');
        $re = '/[\/:*?"<>|]/';
        preg_match_all($re, $titles, $results, PREG_SET_ORDER, 0);

        if($results){
            $this->session->set_flashdata('voteNow', '<div class="alert alert-danger" role="alert">Vote room creation error cause your title contain characters \ / : * ? " < > | </div>');
            redirect('User');
        }
        
        do {
            $roomCode = $this->generateCode();
            $where = ['kode_room' => $roomCode];
        } while ($this->ModRoom->checkExist($where, 'room'));

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
                'foto' => $this->uploadImages("list" . $i)
            );

            array_push($pilihan, $pilihanData);
        }

        $this->ModRoom->createVoteRoom($insertData, $pilihan);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-success" role="alert"> Vote room successfully created </div>');
        redirect('User');
    }

    public function detailVote($code)
    {
        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_error('You don\'t have access to the url you where trying to reach', 403, '403 - Forbidden: Access is denied.');
        }

        $utils['title'] = '- Vote Details';
        $data = array(
            'room' => $this->ModRoom->loadSpecificRoom($code),
            'chart' => $this->ModRoom->loadChartDataSpecificRoom($code)
        );

        $this->load->view('templates/header', $utils);
        $this->load->view('vote/detail', $data);
        $this->load->view('templates/footer');
    }

    public function resultVote($code)
    {
        $utils['title'] = '- Vote Results';
        $data = array(
            'room' => $this->ModRoom->loadSpecificRoom($code),
            'chart' => $this->ModRoom->loadChartDataSpecificRoom($code)
        );

        $this->load->view('templates/header', $utils);
        $this->load->view('vote/room', $data);
        $this->load->view('templates/footer');
    }

    public function detailVoteChart($code)
    {
        $chart = $this->ModRoom->loadChartDataSpecificRoom($code);
        echo json_encode($chart);
    }

    public function endVoteNow($code)
    {
        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_error('You don\'t have access to the url you where trying to reach', 403, '403 - Forbidden: Access is denied.');
        }

        $this->ModRoom->endVoteRoom($code);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-success" role="alert"> Vote room is closed </div>');
        redirect('User');
    }

    public function startVoteNow($code)
    {
        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_error('You don\'t have access to the url you where trying to reach', 403, '403 - Forbidden: Access is denied.');
        }

        $this->ModRoom->startVoteRoom($code);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-success" role="alert"> Vote room is started </div>');
        redirect('User');
    }

    public function deleteVote($code)
    {
        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_404();
        }

        $this->ModRoom->deleteVote($code);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-danger" role="alert"> Vote room was successfully deleted </div>');
        redirect('User');
    }

    public function updateVote()
    {
        $code = $this->input->post('roomCode');

        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_404();
        }

        $start = strtotime($this->input->post('dateStart'));
        $finish = strtotime($this->input->post('dateFinish'));

        $insertData = array(
            'judul' => $this->input->post('title'),
            'deskripsi' => $this->input->post('description'),
            'waktu_pembuatan' => date('Y-m-d', $start),
            'waktu_akhir' => date('Y-m-d', $finish),
            'active' => 0
        );

        $this->ModRoom->updateVote($insertData, $code);
        $this->session->set_flashdata('voteNow', '<div class="alert alert-success" role="alert"> Vote room successfully updated </div>');
        redirect('User');
    }

    public function roomVote()
    {
        $utils['title'] = '- Voting Room';
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

        if (!$this->ModRoom->checkRoomActive($code) || $this->ModRoom->checkRoomEnded($code)) {
            $this->resultVote($code);
            return;
        }

        if ($this->ModRoom->checkUserVoted($code)) {
            $waktuAkhirRaw = $this->ModRoom->getVoteDate($code)[0];
            $waktuAkhir = date('d-m-Y', strtotime("+1 day", strtotime($waktuAkhirRaw['waktu_akhir'])));

            $this->session->set_flashdata('rooms', "Sorry, the vote results will be announced at {$waktuAkhir}");
            redirect('#vote');
        }

        $data['sql'] = $this->ModRoom->loadSpecificRoom($code);
        $this->load->view('templates/header', $utils);
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
        $this->session->set_flashdata('voted', 'Enter the room code when vote already ended to check the results');
        redirect('');
    }

    public function saveToExcel($code)
    {
        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_error('You don\'t have access to the url you where trying to reach', 403, '403 - Forbidden: Access is denied.');
        }

        $this->load->library('excel');
        $data = $this->ModRoom->getDataFiles($code);

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

    public function saveToPDF($code)
    { 
        if (!$this->ModRoom->checkRoomCreator($code)) {
            show_error('You don\'t have access to the url you where trying to reach', 403, '403 - Forbidden: Access is denied.');
        }

        $this->load->library('filePDF');
        $data = $this->ModRoom->getDataFiles($code);

        $pdf = new filePDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Judul
        $pdf->setFont('Arial', 'B', 12);
        $pdf->Cell('83');
        $pdf->Cell(24, 5, $data[0]->judul, 0, 0, 'C');
        $pdf->Ln(7);

        // Dibawah judul
        $pdf->setFont('Arial', '', 11);
        $pdf->Cell(10);
        $pdf->Cell(20, 3, 'Kode : '.$data[0]->kode_room, 0, 0, '');
        $pdf->Cell(115);
        $pdf->Cell(35, 5, 'Mulai    : '.date('d-m-Y', strtotime($data[0]->waktu_pembuatan)), 0, 1, '');
        $pdf->Cell(145);
        $pdf->Cell(35, 5, 'Selesai : '.date('d-m-Y', strtotime($data[0]->waktu_akhir)), 0, 1, '');
        $pdf->Ln(8);
        
        // Tabel
        $pdf->Cell(10);
        // Header tabel
        $pdf->setFont('Arial', 'B', 11);
        $pdf->Cell(56, 7, 'No', 1, 0, 'C');
        $pdf->Cell(58, 7, 'Candidate', 1, 0, 'C');
        $pdf->Cell(57, 7, 'Jumlah', 1, 1, 'C');
        // Isi tabel
        $pdf->setFont('Arial', '', 11);
        for ($i=0; $i < sizeof($data); $i++) { 
            $pdf->Cell(10);
            $pdf->Cell(56, 7, $i+1, 1, 0, 'C');
            $pdf->Cell(58, 7, $data[$i]->nama_pilihan, 1, 0, 'C');
            $pdf->Cell(57, 7, $data[$i]->qty, 1, 1, 'C');
        }
        $pdf->Cell(10);
        $pdf->Cell(114, 7, 'Total', 1, 0, 'C');
        $pdf->Cell(57, 7, $data[0]->total, 1, 1, 'C');

        $pdf->output('I', 'vote-' . $data[0]->judul . '.pdf');
    }

    public function tes($code)
    {
        echo json_encode($this->ModRoom->getDataFiles($code));
    }
}

/* End of file Vote.php */
