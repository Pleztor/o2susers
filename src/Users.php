<?php namespace O2s\Users;

class Users {

	protected $model;

	public function __construct(\App\User $model = null) {
		if ($model) {
			$this->model = $model;
		}
		else {
			$this->model = new \App\User;
		}
	}


	public function listAll() {
		return $this->model->orderBy('name')->get();
	}

	public function save($data) {
		if (is_array($data)) {
			$user = new \App\User;
			if (array_key_exists('id', $data) AND $data['id'] > 0) {
				$user = \App\User::find($data['id']);
			}

			if (array_key_exists('name', $data)) { $user->name = $data['name']; }
			if (array_key_exists('email', $data)) { $user->email = $data['email']; }
			if (array_key_exists('password', $data)) { $user->password = \Hash::make($data['password']); }

			return $user->save();
		}

		return null;
	}

}