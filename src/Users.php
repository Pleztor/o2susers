<?php namespace O2s\Users;



class Users {

	// we need to detect the namespace in use by the containing application
	use \Illuminate\Console\AppNamespaceDetectorTrait;
	
	protected $model;

	// Assume we are using the default "App" namespace to begin,
	// this will be overridden if needed.
	protected $userClass = '\App\User';

	public function __construct(\Illuminate\Database\Eloquent\Model $model = null) {
		if ($model) {
			$this->model = $model;
		}
		else {
			$this->userClass = $this->getAppNamespace() .'User';
			$this->model = new $this->userClass;
		}
	}


	public function listAll() {
		return $this->model->orderBy('name')->get();
	}

	public function save($data) {
		if (is_array($data)) {
			$user = new $this->userClass;
			if (array_key_exists('id', $data) AND $data['id'] > 0) {
				$user = $user->find($data['id']);
			}

			if (array_key_exists('name', $data)) { $user->name = $data['name']; }
			if (array_key_exists('email', $data)) { $user->email = $data['email']; }
			if (array_key_exists('password', $data)) { $user->password = \Hash::make($data['password']); }

			if ( ! $user->id ) {
				// assign a hashid
				$user->hashid = uniqid();
			}

			return $user->save();
		}

		return null;
	}

}