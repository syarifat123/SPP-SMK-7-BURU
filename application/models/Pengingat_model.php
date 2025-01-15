<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengingat_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function tabel($where="")
	{
		if($where== NULL){
			$this->db->select('*');
			$this->db->from('tbl_pengingat');
			$this->db->order_by('id_pengingat', 'Desc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_pengingat');
			$this->db->where($where);
			$this->db->order_by('id_pengingat', 'Desc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function login($username,$enpass)
	{
		$username = $this->db->escape_str($username);
		$password = $this->db->escape_str($enpass);
		$this->db->select('*');
		$this->db->from('tbl_pengingat');
		$this->db->where(array(
			'tbl_pengingat.email_pengingat' => $username,
			'tbl_pengingat.password_pengingat' => $password
		));
		$query = $this->db->get();
		return $query->row();
	}

	public function insert($data)
	{
		$this->db->insert('tbl_pengingat', $data);
	}

	public function update($data)
	{
		$this->db->where('id_pengingat', $data['id_pengingat']);
		$this->db->update('tbl_pengingat', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_pengingat', $data['id_pengingat']);
		$this->db->delete('tbl_pengingat');
	}
}
