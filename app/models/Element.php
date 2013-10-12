<?php namespace Models;

class Element extends \Eloquent {

	public function board() {
		return $this->belongsTo('Board');
	}
}