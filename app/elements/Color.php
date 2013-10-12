<?php namespace Elements;

class Color {
	public $fields = array(
		'color' => 'required|between:5,12',
		'x' => 'required|numeric',
		'y' => 'required|numeric',
		'xscale' => 'required|numeric',
		'yscale' => 'required|numeric'
	);

	public $process = array();
}