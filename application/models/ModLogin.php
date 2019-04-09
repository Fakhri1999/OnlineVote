<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModLogin extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert('user', $data);
    }

    public function getSpecific($data)
    {
        return $this->db->get_where('user', $data)->row_array();
    }
    

}

/* End of file ModLogin.php */
