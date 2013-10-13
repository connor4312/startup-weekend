<?php namespace Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Models\Board;

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
		if ($validator->fails()) {
			return Redirect::to('/board')->withErrors($validator);
		}

		$board = new Board;
		$board->user_id = Auth::user()->id;
		$board->key = str_random(64);
		$board->name = Input::get('name');
		$board->save();

		$this->pushBoards();
		
		return Redirect::to('/board/' . $board->key);
	}

	public function view($key) {
		if (!$b = Board::where('key', $key)->first()) {
			return App::abort(404);
		}

		return View::make('pages.board')
			->with('scripts', array(
				'js/raphael.min.js',
				'js/ajaxForm.min.js',
				'js/colorPicker.min.js',
				'js/canvas.min.js'
			))
			->with('board', $b);
	}

	public function makePublic($key) {

		$to = array_key_exists('true', $_GET) ? 1 : 0;

		DB::table('boards')
			->where('key', $key)
			->update(array('public' => '1'));

	}

}