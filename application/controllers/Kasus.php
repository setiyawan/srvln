<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Kasus extends My_Controller {

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
    }
    
    public function index() {
    	$get = $this->input->get();
    	$filter = array(
    		'update_time' => $this->Ternary->isempty_value($get['tanggal'], $this->TimeConstant->get_current_date())
    	);

    	$data_kasus = array();
    	$data_kasus_konfirmasi = array();
    	$data_kontak_erat = array();
    	$data_kasus_meninggal = array();
    	$data_pemeriksaan_lab = array();
    	$data_isolasi = array();

    	$kasus= $this->Tracing->get_data_tracing($filter);
    	foreach ($kasus as $key => $value) {
    		$data_kasus['id_upk'][$value['id_upk']] = $value['id_upk'];
    		
    		if ($value['kategori_kasus'] == 'SUSPEK') {
    			$data_kasus[$value['id_upk']]['suspek'] ++;
    		}

    		if ($value['kategori_kasus'] == 'PROBABLE') {
    			$data_kasus[$value['id_upk']]['probable'] ++;
    		}

    		if ($value['kategori_kasus'] == 'SUSPEK' && $value['status_pasien'] == 'ISOLASI MANDIRI') {
    			$data_kasus[$value['id_upk']]['suspek_isolasi'] ++;
    		}

    		if ($value['kategori_kasus'] == 'SUSPEK' && $value['status_pasien'] == 'DISCARDED') {
    			$data_kasus[$value['id_upk']]['suspek_discarded'] ++;
    		}
    	}

    	foreach ($kasus as $key => $value) {
    		$data_kasus_konfirmasi['id_upk'][$value['id_upk']] = $value['id_upk'];

    		if ($value['kategori_kasus'] == 'KONFIRMASI') {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi'] ++;
    		}

    		if ($value['kategori_kasus'] == 'KONFIRMASI' && $value['ada_gejala'] == '1') {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi_gejala'] ++;
    		}

    		if ($value['kategori_kasus'] == 'KONFIRMASI' && $value['ada_gejala'] == '0') {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi_tanpa_gejala'] ++;
    		}

    		if ($value['kategori_kasus'] == 'KONFIRMASI' && $value['riwayat_perjalanan'] != '') {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi_riwayat_perjalanan'] ++;
    		}

    		if ($value['kategori_kasus'] == 'KONFIRMASI' && $value['pelacakan_kontak_erat'] == '1') {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi_kontak_erat'] ++;
    		}

    		if ($value['kategori_kasus'] == 'KONFIRMASI' && ($value['riwayat_perjalanan'] != '' || $value['pelacakan_kontak_erat'] == '1')) {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi_perjalanan_atau_kontak'] ++;
    		}

    		if ($value['kategori_kasus'] == 'KONFIRMASI' && $value['status_pasien'] == 'SELESAI ISOLASI') {
    			$data_kasus_konfirmasi[$value['id_upk']]['konfirmasi_selesai_isolasi'] ++;
    		}
    	}

    	foreach ($kasus as $key => $value) {
    		$data_kontak_erat['id_upk'][$value['id_upk']] = $value['id_upk'];

    		// NOTE!!!!
    		if ($value['kategori_kasus'] == 'KONFIRMASI' && $value['pelacakan_kontak_erat'] == '1') {
    			$data_kontak_erat[$value['id_upk']]['konfirmasi_lacak_kontak'] ++;
    		}

    		if ($value['pelacakan_kontak_erat'] == '1' && $value['kategori_kasus'] == 'SUSPEK') {
    			$data_kontak_erat[$value['id_upk']]['suspek'] ++;
    		}

    		if ($value['pelacakan_kontak_erat'] == '1' && $value['kategori_kasus'] == 'KONFIRMASI') {
    			$data_kontak_erat[$value['id_upk']]['konfirmasi'] ++;
    		}

    		if ($value['pelacakan_kontak_erat'] == '1' && $value['hasil_pemantauan'] == 'MANGKIR') {
    			$data_kontak_erat[$value['id_upk']]['mangkir'] ++;
    		}

    		if ($value['pelacakan_kontak_erat'] == '1' && $value['status_pasien'] == 'DISCARDED') {
    			$data_kontak_erat[$value['id_upk']]['discarded'] ++;
    		}
    	}

    	foreach ($kasus as $key => $value) {
    		$data_kasus_meninggal['id_upk'][$value['id_upk']] = $value['id_upk'];

    		if ($value['status_pasien'] == 'MENINGGAL') {
    			$data_kasus_meninggal[$value['id_upk']]['meniggal'] ++;
    		}

    		if ($value['status_pasien'] == 'MENINGGAL' && $value['hasil_lab'] == '1') {
    			$data_kasus_meninggal[$value['id_upk']]['lab_positif'] ++;
    		}

    		if ($value['status_pasien'] == 'MENINGGAL' && $value['kategori_kasus'] == 'PROBABLE') {
    			$data_kasus_meninggal[$value['id_upk']]['probable'] ++;
    		}
    	}

    	foreach ($kasus as $key => $value) {
    		$data_pemeriksaan_lab['id_upk'][$value['id_upk']] = $value['id_upk'];

    		if ($value['rapid_test'] == '1' || $value['pemeriksaan_lab'] == '1') {
    			$data_pemeriksaan_lab[$value['id_upk']]['spesimen'] ++;
    		}

    		if ($value['rapid_test'] == '1') {
    			$data_pemeriksaan_lab[$value['id_upk']]['rapid_test'] ++;
    		}

    		if ($value['hasil_rapid_test'] == '1') {
    			$data_pemeriksaan_lab[$value['id_upk']]['hasil_rapid_test'] ++;
    		}

    		if ($value['pemeriksaan_lab'] == '1') {
    			$data_pemeriksaan_lab[$value['id_upk']]['pemeriksaan_lab'] ++;
    		}

    		if ($value['hasil_lab'] == '1') {
    			$data_pemeriksaan_lab[$value['id_upk']]['hasil_lab'] ++;
    		}

    	}

    	foreach ($kasus as $key => $value) {
    		$data_isolasi['id_upk'][$value['id_upk']] = $value['id_upk'];
    	}

    	$data = array(
    		'data_kasus' => $data_kasus,
    		'data_kasus_konfirmasi' => $data_kasus_konfirmasi,
			'data_kontak_erat' => $data_kontak_erat,
			'data_kasus_meninggal' => $data_kasus_meninggal,
			'data_pemeriksaan_lab' => $data_pemeriksaan_lab,
			'data_isolasi' => $data_isolasi,
			'tanggal' => $filter['update_time']
    	);


		$this->load->view('kasus', $data);
	}
}