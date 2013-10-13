<?php namespace Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class BoardController extends \BaseController {

	/**
	 * Shows the board view
	 * @return \Illuminate\View\View
	 */
	public function index() {
		return View::make('pages.allboards')
			->with('boards', Auth::user()->boards);
	}

	/**
	 * Shows the board view
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return View::make('pages.board');
	}

}