<?php namespace Models;

class Board extends \Eloquent {

	public function elements() {
		return $this->hasMany('Models\Element');
	}

	public function user() {
		return $this->belongsTo('User');
	}
}