<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Dashboard extends My_Controller {

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



    public function __construct() {
        parent::__construct();

        $this->must_login();
    }
    
    public function index() {
    	$filter = array();
    	if ($this->get_session_by_id('tipe_upk') != 3) {
    		$filter['id_upk'] = $this->get_session_by_id('id_upk');
    	}

    	$data = array(
    		'total_kasus' => $this->DashboardModel->total_kasus($filter),
    		'total_kasus_konfirmasi' => $this->DashboardModel->total_kasus_konfirmasi($filter),
    		'total_kasus_suspek' => $this->DashboardModel->total_kasus_suspek($filter),
    		'total_kasus_probable' => $this->DashboardModel->total_kasus_probable($filter),
    		'total_kontak_erat' => $this->DashboardModel->total_kontak_erat($filter),
    		'total_kasus_rapid_reaktif' => $this->DashboardModel->total_kasus_rapid_reaktif($filter),
    	);

		$this->load->view('dashboard', $data);
	}
}