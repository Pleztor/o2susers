<?php namespace O2s\Users;

class Users {

	protected $model;

	public function __construct($model) {
		if ($model) {
			$this->model = $model;
		}
		else {
			$this-model = new \App\User;
		}
	}


	public function listAll() {
		return $this->model->all()->orderBy('name')->get();
	}

	
}