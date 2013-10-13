<?php namespace Elements;

use Illuminate\Support\Facades\Input;

class Image {
	public $fields = array(
		'url' => 'required|url',
		'x' => 'required|numeric',
		'y' => 'required|numeric',
		'index' => 'required|numeric',
		'width' => 'required|numeric',
		'height' => 'required|numeric'
	);

	public $process = array();
}