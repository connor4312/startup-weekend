<?php namespace Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use User;

class LoginController extends \BaseController {

	/**
	 * Shows the login view
	 * @return \Illuminate\View\View
	 */
	public function view() {
		return View::make('pages.login');
	}

	/**
	 * Shows the registry view
	 * @return \Illuminate\View\View
	 */
	public function regview() {
		return View::make('pages.signup');
	}

	/**
	 * Tries to register a user
	 */
	public function regsubmit() {
		$validator = Validator::make(Input::all(), array(
			'email' => 'required|email',
			'password' => 'required|between:5,20',
			'company' => 'max:50'
		));

		if ($validator->fails()) {
			return Redirect::to('/account/register')->withErrors($validator);
		}

		if (User::where('email', Input::get('email'))->count()) {
			return Redirect::to('/account/register')->withErrors('That email has already been taken');
		}

		$user = new User;
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->company = (string) Input::get('company');
		$user->save();

		Auth::login($user);
		return Redirect::to('/board');
	}

	/**
	 * Validates a login request
	 * @return type
	 */
	public function submit() {
		$messages = array();

		if ($this->isLockedOut()) {
			$messages[] = $this->lockedMessage();
		} elseif (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
			Session::set('login.attempts', 0);
			return Redirect::intended('/');
		} else {
			$messages[] = 'Invalid email or password.';
			if ($m = $this->updateLocks()) {
				$messages[] = $m;
			}

		}

		return Redirect::to('/account/login')->withErrors($messages);
	}

	/**
	 * Checks to see if the client has been locked out
	 * @return boolean
	 */
	private function isLockedOut() {
		return Session::get('login.locktill', 0) > time() ? true : false;
	}

	/**
	 * Returns a locked out message, with a time till unlock
	 * @return string
	 */
	private function lockedMessage() {
		$carbon = new Carbon(date('Y-m-d H:i:s', Session::get('login.locktill')));
		return 'Login temporarily blocked. Try again in ' . $carbon->diffForHumans() . '.';
	}

	/**
	 * Updates failed login attempts, returning an apropriate error if
	 * a lockout has occured
	 * @return void|string
	 */
	private function updateLocks() {

		$attempts = Session::get('login.attempts', 0);
		Session::set('login.attempts', $attempts + 1);

		if ($attempts >= 4) {
			Session::put('login.locktill', time() + 300);
			return 'Login temporarily blocked.';
		}

		return null;
	}

	/**
	 * Logs out the user; clears auth and wipes session variables
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout() {
		Auth::logout();
		Session::flush();
		return Redirect::to($this->url('view'))->withErrors('success: Logged out.');
	}

}