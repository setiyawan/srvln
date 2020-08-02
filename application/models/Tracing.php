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

        if (!empty($filter['update_time'])) {
            $this->db->where('date(gd.update_time)', $filter['update_time']);
        }

        $this->db->join('gejala_diagnosa gd', 'p.id_personal = gd.id_personal');
        return  $this->db->get('personal p')->result_array();
        // print_r($this->db->last_query());  
        // die;
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