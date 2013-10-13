<?php namespace Repos;

use Illuminate\Support\Facades\Input;

class ImgUpload {

	public static function upload() {
		return Input::file('file')->getRealPath();;
	}

}