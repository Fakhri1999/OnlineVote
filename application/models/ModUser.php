<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModUser extends CI_Model
{

   public function editProfile()
   { }

   public function getCountRoomCreated()
   {
      $this->db->like('id_user', $this->session->userdata('id_user'));
      $this->db->from('room');
      return $this->db->count_all_results();
   }

   public function getCountRoomVoted()
   {
      $this->db->like('id_user', $this->session->userdata('id_user'));
      $this->db->from('voter');
      return $this->db->count_all_results();
   }
}

/* End of file ModUser.php */
