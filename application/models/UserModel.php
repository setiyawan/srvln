<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
	
	public function login($username, $password) {
        $pwd = md5($password) ;
        $this->db->where('username', $username);
        $this->db->where('password', $pwd);
        
        return $this->db->get('user')->result_array();
    }

    public function update_password($user_id, $data) {
        $this->db->set($data);
        $this->db->where('user_id', $user_id);

        return $this->db->update('user');
    }
	
}

?>