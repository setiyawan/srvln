<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {
    
    public function total_kasus($filter=[]) {
        if (!empty($filter['id_upk'])) {
            $this->db->where('id_upk', $filter['id_upk']);
        }
        
        return $this->db->count_all_results('gejala_diagnosa');
    }

    public function total_kasus_konfirmasi($filter=[]) {
        if (!empty($filter['id_upk'])) {
            $this->db->where('id_upk', $filter['id_upk']);
        }
        $this->db->where('kategori_kasus', 'KONFIRMASI');
        
        return $this->db->count_all_results('gejala_diagnosa');
    }

    public function total_kasus_suspek($filter=[]) {
        if (!empty($filter['id_upk'])) {
            $this->db->where('id_upk', $filter['id_upk']);
        }
        $this->db->where('kategori_kasus', 'SUSPEK');
        
        return $this->db->count_all_results('gejala_diagnosa');
    }

    public function total_kasus_probable($filter=[]) {
        if (!empty($filter['id_upk'])) {
            $this->db->where('id_upk', $filter['id_upk']);
        }
        $this->db->where('kategori_kasus', 'PROBABLE');
        
        return $this->db->count_all_results('gejala_diagnosa');
    }

    public function total_kontak_erat($filter=[]) {
        if (!empty($filter['id_upk'])) {
            $this->db->where('id_upk', $filter['id_upk']);
        }
        $this->db->where('pelacakan_kontak_erat', '1');
        
        return $this->db->count_all_results('gejala_diagnosa');
    }

    public function total_kasus_rapid_reaktif($filter=[]) {
        if (!empty($filter['id_upk'])) {
            $this->db->where('id_upk', $filter['id_upk']);
        }
        $this->db->where('rapid_test', '1');
        
        return $this->db->count_all_results('gejala_diagnosa');
    }

}

?>