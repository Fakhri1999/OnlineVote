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
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function getSpecific($data)
    {
        return $this->db->get_where('user', $data)->row_array();
    }
    
    public function setExp($id, $kode)
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = new DateTime('+30 minutes');
        $dateFormated = $date->format('Y-m-d H:i:s');
        $data = [
            'id_user' => $id,
            'kode' => $kode,
            'expired' => $dateFormated
        ];

        if($this->kodeExist($kode)){
            $this->db->set('expired', $data['expired']);
            $this->db->where('kode', $data['kode']);
            $this->db->update('recovery');
        } else {
            $this->db->insert('recovery', $data);
        }
    }

    private function kodeExist($kode)
    {
        $this->db->where('kode', $kode);
        return $this->db->get('recovery')->num_rows() > 0 ? true : false;
    }

    public function verifyKode($kode)
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = new DateTime();
        $dateFormated = $date->format('Y-m-d H:i:s');

        $this->db->where('kode', $kode);
        $result = $this->db->get('recovery')->row_array();

        if($result['expired'] > $dateFormated){
            return $result;
        } else {
            return null;
        }
    }

    public function resetPassword($id, $update)
    {
        $this->db->where('id_user', $id);
        $this->db->set($update);
        $this->db->update('user');

        $this->db->where('id_user', $id);
        $this->db->delete('recovery');
    }

}

/* End of file ModLogin.php */
