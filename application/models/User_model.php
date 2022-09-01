<?php
class user_model extends CI_Model 
{
 
	public function __construct()
	{
		$this->load->database();
	}

	//public function get_mahasiswa()
	//{
	//	$sql = 'select mahasiswa.*, group_mahasiswa.warna  
	//			from mahasiswa 
	//			inner join group_mahasiswa ON mahasiswa.group_id = group_mahasiswa.id 
	//			where semester_id = '.$semester_id.' order by id';
	//	$query = $this->db->query($sql);
	//	return $query->result();
	//}

	public function get_user()   
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->order_by('level','ASC');
		return $query->get()->result();
	}

	public function get_admin()  
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->where('level',0);
		return $query->get()->result();
	}
	public function get_admin_select($id)  
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->where('id',$id);
		return $query->get()->result();
	}

	public function submit_tambah_admin($save_data)  
	{
		$result = $this->db->insert('user',$save_data);
		return true;
	}

	public function get_dosen()  
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->where('level',1);
		return $query->get()->result();
	}
	public function get_dosen_select($id)  
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->where('id',$id);
		return $query->get()->result();
	}

	public function submit_tambah_dosen($save_data)  
	{
		$result = $this->db->insert('user',$save_data);
		return true;
	}

	public function get_mahasiswa()  
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->where('level',2);
		return $query->get()->result();
	}
	public function get_mahasiswa_select($id)  
	{
		$query = $this->db->select('*');
		$query->from('user');
		$query->where('id',$id);
		return $query->get()->result();
	}

	public function submit_tambah_mahasiswa($save_data)  
	{
		$result = $this->db->insert('user',$save_data);
		return true;
	}
	public function hapus_user($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user');
		return true;
	}

	
}
?>