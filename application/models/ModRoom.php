<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModRoom extends CI_Model
{

   public function loadRoom()
   {
      $this->db->select('judul, deskripsi, kode_room, waktu_pembuatan, waktu_akhir');
      return $this->db->get_where('room', array('id_user' => $this->session->userdata('id_user')))->result();
   }

   public function loadSpecificRoom($code)
   {
      // detail informasi room
      // untuk vote atau lihat detail
      $this->db->select('*');
      $this->db->from('room r');
      $this->db->join('pilihan p', 'r.id_room = p.id_room');
      $this->db->where('kode_room', $code);
      return $this->db->get()->result();
   }

   public function checkSpecificRoom($code)
   {
      $query = $this->db->get_where('room', array('id_room' => $code));
      return $query->num_rows > 0 ? true : false;
   }

   public function checkRoomActive($code)
   {
      $this->db->select('active');
      $this->db->from('room');
      $this->db->where('id_kode', $code);
      return $this->db->get()->result();
   }

   public function endVoteRoom($code)
   {
      $this->db->set('active', '0');
      $this->db->where('id_kode', $code);
      $this->db->update('room');
   }

   public function createVoteRoom($insertData)
   {
      // insertData is an array
      $this->db->insert('room', $insertData);
      $this->db->insert('pilihan', $insertData);
   }
}

/* End of file ModRoom.php */
