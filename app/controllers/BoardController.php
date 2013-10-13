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
			->with('boards', Auth::user()->boards)
			->with('scripts', 'js/createboard.min.js');
	}

	/**
	 * Shows the board view
	 * @return \Illuminate\View\View
	 */
	public function create() {
		$validator = Validator::make(Input::all(), array(
			'name' => 'required|between:3,50'
		));
		return View::make('pages.board');
	}

}