<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	private function pushBoards() {
		if (Auth::check()) {
			Session::put('boards', Boards::where('user_id', Auth::user()->id));
		} else {
			Session::forget('boards');
		}

	}

}