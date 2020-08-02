<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TracingConstant extends CI_Model {
	function ya_tidak() {
		return array(
			'1' => 'YA', 
			'0' => 'TIDAK' 
		);
	}

	function status_pasien() {
		return array(
			'DALAM PERAWATAN' => 'DALAM PERAWATAN',
			'ISOLASI MANDIRI' => 'ISOLASI MANDIRI',
			'SELESAI ISOLASI' => 'SELESAI ISOLASI',
			'MENINGGAL' => 'MENINGGAL',
			'DISCARDED' => 'DISCARDED'
		);
	}

	function hasil_lab() {
		return array(
			'1' => 'Positif COVID-19', 
			'0' => 'Negatif COVID-19' 
		);
	}

	function hasil_rapid_test() {
		return array(
			'1' => 'Reaktif', 
			'0' => 'Non Reaktif' 
		);
	}

	function kategori_kasus() {
		return array(
			'KONFIRMASI' => 'KONFIRMASI', 
			'SUSPEK' => 'SUSPEK',
			'PROBABLE' => 'PROBABLE'
		);
	}

	function hasil_pemantauan() {
		return array(
			'SEHAT' => 'SEHAT',
			'DEMAM' => 'DEMAM',
			'BATUK' => 'BATUK',
			'SESAK NAPAS' => 'SESAK NAPAS',
			'GEJALA LAIN' => 'GEJALA LAIN',
			'AMAN' => 'AMAN',
			'RUJUK' => 'RUJUK',
			'MANGKIR' => 'MANGKIR'
		);
	}

	function kecamatan() {
		return array(
			'BANYUSARI' => 'BANYUSARI',
			'BATUJAYA' => 'BATUJAYA',
			'CIAMPEL' => 'CIAMPEL',
			'CIBUAYA' => 'CIBUAYA',
			'CIKAMPEK' => 'CIKAMPEK',
			'CILAMAYA' => 'CILAMAYA',
			'CILAMAYA' => 'CILAMAYA',
			'CILEBAR' => 'CILEBAR',
			'JATISARI' => 'JATISARI',
			'JAYAKARTA' => 'JAYAKARTA',
			'KARAWANG' => 'KARAWANG',
			'KARAWANG' => 'KARAWANG',
			'KLARI' => 'KLARI',
			'KOTABARU' => 'KOTABARU',
			'KUTAWALUYA' => 'KUTAWALUYA',
			'LEMAHABANG' => 'LEMAHABANG',
			'MAJALAYA' => 'MAJALAYA',
			'PAKISJAYA' => 'PAKISJAYA',
			'PANGKALAN' => 'PANGKALAN',
			'PEDES' => 'PEDES',
			'PURWASARI' => 'PURWASARI',
			'RAWAMERTA' => 'RAWAMERTA',
			'RENGASDENGKLOK' => 'RENGASDENGKLOK',
			'TEGALWARU' => 'TEGALWARU',
			'TELAGASARI' => 'TELAGASARI',
			'TELUKJAMBE' => 'TELUKJAMBE',
			'TELUKJAMBE' => 'TELUKJAMBE',
			'TEMPURAN' => 'TEMPURAN',
			'TIRTAJAYA' => 'TIRTAJAYA',
			'TIRTAMULYA' => 'TIRTAMULYA'
		);
	}

	function kelurahan() {
		return array(
			'BANYUASIH' => 'BANYUASIH',
			'BATUJAYA' => 'BATUJAYA',
			'KUTAMEKAR' => 'KUTAMEKAR',
			'CEMARAJAYA' => 'CEMARAJAYA',
			'CIKAMPEK BARAT' => 'CIKAMPEK BARAT',
			'BAYUR KIDUL' => 'BAYUR KIDUL',
			'CIKALONG' => 'CIKALONG',
			'CIKANDE' => 'CIKANDE',
			'BALONGGANDU' => 'BALONGGANDU',
			'CIPTAMARGA' => 'CIPTAMARGA',
			'ADIARSA BARAT' => 'ADIARSA BARAT',
			'ADIARSA TIMUR' => 'ADIARSA TIMUR',
			'ANGGADITA' => 'ANGGADITA',
			'CIKAMPEK UTARA' => 'CIKAMPEK UTARA',
			'KUTAGANDOK' => 'KUTAGANDOK',
			'CIWARINGIN' => 'CIWARINGIN',
			'BENGLE' => 'BENGLE',
			'SOLOKAN' => 'SOLOKAN',
			'CINTAASIH' => 'CINTAASIH',
			'DONGKAL' => 'DONGKAL',
			'CENGKONG' => 'CENGKONG',
			'BALONGSARI' => 'BALONGSARI',
			'AMANSARI' => 'AMANSARI',
			'CADASKERTAJAYA' => 'CADASKERTAJAYA',
			'CIGUNUNGSARI' => 'CIGUNUNGSARI',
			'KARANGLIGAR' => 'KARANGLIGAR',
			'PINAYUNGAN' => 'PINAYUNGAN',
			'CIKUNTUL' => 'CIKUNTUL',
			'BOLANG' => 'BOLANG',
			'BOJONGSARI' => 'BOJONGSARI',
			'CIPTASARI' => 'CIPTASARI',
			'CINTALAKSANA' => 'CINTALAKSANA',
			'KUTAPOHACI' => 'KUTAPOHACI'
		);
	}

}

?>