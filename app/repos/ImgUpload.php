<?php namespace Repos;

class ImgUpload {

	public static function upload() {
		return Input::file('file')->getRealPath();;
	}

}