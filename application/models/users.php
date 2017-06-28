<?php
Class Users extends CI_Model
{

	function get_user($username)
	{
		$this->db->select('*')->from('users')->where('username', $username);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	function insert_user($username, $password, $email, $firstname, $lastname, $address)
	{
		$data = array(
			'username' 	=> $username,
			'password' 	=> $password,
			'email' 	=> $email,
			'firstname' => $firstname,
			'lastname' 	=> $lastname,
			'address' 	=> $address
			);
		$insert = $this->db->insert('users',$data);
		if($insert) {
			return true;
		}
		else {
			return false;
		}
	}

	function check_email($email) {
		$this->db->select('*')->from('users')->where('email', $email);
		$query = $this->db->get();

		if($query->num_rows() >= 1){
			return true;
		}
		else {
			return false;
		}
	}

}
?>