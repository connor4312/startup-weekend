<?php namespace Repos;

use Illuminate\Support\Facades\Input;

class ImgRemote {

	private static $allowedTypes = array(
		'image/png' => 'png',
		'image/gif' => 'gif',
		'image/jpg' => 'jpg',
		'image/jpeg' => 'jpg',
		'image/bmp' => 'bmp',
	);

	public static function download() {
		$file = self::grabFile(Input::get('url'), 'tmp');

		if (!array_key_exists($file['mime'], self::$allowedTypes)) {
			return array('success' => false, 'data' => 'Not a valid image, ' . $file['mime']);
		}

		$newpath = preg_replace('/tmp$/', self::$allowedTypes[$file['mime']], $file['path']);
		rename($file['path'], $newpath);

		return array('success' => 'true', 'data' => array($newpath));
	}

	public static function shot() {
		preg_match('/[0-9]+|-[A-z]+$/', Input::get('url'), $matches);
		if (!array_key_exists(0, $matches)) {
			return array('success' => false, 'error' => 'Bad URL');
		}

		$curl = new \Curl;
		$data = json_decode($curl->simple_get('http://api.dribbble.com/shots/' . $matches[0]));

		if (!isset($data->image_url)) {
			return array('success' => false, 'Could not find shot');
		}

		return array('success' => true, 'data' => array(self::grabFile($data->image_url)['path']));
	}

	public static function bucket() {
		if (!preg_match('/\/\/dribbble.com\/[A-z_\-]+\/buckets\/[0-9A-z_\-]+/', Input::get('url'))) {
			return array('success' => false, 'error' => 'Bad URL');
		}

		$curl = new \Curl;
		$data = $curl->simple_get(Input::get('url'));

		preg_match_all('/dribbble\.s3\.amazonaws\.com\/users\/[0-9]+\/screenshots\/[0-9]+\/[0-9A-z_\-]+\.png/', $data, $matches);

		$out = array();
		foreach ($matches[0] as $m) {
			$out[] = self::grabFile('http://' . $m)['path'];
		}
		return array('success' => true, 'data' => $out);
	}

	private static function grabFile($url, $extension = null) {
		$name = str_random(32);

		$ext = $extension ? $extension : substr(strrchr($url, '.'), 1);

		$path = storage_path() . '/' . $name . '.' . $ext;

		$fp = fopen($path, 'w');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch);
		$mime = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
		curl_close($ch);
		fclose($fp);

		return compact('path', 'mime');
	}

}