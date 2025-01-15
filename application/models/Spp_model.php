<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function tabel($where="")
	{
		if($where == null){
			$this->db->select('*');
			$this->db->from('tbl_spp');
			$this->db->join('tbl_user','tbl_spp.id_user = tbl_user.id_user','inner');
			$this->db->join('tbl_siswa','tbl_spp.id_siswa = tbl_siswa.id_siswa','inner');
			$this->db->join('tbl_wali_siswa','tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa','inner');
			$this->db->order_by('tbl_spp.id_spp', 'Asc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_spp');
			$this->db->join('tbl_user','tbl_spp.id_user = tbl_user.id_user','inner');
			$this->db->join('tbl_siswa','tbl_spp.id_siswa = tbl_siswa.id_siswa','inner');
			$this->db->join('tbl_wali_siswa','tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa','inner');
			$this->db->where($where);
			$this->db->order_by('tbl_spp.id_spp', 'Asc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function detail($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_spp');
		$this->db->join('tbl_siswa','tbl_spp.id_siswa = tbl_siswa.id_siswa','inner');
		$this->db->join('tbl_kelas','tbl_siswa.id_kelas = tbl_kelas.id_kelas','inner');
		$this->db->where('tbl_spp.id_spp', $id);
		$query = $this->db->get();
		return $query;
	}

	public function tagihan($where)
	{
		$query = "SELECT DISTINCT(tbl_spp.id_siswa) as id_siswa, (select sum(tbl_spp.jumlah_bayar) from tbl_spp where $where) as jumlah_bayar, tbl_siswa.*, tbl_wali_siswa.* , tbl_kelas.* 
		FROM tbl_spp 
		INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa
		INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
		INNER JOIN tbl_wali_siswa on tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa where $where";
		return $this->db->query($query);
	}

	public function tunggakan($where)
	{
		$query = "SELECT sum(tbl_spp.jumlah_bayar) as jumlah_bayar 
		FROM tbl_spp 
		INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_spp.id_siswa
		INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
		INNER JOIN tbl_wali_siswa on tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa where $where";
		return $this->db->query($query);
	}

	public function insert($data)
	{
		$this->db->insert('tbl_spp', $data);
	}

	public function update($data)
	{
		$this->db->where('id_spp', $data['id_spp']);
		$this->db->update('tbl_spp', $data);
	}

	public function update_harga($data)
	{
		$this->db->where('tbl_spp.id_siswa', $data['id_siswa']);
		$this->db->where('tbl_spp.no_bayar', "");
		$this->db->update('tbl_spp', $data);
	}

	public function update_nobayar($data, $no_bayar)
	{
		$this->db->where('no_bayar', $no_bayar);
		$this->db->update('tbl_spp', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_spp', $data['id_spp']);
		$this->db->delete('tbl_spp');
	}

	public function delete_siswa($data)
	{
		$this->db->where('id_siswa', $data['id_siswa']);
		$this->db->delete('tbl_spp');
	}
}
