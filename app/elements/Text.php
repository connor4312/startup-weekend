<?php namespace Elements;

class Text {
	public $fields = array(
		'content' => 'required',
		'font' => 'required',
		'size' => 'required|numeric',
		'index' => 'required|numeric',
		'x' => 'required|numeric',
		'y' => 'required|numeric'
	);

	public $process = array();
}