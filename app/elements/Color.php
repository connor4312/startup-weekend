<?php namespace Elements;

class Color {
	public static $fields = array(
		'color' => 'required|size:6',
		'x' => 'required|numeric',
		'y' => 'required|numeric',
		'xscale' => 'required|numeric',
		'yscale' => 'required|numeric'
	);

	public static $process = array();
}