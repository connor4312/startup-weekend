<?php namespace Controllers;

use Illuminate\Support\Facades\View;

class ResourceController extends \BaseController {

	public function __call($method, $arguments) {
		dd($arguments);
	}

}