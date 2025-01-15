<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_siswa_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function tabel($where="")
	{
		if($where== NULL){
			$this->db->select('*');
			$this->db->from('tbl_wali_siswa');
			$this->db->order_by('id_wali_siswa', 'Desc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_wali_siswa');
			$this->db->where($where);
			$this->db->order_by('id_wali_siswa', 'Desc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function login($username,$enpass)
	{
		$username = $this->db->escape_str($username);
		$password = $this->db->escape_str($enpass);
		$this->db->select('*');
		$this->db->from('tbl_wali_siswa');
		$this->db->where(array(
			'tbl_wali_siswa.email_wali_siswa' => $username,
			'tbl_wali_siswa.password_wali_siswa' => $password
		));
		$query = $this->db->get();
		return $query->row();
	}

	public function insert($data)
	{
		$this->db->insert('tbl_wali_siswa', $data);
	}

	public function update($data)
	{
		$this->db->where('id_wali_siswa', $data['id_wali_siswa']);
		$this->db->update('tbl_wali_siswa', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_wali_siswa', $data['id_wali_siswa']);
		$this->db->delete('tbl_wali_siswa');
	}
}
