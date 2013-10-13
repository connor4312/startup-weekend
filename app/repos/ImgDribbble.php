<?php namespace Repos;

use Illuminate\Support\Facades\Input;

class ImgDribbble {

	public static function shot() {
		preg_match('/[0-9]+|-[A-z]+$/', Input::get('url'), $matches);
		if (!array_key_exists(0, $matches)) {
			return false;
		}

		$curl = new \Curl;
		$data = json_decode($curl->simple_get('http://api.dribbble.com/shots/' . $matches[0]));

		if (!isset($data->image_url)) {
			return false;
		}

		return self::grabFile($data->image_url);
	}

	public static function bucket() {
		if (!preg_match('/\/\/dribbble.com\/[A-z_\-]+\/buckets\/[0-9A-z_\-]+/', Input::get('url'))) {
			return false;
		}

		$curl = new \Curl;
		$data = $curl->simple_get(Input::get('url'));

		preg_match_all('/dribbble\.s3\.amazonaws\.com\/users\/[0-9]+\/screenshots\/[0-9]+\/[0-9A-z_\-]+\.png/', $data, $matches);

		$out = array();
		foreach ($matches[0] as $m) {
			$out[] = self::grabFile('http://' . $m);
		}dd($out);
		return $out;
	}

	private static function grabFile($url) {
		$name = str_random(32);
		$path = storage_path() . '/' . $name . '.tmp';

		$fp = fopen($path, 'w');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);

		return $path;
	}

}