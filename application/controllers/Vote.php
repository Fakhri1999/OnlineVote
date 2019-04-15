<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vote extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    { }

    private function generateCode()
    {
        $listed = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $generatedCode = '';
        for ($i = 0; $i < 5; $i++) {
            $generatedCode .= substr($listed, rand(0, strlen($listed) - 1), 1);
        }

        echo json_encode($generatedCode);
    }

    public function createVote()
    { }

    public function detailVote()
    { }

    public function endVoteNow()
    { }

    public function roomVote()
    { 
        $code = $this->input->post('');

        
    }
}

/* End of file Vote.php */
