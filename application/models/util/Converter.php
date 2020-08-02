<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Converter extends CI_Model {
	function to_rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
	}

	function volume_cm3_to_m3($value) {
		return round($value/1000000, 2);
	}

	function text_limit($plain_text, $max_character, $subs_text) {
		if (strlen($plain_text) > $max_character) {
			return substr($plain_text, 0, $max_character) . $subs_text; 
		}

		return $plain_text;
	}

	function to_indonesia_short_month($month) {
		$ina_month = array (
			1 => 'Jan',
			'Feb',
			'Mar',
			'Apr',
			'Mei',
			'Jun',
			'Jul',
			'Agu',
			'Sep',
			'Okt',
			'Nov',
			'Des'
		);
		return $ina_month[$month];
	}

	function to_indonesia_full_month($month) {
		$ina_month = array (
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		return $ina_month[$month];
	}

	function to_indonesia_full_day($day) {
		$ina_day = array (
			'Sat' => 'Sabtu',
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat'
		);
		return $ina_day[$day];
	}

	function to_indonesia_timestamp($time_stamp) {
		$date = date('d m Y H:i:s', strtotime($time_stamp));
		$split = explode(' ', $date);
		return $split[0] . ' ' . $this->to_indonesia_short_month((int)$split[1]) . ' ' . $split[2] . ' ' . $split[3];
	}

	function to_indonesia_date($time_stamp) {
		$date = date('d m Y', strtotime($time_stamp));
		$split = explode(' ', $date);
		return $split[0] . ' ' . $this->to_indonesia_short_month((int)$split[1]) . ' ' . $split[2];
	}

	function to_indonesia_date_full($time_stamp) {
		$date = date('d m Y', strtotime($time_stamp));
		$split = explode(' ', $date);
		return $split[0] . ' ' . $this->to_indonesia_full_month((int)$split[1]) . ' ' . $split[2];
	}

	function birth_date_to_age($date) {
		$bday = new DateTime($date); // Your date of birth
		$today = new Datetime(date('m/d/Y'));
		$diff = $today->diff($bday);

		$age = $diff->y . ' Tahun ' .  $diff->m . ' Bulan ' . $diff->d . ' Hari';
		return $age;
	}
}