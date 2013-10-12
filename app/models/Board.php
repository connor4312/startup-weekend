<?php namespace Models;

class Board extends \Eloquent {

	public function elements() {
		return $this->hasMany('Element');
	}
}