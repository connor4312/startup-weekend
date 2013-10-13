<?php namespace Elements;

class Color {
	public $fields = array(
		'color' => 'required|between:3,8',
		'index' => 'required|numeric',
		'x' => 'required|numeric',
		'y' => 'required|numeric',
	);

	public $process = array();
}