<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function tabel($where="")
	{
		if($where== NULL){
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->order_by('id_user', 'Desc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->where($where);
			$this->db->order_by('id_user', 'Desc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function login($username,$enpass)
	{
		$username = $this->db->escape_str($username);
		$password = $this->db->escape_str($enpass);
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where(array(
			'tbl_user.email_user' => $username,
			'tbl_user.password_user' => $password
		));
		$query = $this->db->get();
		return $query->row();
	}

	public function insert($data)
	{
		$this->db->insert('tbl_user', $data);
	}

	public function update($data)
	{
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('tbl_user', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_user', $data['id_user']);
		$this->db->delete('tbl_user');
	}
}
