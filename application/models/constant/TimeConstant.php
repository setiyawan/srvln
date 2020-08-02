<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TimeConstant extends CI_Model {
	function get_current_timestamp() {
		date_default_timezone_set('Asia/Jakarta');
		return  date("Y-m-d H:i:s");
	}

	function get_current_date() {
		date_default_timezone_set('Asia/Jakarta');
		return  date("Y-m-d");
	}

	function get_current_year() {
		date_default_timezone_set('Asia/Jakarta');
		return  date("Y");
	}

	function get_current_month() {
		date_default_timezone_set('Asia/Jakarta');
		return  date("m");
	}

	function get_current_day() {
		date_default_timezone_set('Asia/Jakarta');
		return  date("d");
	}

	function get_date_min_x_days($day) {
		$modify = '-' .  $day. ' day';
		$current = $this->get_current_timestamp();

		date_default_timezone_set('Asia/Jakarta');
		return date('Y-m-d', strtotime($modify, strtotime($current)));
	}

	function get_month_list() {
		return array(
			'1' => 'January',
			'2' => 'February',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);
	}

	function get_year_list() {
		$year = array();
		for ($i = 2020 ; $i <= $this->get_current_year(); $i++) { 
			$year[$i] = $i;
		}

		return $year;
	}
}

?>