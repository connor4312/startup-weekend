<?php namespace Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ImageController extends \BaseController {

	private $types = array(
		'dribbbleBucket' => array(
			'action' => 'Repos\ImgDribbble@bucket'
			'validation' => array(
				'url' => 'required|regex:^http:\/\/dribbble.com\/[A-z]+\/buckets\/.+$'
			)
		),
		'dribbblePost' => array(
			'action' => 'Repos\ImgDribbble@shot'
			'validation' => array(
				'url' => 'required|regex:^http:\/\/dribbble.com\/shots\/.+$'
			)
		),
		'url' => array(
			'action' => 'Repos\ImgURL@download'
			'validation' => array(
				'url' => 'required|url'
			)
		),
		'upload' => array(
			'action' => 'Repos\ImgUpload@upload'
			'validation' => array(
				'file' => 'mimes:jpg,png,bmp,gif'
			)
		)
	);

	public function upload() {

		if (!$this->checkBoard()) {
			return array('success' => false, 'error' => 'Board Not Found');
		}
		if (!array_key_exists($type = Input::get('type'), $this->types)) {
			return array('success' => false, 'error' => 'Type Not Found');
		}

		$validator = Validator::make(Input::get('all'), $this->types[$type]['validation']);
		if ($validator->fails) {
			return array('success' => false, 'error' => $validator->messages());
		}

		list($class, $method) = explode('@', $this->types[$type]['action']);

		return $this->awsUpload($class::$method);

	}

	private function awsUpload($path) {

	}

	private function checkBoard() {
		if (!$this->board = Board::where('key', Input::get('board'))->first()) {
			return false;
		}
		return true;
	}

}