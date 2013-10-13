<?php namespace Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use S3;
use Models\Board;


class ImageController extends \BaseController {

	private $types = array(
		'dribbbleBucket' => array(
			'action' => 'Repos\ImgDribbble@bucket',
			'validation' => array(
				'url' => 'required|regex:/^http:\/\/dribbble.com\/[A-z]+\/buckets\/.+$/'
			)
		),
		'dribbblePost' => array(
			'action' => 'Repos\ImgDribbble@shot',
			'validation' => array(
				'url' => 'required|regex:/^http:\/\/dribbble.com\/shots\/.+$/'
			)
		),
		'url' => array(
			'action' => 'Repos\ImgURL@download',
			'validation' => array(
				'url' => 'required|url'
			)
		),
		'upload' => array(
			'action' => 'Repos\ImgUpload@upload',
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

		$validator = Validator::make(Input::all(), $this->types[$type]['validation']);
		if ($validator->fails()) {
			return array('success' => false, 'error' => $validator->messages());
		}

		list($class, $method) = explode('@', $this->types[$type]['action']);

		return $this->awsUpload((array) call_user_func(array($class, $method)));

	}

	private function awsUpload($input) {
		if (!$input['success']) {
			return array('success' => false, 'error' => $input['error']);
		}
		
		$this->s3 = new S3(Config::get('mooody.awsAccessKey'), Config::get('mooody.awsSecretKey'));

		$paths = array();
		foreach ($input as $in) {
			if (!$in) {
				continue;
			}
			$paths[] = $this->saveFile($in);
		}
		return array('success' => true, 'data' => $paths);
	}

	private function getExtension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}

	private function saveFile($file) {
		$extension = $this->getExtension($file);
		$id = DB::table('aws')
			->insertGetId(array(
				'board_id' => Input::get('board'),
				'extension' => $extension,
				'created_at' => DB::raw('NOW()')
			));

		$name = 'upload' . $id . '.' . $extension;

		$this->s3->putObject(S3::inputFile($path, false), 'mooody', $name, S3::ACL_PUBLIC_READ);

		unlink($path);

		return 'http://s3.amazonaws.com/mooody/' . $name;
	}

	private function checkBoard() {
		if (!$this->board = Board::where('key', Input::get('board'))->first()) {
			return false;
		}
		return true;
	}

}