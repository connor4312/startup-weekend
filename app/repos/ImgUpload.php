<?php namespace Repos;

use Illuminate\Support\Facades\Input;

class ImgUpload {

	public static function upload() {
		return array('success' => true, 'data' => array(Input::file('file')->getRealPath()));
	}

}