<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModRoom extends CI_Model
{

   public function loadRoom()
   {
      $this->db->select('judul, deskripsi, kode_room, waktu_pembuatan, waktu_akhir, active');
      return $this->db->get_where('room', array('id_user' => $this->session->userdata('id_user')))->result();
   }

   public function loadSpecificRoom($code)
   {
      // detail informasi room
      // untuk vote atau lihat detail
      $this->db->select('*');
      $this->db->from('room r');
      $this->db->join('pilihan p', 'r.kode_room = p.kode_room');
      $this->db->where('r.kode_room', $code);
      return $this->db->get()->result();
   }

   public function checkSpecificRoom($code)
   {
      $query = $this->db->get_where('room', array('kode_room' => $code));
      return $query->num_rows() > 0 ? true : false;
   }

   public function checkRoomActive($code)
   {
      $this->db->select('active');
      $this->db->from('room');
      $this->db->where('kode_room', $code);
      return $this->db->get()->row()->active ? true : false;
   }

   private function checkRoomId($code)
   {
      $this->db->select('kode_room');
      $this->db->from('room');
      $this->db->where('kode_room', $code);
      return $this->db->get()->row();
   }

   public function checkUserVoted($code)
   {
      $checkData = array(
         'kode_room' => $this->checkRoomId($code)->kode_room,
         'id_user' => $this->session->userdata('id_user')
      );

      $query = $this->db->get_where('voter', $checkData);
      return $query->num_rows() > 0 ? true : false;
   }

   public function startVoteRoom($code)
   {
      $this->db->where('kode_room', $code);
      $this->db->update('room', array('active' => 1));
   }

   public function endVoteRoom($code)
   {
      $this->db->where('kode_room', $code);
      $this->db->update('room', array('active' => 0));
   }

   public function createVoteRoom($insertData, $pilihan)
   {
      // insertData is an array
      $this->db->insert('room', $insertData);
      $this->db->insert_batch('pilihan', $pilihan);
   }

   public function insertVoter($insertData)
   {
      $this->db->insert('voter', $insertData);
   }
}

/* End of file ModRoom.php */
