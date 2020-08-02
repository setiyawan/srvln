<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VehicleModel extends CI_Model {

    public function get_vehicle($filter=[]) {
        if (!empty($filter['vehicle_id'])) {
            $this->db->where('vehicle_id', $filter['vehicle_id']);
        }

        if (!empty($filter['vehicle_type'])) {
            $this->db->like('vehicle_type', $filter['vehicle_type']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        $this->db->order_by('tax_period');

        return  $this->db->get('vehicle')->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function get_latest_vehicle_id() {
        $this->db->select_max('vehicle_id');
        return $this->db->get('vehicle')->row()->vehicle_id;
    }

    public function get_vehicle_count($filter=[]) {
        if (!empty($filter['vehicle_expired_month']) && !empty($filter['vehicle_expired_year'])) {
            $this->db->where('month(tax_period)', $filter['vehicle_expired_month']);
            $this->db->where('year(tax_period)', $filter['vehicle_expired_year']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        return $this->db->count_all_results('vehicle');
    }

    // POST TRANSACTION
    public function add_vehicle($data) {
        return $this->db->insert('vehicle', $data);
    }

    public function update_vehicle($data, $vehicle_id){
        $this->db->set($data);
        $this->db->where('vehicle_id', $vehicle_id);
        return $this->db->update('vehicle');
    }

}

?>