<?php namespace O2s\Users;

use Illuminate\Support\Facades\Facade;

class UsersFacade extends Facade {
	protected static function getFacadeAccess() { return 'Users'; }
}