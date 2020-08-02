<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ternary extends CI_Model {
	function isset_value($option1='', $option2='') {
		return isset($option1) ? $option1 : $option2;
	}

	function isempty_value($option1='', $option2='') {
		return !empty($option1) ? $option1 : $option2;
	}

	function istrue_value($is_true=false, $option1='', $option2='') {
		return $is_true ? $option1 : $option2;
	}

	function iscontain_value($plain_text, $word, $option1='', $option2='') {
		return strpos($plain_text, $word) !== false ? $option1 : $option2;
	}
}