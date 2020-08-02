<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tracing extends CI_Model {
    
    public function get_data_tracing($filter=[]) {
        if (!empty($filter['id_personal'])) {
            $this->db->where('p.id_personal', $filter['id_personal']);
        }

        if (!empty($filter['pe'])) {
            $this->db->where('pe', $filter['pe']);
        }

        if (!empty($filter['kontak_erat'])) {
            $this->db->where('kontak_erat', $filter['kontak_erat']);
        }

        if (!empty($filter['id_upk'])) {
            $this->db->where('gd.id_upk', $filter['id_upk']);
        }

        if (!empty($filter['update_time'])) {
            $this->db->where('date(gd.update_time)', $filter['update_time']);
        }

        $this->db->join('gejala_diagnosa gd', 'p.id_personal = gd.id_personal');
        return  $this->db->get('personal p')->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function latest_id_kasus($filter=[]) {
        $this->db->select('id_kasus');
        $this->db->from('gejala_diagnosa');
        $this->db->where('id_kasus <>','NULL');
        $this->db->where('id_upk',$filter['id_upk']);
        $this->db->order_by('id_kasus','desc');
        $this->db->limit(1);
        
        return $this->db->get()->row()->id_kasus;
    }

    public function latest_id_kontak_erat($filter=[]) {
        $this->db->select('id_kontak_erat');
        $this->db->from('gejala_diagnosa');
        $this->db->where('id_kontak_erat <>','NULL');
        $this->db->where('id_upk',$filter['id_upk']);
        $this->db->order_by('id_kontak_erat','desc');
        $this->db->limit(1);
        
        return $this->db->get()->row()->id_kontak_erat;
    }

    // POST TRANSACTION
    public function add_data_personal($data) {
        return $this->db->insert('personal', $data);
    }

    public function update_data_personal($data, $id_personal){
        $this->db->set($data);
        $this->db->where('id_personal', $id_personal);
        return $this->db->update('personal');
    }

    public function add_data_gejala_diagnosa($data) {
        return $this->db->insert('gejala_diagnosa', $data);
    }

    public function update_data_gejala_diagnosa($data, $id_personal){
        $this->db->set($data);
        $this->db->where('id_personal', $id_personal);
        return $this->db->update('gejala_diagnosa');
    }
}

?>