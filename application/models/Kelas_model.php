<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function tabel($where="")
	{
		if($where== NULL){
			$this->db->select('*');
			$this->db->from('tbl_kelas');
			$this->db->order_by('id_kelas', 'Desc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_kelas');
			$this->db->where($where);
			$this->db->order_by('id_kelas', 'Desc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function insert($data)
	{
		$this->db->insert('tbl_kelas', $data);
	}

	public function update($data)
	{
		$this->db->where('id_kelas', $data['id_kelas']);
		$this->db->update('tbl_kelas', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_kelas', $data['id_kelas']);
		$this->db->delete('tbl_kelas');
	}
}
