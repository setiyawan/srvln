<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $this->must_login();
    }
    
    public function index() {
    	$get = $this->input->get();
    	$filter = array(
    		'update_time' => $this->Ternary->isempty_value($get['tanggal'], $this->TimeConstant->get_current_date())
    	);

    	if ($this->get_session_by_id('tipe_upk') != 3) {
    		$filter['id_upk'] = $this->get_session_by_id('id_upk');
    	}

    	$kasus= $this->Tracing->get_data_tracing($filter);

    	$data_kasus = $this->data_kasus($kasus);
    	$data_kasus_konfirmasi = $this->data_kasus_konfirmasi($kasus);
    	$data_kontak_erat = $this->data_kontak_erat($kasus);
    	$data_kasus_meninggal = $this->data_kasus_meninggal($kasus);
    	$data_pemeriksaan_lab = $this->data_pemeriksaan_lab($kasus);
    	$data_isolasi = $this->data_isolasi($kasus);

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

	public function export($value='') {
		$get = $this->input->get();
    	$filter = array(
    		'update_time' => $this->Ternary->isempty_value($get['tanggal'], $this->TimeConstant->get_current_date())
    	);

    	if ($this->get_session_by_id('tipe_upk') != 3) {
    		$filter['id_upk'] = $this->get_session_by_id('id_upk');
    	}
        
        $kasus= $this->Tracing->get_data_tracing($filter);
        $data_kasus = $this->data_kasus($kasus);
        $data_kasus_konfirmasi = $this->data_kasus_konfirmasi($kasus);
    	$data_kontak_erat = $this->data_kontak_erat($kasus);
    	$data_kasus_meninggal = $this->data_kasus_meninggal($kasus);
    	$data_pemeriksaan_lab = $this->data_pemeriksaan_lab($kasus);


    	$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();

    	// TABLE 1
        $kolom = 2;
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . ($kolom-1), 'KASUS SUSPEK')
          ->setCellValue('A' . $kolom, '#')
          ->setCellValue('B' . $kolom, 'Puskes/RS')
          ->setCellValue('C' . $kolom, 'Kasus Suspek')
          ->setCellValue('D' . $kolom, 'Kasus Probable')
          ->setCellValue('E' . $kolom, 'Kasus Suspek di isolasi')
          ->setCellValue('F' . $kolom, 'Kasus Suspek Discarded');

        $kolom++;
        $nomor = 1;
        foreach($data_kasus['id_upk'] as $value) {
           	$spreadsheet->setActiveSheetIndex(0)
               ->setCellValue('A' . $kolom, $nomor)
               ->setCellValue('B' . $kolom, $value)
               ->setCellValue('C' . $kolom, $this->Ternary->isempty_value($data_kasus[$value]['suspek'], 0))
               ->setCellValue('D' . $kolom, $this->Ternary->isempty_value($data_kasus[$value]['probable'], 0))
               ->setCellValue('E' . $kolom, $this->Ternary->isempty_value($data_kasus[$value]['suspek_isolasi'], 0))
               ->setCellValue('F' . $kolom, $this->Ternary->isempty_value($data_kasus[$value]['suspek_discarded'], 0));

	       $kolom++;
	       $nomor++;
        }

        // TABLE 2
        $kolom += 2;
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . ($kolom-1), 'KASUS KONFIRMASI')
          ->setCellValue('A'. $kolom, '#')
          ->setCellValue('B'. $kolom, 'Puskes/RS')
          ->setCellValue('C'. $kolom, 'Kasus Konfirmasi')
          ->setCellValue('D'. $kolom, 'Kasus Konfirmasi Bergejala')
          ->setCellValue('E'. $kolom, 'Kasus Konfirmasi Tanpa Gejala')
          ->setCellValue('F'. $kolom, 'Kasus Konfirmasi Riwayat Perjalanan')
          ->setCellValue('G'. $kolom, 'Kasus Konfirmasi Kontak')
          ->setCellValue('H'. $kolom, 'Kasus Konfirmasi Riwayat Perjalanan atau Kontak Erat')
          ->setCellValue('I'. $kolom, 'Kasus Konfirmasi Selesai Isolasi');

        $kolom++;
        $nomor = 1;
        foreach($data_kasus_konfirmasi['id_upk'] as $value) {
           	$spreadsheet->setActiveSheetIndex(0)
            	->setCellValue('A'. $kolom, $nomor)
				->setCellValue('B'. $kolom, $value)
				->setCellValue('C'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi'], 0))
				->setCellValue('D'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi_gejala'], 0))
				->setCellValue('E'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi_tanpa_gejala'], 0))
				->setCellValue('F'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi_riwayat_perjalanan'], 0))
				->setCellValue('G'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi_kontak_erat'], 0))
				->setCellValue('H'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi_perjalanan_atau_kontak'], 0))
				->setCellValue('I'. $kolom, $this->Ternary->isempty_value($data_kasus_konfirmasi[$value]['konfirmasi_selesai_isolasi'], 0));

	       $kolom++;
	       $nomor++;
        }

        // TABLE 3
        $kolom += 2;
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . ($kolom-1), 'KASUS PEMANTAUAN KONTAK ERAT')
          ->setCellValue('A'. $kolom, '#')
          ->setCellValue('B'. $kolom, 'Puskes/RS')
          ->setCellValue('C'. $kolom, 'Kasus Konfirmasi dilacak Kontak Erat')
          ->setCellValue('D'. $kolom, 'Kontak Erat Baru Suspek')
          ->setCellValue('E'. $kolom, 'Kontak Erat Konfirmasi')
          ->setCellValue('F'. $kolom, 'Kontak Erat Mangkir Pemantauan')
          ->setCellValue('G'. $kolom, 'Kontak Erat Discarded');

        $kolom++;
        $nomor = 1;
        foreach($data_kontak_erat['id_upk'] as $value) {
           	$spreadsheet->setActiveSheetIndex(0)
            	->setCellValue('A'. $kolom, $nomor)
				->setCellValue('B'. $kolom, $value)
				->setCellValue('C'. $kolom, $this->Ternary->isempty_value($data_kontak_erat[$value]['konfirmasi_lacak_kontak'], 0))
				->setCellValue('D'. $kolom, $this->Ternary->isempty_value($data_kontak_erat[$value]['suspek'], 0))
				->setCellValue('E'. $kolom, $this->Ternary->isempty_value($data_kontak_erat[$value]['konfirmasi'], 0))
				->setCellValue('F'. $kolom, $this->Ternary->isempty_value($data_kontak_erat[$value]['mangkir'], 0))
				->setCellValue('G'. $kolom, $this->Ternary->isempty_value($data_kontak_erat[$value]['discarded'], 0));

	       $kolom++;
	       $nomor++;
        }

        // TABLE 4
        $kolom += 2;
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . ($kolom-1), 'KASUS MENINGGAL')
          ->setCellValue('A'. $kolom, '#')
          ->setCellValue('B'. $kolom, 'Puskes/RS')
          ->setCellValue('C'. $kolom, 'Kasus Meninggal Total')
          ->setCellValue('D'. $kolom, 'Kasus Meninggal RT-PCR (+)')
          ->setCellValue('E'. $kolom, 'Kasus Meninggal Probable');

        $kolom++;
        $nomor = 1;
        foreach($data_kasus_meninggal['id_upk'] as $value) {
           	$spreadsheet->setActiveSheetIndex(0)
            	->setCellValue('A'. $kolom, $nomor)
				->setCellValue('B'. $kolom, $value)
				->setCellValue('C'. $kolom, $this->Ternary->isempty_value($data_kasus_meninggal[$value]['meniggal'], 0))
				->setCellValue('D'. $kolom, $this->Ternary->isempty_value($data_kasus_meninggal[$value]['lab_positif'], 0))
				->setCellValue('E'. $kolom, $this->Ternary->isempty_value($data_kasus_meninggal[$value]['probable'], 0));

	       $kolom++;
	       $nomor++;
        }

        // TABLE 5
        $kolom += 2;
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . ($kolom-1), 'PEMERIKSAAN RT-PCR/RAPID TEST')
          ->setCellValue('A'. $kolom, '#')
          ->setCellValue('B'. $kolom, 'Puskes/RS')
          ->setCellValue('C'. $kolom, 'Kasus diambil spesimen/swab')
          ->setCellValue('D'. $kolom, 'Jumlah Rapid Test')
          ->setCellValue('E'. $kolom, 'Jumlah Rapid Test Reaktif')
          ->setCellValue('F'. $kolom, 'Jumlah Reaktif Periksa RT-PCR')
          ->setCellValue('G'. $kolom, 'Jumlah Reaktif RTPCR (+)');

        $kolom++;
        $nomor = 1;
        foreach($data_pemeriksaan_lab['id_upk'] as $value) {
           	$spreadsheet->setActiveSheetIndex(0)
            	->setCellValue('A'. $kolom, $nomor)
				->setCellValue('B'. $kolom, $value)
				->setCellValue('C'. $kolom, $this->Ternary->isempty_value($data_pemeriksaan_lab[$value]['spesimen'], 0))
				->setCellValue('D'. $kolom, $this->Ternary->isempty_value($data_pemeriksaan_lab[$value]['rapid_test'], 0))
				->setCellValue('E'. $kolom, $this->Ternary->isempty_value($data_pemeriksaan_lab[$value]['hasil_rapid_test'], 0))
				->setCellValue('F'. $kolom, $this->Ternary->isempty_value($data_pemeriksaan_lab[$value]['pemeriksaan_lab'], 0))
				->setCellValue('G'. $kolom, $this->Ternary->isempty_value($data_pemeriksaan_lab[$value]['hasil_lab'], 0));

	       $kolom++;
	       $nomor++;
        }

        
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'kasus'; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}

	private function data_kasus($kasus) {
		$data_kasus = array();
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

    	return $data_kasus;
	}

	private function data_kasus_konfirmasi($kasus) {
		$data_kasus_konfirmasi = array();
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

		return $data_kasus_konfirmasi;
	}

	private function data_kontak_erat($kasus) {
		$data_kontak_erat = array();
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

		return $data_kontak_erat;
	}

	private function data_kasus_meninggal($kasus) {
		$data_kasus_meninggal = array();
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

		return $data_kasus_meninggal;
	}

	private function data_pemeriksaan_lab($kasus) {
		$data_pemeriksaan_lab = array();
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

		return $data_pemeriksaan_lab;
	}

	private function data_isolasi($kasus) {
		$data_isolasi = array();
		foreach ($kasus as $key => $value) {
    		$data_isolasi['id_upk'][$value['id_upk']] = $value['id_upk'];
    	}

		return $data_isolasi;
	}
}