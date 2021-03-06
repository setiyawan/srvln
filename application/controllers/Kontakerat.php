<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Kontakerat extends My_Controller {

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

    private function next_id_kasus() {
    	$filter['id_upk'] = $this->get_session_by_id('id_upk');
    	$latest = $this->Tracing->latest_id_kasus($filter);
    	$explode = explode("PE",$latest);

    	$next_id = 1;
    	if (count($explode) > 1) {
    		$next_id = $explode[1] + 1;
    	}

    	return $this->get_session_by_id('user_id') . 'PE' . $next_id;
    }

    private function next_id_kontak_erat() {
    	$filter['id_upk'] = $this->get_session_by_id('id_upk');
    	$latest = $this->Tracing->latest_id_kontak_erat($filter);
    	$explode = explode("KE",$latest);

    	$next_id = 1;
    	if (count($explode) > 1) {
    		$next_id = $explode[1] + 1;
    	}

    	return $this->get_session_by_id('user_id') . 'KE' . $next_id;
    }
    
    public function index() {
    	$filter['kontak_erat'] = 1;
    	if ($this->get_session_by_id('tipe_upk') != 3) {
    		$filter['id_upk'] = $this->get_session_by_id('id_upk');
    	}
    	
    	$data['epidemiologi'] = $this->Tracing->get_data_tracing($filter);
    	$data['id_upk'] = $this->get_session_by_id('id_upk');
		
		$this->load->view('kontakerat', $data);
	}

	public function tambah() {
		$data = array(
			'form_action' => 'add',
			'id_upk' => $this->get_session_by_id('id_upk')
		);
		$this->load->view('kontakerat_form', $data);
	}

	public function edit() {
		$get = $this->input->get();

		$filter['id_personal'] = $get['id'];

    	$data = array(
			'form_action' => 'update',
			'epidemiologi' =>  $this->Tracing->get_data_tracing($filter)[0]
		);

		$this->load->view('kontakerat_form', $data);
	}

	// POST TRANSACTION
	public function add() {
		$post = $this->input->post();

		$data_personal = array(
			'kontak_erat' => 1,
			'nik' => $post['nik'],
			'nama' => $post['nama'],
			'umur' => $post['umur'],
			'jenis_kelamin' => $post['jenis_kelamin'],
			'kecamatan' => $post['kecamatan'],
			'kelurahan' => $post['kelurahan'],
			'alamat' => $post['alamat'],
			'no_telepon' => $post['no_telepon'],
			'create_time' => $this->TimeConstant->get_current_timestamp(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$gejala = $post['suhutubuhatas38'] . ',' . $post['suhutubuhbawah38'] . ',' . $post['batuk'] . ',' . $post['pilek'] . ',' . $post['sakittenggorokan'] . ',' . $post['sakitkepala'] . ',' . $post['sesaknapas'] . ',' . $post['lemah'] . ',' . $post['nyeriotot'] . ',' . $post['mual'] . ',' . $post['nyeriabdomen'] . ',' . $post['diare'];
		$kondisi_penyerta = $post['hamil'] . ',' . $post['diabetes'] . ',' . $post['jantung'] . ',' . $post['hipertensi'] . ',' . $post['keganasan'] . ',' . $post['imunologi'] . ',' . $post['ginjal'] . ',' . $post['hati'] . ',' . $post['ppok'];
		$data_gajala_diagnosa = array(
			'id_kontak_erat' => $this->next_id_kontak_erat(),
			'id_upk' => $post['id_upk'],
			'riwayat_perjalanan' => $post['riwayat_perjalanan'],
			'ada_gejala' => $post['ada_gejala'],
			'tanggal_gejala' => $post['tanggal_gejala'],
			'gejala' => $gejala,
			'kondisi_penyerta' => $kondisi_penyerta,
			'diagnosa' => $post['diagnosa'],
			'status_pasien' => $post['status_pasien'],
			'rapid_test' => $post['rapid_test'],
			'tanggal_rapid_test' => $post['tanggal_rapid_test'],
			'hasil_rapid_test' => $post['hasil_rapid_test'],
			'pemeriksaan_lab' => $post['pemeriksaan_lab'],
			'tanggal_sample' => $post['tanggal_sample'],
			'tanggal_hasil_lab' => $post['tanggal_hasil_lab'],
			'hasil_lab' => $post['hasil_lab'],
			'kategori_kasus' => $post['kategori_kasus'],
			'hasil_pemantauan' => $post['hasil_pemantauan'],
			'create_time' => $this->TimeConstant->get_current_timestamp(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		if ($post['kategori_kasus'] == 'KONFIRMASI' || $post['hasil_rapid_test'] == '1') {
			$data_personal['pe'] = 1;
			$data_gajala_diagnosa['id_kasus'] = $this->next_id_kasus();
		}


		$this->Tracing->add_data_personal($data_personal);

		$data_gajala_diagnosa['id_personal'] = $this->db->insert_id();
		$this->Tracing->add_data_gejala_diagnosa($data_gajala_diagnosa);

		redirect(base_url().'kontakerat/edit?id='.$data_gajala_diagnosa['id_personal']);
	}

	public function update() {
		$post = $this->input->post();
		$id_personal = $post['id_personal'];

		$data_personal = array(
			'kontak_erat' => 1,
			'nik' => $post['nik'],
			'nama' => $post['nama'],
			'umur' => $post['umur'],
			'jenis_kelamin' => $post['jenis_kelamin'],
			'kecamatan' => $post['kecamatan'],
			'kelurahan' => $post['kelurahan'],
			'alamat' => $post['alamat'],
			'no_telepon' => $post['no_telepon'],
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$gejala = $post['suhutubuhatas38'] . ',' . $post['suhutubuhbawah38'] . ',' . $post['batuk'] . ',' . $post['pilek'] . ',' . $post['sakittenggorokan'] . ',' . $post['sakitkepala'] . ',' . $post['sesaknapas'] . ',' . $post['lemah'] . ',' . $post['nyeriotot'] . ',' . $post['mual'] . ',' . $post['nyeriabdomen'] . ',' . $post['diare'];
		$kondisi_penyerta = $post['hamil'] . ',' . $post['diabetes'] . ',' . $post['jantung'] . ',' . $post['hipertensi'] . ',' . $post['keganasan'] . ',' . $post['imunologi'] . ',' . $post['ginjal'] . ',' . $post['hati'] . ',' . $post['ppok'];
		$data_gajala_diagnosa = array(
			'id_upk' => $post['id_upk'],
			'riwayat_perjalanan' => $post['riwayat_perjalanan'],
			'ada_gejala' => $post['ada_gejala'],
			'tanggal_gejala' => $post['tanggal_gejala'],
			'gejala' => $gejala,
			'kondisi_penyerta' => $kondisi_penyerta,
			'diagnosa' => $post['diagnosa'],
			'status_pasien' => $post['status_pasien'],
			'rapid_test' => $post['rapid_test'],
			'tanggal_rapid_test' => $post['tanggal_rapid_test'],
			'hasil_rapid_test' => $post['hasil_rapid_test'],
			'pemeriksaan_lab' => $post['pemeriksaan_lab'],
			'tanggal_sample' => $post['tanggal_sample'],
			'tanggal_hasil_lab' => $post['tanggal_hasil_lab'],
			'hasil_lab' => $post['hasil_lab'],
			'kategori_kasus' => $post['kategori_kasus'],
			'hasil_pemantauan' => $post['hasil_pemantauan'],
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		if ($post['kategori_kasus'] == 'KONFIRMASI' || $post['hasil_rapid_test'] == '1') {
			$data_personal['pe'] = 1;
			if ($post['id_kasus'] == '') {
				$data_gajala_diagnosa['id_kasus'] = $this->next_id_kasus();
			}
		}

		$this->Tracing->update_data_personal($data_personal, $id_personal);

		$this->Tracing->update_data_gejala_diagnosa($data_gajala_diagnosa, $id_personal);

		redirect(base_url().'kontakerat/edit?id='.$id_personal);
	}
}