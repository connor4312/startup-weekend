<?php namespace Controllers;

use Illuminate\Support\Facades\View;

class Controller extends \BaseController {

	/**
	 * Shows the board view
	 * @return \Illuminate\View\View
	 */
	public function index() {
		return View::make('pages.board');
	}

}