<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function tabel($where="")
	{
		if($where == null){
			$this->db->select('*');
			$this->db->from('tbl_siswa');
			$this->db->join('tbl_wali_siswa','tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa','inner');
			$this->db->join('tbl_kelas','tbl_siswa.id_kelas = tbl_kelas.id_kelas','inner');
			$this->db->order_by('tbl_siswa.id_siswa', 'Asc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_siswa');
			$this->db->join('tbl_wali_siswa','tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa','inner');
			$this->db->join('tbl_kelas','tbl_siswa.id_kelas = tbl_kelas.id_kelas','inner');
			$this->db->where($where);
			$this->db->order_by('tbl_siswa.id_siswa', 'Asc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function akhir()
	{
		$this->db->select('*');
		$this->db->from('tbl_siswa');
		$this->db->order_by('tbl_siswa.id_siswa', 'Desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query;
		
	}

	public function insert($data)
	{
		$this->db->insert('tbl_siswa', $data);
	}

	public function update($data)
	{
		$this->db->where('id_siswa', $data['id_siswa']);
		$this->db->update('tbl_siswa', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_siswa', $data['id_siswa']);
		$this->db->delete('tbl_siswa');
	}
}
