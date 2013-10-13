<?php namespace Repos;

class ImgDribbble {

	public function shot($url) {
		preg_match('/[0-9]+|-[A-z]+$/', $url, $matches);
		if (!array_key_exists(0, $matches)) {
			return false;
		}

		$curl = new Curl;
		$data = json_decode($curl->simple_get('http://api.dribbble.com/shots/' . $matches[0]));

		if (!isset($data->image_url)) {
			return false;
		}

		$path = storage_path() . '/' . $name . '.tmp';

		$name = str_random(32);
		$fp = fopen($path, 'w');
		$ch = curl_init($data->image_url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);

		return $path;
	}

}