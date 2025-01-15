<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function tabel($where="")
	{
		if($where == null){
			$this->db->select('*');
			$this->db->from('tbl_bayar');
			$this->db->join('tbl_siswa','tbl_bayar.id_siswa = tbl_siswa.id_siswa','inner');
			$this->db->join('tbl_kelas','tbl_siswa.id_kelas = tbl_kelas.id_kelas','inner');
			$this->db->join('tbl_user','tbl_bayar.id_user = tbl_user.id_user','left');
			$this->db->order_by('tbl_bayar.id_bayar', 'Desc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('tbl_bayar');
			$this->db->join('tbl_siswa','tbl_bayar.id_siswa = tbl_siswa.id_siswa','inner');
			$this->db->join('tbl_kelas','tbl_siswa.id_kelas = tbl_kelas.id_kelas','inner');
			$this->db->join('tbl_user','tbl_bayar.id_user = tbl_user.id_user','left');
			$this->db->where($where);
			$this->db->order_by('tbl_bayar.id_bayar', 'Desc');
			$query = $this->db->get();
			return $query;
		}
	}

	public function bayar($where)
	{
		$query = "SELECT sum(tbl_bayar.total_bayar) as total_bayar 
		FROM tbl_bayar 
		INNER JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_bayar.id_siswa
		INNER JOIN tbl_kelas ON tbl_kelas.id_kelas = tbl_siswa.id_kelas
		INNER JOIN tbl_wali_siswa on tbl_siswa.id_wali_siswa = tbl_wali_siswa.id_wali_siswa where $where";
		return $this->db->query($query);
	}
	
	public function insert($data)
	{
		$this->db->insert('tbl_bayar', $data);
	}

	public function update($data)
	{
		$this->db->where('id_bayar', $data['id_bayar']);
		$this->db->update('tbl_bayar', $data);
	}

	public function update_nobayar($data)
	{
		$this->db->where('no_bayar', $data['no_bayar']);
		$this->db->update('tbl_bayar', $data);
	}

	public function delete($data)
	{
		$this->db->where('no_bayar', $data['no_bayar']);
		$this->db->delete('tbl_bayar');
	}

	public function delete_siswa($data)
	{
		$this->db->where('id_siswa', $data['id_siswa']);
		$this->db->delete('tbl_bayar');
	}

	function get_no_bayar(){
        $q = $this->db->query("SELECT MAX(RIGHT(no_bayar,3)) AS kd_max FROM tbl_bayar WHERE DATE(tgl_bayar)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('ymd').$kd;
    }
}
