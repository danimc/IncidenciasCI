<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Simplelogin
{
	var $CI;
	var $user_table = 'usuario';

	function login($user='', $password='') {
		
		$this->CI =& get_instance();		

		if($user == '' OR $password == '') {
			return false;
			die(var_dump($user));
		}

		if($this->CI->session->userdata('user') == $user) {

			return false;
			die(var_dump($user));
		}

		$this->CI->db->select("*"); 
		$this->CI->db->where('codigo', $user);
		$query = $this->CI->db->get($this->user_table);
		
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array(); 
			
			if(md5($password) != $row['password']) {

				return false;
				die(var_dump($user));
			}
			
			$this->CI->session->sess_destroy();

			$this->CI->session->sess_create();

			unset($row['password']);

			$this->CI->session->set_userdata($row);

			$this->CI->session->set_userdata(array('logged_in' => true));			
		
			return true;
		} else {

			return false;
			die(var_dump($user));
		}	

	}


	function logout() {

		$this->CI =& get_instance();		

		$this->CI->session->sess_destroy();
	}
}
?>