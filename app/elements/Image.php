<?php namespace Elements;

class Image {
	public static $fields = array(
		'url' => 'required_without:data|url',
		'data' => 'required_without:url|image',
		'x' => 'required|numeric',
		'y' => 'required|numeric',
		'xscale' => 'required|numeric',
		'yscale' => 'required|numeric'
	);

	public static $process = array(
		'data' => function() {
			return file_get_contents(Input::file('data')->getRealPath());
		}
	);
}