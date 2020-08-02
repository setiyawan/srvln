<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Validator extends CI_Model {
	function image_validator($path, $image_name, $default_image_name){
		if(file_exists($path . $image_name) && $image_name != null && $image_name != "" ) {
			return base_url(). $path . $image_name;
		} else {
			return base_url(). $path . $default_image_name;
		}
	}
}