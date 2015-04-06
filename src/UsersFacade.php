<?php namespace O2s\Users;

use Illuminate\Support\Facades\Facade;

class O2sUsersFacade extends Facade {
	protected static function getFacadeAccess() { return 'O2sUsers'; }
}