<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class User extends My_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


    public function __construct(){

		parent::__construct();
		
		$this->load->model('UserModel');
    
        ini_set('display_error','off');
        error_reporting(0);
    
	}

	// PRIVATE FUNCTION
	private function set_session($data) {
		$userdata = array(
			'user_id'   => $data['user_id'],
			'gender'    => $data['gender'],
			'username'  => $data['username'], 
			'full_name' => $data['full_name'], 
			'id_upk' => $data['id_upk'], 
			'tipe_upk' => $data['tipe_upk'], 
			'logged_in' => TRUE
		);  

		$this->session->set_userdata($userdata);
	}

	// GET TRANSACTION
	public function login() {
		if ($this->is_logged_in()) {
			redirect(base_url().'dashboard');
		}

		$this->load->view('login');
	}

	public function ganti_password() {
		$this->must_login();

		$this->load->view('ganti_password');
	}
	
	// POST TRANSACTION
	public function do_login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$result = $this->UserModel->login($username , $password);
		if (count($result) > 0) {
			$this->set_session($result[0]);
			
			redirect(base_url().'dashboard');
		} else {
			$this->set_alert('danger', 'Username/Password salah. Periksa kembali ya.');
			
			redirect(base_url().'user/login');
		}
	}

	public function do_update_password() {
		$this->must_login();
		
		$user_id = $this->get_session_by_id('user_id');
		$username = $this->get_session_by_id('username');

		$post = $this->input->post();
		$old_password = $post['password'];
		$new_password = $post['new_password'];
		$confirm_password = $post['confirm_password'];

		$result = $this->UserModel->login($username , $old_password);
		if (count($result) == 0) {
			$this->set_alert('danger', 'Password Lama yang kamu masukkan salah. Periksa kembali ya.');
			redirect(base_url().'user/ganti_password');
		}

		if($new_password == $confirm_password) {
			$data['password'] = md5($confirm_password);
			$data['update_time'] = $this->TimeConstant->get_current_timestamp();
			$this->UserModel->update_password($user_id, $data);	
		} else {
			$this->set_alert('warning', 'Password Baru yang kamu masukkan tidak sama. Periksa kembali ya.');
			redirect(base_url().'user/ganti_password');
		}

		$this->logout();
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'user/login');
	}

}
