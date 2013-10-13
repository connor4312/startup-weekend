<?php namespace Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Models\Board;
use Models\Element;

use Elements\Image;
use Elements\Color;
use Elements\Text;

class ResourceController extends \BaseController {

	private $types = array(
		'image',
		'color',
		'text'
	);

	public function __call($methods, $args) {

		list($resource, $method) = explode('_', $methods);

		$this->type = $resource;

		$resource = 'Elements\\' . ucwords($resource);

		$mod = new $resource();

		$this->fields = $mod->fields;
		$this->process = $mod->process;
		$this->redis = Redis::connection();

		$response = array();

		if (!$o = $this->checkBoard()) {
			$response = array(
				'success' => false,
				'error' => 'Board Not Found'
			);
			return $response;
		}

		return call_user_func_array(array($this, $method), $args);
	}

	public function bulkGet() {
		$this->redis = Redis::connection();

		if (!$o = $this->checkBoard()) {
			$response = array(
				'success' => false,
				'error' => 'Board Not Found'
			);
			return $response;
		}

		$elems = Element::where('board_id', $this->board->id)
			->select('id')
			->get();

		$out = array();
		foreach ($elems as $elem) {
			$out[] = getData($elem->id);
		}

		return array(
			'success' => true,
			'data' => $out
		);
	}

	public function bulkSave() {
		$this->redis = Redis::connection();

		if (!$o = $this->checkBoard()) {
			$response = array(
				'success' => false,
				'error' => 'Board Not Found'
			);
			return $response;
		}
		if (!is_array(Input::get('elements'))) {
			return array(
				'success' => false,
				'error' => 'Elements not given'
			);
		}
		foreach (Input::get('elements') as $elem) {
			$type = $elem['type'];
			$ctype = 'Elements\\' . ucwords($type);

			$class = new $ctype;
			$validator = Validator::make($elem, $class->fields);
			if ($validator->fails()) {
				return array('sucess' => false, 'error' => $validator->messages()->toArray());
			}

			$e = DB::table('elements')->insertGetId(array(
					'type' => $type,
					'board_id' => $this->board->id
				)
			);

			foreach ($class->fields as $key => $v) {
				$this->redis->hset($this->key($e), $key, Input::get($key));
			}
		}
		return array('success' => true);
	}

	private function checkBoard() {
		if (!$this->board = Board::where('key', Input::get('board'))->first()) {
			return false;
		}
		return true;
	}

	private function edit($id, $response) {
		$validator = Validator::make(Input::all(), $this->fields);
		if ($validator->fails()) {
			return array('sucess' => false, 'error' => $validator->messages);
		}

		if (!$e = Element::where('id', $id)->where('board_id', $this->board->id)->select('id')->first()) {
			return array('sucess' => false, 'error' => 'Element not found');
		}

		foreach ($this->fields as $key => $v) {
			$this->redis->hset($this->key($e->id), $key, Input::get($key));
		}
		return array('success' => true);
	}

	private function create() {
		$validator = Validator::make(Input::all(), $this->fields);
		if ($validator->fails()) {
			return array('sucess' => false, 'error' => $validator->messages);
		}

		$e = DB::table('elements')->insertGetId(array(
				'type' => $this->type,
				'board_id' => $this->board->id
			)
		);

		foreach ($this->fields as $key => $v) {
			$this->redis->hset($this->key($e), $key, Input::get($key));
		}
		return array('success' => true);
	}

	private function delete($id) {

		if (!$e = Element::where('id', $id)->where('board_id', $this->board->id)->select('id')->first()) {
			return array('sucess' => false, 'error' => 'Element not found');
		}

		$this->redis->del($this->key($e->key));
		Element::find($id)->delete();

		return array('success' => true);
	}

	private function get($id) {

		if (!$e = Element::where('id', $id)->where('board_id', $this->board->id)->select('id')->first()) {
			return array('sucess' => false, 'error' => 'Element not found');
		}

		return array(
			'success' => true,
			'data' => $this->redis->hgetall($this->key($e->id))
		);
	}

	private function index() {
		$elems = Element::where('board_id', $this->board->id)
			->where('type', $this->type)
			->select('id')
			->get();

		$out = array();
		foreach ($elems as $elem) {
			$out[] = getData($elem->id);
		}

		return array(
			'success' => true,
			'data' => $out
		);
	}

	private function getData($id) {
		return $this->redis->hgetall($this->key($id));
	}

	private function key($id) {
		return 'mooody:elem:' . $key;
	}
}