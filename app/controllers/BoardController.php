<?php namespace Controllers;

use Illuminate\Support\Facades\View;

class BoardController extends \BaseController {

	/**
	 * Shows the board view
	 * @return \Illuminate\View\View
	 */
	public function index() {
		return View::make('pages.allboards');
	}

	/**
	 * Shows the board view
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return View::make('pages.board');
	}

}