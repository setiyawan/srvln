<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

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

        $this->load->helper('file');
		$this->load->library('session');
		$this->load->library('upload');

        $this->load->model('util/Converter');
        $this->load->model('util/Ternary');

        $this->load->model('constant/TimeConstant'); 
        $this->load->model('constant/UserConstant');
        $this->load->model('constant/TracingConstant');

        $this->load->model('Tracing');

        ini_set('display_error','off');
        error_reporting(0);
    
    }

    // PRIVATE FUNCTION
	protected function is_logged_in() {
		return $this->session->userdata('logged_in');
	}

	protected function must_login() {
		if (!$this->is_logged_in()) {
			redirect(base_url().'user/login');
		}
	}

	protected function get_userid() {
		return $this->session->userdata('user_id');
	}

	protected function get_session_by_id($id) {
		return $this->session->userdata($id);
	}

	protected function set_alert($type, $message)	{
		// error type => info, success, warning, danger, primary
		$alert = array(
			'is_alert' => true,
			'type' => $type,
			'message' => $message 
		);

		$this->session->set_flashdata('alert', $alert);
	}

	protected function build_uri_parameter($data) {
		$result = '';
		foreach ($data as $key => $value) {
			if ($result != '') {
				$result = $result . '&';
			}
			$result = $result . $key . '=' . $value;
		}

		return $result;
	}

	protected function validate_referer() {
		if ($_SERVER['HTTP_REFERER'] == NULL) {
			redirect(base_url());
		}
	}

    // updaload image will return file name
    // path is /asset/img/[path]
    // 
    protected function upload_image($file, $path, $file_name) {
    	//upload config 
		$file_name = preg_replace("/[^A-Za-z0-9-]/", "-", $file_name).time();
		$config['upload_path'] 		= './asset/img/' . $path;
		$config['allowed_types'] 	= 'jpg|png|jpeg';
		$config['max_size'] 		= 10000;
		$config['file_name'] 		= $file_name;

		$this->upload->initialize($config);
	    if(!$this->upload->do_upload($file)){
	        $up_data = $this->upload->display_errors();
	        var_dump($up_data);
	        return '';
	    }else{
	        $up_data = $this->upload->data();
	    	return $up_data['file_name'];
	    }
    }

}