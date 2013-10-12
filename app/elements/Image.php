<?php namespace Elements;

use Illuminate\Support\Facades\Input;

class Image {
	public $fields = array(
		'url' => 'required:url|image',
		'x' => 'required|numeric',
		'y' => 'required|numeric',
		'xscale' => 'required|numeric',
		'yscale' => 'required|numeric'
	);

	public $this->process = array();
}