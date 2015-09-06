<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	/**
	 * Returns a boolean indicating if the current user is an administrative user or not.
	 * NOTE: This should be evolved to allow multiple admin accounts
	 * @return boolean
	 */
	public function is_Admin() {
		if ($this->id == 1 || $this->isAdmin == 1) {
			return true;
		}
		return false;
	}


	/**
	 * Override the default save
	 * If the incoming data is new, set the hashid
	 * @param  array  $options
	 */
	public function save(array $options = array()) {
		if ( ! $this->id ) {
			if (\Schema::hasColumn('users', 'hashid')) {
				// assign a hashid
				$this->hashid = uniqid();
			}
		}
		parent::save();
	}

}
